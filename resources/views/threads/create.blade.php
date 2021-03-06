<x-app-layout>
    <div class="w-full bg-white border-gray-200 border rounded-xl shadow p-5 p-6">
        <div class="text-center w-full text-2xl font-bold text-gray-600 ">
            CREATE A POST !
        </div>
        <br>
        <hr>
        <br>
        <form method="POST" action = "/threads">
            {{ csrf_field() }}

            <div class="form-group p-4 m-2">
                <div class="font-semibold text-gray-600 text-center mb-2 text-lg">
                    Title
                </div>
                <input placeholder="Title..." type="text" name="title" class="border-blue-400 placeholder-blue-500 p-2 w-full rounded-lg shadow" value="{{ old('title') }}">
            </div>

            <div class="form-group p-4 m-2">
                <div class="font-semibold text-gray-600 text-center mb-2 text-lg">
                    Channel
                </div>
                <select name="channel_id" class="border-blue-400 w-full placeholder-blue-500 text-blue-500 placeholder-blue-500 p-2 rounded-lg shadow" required>
                    <option value="">Choose One...</option>

                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}" {{ old('channel_id') === "$channel->id" ? 'selected' : '' }}>{{ $channel->name }}</option>
                    @endforeach


                </select>
            </div>

            <div class="form-group p-4 m-2 ">
                <div class="font-semibold text-gray-600 text-center mb-2 text-lg">
                    Body
                </div>
                <textarea placeholder="Content..." id="body" class="w-full shadow placeholder-blue-500 border-blue-400 rounded-lg p-4" name="body" cols="30" rows="10"></textarea>
            </div>

            @if (count($errors))
                <div class="form-group p-4 m-2 bg-red-400">
                    <div class="font-semibold text-white text-center mb-2 text-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="form-group text-center">
                <button type="submit" class="shadow w-full bg-blue-200 hover:bg-blue-400  rounded hover:border-white hover:text-white hover:font-semibold transition ease-in duration-150 p-2">Create</button>
            </div>

        </form>
    </div>

</x-app-layout>
