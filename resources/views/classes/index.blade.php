<x-guest-layout>

    {{-- <div class="flex flex-col gap-5">
        <form class="border" action="{{ route('classes.store') }}" method="POST">
            @csrf
            <button type="submit">create class</button>
        </form> --}}

    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Title</label>
            <input type="text" id="name" name="name"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="datetime" class="block text-gray-700 font-medium">Date and Time</label>
            <input type="datetime-local" id="datetime" name="datetime"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium">Description</label>
            <input type="text" id="description" name="description"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-medium">Style</label>
            <select id="category" name="category"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                <option value="samba">samba</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="level" class="block text-gray-700 font-medium">Level</label>
            <select id="level" name="level"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                <option value="beginner">beginner</option>
                <option value="advanced">advanced</option>
            </select>

        </div>
        <div class="mb-4">
            <label for="instructor" class="block text-gray-700 font-medium">Instructor</label>
            <input type="text" id="instructor" name="instructor"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="enrollment_mode" class="block text-gray-700 font-medium">Enrollment Mode</label>
            <select id="enrollment_mode" name="enrollment_mode"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                <option value="single">single</option>
                <option value="term">term</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-medium">Location</label>
            <select id="location" name="location"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                <option value="the studio">the studio</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium">Price</label>
            <input type="number" id="price" name="price"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-6">
            <button type="submit"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
        </div>
    </form>



    <h1>Classes by Name</h1>
    <ul>
        @foreach ($classes as $class)
            <a href="{{ route('classes.show', ['class' => $class]) }}">{{ $class->name }}</a>
        @endforeach
    </ul>

    </div>

</x-guest-layout>
