<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;
use App\User;
use App\Item;
use App\Table;
use Carbon\Carbon;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      //Admin dashboard
      $total_reservation = Book::whereDate('created_at', Carbon::today())->count();
      $total_registration = User::whereDate('created_at', Carbon::today())->count();
      $total_items = Item::count();
      $total_cancel_order = Book::where('status', 5)->count();
      $total_product = Category::count();
      $total_table = Table::count();

      //Admin product
      $categories = Category::get();

      return view('admin.index', [
        'dashboard' => [
          'total_reservation' => $total_reservation,
          'total_registration' => $total_registration,
          'total_cancel_order' => $total_cancel_order,
          'total_items' => $total_items,
          'total_product' => $total_product,
          'total_table' => $total_table,
        ],
        'product' => [
          'categories' => $categories,
        ],
      ]);
    }

    public function manageTable()
    {
      $books = Book::with(['category'])->where('user_id', Auth::id())->get();

      return view('user.managetable', [
        'books' => $books,
      ]);
    }
}
