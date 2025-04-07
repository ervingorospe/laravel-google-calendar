<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interface\GoogleCalendarRepositoryInterface;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Carbon\Carbon;

class GoogleCalendarService
{
    protected $googleRepo;

    public function __construct(GoogleCalendarRepositoryInterface $googleRepo)
    {
        $this->googleRepo = $googleRepo;
    }

    public function getEvents(User $user, $calendarId = 'primary')
    {
        try {
            return $this->googleRepo->listEvents($user, $calendarId);
        } catch (\Exception $e) {
            // Handle logging or fallback logic here
            throw $e;
        }
    }

    public function getEvent(User $user, $id, $calendarId = 'primary') {
        try {
            return $this->googleRepo->getEvent($id, $user,$calendarId);
        } catch (\Exception $e) {
            throw new \Exception("Failed to fetch event: " . $e->getMessage());
        }
    }

    public function deleteEvent($user, $id, $calendarId = 'primary')
    {
        try {
            return $this->googleRepo->deleteEvent($id,$user,  $calendarId);
        } catch (\Google_Service_Exception $e) {
            // Handle error (e.g., event not found)
            throw new \Exception("Failed to delete event: " . $e->getMessage());
        }
    }

    public function createEvent(array $data, User $user, $calendarId = 'primary')
    {
        try {
            $data['start_date'] = $this->formatToRFC3339($data['start_date']);
            $data['end_date'] = $this->formatToRFC3339($data['end_date']);

            return $this->googleRepo->createEvent($data, $user, $calendarId);
        } catch (\Google_Service_Exception $e) {
            // Handle error (e.g., event not found)
            throw new \Exception("Failed to Create event: " . $e->getMessage());
        }
    }

    public function updateEvent(array $data, User $user, $id, $calendarId = 'primary')
    {
        try {
            $data['start_date'] = $this->formatToRFC3339($data['start_date']);
            $data['end_date'] = $this->formatToRFC3339($data['end_date']);

            return $this->googleRepo->updateEvent($data, $user, $id, $calendarId);
        } catch (\Google_Service_Exception $e) {
            // Handle error (e.g., event not found)
            throw new \Exception("Failed to Create event: " . $e->getMessage());
        }
    }

    private function formatToRFC3339(string $datetime): string
    {
        return Carbon::parse($datetime)->toRfc3339String();
    }
}
