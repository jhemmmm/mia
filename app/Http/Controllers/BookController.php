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
