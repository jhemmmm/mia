<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manageTable()
    {
      $books = Book::with(['category'])->where('user_id', Auth::id())->get();

      return view('user.managetable', [
        'books' => $books,
      ]);
    }
}
