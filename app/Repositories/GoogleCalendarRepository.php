<?php

// App/Repositories/GoogleCalendarRepository.php

namespace App\Repositories;

use App\Models\User;
use Google_Client as GoogleClient;
use App\Repositories\Interface\GoogleCalendarRepositoryInterface;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class GoogleCalendarRepository implements GoogleCalendarRepositoryInterface
{
    protected function getGoogleClient(User $user): GoogleClient
    {   
        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(route('google.callback'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setAccessToken([
            'access_token' => $user->google_token,
            'refresh_token' => $user->google_refresh_token,
            'expires_in' => $user->token_expires_in,
            'created' => now()->subMinutes(5)->timestamp, // fudge factor to make sure refresh triggers if needed
        ]);

        // Refresh token if needed
        if ($client->isAccessTokenExpired()) {
            $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $user->update([
                'google_token' => $newToken['access_token'],
                'token_expires_in' =>  $newToken['expires_in'] ?? null,
            ]);
        }

        return $client;
    }

    public function redirectToGoogleLogin()
    {
        return Socialite::driver('google')
            ->scopes([env('GOOGLE_CALENDAR_SCOPES')])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }

    public function login()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => null,
            ]);
        }

        $user->google_token = $googleUser->token;
        $user->google_refresh_token = $googleUser->refreshToken;
        $user->token_expires_in = $googleUser->expiresIn;
        $user->save();

        Auth::login($user, true);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function listEvents($user, $calendarId = 'primary')
    {
        $client = $this->getGoogleClient($user);
        $service = new Calendar($client);
        // 'timeMin' => now()->toRfc3339String(),

        $oneWeekAgo = now()->subWeek()->startOfDay()->toRfc3339String();

        $events = $service->events->listEvents($calendarId, [
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => $oneWeekAgo,
        ]);

        return $events->getItems();
    }

    public function createEvent(array $data, $user, $calendarId = 'primary')
    {
        $client = $this->getGoogleClient($user);
        $service = new Calendar($client);

        $event = $this->formattingEventData($data);

        return $service->events->insert($calendarId, $event);
    }

    public function updateEvent(array $data, $user, $id, $calendarId = 'primary')
    {
        $client = $this->getGoogleClient($user);
        $service = new Calendar($client);

        $event = $this->formattingEventData($data);

        return $service->events->update($calendarId, $id, $event);
    }

    public function deleteEvent($eventId, $user, $calendarId = 'primary')
    {
        $client = $this->getGoogleClient($user);
        $service = new Calendar($client);

        return $service->events->delete($calendarId, $eventId);
    }

    public function getEvent($eventId, $user, $calendarId = 'primary')
    {
		$client = $this->getGoogleClient($user);
        $service = new Calendar($client);

		return $service->events->get($calendarId, $eventId);
    }

    protected function formattingEventData(array $data) {
        $event = new Event([
            'summary' => $data['title'],
            'description' => $data['description'] ?? '',
            'location' => $data['location'] ?? '',
            'start' => [
                'dateTime' => $data['start_date'],
                'timeZone' => 'Asia/Manila',
            ],
            'end' => [
                'dateTime' => $data['end_date'],
                'timeZone' => 'Asia/Manila',
            ],
        ]);

        return $event;
    }
}
