<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        
        return view('content.index', compact('contents'));
    }
    // return view with form for create a content
    public function create()
    {
        return view('content.create');
    }

    // store and validation content 
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'content' => 'required'
        ]);

        Content::create([
            'name'  => $request->name,
            'content'  => html_entity_decode($request->content),
        ]);

        if($request->ajax())
        {
            return response()->json(['flash' => 'Podarilo sa vytvoriť nový kontent.',
                                     'status'=> '1'
                                    ]);
        }
        return back()->with(['flash' => 'Podarilo sa vytvoriť nový kontent.',
                                 'name'  => $request->name ,
                                 ]);
    }

    public function edit(Content $content)
    {
        return view('content.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'name'    => 'required',
            'content' => 'required'
        ]);

        $content->update([
            'name'  => $request->name,
            'content'  => $request->content
        ]);

        if($request->ajax())
        {
            return response()->json(['flash' => 'Podarilo sa upraviť kontent.',
                                     'content'  => $request->content ,
                                     'name'  => $request->name ,
                                     'status'=> '1'
                                    ]);
        }
        return back()->with(['flash' => 'Podarilo sa upraviť kontent.',
                                 'name'  => $request->name ,
                                 'status'=> '1'
                                 ]);

    }

    public function destroy(Request $request ,Content $content)
    {
        $id = $content->id;
        $content->delete();

        if($request->ajax())
        {
            return response()->json(['flash' => 'Kontent bol odstránený',
                                     'id'  => $id ,
                                     'status'=> '1'
                                    ]);
        }
        return back()->with(['info' => 'Kontent bol odstránený','type'  => 'danger']);

    }
}
