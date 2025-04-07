@extends('layouts.auth-layout')

@section('title', 'Google Calendar')

@section('content')
    <div class="container mt-16">
        @if (session('success'))
            <x-success-alert/>
        @endif

        @if (session('failed'))
            <x-error-alert/>
        @endif

        <x-events-table :events="$events"/>
    </div>
@endsection