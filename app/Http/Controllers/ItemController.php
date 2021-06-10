<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Character $character)
    {
        if (is_null($character)) {
            $items = Item::all();
        } else {
            $items = $character->items()->get();
        }
        return view('items.index', compact(['items', 'character']));
    }
    public function create(Character $character)
    {
        if (!Auth::check()) {
            abort(401, "Authentication required");
        }
        return view('items.create')->with(compact(['character']));
    }
    public function store(Request $request, Character $character)
    {
        if (!Auth::check()) {
            abort(401, "Authentication required");
        }

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        if (is_null($character))
            abort(404, "Model not found");

        $data["character_id"] = $character->id;
        $data["user_id"] = Auth::id();
        Item::create($data);
        return redirect()->route('items.create', $character)
            ->with('success', 'Объект создан.');

    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
