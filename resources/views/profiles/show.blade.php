<x-app-layout>
    <div class="w-full">
        <div class="header border-b-2 border-gray-400 p-4 flex items-center">
            <span class="text-7xl">{{ $profileUser->name }}</span>
            <span class="ml-8 text-2xl">{{ $profileUser->created_at->diffForHumans() }} <i class="fa fa-clock text-blue-500"></i></span>
        </div>

        @foreach ($threads as $thread)
            <div class="w-2/3 mx-auto bg-white border-gray-200 border shadow p-6 my-5">
                <div class="font-semibold p-5 border-b-2 border-gray-200 mb-4 flex items-center justify-between w-full">
                    <div class="thread-head flex items-center">
                        <span class="max-w-min border-r-2 border-blue-500 pr-2">
                            <a href="#" class="text-blue-400 hover:underline">{{ $thread->creator->name }}</a> posted:
                        </span>
                        <span class="text-lg ml-2">
                            {{ $thread->title }}
                        </span>
                    </div>
                    <div class="border-l-2 border-blue-500 pl-2">{{ $thread->created_at->diffForHumans() }}</div>
                </div>

                <div class="p-4 ">
                    {{ $thread->body }}
                </div>

            </div>
        @endforeach
        <div class="bg-white p-2 rounded-lg border-none">
            {{ $threads->links() }}
        </div>
    </div>

</x-app-layout>
