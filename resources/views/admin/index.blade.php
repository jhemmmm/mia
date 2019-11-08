@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row no-gutters justify-content-center">
        @if (count($errors) > 0)
        <div class="col-12">
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="col-12 col-md-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
				<a class="list-group-item list-group-item-action" id="list-reservation-list" data-toggle="list" href="#list-reservation" role="tab" aria-controls="product">
                    Reservations @if(Helper::getNotificationCount() != 0)<div class="notification">{{ Helper::getNotificationCount() }}</div>@endif
                </a>
                <a class="list-group-item list-group-item-action" id="list-product-list" data-toggle="list" href="#list-product" role="tab" aria-controls="product">Products</a>
                <a class="list-group-item list-group-item-action" id="list-items-list" data-toggle="list" href="#list-items" role="tab" aria-controls="items">Product Inventory</a>
                <a class="list-group-item list-group-item-action" id="list-table-list" data-toggle="list" href="#list-table" role="tab" aria-controls="table">Tables</a>
                <a class="list-group-item list-group-item-action" id="list-user-list" data-toggle="list" href="#list-user" role="tab" aria-controls="table">Users</a>
                <a class="list-group-item list-group-item-action" id="list-sale-list" data-toggle="list" href="#list-sale" role="tab" aria-controls="table">Sales Report</a>
                <a class="list-group-item list-group-item-action" id="list-refund-list" data-toggle="list" href="#list-refund" role="tab" aria-controls="table">
                    Refund List @if(Helper::getRefundNotificationCount() != 0)<div class="notification">{{ Helper::getRefundNotificationCount() }}</div>@endif
                </a>
            </div>
        </div>
        <script>
        jQuery(document).ready(function ($) {
            $('a.list-group-item').on('click', function (e) {
                var href = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $('#nav-tabContent').offset().top - 200
                }, 'slow');
                e.preventDefault();
            });
        });
        </script>
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">DASHBOARD</div>
                <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">

					    <!--- Admin Reservation !--->													
                        <div class="tab-pane fade" id="list-reservation" role="tabpanel" aria-labelledby="list-reservation-list">
							<h3>Reservation</h3>
							<div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Details</th>
											<th scope="col">Ordered</th>
                                            <th scope="col">Time</th>
											<th scope="col">Status</th>
                                            <th scope="col">Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($admin_book['books'] as $book)
                                        <tr id="reservation-t-{{ $book->id }}">
                                            <th scope="row">#{{ $book->id }}</th>
                                            <td>
												Name: <b>{{ $book->user->name }} </b></br>
												Total Person: <b>{{ $book->total_person }}</b></br>
												Table #: <b>{{ $book->table_id }} </b> </br></br>
											</td>
											<td>
												@foreach($book->category as $category)
												{{ $category->name }} </br>
												@endforeach
											</td>
                                            <td>
                                                <b>Created At:</b> </br>{{ $book->created_at->isoFormat('LLLL') }}<br></br>
                                                <b>Reservation Time:</b> </br>{{ $book->time->isoFormat('LLLL') }}
                                            </td>
											<td class="{{ Helper::getStatus($book->time, $book->status)['status'] }}">{{ Helper::getStatus($book->time, $book->status)['message'] }}</td>
                                            <td><a id="reservation-delete" data-target-id="{{ $book->id }}" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<!--- End Admin Reservation !--->

                        <!--- Admin Dashboard !--->
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="row">
                                <div class="col-6 col-md-2">
                                    <div class="text-center">
                                        <h1>{{ $dashboard['total_reservation'] }}</h1>
                                        <small>Reservation Today</small>
                                    </div>
                                </div>

                                <div class="col-6 col-md-2">
                                    <div class="text-center">
                                        <h1>{{ $dashboard['total_registration'] }}</h1>
                                        <small>Registered Today</small>
                                    </div>
                                </div>

                                <div class="col-6 col-md-2">
                                    <div class="text-center">
                                        <h1>{{ $dashboard['total_cancel_order'] }}</h1>
                                        <small>Total Cancel Order</small>
                                    </div>
                                </div>

                                <div class="col-6 col-md-2">
                                    <div class="text-center">
                                        <h1>{{ $dashboard['total_items'] }}</h1>
                                        <small>Total Items</small>
                                    </div>
                                </div>

                                <div class="col-6 col-md-2">
                                    <div class="text-center">
                                        <h1>{{ $dashboard['total_product'] }}</h1>
                                        <small>Total Product</small>
                                    </div>
                                </div>

                                <div class="col-6 col-md-2">
                                    <div class="text-center">
                                        <h1>{{ $dashboard['total_table'] }}</h1>
                                        <small>Total Table</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--- End Admin Dashboard !--->

                        <!--- Admin Product !--->
                        <div class="tab-pane fade" id="list-product" role="tabpanel" aria-labelledby="list-product-list">
                            <div class="float-right my-1">
                                <button data-toggle="modal" data-target="#addProductModal" class="btn btn-primary" type="button" name="button"><i class="fas fa-plus-square"></i> Add Product</button>
                                <!--- Manage User Ordered Modal !--->
                                <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addProductModalLabel">ADD NEW PRODUCT</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            {!! Form::open(array('route' => 'addProduct', 'enctype' =>
                                            'multipart/form-data')) !!}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label>Name</label>
                                                        <input id="name-product" type="text" class="form-control" name="name" value="" required autofocus>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Price</label>
                                                        <input id="price-product" type="number" class="form-control" name="price" value="" required>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Description</label>
                                                        <textarea id="description-product" rows="3" class="form-control" name="description"></textarea>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <div class="item-list">
                                                            <h5>Items</h5>
                                                            @foreach($product['items'] as $item)
                                                            <div class="form-check row">
                                                                <div class="col-6">
                                                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="items_id[]" id="item-check-{{ $item->id }}">
                                                                    <label class="form-check-label" for="item-check-{{ $item->id }}">
                                                                        {{ $item->name }}
                                                                    </label>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input class="form-control" name="items_value[]" type="text" value="0">
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type">
                                                            <option value="0" selected>Per Pack</option>
                                                            <option value="1">Per Head</option>
                                                        </select>
                                                        </br>
                                                        <label>Image</label>
                                                        {!! Form::file('image', array('class' => 'image form-control'))!!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="display: block !important">
                                                <button id="add-product" data-id="" type="submit" class="btn btn-primary btn-block">ADD PRODUCT</button>
                                                <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <!--- End Manage User Ordered Modal !--->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product['categories'] as $category)
                                        <tr id="product-t-{{ $category->id }}">
                                            <th scope="row">
                                                {{ $category->id }}
                                                <img style="max-width: 40px;" src="{{ asset($category->image) }}" />
                                            </th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>{{ $category->price }}</td>
                                            <td>
                                                <a data-toggle="modal" data-target="#editProductModal-{{ $category->id }}" href="#"><i class="fas fa-edit"></i></a>
                                                <!--- Manage User Ordered Modal !--->
                                                <div class="modal fade" id="editProductModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editProductModalLabel">Edit
                                                                    {{ $category->name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            {!! Form::open(array('route' => 'editProduct', 'enctype' =>
                                                            'multipart/form-data')) !!}
                                                            <input name="id" type="hidden" value="{{ $category->id }}" />
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="form-group col-6">
                                                                        <label>Name</label>
                                                                        <input id="name-product" type="text" class="form-control" name="name" value="{{ $category->name }}" required autofocus>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label>Price</label>
                                                                        <input id="price-product" type="number" class="form-control" name="price" value="{{ $category->price }}" required>
                                                                    </div>
                                                                    <div class="form-group col-12">
                                                                        <label>Description</label>
                                                                        <textarea id="description-product" rows="3" class="form-control" name="description">{{ $category->description }}</textarea>
                                                                    </div>
                                                                     <div class="form-group col-6">
                                                                        <div class="item-list">
                                                                            <h5>Items</h5>
                                                                            @foreach($product['items'] as $item)
                                                                            <div class="form-check row">
                                                                                <div class="col-6">
                                                                                    <?php 
                                                                                        $is_checked = false;
                                                                                        $value = 0;
                                                                                        foreach($category->item as $c_item){
                                                                                            if($c_item->id == $item->id){
                                                                                               
                                                                                                $is_checked = true;
                                                                                                $value = $c_item->pivot->item_value;
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                    <input {{ ($is_checked) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="{{ $item->id }}" name="items_id[]" id="edit-item-check-{{ $item->id }}">
                                                                                    <label class="form-check-label" for="edit-item-check-{{ $item->id }}">
                                                                                        {{ $item->name }}
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input class="form-control" name="items_value[]" type="text" value="{{ $value }}">
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label>Image</label>
                                                                        {!! Form::file('image', array('class' => 'image
                                                                        form-control')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer" style="display: block !important">
                                                                <button id="save-product" data-id="" type="submit" class="btn btn-primary btn-block">SAVE
                                                                    PRODUCT</button>
                                                                <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--- End Manage User Ordered Modal !--->
                                                <a id="product-delete" data-target-id="{{ $category->id }}" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--- End Admin Product !--->

						<!--- Admin Item !--->
                        <div class="tab-pane fade" id="list-items" role="tabpanel" aria-labelledby="list-items-list">
                         <div class="float-right my-1">
                                <button data-toggle="modal" data-target="#addItemModal" class="btn btn-primary" type="button" name="button"><i class="fas fa-plus-square"></i> Add Item</button>
                                <!--- Manage User Ordered Modal !--->
                                <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addItemLabel">ADD NEW ITEM</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            {!! Form::open(array('route' => 'addItem', 'enctype' => 'multipart/form-data')) !!}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name" value="" required autofocus>
                                                    </div>    
                                                    <div class="form-group col-12">
                                                        <label>Total</label>
                                                        <input type="number" class="form-control" name="total" value="0" required>
                                                    </div>     
													<div class="form-group col-12">
                                                        <label>Type</label>
                                                        <select name="type" class="form-control">
															<option value="0" selected>No type</option>
															<option value="1">Gram</option>
														</select>
                                                    </div>                                
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="display: block !important">
                                                <button type="submit" class="btn btn-primary btn-block">ADD ITEM</button>
                                                <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <!--- End Manage User Ordered Modal !--->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($admin_item['items'] as $item)									
                                        <tr id="item-t-{{ $item->id }}">
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->total . (($item->type == 1)? 'g' : '') }}</td>
                                            <td>
												<a data-toggle="modal" data-target="#editItem-{{ $item->id }}" href="#"><i class="fas fa-edit"></i></a>
												<!--- Manage User Ordered Modal !--->
												<div class="modal fade" id="editItem-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editItemLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="editItemLabel">EDIT {{ $item->name }} </h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															</div>
															{!! Form::open(array('route' => 'editItem', 'enctype' => 'multipart/form-data')) !!}
															<input type="hidden" name="id" value="{{ $item->id }}"/>
															<div class="modal-body">
																<div class="row">
																	<div class="form-group col-12">
																		<label>Name</label>
																		<input type="text" class="form-control" name="name" value="{{ $item->name }}" required autofocus>
																	</div>    
																	<div class="form-group col-12">
																		<label>Total</label>
																		<input type="number" class="form-control" name="total" value="{{ $item->total }}" required>
																	</div>     
																	<div class="form-group col-12">
																		<label>Type</label>
																		<select name="type" class="form-control">
																			<option {{ ($item->type == 0)? 'selected' : '' }} value="0">No type</option>
																			<option {{ ($item->type == 1)? 'selected' : '' }} value="1">Gram</option>
																		</select>
																	</div>                                
																</div>
															</div>
															<div class="modal-footer" style="display: block !important">
																<button type="submit" class="btn btn-primary btn-block">EDIT ITEM</button>
																<button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
															</div>
															{!! Form::close() !!}
														</div>
													</div>
												</div>
												<!--- End Manage User Ordered Modal !--->
												<a id="item-delete" data-target-id="{{ $item->id }}" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
											</td>
                                        </tr>
										@endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
						<!--- End Admin Item !--->

						<!--- Admin Table !--->													
                        <div class="tab-pane fade" id="list-table" role="tabpanel" aria-labelledby="list-table-list">
							<div class="float-right my-1">
                                <button data-toggle="modal" data-target="#addTableModal" class="btn btn-primary" type="button" name="button"><i class="fas fa-plus-square"></i> Add Table</button>
                                <!--- Manage User Ordered Modal !--->
                                <div class="modal fade" id="addTableModal" tabindex="-1" role="dialog" aria-labelledby="addTableModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addTableModalLabel">ADD NEW TABLE</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            {!! Form::open(array('route' => 'addTable', 'enctype' => 'multipart/form-data')) !!}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name" value="" required>
                                                    </div>  
                                                    <div class="form-group col-6">
                                                        <label>Min Person</label>
                                                        <input type="number" class="form-control" name="min_val" value="0" required>
                                                    </div>  
													<div class="form-group col-6">
                                                        <label>Max Person</label>
                                                        <input type="number" class="form-control" name="max_val" value="0" required>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="1" selected>Enable</option>
                                                            <option value="0">Disable</option>
                                                        </select>
                                                    </div>                                     
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="display: block !important">
                                                <button type="submit" class="btn btn-primary btn-block">ADD TABLE</button>
                                                <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <!--- End Manage User Ordered Modal !--->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>                               
                                            <th scope="col">Min Person</th>
											<th scope="col">Max Person</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($admin_table['tables'] as $table)									
                                        <tr id="table-t-{{ $table->id }}">
                                            <th scope="row">Table ID #{{ $table->id }}</th>
                                            <td>{{ $table->name }}</td>
                                            <td>{{ $table->min }}</td>
                                            <td>{{ $table->max }}</td>
                                            <td>
                                                @if($table->status == 1)
                                                    <div class="text-success">Enabled</div>
                                                @else
                                                    <div class="text-danger">Disabled</div>
                                                @endif
                                            </td>
                                            <td>
												<a data-toggle="modal" data-target="#editTable-{{ $table->id }}" href="#"><i class="fas fa-edit"></i></a>
												<!--- Manage User Ordered Modal !--->
												<div class="modal fade" id="editTable-{{ $table->id }}" tabindex="-1" role="dialog" aria-labelledby="editTableLable" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="editTableLable">EDIT {{ $table->name }} </h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															</div>
															{!! Form::open(array('route' => 'editTable', 'enctype' => 'multipart/form-data')) !!}
															<input type="hidden" name="id" value="{{ $table->id }}"/>
															<div class="modal-body">        
																<div class="row">
                                                                    <div class="form-group col-12">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control" name="name" value="{{ $table->name }}" required>
                                                                    </div>          
                                                                    <div class="form-group col-6">
                                                                        <label>Min Person</label>
                                                                        <input type="number" class="form-control" name="min_val" value="{{ $table->min }}" required>
                                                                    </div>  
                                                                    <div class="form-group col-6">
                                                                        <label>Max Person</label>
                                                                        <input type="number" class="form-control" name="max_val" value="{{ $table->max }}" required>
                                                                    </div>
                                                                    <div class="form-group col-12">
                                                                        <label>Status</label>
                                                                        <select class="form-control" name="status">
                                                                            <option value="1" {{ ($table->status == 1) ? 'selected' : '' }}</option>Enable</option>
                                                                            <option value="0" {{ ($table->status == 0) ? 'selected' : '' }}</option>Disable</option>
                                                                        </select>
                                                                    </div>     
																</div>
															</div>
															<div class="modal-footer" style="display: block !important">
																<button type="submit" class="btn btn-primary btn-block">EDIT TABLE</button>
																<button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
															</div>
															{!! Form::close() !!}
														</div>
													</div>
												</div>
												<!--- End Manage User Ordered Modal !--->
												<a id="table-delete" data-target-id="{{ $table->id }}" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
											</td>
                                        </tr>
										@endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
						</div>
						<!--- End Admin Table !--->

                        <!--- Admin User !--->													
                        <div class="tab-pane fade" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
											<th scope="col">Email</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($admin_user['users'] as $user)									
                                        <tr id="user-t-{{ $user->id }}">
                                            <th scope="row">#{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>
                                                {{ $user->address }} </br>
                                                <b>Optional Address: </b> {{ $user->optional_address }}
                                            </td>
                                            <td>
                                                {{ $user->created_at }}
                                            </td>
                                            <td>
												<a data-toggle="modal" data-target="#editUser-{{ $user->id }}" href="#"><i class="fas fa-edit"></i></a>
												<!--- Manage User Ordered Modal !--->
												<div class="modal fade" id="editUser-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLable" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="editUserLable">EDIT {{ $user->name }} </h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															</div>
															{!! Form::open(array('route' => 'editUser', 'enctype' => 'multipart/form-data')) !!}
															<input type="hidden" name="id" value="{{ $user->id }}"/>
															<div class="modal-body">
																<div class="row">
                                                                    <div class="form-group col-12">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                                                    </div>  
                                                                    <div class="form-group col-12">
                                                                        <label>Email</label>
                                                                        <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                                                                    </div>  
                                                                    <div class="form-group col-12">
                                                                        <label>Password</label>
                                                                        <input type="text" class="form-control" name="password" value="">
                                                                    </div>  
                                                                    <div class="form-group col-12">
                                                                        <label>Address</label>
                                                                        <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                                                                    </div>  
                                                                    <div class="form-group col-12">
                                                                        <label>Optional Address</label>
                                                                        <input type="text" class="form-control" name="optional_address" value="{{ $user->optional_address }}">
                                                                    </div>  
                                                                    <div class="form-group col-12">
                                                                        <label>Mobile</label>
                                                                        <input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}" required>
                                                                    </div>  
                                                                </div>
															</div>
															<div class="modal-footer" style="display: block !important">
																<button type="submit" class="btn btn-primary btn-block">EDIT USER</button>
																<button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
															</div>
															{!! Form::close() !!}
														</div>
													</div>
												</div>
												<!--- End Manage User Ordered Modal !--->
												<a id="user-delete" data-target-id="{{ $user->id }}" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
											</td>
                                        </tr>
										@endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
						</div>
						<!--- End Admin User !--->

                         <!--- Admin Sales Report !--->
                        <div class="tab-pane fade show" id="list-sale" role="tabpanel" aria-labelledby="list-sale-list">
                            <div class="row justify-content-center">
                                <div class="col-12 py-2">
                                    <div class="bg-light p-4">
                                        <div id="DivIdToPrint" class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="text-left">
                                                    <h5>Sales Report</h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group text-right">
                                                    <select class="form-control" name="sort-sale">
                                                        <option value="0">Today</option>
                                                        <option value="1">Last Week</option>
                                                        <option value="2">Last Month</option>
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-12"><hr></div>
                                            <?php $sale_total = 0; ?>
                                            @foreach($admin_sale['sales'] as $sale)
                                            <div id="sales-t-{{ $sale->id }}" class="col-12"> 
                                                <div class="float-left">
                                                <b>Reservation #{{ $sale->id }}</b></br>
                                                <small>
                                                    By: {{ $sale->user->name }} </br>
                                                    Total Person: {{ $sale->total_person }}
                                                </small>
                                                </div>
                                                <div class="text-right">
                                                    <a id="reservation-delete" data-target-id="{{ $sale->id }}" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
                                                    <small>
                                                    <br>
                                                    @foreach($sale->category as $category)
                                                        Name: {{ $category->name }} <br>
                                                        Price: ₱{{ $category->price }}  Qty: {{ $category->pivot->category_quantity }} <br>
                                                        <?php $sale_total += $category->price * $category->pivot->category_quantity ?>
                                                    @endforeach
                                                    </small>
                                                </div>
                                                <div class="px-5"><hr></div>
                                            </div>
                                            @endforeach
                                            <div class="col-6 text-left">
                                                <h2>Total Received</h2>
                                            </div>
                                            <div class="col-6 text-right">
                                                <h2>₱{{ $sale_total }} </h2>
                                            </div>
                                        </div>
                                         <div class="float-right">
                                            <a onclick="printDiv()" href="#"><i class="fas fa-print"></i> PRINT</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--- End Admin Sales Report !--->

                         <!--- Canceled Reservation !--->
                        <div class="tab-pane fade show" id="list-refund" role="tabpanel" aria-labelledby="list-refund-list">
                            <h3>Canceled Reservation</h3>
							@if(count($admin_book['canceled_books']) > 0)
							<div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Details</th>
											<th scope="col">Ordered</th>
                                            <th scope="col">Time</th>
											<th scope="col">Status</th>
                                            <th scope="col">Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($admin_book['canceled_books'] as $book)
                                        <tr id="refund-t-{{ $book->id }}">
                                            <th scope="row">#{{ $book->id }}</th>
                                            <td>
												Name: <b>{{ $book->user->name }} </b></br>
												Total Person: <b>{{ $book->total_person }}</b></br>
												Table #: <b>{{ $book->table_id }} </b> </br></br>

                                                <button title="Click to Show/Hide Content" type="button" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}">Reason</button>
                                                <div id="spoiler" style="display:none">
                                                    {{ $book->reason }}
                                                </div>
											</td>
											<td>
												@foreach($book->category as $category)
												{{ $category->name }} </br>
												@endforeach
											</td>
                                            <td>
                                                <b>Created At:</b> </br>{{ $book->created_at->isoFormat('LLLL') }}<br></br>
                                                <b>Reservation Time:</b> </br>{{ $book->time->isoFormat('LLLL') }}
                                            </td>
											<td class="text-danger">Canceled</td>
                                            <td><a id="reservation-delete" data-target-id="{{ $book->id }}" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@else
							<div class="alert alert-success">
								You have 0 canceled reservation
							</div>
							@endif
                        </div>
                        <!--- End Canceled Reservation !--->                                                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function printDiv() 
{
  var divToPrint=document.getElementById('DivIdToPrint');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
}
$(function(){
    $(document).ready(function () {
        $.post("/admin/api/updateNotification", {
            id: 'RemoveIt',
        }).done(function (data) {
            $.notify(data.message, data.status);
        });

        $("a[id='reservation-delete']").click(function () {
            var targetId = $(this).data('target-id');
            if (confirm('Are you sure you want to delete this reservation?')) {
                $.post("/admin/api/deleteReservation", {
                    id: targetId,
                }).done(function (data) {
                    $("#reservation-t-" + targetId).fadeOut("slow");
                    $("#sales-t-" + targetId).fadeOut("slow");
                    $("#refund-t-" + targetId).fadeOut("slow");
                    $.notify(data.message, data.status);
                });
            }
		});

        $("a[id='user-delete']").click(function () {
            var targetId = $(this).data('target-id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.post("/admin/api/deleteUser", {
                    id: targetId,
                }).done(function (data) {
                    $("#user-t-" + targetId).fadeOut("slow");
                    $.notify(data.message, data.status);
                });
            }
		});

		$("a[id='table-delete']").click(function () {
            var targetId = $(this).data('target-id');
            if (confirm('Are you sure you want to delete this table?')) {
                $.post("/admin/api/deleteTable", {
                    id: targetId,
                }).done(function (data) {
                    $("#table-t-" + targetId).fadeOut("slow");
                    $.notify(data.message, data.status);
                });
            }
		});

		$("a[id='item-delete']").click(function () {
            var targetId = $(this).data('target-id');
            if (confirm('Are you sure you want to delete this item?')) {
                $.post("/admin/api/deleteItem", {
                    id: targetId,
                }).done(function (data) {
                    $("#item-t-" + targetId).fadeOut("slow");
                    $.notify(data.message, data.status);
                });
            }
		});
		
        $("a[id='product-delete']").click(function () {
            var targetId = $(this).data('target-id');
            if (confirm('Are you sure you want to delete this product?')) {
                $.post("/admin/api/deleteProduct", {
                    id: targetId,
                }).done(function (data) {
                    $("#product-t-" + targetId).fadeOut("slow");
                    $.notify(data.message, data.status);
                });
            }
        });

        if (location.hash) {
            $("a[href='" + location.hash + "']").tab("show");
        }
        $(document.body).on("click", "a[data-toggle='list']", function (event) {
            location.hash = this.getAttribute("href");
        });
    });
    $(window).on("popstate", function () {
        var anchor = location.hash || $("a[data-toggle='list']").first().attr("href");
        $("a[href='" + anchor + "']").tab("show");
    });
});
</script>
@endsection
