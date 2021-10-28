<x-app-layout>
    <div class="w-2/3 mx-auto ">
        <div class="text-2xl text-gray-500 bg-white border-gray-200 border shadow p-5 p-6 font-semibold p-5 border-b-2 border-gray-200 mb-4">
            {{ auth()->user()->name ? 'Your Threads' : 'All Threads'  }}
        </div>
        @foreach ($threads as $thread)
            <article class="my-4 p-7 bg-white border-gray-200 border shadow">
                <div class="level">
                    <div class="flex items-center justify-between">
                        <h4 class="mb-2 font-bold text-blue-400 flex max-w-2xl items-center justify-between text-xl hover:underline">
                            <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                        </h4>

                        <strong class="m-3 float-right text-gray-500 flex items-center">
                            {{ $thread->replyCount }} {{ \Illuminate\Support\Str::plural('reply', $thread->replyCount) }} <img class="ml-2" src="https://img.icons8.com/external-sbts2018-flat-sbts2018/26/000000/external-comment-social-media-basic-1-sbts2018-flat-sbts2018.png"/>
                        </strong>
                    </div>

                    <div class="text-lg">{{ $thread->body }}</div>
                </div>
            </article>
        @endforeach
    </div>

</x-app-layout>
