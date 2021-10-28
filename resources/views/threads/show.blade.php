<x-app-layout>
    <div class="flex">
        <div class="w-2/3">
            <div class="w-full bg-white border-gray-200 border shadow p-6">
                <div class="font-semibold p-5 border-b-2 border-gray-200 mb-4">
                    <a href="#" class="text-blue-400 hover:underline">{{ $thread->creator->name }}</a> posted :
                    {{ $thread->title }}
                </div>

                <div class="p-4 ">
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

            @foreach ($replies as $reply)

                @include('threads.reply')

            @endforeach

            <div class="my-2">
                {{ $replies->links() }}
            </div>

            @if(auth()->check())
                <form action="/threads/w{{ $thread->channel }}/{{ $thread->id }}/replies" method="POST">
                    @csrf
                    <textarea placeholder="Have something to say ?" id="body" class="w-full border-none shadow placeholder-blue-500 focus:outline-none rounded-lg p-4" name="body" cols="30" rows="10"></textarea>

                    <div class="text-center">
                        <button type="submit"
                                class="flex items-center justify-center shadow mt-2 w-full bg-blue-200 hover:bg-blue-400 rounded hover:border-white hover:text-white hover:font-semibold transition ease-in duration-150 p-2">
                            <span>Send Comment</span>
                            <img class="w-8 ml-2 " src="https://img.icons8.com/external-sbts2018-flat-sbts2018/58/000000/external-comment-social-media-basic-1-sbts2018-flat-sbts2018.png"/>

                        </button>
                    </div>
                </form>
            @else
                <p class="w-full text-center ">
                    Please <a href="/login" class="text-blue-500 hover:underline">Sign</a> In For Leave A Comment !
                </p>
            @endif

        </div>
        <div class="w-1/3 ml-4 bg-white border-gray-200 border shadow p-5 text-gray-500 font-bold max-h-64 ">
            This threads published <span class="text-blue-500 hover:underline">{{ $thread->created_at->diffForHumans()  }}</span>
            by <a href="#" class="text-blue-500 hover:underline">{{ $thread->creator->name }}</a>
            and currently has
            <span class="text-blue-500 hover:underline">{{$thread->replyCount}} {{ \Illuminate\Support\Str::plural('comment', $thread->replyCount) }}</span>
        </div>
    </div>
</x-app-layout>
