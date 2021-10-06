<x-app-layout>
    <div class="w-full bg-white border-gray-200 border rounded-xl shadow p-5 p-6">
        <div class="text-2xl font-semibold p-5  border-b-2 border-gray-200 mb-4">
            <a href="#" class="text-blue-400 hover:underline">{{ $thread->creator->name }}</a> posted :
            {{ $thread->title }}
        </div>

        <div class="p-4 text-lg">
            {{ $thread->body }}
        </div>

    </div>

    @foreach ($thread->replies as $reply)

        @include('threads.reply')

    @endforeach
    <div class="w-full bg-white hover:shadow hover:border-gray-300 transition ease-in duration-100  border-gray-200 border my-3 rounded-xl p-5 p-6">

    @if(auth()->check())
            <form action="/threads/{{ $thread->id }}/replies" method="POST">
                <div class="w-full mb-2 text-center text-2xl">
                    Leave A Comment <i class="fa fa-comment text-blue-500"></i>
                </div>
                @csrf
                <textarea placeholder="Have something to say ?" id="body" class="w-full shadow placeholder-blue-500 border-blue-400 rounded-lg p-4" name="body" cols="30" rows="10"></textarea>
                <div class="text-center">
                    <button type="submit" class="shadow bg-blue-200 hover:bg-blue-400 rounded hover:border-white hover:text-white hover:font-semibold transition ease-in duration-150 p-2">Send Comment</button>
                </div>
            </form>
    @else
            <p class="w-full text-center">
                Please <a href="/login" class="text-blue-500 hover:underline">Sign</a> In For Leave A Comment !
            </p>
    @endif

    </div>

</x-app-layout>
