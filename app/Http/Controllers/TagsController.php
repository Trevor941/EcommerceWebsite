<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        if($request->slug){
            $tag->slug = Str::slug($request->slug, '-');
        }
        else{
            $tag->slug = Str::slug($tag->name, '-');
        }
        $tag->description = $request->description;
         $tag->save();
    return redirect(route('tags.index'))->with('success', 'New tag created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag =  Tag::findOrFail($id);
        $tags = Tag::paginate(10);
        return view('tags.index', compact('tag', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag =  Tag::findOrFail($id);
        $tag->name = $request->name;
        if($request->slug){
            $tag->slug = Str::slug($request->slug, '-');
        }
        else{
            $tag->slug = Str::slug($tag->name, '-');
        }
        $tag->description = $request->description;
        $tag->update();
    return redirect(route('tags.index'))->with('success', 'Tag updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return Redirect()->back();
    }
}
