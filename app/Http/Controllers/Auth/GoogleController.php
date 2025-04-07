<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GoogleCalendarService;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    protected $authService;
    protected $googleCalendarService;

    public function __construct(AuthService $authService, GoogleCalendarService $googleCalendarService) 
    {
        $this->authService = $authService;
        $this->googleCalendarService = $googleCalendarService;
    }

    public function index()
    {
        return view('welcome');
    }

    public function redirectToGoogle()
    {
        return $this->authService->redirectToGoogleLogin();
    }

    // Handle Google callback and login the user
    public function handleGoogleCallback()
    {
        $this->authService->login();
        return redirect()->route('dashboard');
    }

    public function dashboard(Request $request)
    {
        try {
            $user = Auth::user();
            $events = $this->googleCalendarService->getEvents($user);
    
            return view('dashboard', ['events' => $events]);
        } catch (\Exception $e) {
            $this->authService->logout($request);
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return redirect('/');
    }

    public function show($id)
    {
        $user = Auth::user();
        $event = $this->googleCalendarService->getEvent($user, $id);
        // dd($event);
        return view('event', ['event' => $event]);
    }

    public function destroy($id) 
    {
        $user = Auth::user();

        if ($this->googleCalendarService->deleteEvent($user, $id)) {
            return redirect()->route('dashboard')->with('success', 'Event successfully deleted.');
        }

        return redirect()->route('dashboard')->with('failed', 'There is an erro deleting your event.');
    }

    public function create()
    {
        return view('create-event');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $user = Auth::user();
        $this->googleCalendarService->createEvent($validated, $user);

        return redirect()->route('dashboard')->with('success', 'New event successfully created.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $user = Auth::user();
        $this->googleCalendarService->updateEvent($validated, $user, $id );

        return redirect()->route('dashboard')->with('success', 'Event successfully Updated.');
    }
}
