<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use App\Category;
use App\Table;
use App\Item;
use App\Book;
use App\BookCategory;
use Carbon\Carbon;
use App\Helper;
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

      if(!Auth::user()->hasVerifiedEmail())
          return response()->json([
            'status' => 'verify'
          ]);

      $totalPerson = $request->totalPerson;
      $time = Carbon::parse(strtotime($request->time));

      if((int)$time->format('H') < 10  || (int)$time->format('H') > 22)
          return response()->json([
            'status' => 'info',
            'message' => 'Shop is opened at 10:00 AM and closed at 10:00 PM',
          ]);

      $tables = Table::where('min', '<=', $totalPerson)->where('max', '>=', $totalPerson)->where('status', 1)->get();
      $availableTables = array();
      foreach($tables as $table)
      {
        //Carbon::parse(strtotime($request->time))
        $availableTables[] = $table->id;
        
        $books = Book::where('table_id', $table->id)->get();
        foreach($books as $book ){
          if($book->time->format('Y-m-d') == $time->format('Y-m-d')){
            if((int)$book->time->format('H') == (int)$time->format('H') 
            || ((int)$book->time->format('H')+1) == (int)$time->format('H')
            || ((int)$book->time->format('H')-1) == (int)$time->format('H')){
              if(($key = array_search($table->id, $availableTables)) !== false) {
                  unset($availableTables[$key]);
              }
            }
          }
        }
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

      $provider = new ExpressCheckout;

      $tableid = $request->tableId;
      $totalPerson = $request->totalPerson;
      $date = strtotime($request->date);
      $categoryId = $request->categoryId;
      $categoryQuantity = $request->categoryQuantity;
      $data = [];

      foreach($categoryId as $index => $id){
        $item = Category::with(['item'])->find($id);
       
        $data['items'][$index]['name'] = $item->name;
        $data['items'][$index]['price'] = $item->price;
        $data['items'][$index]['desc'] = $item->description;
        $data['items'][$index]['qty'] = $categoryQuantity[$index];

        foreach($item->item as $item){
          if($item->total < ($item->pivot->item_value * $categoryQuantity[$index])){
            return response()->json([
              'status' => 'fail',
              'message' => 'Not enough ' . $item->name . ', the item has ' . $item->total . (($item->type == 1)? 'g' : ''),
            ]);
          }else{
            $item->total -= $item->pivot->item_value;
            $item->save();
          }
        }
      }
    
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

      $data['invoice_id'] = $book->id;
      $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
      $data['return_url'] = url('/success');
      $data['cancel_url'] = url('/home');

      $total = 0;
      foreach($data['items'] as $item) {
          $total += $item['price']*$item['qty'];
      }

      $data['total'] = $total; 
      
      $response = $provider->setExpressCheckout($data);
      $book->transaction_token = $response['TOKEN'];
      $book->save();

      return response()->json([
          'redirect_url' => $response['paypal_link'],
      ]);
    }
}
