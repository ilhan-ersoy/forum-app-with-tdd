<div class="w-full bg-white hover:shadow hover:border-gray-300 transition ease-in duration-100  border-gray-200 border my-3 p-5 p-6">
    <div class="text-lg p-3  border-b-2">
        <a href="#" class="text-blue-400 hover:underline">{{ $reply->owner->name }}</a>
        said {{ $reply->created_at->diffForHumans() }}
        <i class="fa text-blue-500 text-lg fa-comment mx-2"></i>
    </div>

    <div class="text-left w-full p-2 mt-3">
        {{ $reply->body }}
    </div>
</div>
