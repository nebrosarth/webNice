<?php

use App\Models\Character;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/character', function (Request $request) {
    $id = $request->get("id");
    $ch = Character::where("id", $id)->first();
    $isFriend = Auth::user()->friends->where('friend_id', $ch->user_id)->first() != null;
    return $ch->toArray() + ['is_friend' => $isFriend];
});
Route::middleware('auth:api')->post('/character', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'name2' => 'required',
        'description2' => 'required',
        'image_url' => 'required',
        'date1' => 'required',
    ]);
    $data['user_id'] = Auth::user()->id;
    $ch = Character::create($data);
    return $ch;
});

Route::middleware('auth:api')->put('/character', function (Request $request) {
    $data = $request->validate([
        'id' => 'required',
    ]);
    $data = $data + [
            'name' => $request->get('name', ''),
            'description' => $request->get('description', ''),
            'name2' => $request->get('name2', ''),
            'description2' => $request->get('description2', ''),
            'image_url' => $request->get('image_url', ''),
            'date1' => $request->get('date1', '')
        ];
    $ch = Character::where('id', $data['id'])->first();
    if($data['name'] != '')
        $ch->name = $data['name'];
    if($data['description'] != '')
        $ch->description = $data['description'];
    if($data['name2'] != '')
        $ch->name2 = $data['name2'];
    if($data['description2'] != '')
        $ch->description2 = $data['description2'];
    if($data['image_url'] != '')
        $ch->image_url = $data['image_url'];
    if($data['date1'] != '')
        $ch->date1 = $data['date1'];
    $ch->save();
    return $ch;
});

Route::middleware('auth:api')->get('/item', function (Request $request) {
    $id = $request->get("id");
    $item = Item::where("id", $id)->first();
    $ch = Character::where('id', $item->character_id)->first();
    $isFriend = Auth::user()->friends->where('friend_id', $item->user_id)->first() != null;
    return ["Item" => $item->toArray() + ['is_friend' => $isFriend], 'Character' => $ch->toArray()];
});

Route::middleware('auth:api')->post('/item', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'character_id' => 'required'
    ]);
    $data['user_id'] = Auth::user()->id;
    $item = Item::create($data);
    $character = Character::where('id', $item->character_id)->first();
    return ["Item" => $item->toArray(), "Character" => $character->toArray()];
});

Route::middleware('auth:api')->put('/item', function (Request $request) {
    $data = $request->validate([
        'id' => 'required',
    ]);
    $data = $data + [
            'name' => $request->get('name', ''),
            'description' => $request->get('description', ''),
        ];
    $item = Item::where('id', $data['id'])->first();
    if($data['name'] != '')
        $item->name = $data['name'];
    if($data['description'] != '')
        $item->description = $data['description'];
    $item->save();
    $character = Character::where('id', $item->character_id)->first();
    return ["Item" => $item->toArray(), 'Character' => $character->toArray()];
});
