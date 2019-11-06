<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use App\Category;
use App\Book;
use App\User;
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
          $books = Book::with(['category'])->where('status', '!=', 0)->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        $categories = Category::get();

        $per_head = Category::where('type', 1)->get();
        $per_pack = Category::where('type', 0)->get();

        $admin = User::find(1);

        return view('welcome', [
          'per_head' => $per_head,
          'per_pack' => $per_pack,
          'categories' => $categories,
          'books' => $books,
          'admin' => $admin,
        ]);
    }

    public function success(Request $request)
    {
      if(!$request->token)
        return abort(404);

      $book = Book::with(['category'])->where('transaction_token', $request->token)->first();
      if(!$book)
        return abort(404);
      
      $book->status = 1;
      $book->save();

      $total = 0;
      foreach($book->category as $category){
        $total += $category->price * $category->pivot->category_quantity;
      }

      return view('success', [
        'book' => $book,
        'total' => $total,
      ]);
    }
}
