<x-app-layout>
    <div>
        <div class="header border-b-2 border-gray-400 p-4">
            <span class="text-7xl">{{ $profileUser->name }}</span>
            <span class="ml-8 text-2xl">{{ $profileUser->created_at->diffForHumans() }}</span>
        </div>

        @foreach ($threads as $thread)
            <div class="w-full bg-white border-gray-200 border shadow p-6 my-2">
                <div class="font-semibold p-5 border-b-2 border-gray-200 mb-4">
                    <a href="#" class="text-blue-400 hover:underline">{{ $thread->creator->name }}</a> posted :
                    {{ $thread->title }}
                </div>

                <div class="p-4 ">
                    {{ $thread->body }}
                </div>

            </div>
        @endforeach
    </div>

</x-app-layout>
