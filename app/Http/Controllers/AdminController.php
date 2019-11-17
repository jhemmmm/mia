<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\CategoryItem;
use App\Book;
use App\User;
use App\Item;
use App\Table;
use Carbon\Carbon;
use Auth;
use Validator;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
	  //Admin dashboard
	  $total_reservation = Book::where('status', 1)->whereDate('created_at', Carbon::today())->count();
	  $total_registration = User::whereDate('created_at', Carbon::today())->count();
	  $total_items = Item::count();
	  $total_cancel_order = Book::where('status', 5)->count();
	  $total_product = Category::count();
	  $total_table = Table::count();

	  //Admin product
	  $categories = Category::with(['item'])->get();

	  //Admin items
	  $items = Item::get();

	  //Admin tables
	  $tables = Table::get();

	  //Admin reservation
	  $books = Book::with(['user', 'category'])->where('status', '!=', 0)->orderBy('time', 'asc')->get();
	  $canceled_books = Book::with(['user', 'category'])->where('status', 5)->orderBy('time', 'asc')->get();

	  //Admin user
	  $users = User::where('id', '!=', 1)->get();

	  //Sales report
	  $sales = Book::with(['user','category' => function($q){
		  $q->with(['item']);
	  }])->where('status', 1);

	  $sort = $request->sort ?? 0;
	  switch ((int)$sort)
	  {
		case 1:
			$sales = $sales->whereDate('created_at', Carbon::today()->subDays(7))->get();
			break;
		case 2:
			$sales = $sales->whereDate('created_at', Carbon::today()->subDays(30))->get();
			break;
		default:
			$sales = $sales->whereDate('created_at', Carbon::today())->get();
			break;
	  }

	  return view('admin.index', [
		'admin_sale' => [
			'sales' => $sales,
		],
		'dashboard' => [
		  'total_reservation' => $total_reservation,
		  'total_registration' => $total_registration,
		  'total_cancel_order' => $total_cancel_order,
		  'total_items' => $total_items,
		  'total_product' => $total_product,
		  'total_table' => $total_table,
		],
		'admin_book' => [
			'books' => $books,
			'canceled_books' => $canceled_books,
		],
		'product' => [
		  'categories' => $categories,
		  'items' => $items,
		],
		'admin_item' => [
			'items' => $items,
		],
		'admin_table' => [
			'tables' => $tables,
		],
		'admin_user' => [
			'users' => $users
		],
	  ]);
	}

	public function editNormalUser(Request $request)
	{
		$user = User::find(Auth::id());
		if(!Hash::check($request->cur_password, $user->password))
			return response()->json([
				'status' => 'error',
				'message' => 'Invalid current password.',
			]);
		
		
		
		$validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'address' => ['required', 'string', 'min:8'],
            'mobile' => ['required', 'digits:11'],
        ]);
		
		if($validator->fails()){
			$error = $validator->errors()->first();
			return response()->json([
				'status' => 'error',
				'message' => $error,
			]);
		}

		$user->name = $request->name;
		$user->email = $request->email;
		$user->address = $request->address;
		$user->optional_address = $request->optional_address;
		$user->mobile = $request->mobile;

		if(isset($request->password)){
			$validator = Validator::make($request->all(), [
				'password' => ['required', 'string', 'min:8', 'confirmed'],
			]);
		
			if($validator->fails())
				return response()->json([
					'status' => 'error',
					'message' => 'Confirm your password might be wrong or, the minimum characters if password is 8 characters!',
				]);
			
			$user->password = Hash::make($request->password);
		}
		$user->save();

		return response()->json([
			'status' => 'success',
			'message' => 'You have successfully edited your information. :)',
		]);
	}

	public function editUser(Request $request)
	{
		$this->validate($request, [
			'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'min:8'],
            'mobile' => ['required', 'digits:11'],
		]);

		$user = User::find($request->id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = ($request->password) ? Hash::make($request->password) : $user->password;
		$user->address = $request->address;
		$user->optional_address = $request->optional_address;
		$user->mobile = $request->mobile;
		$user->save();

		return redirect()->to(url()->previous() . '#list-user');
	}

	public function deleteReservation(Request $request)
	{
		$book = Book::find($request->id);
		if(!$book)
			return response()->json([
				'status' => 'error',
				'message' => 'Unable to find the reservation',
			]);
		
		$book->delete();

		return response()->json([
			'status' => 'success',
			'messaged' => 'Reservation has been deleted successfully',
		]);
	}


	public function deleteUser(Request $request)
	{
		$user = User::find($request->id);
		if(!$user)
			return response()->json([
				'status' => 'error',
				'message' => 'Unable to find the user',
			]);
		
		$user->delete();

		return response()->json([
			'status' => 'success',
			'messaged' => 'User has been deleted successfully',
		]);
	}

	public function addTable(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|min:2',
			'min_val' => 'required|numeric|min:1',
			'max_val' => 'required|numeric|gt:min_val',
		]);

		$table = new Table;
		$table->name = $request->name;
		$table->min = $request->min_val;
		$table->max = $request->max_val;
		$table->status = $request->status;
		$table->save();

		return redirect()->to(url()->previous() . '#list-table');
	}

	public function editTable(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|min:2',
			'min_val' => 'required|numeric|min:1',
			'max_val' => 'required|numeric|gt:min_val',
		]);

		$table = Table::find($request->id);
		$table->name = $request->name;
		$table->min = $request->min_val;
		$table->max = $request->max_val;
		$table->status = $request->status;
		$table->save();

		return redirect()->to(url()->previous() . '#list-table');
	}

	public function deleteTable(Request $request)
	{
		$table = Table::find($request->id);
		if(!$table)
			return response()->json([
				'status' => 'error',
				'message' => 'Unable to find the table',
			]);
		
		$table->delete();

		return response()->json([
			'status' => 'success',
			'messaged' => 'Table has been deleted successfully',
		]);
	}

	public function addItem(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|min:2',
			'total' => 'required',
			'type' => 'required',
		]);

		$item = new Item;
		$item->name = $request->name;
		$item->total = $request->total;
		$item->type = $request->type;
		$item->save();

		return redirect()->to(url()->previous() . '#list-items');
	}

	public function editItem(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|min:2',
			'total' => 'required',
			'type' => 'required',
		]);

		$item = Item::find($request->id);
		$item->name = $request->name;
		$item->total = $request->total;
		$item->type = $request->type;
		$item->save();

		return redirect()->to(url()->previous() . '#list-items');
	}

	public function deleteItem(Request $request)
	{
		$item = Item::find($request->id);
		if(!$item)
			return response()->json([
				'status' => 'error',
				'message' => 'Unable to find the item',
			]);
		
		$item->delete();

		return response()->json([
			'status' => 'success',
			'messaged' => 'Item has been deleted successfully',
		]);
	}

	//Product
	public function addProduct(Request $request)
	{
		$this->validate($request, [
			'price' => 'required|min:1',
			'name' => 'required|string|max:255',
			'description' => 'required',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'items_id' => 'required',
			'items_value' => 'required',
		]);

		$image = $request->file('image');
		$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
		$destinationPath = public_path('/images');
		$image->move($destinationPath, $input['imagename']);

		$category = new Category;
		$category->name = $request->name;
		$category->description = $request->description;
		$category->price = $request->price;
		$category->type = $request->type;
		$category->image = 'images/'.$input['imagename'];
		$category->save();

		foreach($request->items_id as $index => $item_id){
			$category_item = new CategoryItem;
			$category_item->category_id = $category->id;
			$category_item->item_id = $item_id;
			$category_item->item_value = $request->items_value[$index];
			$category_item->save();
		}
		return redirect()->to(url()->previous() . '#list-product');
	}


	public function editProduct(Request $request)
	{
	  $this->validate($request, [
		'price' => 'required|min:1',
		'name' => 'required|string|max:255',
		'description' => 'required',
		'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		'items_id' => 'required',
		'items_value' => 'required',
	  ]);

	  $category = Category::find($request->id);
	  $category->name = $request->name;
	  $category->price = $request->price;
	  $category->description = $request->description;
	  $category->type = $request->type;
	  $image = $request->file('image');
	  if($image){
		$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
		$destinationPath = public_path('/images');
		$image->move($destinationPath, $input['imagename']);
		$category->image = 'images/'.$input['imagename'];
	  }
	  $category->save();

	  $category_item = CategoryItem::where('category_id', $category->id)->delete();
	  foreach($request->items_id as $index => $item_id){
			$category_item = new CategoryItem;
			$category_item->category_id = $category->id;
			$category_item->item_id = $item_id;
			$category_item->item_value = $request->items_value[$index];
			$category_item->save();
		}

	  return redirect()->to(url()->previous() . '#list-product');
	}

	public function deleteProduct(Request $request)
	{
	  $category = Category::find($request->id);
	  if(!$category)
		return response()->json([
		  'status' => 'error',
		  'message' => 'Unable to find the product',
		]);

	  $category->delete();

	  return response()->json([
		'status' => 'success',
		'messaged' => 'Product has been successfully deleted',
	  ]);
	}

	public function updateNotification(Request $request)
	{
		Book::where('notification_status', 1)->orWhere('notification_status', 2)->update(['notification_status' => 0]);

		return response()->json([
			'status' => 'success',
			'messaged' => 'notification has been updated',
	  ]);
	}
}
