<form action="{{ $route }}"  method="POST" class="space-y-6">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif
    
    <div class="w-full">
        <label
            class="mb-2 block text-xs font-bold text-gray-600 uppercase"
            for="title"
        >
            Title
        </label>
        <input
            id="title"
            type="text"
            name="title"
            value="{{ old('title', $event->title ?? '') }}"
            class="w-full rounded border-0 bg-white px-3 py-3 text-sm shadow transition-all duration-150 ease-linear focus:ring focus:outline-none"
            placeholder="Morning Excercise"
        />
        @error('title')
            <p class="mt-2 text-sm font-bold text-red-500">*{{ $message }}</p>
        @enderror
    </div>

    <!-- Start Date and Time -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex flex-col w-full sm:w-1/2">
            <label for="start_date" class="mb-2 block text-xs font-bold text-gray-600 uppercase">Start Date and Time</label>
            <input 
                type="datetime-local" 
                id="start_date" 
                name="start_date" 
                value="{{ old('start_date', $event->start ?? '') }}"
                class="w-full rounded border-0 bg-white px-3 py-3 text-sm shadow transition-all duration-150 ease-linear focus:ring focus:outline-none" 
            >
            @error('start_date')
                <p class="mt-2 text-sm font-bold text-red-500">*{{ $message }}</p>
            @enderror
        </div>

        <!-- End Date and Time -->
        <div class="flex flex-col w-full sm:w-1/2">
            <label for="end_date" class="mb-2 block text-xs font-bold text-gray-600 uppercase">End Date and Time</label>
            <input 
                type="datetime-local" 
                id="end_date" 
                name="end_date" 
                value="{{ old('end_date', $event->end ?? '') }}"
                class="w-full rounded border-0 bg-white px-3 py-3 text-sm shadow transition-all duration-150 ease-linear focus:ring focus:outline-none"
            >
            @error('end_date')
                <p class="mt-2 text-sm font-bold text-red-500">*{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="w-full">
        <label
            class="mb-2 block text-xs font-bold text-gray-600 uppercase"
            for="description"
        >
            Description (Optional)
        </label>
        <textarea
            id="description"
            type="text"
            name="description"
            class="w-full rounded border-0 bg-white px-3 py-3 text-sm shadow transition-all duration-150 ease-linear focus:ring focus:outline-none"
            rows="4"
            placeholder="Description about the event"
        >{{ old('description', $event->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm font-bold text-red-500">*{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full">
        <label
            class="mb-2 block text-xs font-bold text-gray-600 uppercase"
            for="location"
        >
            Location (Optional)
        </label>
        <input
            id="location"
            type="text"
            name="location"
            value="{{ old('location', $event->location ?? '') }}"
            class="w-full rounded border-0 bg-white px-3 py-3 text-sm shadow transition-all duration-150 ease-linear focus:ring focus:outline-none"
            placeholder="Manila, Philippines"
        />
        @error('location')
            <p class="mt-2 text-sm font-bold text-red-500">*{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-6">
        <button
            class="button bg-primary-600 hover:shadow-lg text-white"
            type="submit"
        >
            {{ $method === 'PUT' ? 'Update' : 'Create' }} Event
        </button>
    </div>
</form>