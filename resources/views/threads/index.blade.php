<x-app-layout>
    <div class="w-full">
        <div class="text-2xl text-gray-500 bg-white border-gray-200 border shadow p-5 p-6 font-semibold p-5 border-b-2 border-gray-200 mb-4">
            {{ auth()->user()->name ? 'Your Threads' : 'All Threads'  }}
        </div>
        @foreach ($threads as $thread)
            <article class="my-4 p-5 bg-white border-gray-200 border shadow p-5 p-6">
                <h4 class="mb-2 font-bold text-blue-400 flex items-center justify-between text-2xl hover:underline">
                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                    <i class="fa fa-eraser w-5 text-red-500 cursor-pointer focus:underline">
                    </i>
                    <form action="/thread/" method="POST" class="hidden myForm" >
                        @csrf
                        <input type="text" name="thread_id" value="{{ $thread->id }}">
                    </form>
                </h4>
                <div>{{ $thread->body }}</div>

            </article>
        @endforeach
    </div>
</x-app-layout>
