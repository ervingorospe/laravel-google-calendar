@extends('layouts.auth-layout')

@section('title', 'Google Calendar')

@section('content')
	<div class="container mx-auto max-w-4xl mt-10 p-6 bg-white rounded-lg shadow-md mb-32">
		<div class="px-4 pb-6 lg:px-6 w-full flex items-center justify-between">
			<h2 class="text-2xl font-semibold text-gray-600">Update Event</h2>
			<div class="flex space-x-4">
				<button @click="active = '{{ $event->getId() }}'" class="cursor-pointer group p-3 rounded-full bg-red-700 hover:bg-red-800">
					<svg class="h-4 w-auto fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
					</svg>
				</button>
			</div>
		</div>

		<hr class="border-2 border-primary-600"/>
		
		<div class="px-4 py-10 lg:px-10">
			<x-event-form
				:route="route('event.update', $event->getId())" 
				method="PUT" 
				:event="$event" 
			/>
		</div>

		<x-confirmation-modal 
			eventId="{{ $event->getId() }}"
			title="Delete Event" 
			message="Are you sure you want to delete {{ $event->getSummary() }}?" 
		/>
	</div>
@endsection