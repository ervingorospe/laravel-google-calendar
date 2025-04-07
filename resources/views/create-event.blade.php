@extends('layouts.auth-layout')

@section('title', 'Google Calendar')

@section('content')
	<div class="container mx-auto max-w-4xl mt-10 p-6 bg-white rounded-lg shadow-md mb-32">
		<div class="px-4 pb-6 lg:px-6 w-full flex items-center justify-between">
			<h2 class="text-2xl font-semibold text-gray-600">Create New Event</h2>
		</div>

		<hr class="border-2 border-primary-600"/>
		
		<div class="px-4 py-10 lg:px-10">
			<x-event-form
                :route="route('event.store')" 
                method="POST" 
            />
		</div>
	</div>
@endsection