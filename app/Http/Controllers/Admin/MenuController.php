<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use Illuminate\Support\Facades\Storage;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
        $image = $request->file('image')->store('public/menus');

        $menu = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'price' => $request->price,
            'image' => $image,
        ]);

        if($request->has('categories')){
            $menu->categories()->sync($request->categories);
        }

        return redirect('/admin/menus/')->with(['info' => 'Vytvorili ste nové menu','type'  => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'price' => 'required',
        ]);
        $image = $menu->image;

        if($request->hasFile('image')){
            Storage::delete($menu->image);
            $image = $request->file('image')->store('public/menus');
        };

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'price' => $request->price,
            'image' => $image,
        ]);

        if($request->has('categories')){
            $menu->categories()->sync($request->categories);
        }
        return redirect('/admin/menus/')->with(['info' => 'Menu bolo upravené','type'  => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Storage::delete($menu->image);
        $menu->categories()->detach();
        $menu->delete();

        return redirect('/admin/menus')->with(['info' => 'Kategória bola odstránená','type'  => 'danger']);
    }

    public function search(Request $request)
    {
        $ingredient = $request->ingredient;

        $menuSearch = Menu::where('ingredients', 'like', '%'. $ingredient .'%')->get();

        if($menuSearch->count() > 0)
        {
            $flash = 'Podarilo sa nájsť menu';
            $status = '1';
            $type = 'success';
        }else{
            $flash = 'Nepodarilo sa nájsť menu';
            $status = '0';
            $type = 'danger';

        }

        if($request->ajax())
        {
            return response()->json(['flash' => $flash ,
                                     'status'=> $status
                                    ]);
        }
        return back()->with(['search' => $flash ,
                             'type'=> $type,
                             'menuSearch' => $menuSearch ]);
    }
}
