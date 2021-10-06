<x-app-layout>
    <div class="w-full">
        <div class="text-2xl text-gray-500 bg-white border-gray-200 border rounded-xl shadow p-5 p-6 font-semibold p-5 border-b-2 border-gray-200 mb-4">
            Forum Threads...
        </div>
        @foreach ($threads as $thread)
            <article class="my-4 p-5 bg-white border-gray-200 border rounded-xl shadow p-5 p-6">
                <h4 class="mb-2 font-bold text-blue-400 text-2xl hover:underline">
                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                </h4>
                <div>{{ $thread->body }}</div>
            </article>
        @endforeach
    </div>
</x-app-layout>
