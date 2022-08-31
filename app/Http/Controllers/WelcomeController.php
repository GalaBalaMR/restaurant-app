<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $contents = Content::all();
        return view('welcome', compact('categories', 'contents'));
    }
}
