<x-app-layout>
    <div class="w-full bg-white border-gray-200 border shadow p-5 p-6">
        <div class="text-2xl font-semibold p-5  border-b-2 border-gray-200 mb-4">
            <a href="#" class="text-blue-400 hover:underline">{{ $thread->creator->name }}</a> posted :
            {{ $thread->title }}
        </div>

        <div class="p-4 text-lg">
            {{ $thread->body }}
        </div>

    </div>

    @if ($thread->replies->count() > 0)
        <div class="text-center w-full font-bold text-gray-500 m-4 text-2xl">
            Replies
        </div>
    @else
        <div class="text-center w-full font-bold text-gray-500 m-4 text-2xl">
            No replies yet ...
        </div>
    @endif

    @foreach ($thread->replies as $reply)

        @include('threads.reply')

    @endforeach
    <div class="w-full bg-white hover:shadow hover:border-gray-300 transition ease-in duration-100 border-gray-200 border my-3 p-5 p-6">


    @if(auth()->check())
            <form action="/threads/{{ $thread->channel }}/{{ $thread->id }}/replies" method="POST">
                <div class="w-full mb-2 text-center text-2xl">
                    Leave A Comment <i class="fa fa-comment text-blue-500"></i>
                </div>
                @csrf
                <textarea placeholder="Have something to say ?" id="body" class="w-full shadow placeholder-blue-500 border-blue-400 rounded-lg p-4" name="body" cols="30" rows="10"></textarea>
                <div class="text-center">
                    <button type="submit"
                            class="flex items-center justify-center shadow mt-2 w-full bg-blue-200 hover:bg-blue-400 rounded hover:border-white hover:text-white hover:font-semibold transition ease-in duration-150 p-2">

                        <span>Send Comment</span>
                        <img class="w-8 ml-2 " src="https://img.icons8.com/external-sbts2018-flat-sbts2018/58/000000/external-comment-social-media-basic-1-sbts2018-flat-sbts2018.png"/>

                    </button>
                </div>
            </form>
    @else
            <p class="w-full text-center">
                Please <a href="/login" class="text-blue-500 hover:underline">Sign</a> In For Leave A Comment !
            </p>
    @endif

    </div>

</x-app-layout>
