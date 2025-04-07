<?php

namespace App\Services;

use App\Repositories\Interface\GoogleCalendarRepositoryInterface;
use Illuminate\Http\Request;

class AuthService
{
    protected $googleRepo;

    public function __construct(GoogleCalendarRepositoryInterface $googleRepo)
    {
        $this->googleRepo = $googleRepo;
    }

    public function redirectToGoogleLogin()
    {
        return $this->googleRepo->redirectToGoogleLogin();
    }

    public function login()
    {
        $this->googleRepo->login();
    }

    public function logout(Request $request)
    {
        $this->googleRepo->logout($request);
    }
}
