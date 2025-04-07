<?php
// App/Repositories/Contracts/GoogleCalendarRepositoryInterface.php

namespace App\Repositories\Interface;

use Illuminate\Http\Request;

interface GoogleCalendarRepositoryInterface
{
    public function redirectToGoogleLogin();
    public function login();
    public function logout(Request $request);
    public function listEvents($user, $calendarId = 'primary');
    public function createEvent(array $data, $user, $calendarId = 'primary');
    public function updateEvent(array $data, $user, $id, $calendarId = 'primary');
    public function deleteEvent($eventId, $user, $calendarId = 'primary');
    public function getEvent($eventId, $user, $calendarId = 'primary');
}
