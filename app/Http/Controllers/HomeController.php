<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = null;
        if(Auth::id())
          $books = Book::with(['category'])->where('user_id', Auth::id())->get();

        $categories = Category::get();

        $per_head = Category::where('type', 1)->get();
        $per_pack = Category::where('type', 0)->get();

        return view('welcome', [
          'per_head' => $per_head,
          'per_pack' => $per_pack,
          'categories' => $categories,
          'books' => $books,
        ]);
    }
}
