<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Character::all();
        return view('characters.index', compact(['characters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Character $character)
    {
        return view('characters.create', compact(['character']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'name2' => 'required',
            'description2' => 'required',
            'image_url' => 'required',
            'date1' => 'required',
        ]);
        Character::create($data);
        return redirect('/characters');
//        $path = $request->File('image_url')->store('public/character_images');
//        $data["image_url"] = $path;
//        $img = Image::make(Storage::path($path))->resize(300, 200)->encode('jpg', 85);
//        $img->Save(Storage::path($path)."thumb.jpg");
//        Character::Create($data);
//        $character = new Character();
//        $character->name = request('name');
//        $character->name2 = request('name2');
//        $character->description = request('description');
//        $character->description2 = request('description2');
//        $character->save();
//        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        return view('characters.modal', compact(['character']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        return view('characters.edit', compact(['character']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Character $character)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'name2' => 'required',
            'description2' => 'required',
            'image_url' => 'required',
            'date1' => 'required',
        ]);
        $character->update($data);
        return redirect('/characters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        $character->delete();

        return redirect()->route('characters.index')
            ->with('success', 'Project deleted successfully');
    }
}
