<?php

namespace App\Http\Controllers\Api;

use App\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;

class TagsController extends Controller
{
   
    public function index()
    {
        $tags = Tags::all();
        return TagResource::collection($tags);
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


       $tag = Tags::create([
            'tag_title'=>$request->tag_title,
         
        ]);

        return response()->json([
            'status' => (bool) $tag,
            'data'   => $tag,
            'message' => $tag ? 'Tag Created!' : 'Error Creating Tag'
        ]);

        // session()->flash('msg','The Tag has been Created');

        // return redirect('admin/tags/create');
    }

   
    public function show(Tags $tag)
    {
        return new TagResource($tag);
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
        $tags = $tag->update([
             'tag_title'=>$request->tag_title,
        ]);
        return response()->json([
            'status' => $tags,
            'message' => $tags ? 'Tag Updated!' : 'Error Creating Tag'
        ]);

        // session()->flash('msg','Your Tag Has been Updated');

        // return redirect('admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tags  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tags $tag)
    {
        $tags = $tag->delete();

        return response()->json([
            'status' => $tags,
            'message' => $tags ? 'Tag Deleted!' : 'Error Creating Tag'
        ]);

        // session()->flash('msg','The Tag Has been Deleted!!');

        // return redirect('admin/tags');
    }
}
