<div class="px-6">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold text-gray-900">Upcoming Events</h1>
        <p class="mt-2 text-sm text-gray-700">Note: This events are coming from your google calendar, any changes made here will reflect to your googel calendar.</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <a href="{{ route('event.create') }}" class="button bg-primary-600 text-white hover:bg-transparent hover:border-primary-600 hover:text-primary-600">Create Event</a>
    </div>
  </div>
  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle">
            <table class="min-w-full border-separate border-spacing-0">
                <thead>
                    <tr>
                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter sm:pl-6 lg:pl-8">Title</th>
                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter">Start Date & Time</th>
                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter">End Date & Time</th>
                    <th scope="col" class="sticky top-0 z-10 border-b hidden border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-filter sm:table-cell">Description</th>
                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 py-3.5 pr-4 pl-3 backdrop-blur-sm backdrop-filter sm:pr-6 lg:pr-8">
                        <span class="sr-only">Action</span>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td class="border-b border-gray-200 py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6 lg:pl-8">{{ $event->title }}</td>
                            <td class="border-b border-gray-200 px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $event->start }}</td>
                            <td class="border-b border-gray-200 px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $event->end }}</td>
                            <td class="hidden border-b border-gray-200 px-3 py-4 text-sm whitespace-nowrap text-gray-500 sm:table-cell">{{ Str::limit($event->description, 70) ?? '—' }}</td>
                            <td class="relative border-b border-gray-200 py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-8 lg:pr-8">
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <button @click="open = !open" class="cursor-pointer text-sm">
                                        <svg class="fill-secondary-700 h-4 w-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                        </svg>
                                    </button>
                                
                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-white z-10">
                                        <div class="py-1">
                                            <a href="{{ route('event.show', ['id' => $event->id]) }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                                                View
                                            </a>
                                            <a href="{{ route('event.show', ['id' => $event->id]) }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                                                Update
                                            </a>

                                            <button type="button" @click="active = '{{ $event->id }}'" class="cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <x-confirmation-modal 
                                eventId="{{ $event->id }}"
                                title="Delete Event" 
                                message="Are you sure you want to delete {{ $event->title }}?" 
                            />
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">No upcoming events found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
  