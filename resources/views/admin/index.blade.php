@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
            <a class="list-group-item list-group-item-action" id="list-product-list" data-toggle="list" href="#list-product" role="tab" aria-controls="product">Product</a>
            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
          </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header">DASHBOARD</div>
                <div class="card-body">
                  <div class="tab-content" id="nav-tabContent">
                    <!--- Admin Dashboard !--->
                   <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                     <div class="row justify-content-center">
                       <div class="col-6 col-md-4 py-2">
                         <div class="bg-primary text-white dashboard text-center p-4">
                           <h1>{{ $dashboard['total_reservation'] }}</h1>
                           <small>Reservation Today</small>
                         </div>
                       </div>

                       <div class="col-6 col-md-4 py-2">
                         <div class="bg-secondary text-white dashboard text-center p-4">
                           <h1>{{ $dashboard['total_registration'] }}</h1>
                           <small>Registered Today</small>
                         </div>
                       </div>

                       <div class="col-6 col-md-4 py-2">
                         <div class="bg-success text-white dashboard text-center p-4">
                           <h1>{{ $dashboard['total_cancel_order'] }}</h1>
                           <small>Total Cancel Order</small>
                         </div>
                       </div>

                       <div class="col-6 col-md-4 py-2">
                         <div class="bg-danger text-white dashboard text-center p-4">
                           <h1>{{ $dashboard['total_items'] }}</h1>
                           <small>Total Items</small>
                         </div>
                       </div>

                       <div class="col-6 col-md-4 py-2">
                         <div class="bg-dark text-white dashboard text-center p-4">
                           <h1>{{ $dashboard['total_product'] }}</h1>
                           <small>Total Product</small>
                         </div>
                       </div>

                       <div class="col-6 col-md-4 py-2">
                         <div class="bg-info text-white dashboard text-center p-4">
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
                       <button class="btn btn-primary" type="button" name="button"><i class="fas fa-plus-square"></i> Add Product</button>
                     </div>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Tools</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($product['categories'] as $category)
                          <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->image }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->price }}</td>
                            <td>
                              <a data-toggle="modal" data-target="#editProductModal" href="#">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="#">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    <!--- Manage User Ordered Modal !--->
                    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
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
                                  <textarea id="description-product" rows="3" class="form-control"></textarea>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer" style="display: block !important">
                              <button id="save-product" data-id="" type="button" class="btn btn-primary btn-block">SAVE PRODUCT</button>
                              <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!--- End Manage User Ordered Modal !--->

                    <!--- End Admin Product !--->
                   <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                   <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle='list']", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='list']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});
</script>
@endsection
