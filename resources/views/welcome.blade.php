@extends('layouts.default-layout')

@section('title', 'Google Calendar')

@section('content')
    <div class="w-full px-4 md:w-3/4 xl:w-3/12">
        <div class="relative mb-6 flex w-full min-w-0 flex-col rounded-lg border-0 bg-white break-words shadow-lg">
            <div class="mb-0 rounded-t px-6 py-6">
                <div class="mb-3 text-center">
                    <h2 class="text-4xl font-black text-gray-600 uppercase tracking-wide">Welcome</h2>
                    <p class="text-sm mt-2 text-gray-400">Example Laravel App for Google Calendar</p>
                </div>
            </div>
            <div class="w-auto flex px-4 pb-10">
                <a
                    href="{{ route('google.login') }}"
                    class="button mx-auto bg-transparent border border-green-600 text-green-600 hover:shadow-lg flex"
                >
                    <svg class="h-6 mr-2 w-auto fill-primary-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M386.1 228.5c1.8 9.7 3.1 19.4 3.1 32C389.2 370.2 315.6 448 204.8 448c-106.1 0-192-85.9-192-192s85.9-192 192-192c51.9 0 95.1 18.9 128.6 50.3l-52.1 50c-14.1-13.6-39-29.6-76.5-29.6-65.5 0-118.9 54.2-118.9 121.3 0 67.1 53.4 121.3 118.9 121.3 76 0 104.5-54.7 109-82.8H204.8v-66h181.3zm185.4 6.4V179.2h-56v55.7h-55.7v56h55.7v55.7h56v-55.7H627.2v-56h-55.7z"/></svg>
                    <span>Sign in with Google</span>
                </a>
            </div>
        </div>
    </div>
@endsection