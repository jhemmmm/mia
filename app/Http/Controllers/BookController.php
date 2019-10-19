<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Table;
use App\Book;
use App\BookCategory;
use Carbon\Carbon;
use Auth;

class BookController extends Controller
{

    public function getBookByID(Request $request)
    {
      $book_id = $request->id;
      $books = Book::with(['category'])->where('id', $book_id )->first();

      return response()->json([
        'status' => 'success',
        'result' => $books,
      ]);
    }

    public function saveOrder(Request $request)
    {
      $book_id = $request->id;
      $time = strtotime($request->time);
      $book = Book::where('id', $book_id )->first();
      if(!$book)
        return response()->json([
          'status' => 'error',
          'message' => 'Unable to find the order!',
        ]);

      $book->time = $time;
      $book->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Order time has been updated!',
      ]);
    }

    public function cancelOrder(Request $request)
    {
      $book_id = $request->id;
      $book = Book::where('id', $book_id )->first();
      if(!$book)
        return response()->json([
          'status' => 'error',
          'message' => 'Unable to find the order!',
        ]);

      $book->status = 5;
      $book->save();

      return response()->json([
        'status' => 'warning',
        'message' => 'Your order has been canceled',
      ]);
    }

    public function availableTable(Request $request)
    {
      if(!Auth::id())
        return response()->json([
          'status' => 'login'
        ]);

      $totalPerson = $request->totalPerson;
      $tables = Table::where('min', '<=', $totalPerson)->where('max', '>=', $totalPerson)->get();
      $availableTables = array();
      foreach($tables as $table)
      {
        $book = Book::where('table_id', $table->id)->first();
        if(!$book)
          $availableTables[] = $table->id;
      }

      return response()->json([
        'status' => (count($availableTables) == 0) ? 'fail' : 'success',
        'result' => $availableTables,
      ]);
    }

    public function saveBook(Request $request)
    {
      if(!Auth::id())
        return response()->json([
          'status' => 'login'
        ]);

      $tableid = $request->tableId;
      $totalPerson = $request->totalPerson;
      $date = strtotime($request->date);
      $categoryId = $request->categoryId;
      $categoryQuantity = $request->categoryQuantity;

      $book = new Book;
      $book->user_id = Auth::id();
      $book->table_id = $tableid;
      $book->total_person = $totalPerson;
      $book->time = $date;
      $book->save();

      foreach($categoryId as $index => $id){
        $bookCategory = new BookCategory;
        $bookCategory->book_id = $book->id;
        $bookCategory->category_id = $id;
        $bookCategory->category_quantity = $categoryQuantity[$index];
        $bookCategory->save();
      }

      return response()->json([
        'status' => 'success'
      ]);
    }
}
