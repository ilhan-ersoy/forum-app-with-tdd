<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reply;

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->favorite();

        return back();
    }
}
