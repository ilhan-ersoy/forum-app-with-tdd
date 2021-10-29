<div class="w-full bg-white hover:shadow hover:border-gray-300 transition ease-in duration-100  border-gray-200 border my-3 p-5 p-6">
    <div class="text-lg p-3  border-b-2 flex justify-between">
        <div class="title">
            <a href="#" class="text-blue-400 hover:underline">{{ $reply->owner->name }}</a>
            said {{ $reply->created_at->diffForHumans() }}
            <i class="fa text-blue-500 text-lg fa-comment mx-2"></i>
        </div>
        <div class="favorite float-right flex items-center border-2 border-gray-300 rounded-lg hover:shadow cursor-pointer p-2 rounded-lg">
            <form action="/replies/{{$reply->id}}/favorites" method="POST">
                @csrf
                {{ $reply->favorites()->count() }}
                <button type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }} class="font-mono text-sm">{{ \Illuminate\Support\Str::plural('Favorite', $reply->favorites()->count()) }}</button>
{{--                <img class="mb-2" src="https://img.icons8.com/external-sbts2018-blue-sbts2018/30/000000/external-favorite-social-media-basic-1-sbts2018-blue-sbts2018.png"/>--}}
            </form>
        </div>
    </div>

    <div class="text-left w-full p-2 mt-3">
        {{ $reply->body }}
    </div>
</div>
