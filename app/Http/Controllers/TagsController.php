<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
   
    public function index()
    {
        $tags = Tags::all();
        return view('Admin.Tags.index', compact('tags'));
    }

    
    public function create(Tags $tag)
    {
        return view('Admin.Tags.create',compact('tag'));
    }

    public function store(Request $request,Tags $tag)
    {
        $attributes = $request->validate([
            'tag_title'=>'required',
        ]);


        Tags::create([
            'tag_title'=>$request->tag_title,
         
        ]);

        session()->flash('msg','The Tag has been Created');

        return redirect('admin/tags/create');
    }

   
    public function show(Tags $tag)
    {
        return view('Admin.tags.details', compact('tag'));
    }

    public function edit(Tags $tag)
    {
        return view('Admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tags $tag)
    {
        $attributes = $request->validate([
            'tag_title'=>'required',
        ]);
        $tag->update([
             'tag_title'=>$request->tag_title,
        ]);

        session()->flash('msg','Your Tag Has been Updated');

        return redirect('admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tags  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tags $tag)
    {
        $tag->delete();

        session()->flash('msg','The Tag Has been Deleted!!');

        return redirect('admin/tags');
    }
}
