@extends('layouts.app')

@section('content')
<div class="header">
    <div class="header-container container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1>Annyeong Samgyupsal <br>
                    Reservation Online System
                    <br>
                </h1>
                <div class="hr-border"></div>
                <p>Don't waste your time, reserve your table online!. One of the best online reservation system</p>
            </div>
        </div>
    </div>
    <div class="header-footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center p-4">
                    <a href="#reservation"><i class="fas fa-chevron-down"></i> Book your table <i class="fas fa-chevron-down"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="reservation" class="content">
    <div class="container">
        <div class="order-block row justify-content-center">
            <div class="col-12">
                <div class="text-center">
                    <h2>Your order confirmed in REAL-TIME!</h2>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary btn-block">Table
                    Reservation</button>
            </div>
            <div class="col-12 col-md-4">
                <button class="btn btn-primary btn-block">Contact US</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1 class="title">Our Menu</h1>
            <div class="hr-border"></div>
        </div>
        <!-- Start Total People Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">BOOK YOUR TABLE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="modelBody" class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label">Total Person:</label>
                            <div class="col-md-12">
                                <select id="totalPersonValue" class="form-control" name="totalPerson">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date-input" class="col-12 col-form-label">Date & Time:</label>
                            <div class="col-12">
                                <input class="form-control" type="datetime-local" value="" id="date-input" max="2021-01-01 00:00:00" min="2018-01-01 00:00:00">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-center">
                                <label class="radio-inline"><input id="typeOrderValue" type="radio" name="type" value="1" checked> Per Head</label>
                            </div>
                            <div class="col-6 text-center">
                                <label class="radio-inline"><input id="typeOrderValue" type="radio" name="type" value="0"> Per Package</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        <button id="submitTotalPerson" type="button" class="btn btn-primary">CONTINUE</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Select Table Modal -->
        <div class="modal fade" id="selectTableModal" tabindex="-1" role="dialog" aria-labelledby="selectTableLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selectTableLabel">SELECT YOUR TABLE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="selectTableBody" class="modal-body">
                        <div id="enableSelectTable" class="d-none">
                            <div class="text-center"><div class="loader"></div>Loading....</div>
                        </div>
                        <div id="enableSelectTableBody">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Available Table:</label>
                                <div class="col-12">
                                    <select id="selectTableAvailable" class="form-control" name="selectTableAvailable">
                                    </select>
                                </div>
                            </div>
                            <div id="selectPackageBody">
                                <label>Select your order:</label>
                                <div id="displayPerHead" class="row d-none">
                                    @foreach($per_head as $category)
                                    <div id="selectPerhead" class="col-6 col-md-3 text-center">
                                        <div id="selectPerheadBtn">
                                            <h1>{{ $category->name }}</h1>
                                            <label>{{ $category->price }}</label>
                                        </div>
                                        <div class="input-group number-spinner">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" data-dir="dwn">-</button>
                                            </span>
                                            <input data-id="{{ $category->id }}" type="number" class="form-control text-center" value="0" min="0" max="99">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" data-dir="up">+</button>
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="displayPackage" class="row d-none">
                                    @foreach($per_pack as $category)
                                    <div class="selectPackage col-6 col-md-4 text-center">
                                        <h1>{{ $category->name }}</h1>
                                        <label>{{ $category->price }}</label>
                                        <div class="input-group number-spinner">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" data-dir="dwn">-</button>
                                            </span>
                                            <input data-id="{{ $category->id }}" type="number" class="form-control text-center" value="0" min="0" max="99">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" data-dir="up">+</button>
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Payment:</label>
                                <div class="col-12">
                                    <select id="paymentType" class="form-control" name="paymentType">
                                        <option value="paypal" selected>Paypal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submitSelectTable" type="button" class="btn btn-primary btn-lg btn-block">CONTINUE</button>
                    </div>
                </div>
            </div>
        </div>

        <!--- Manage User Table Modal !--->
        <div class="modal fade" id="manageTableModal" tabindex="-1" role="dialog" aria-labelledby="manageTableModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageTableModalLabel">MANAGE MY TABLE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @if($books)
                        @foreach($books as $book)
                        <div data-toggle="modal" data-target="#manageOrderedModal" data-id="{{ $book->id }}" id="manageTable" class="u-table row">
                            <div class="col-4">
                                <i class="fas fa-arrow-right"></i>
                                Order Number: #{{ $book->id }}
                            </div>
                            <div class="col-4">
                                {{ $book->time->isoFormat('LLLL') }}
                            </div>
                            <div class="col-4">
                                <p class="{{ Helper::getStatus($book->time, $book->status)['status'] }}">
                                    {{ Helper::getStatus($book->time, $book->status)['message'] }}
                                </p>

                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!--- End Manage User Table Modal !--->

        <!--- Manage User Ordered Modal !--->
        <div class="modal fade" id="manageOrderedModal" tabindex="-1" role="dialog" aria-labelledby="manageOrderedModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageOrderedModalLabel">USER ORDER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div id="table-input"></div>
                                <div class="text-left">
                                    <small>
                                        <div id="total-person-input"></div>
                                    </small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div id="category-input"></div>
                            </div>
                            <div class="col-6">
                                Total Price: <div id="total-price-input"></div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">Date & Time:</label>
                                    <input class="form-control" type="datetime-local" value="2019-10-19T10:10:00" id="date-input-order">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block !important">
                        <button id="save-order" data-id="" type="button" class="btn btn-primary btn-block">SAVE
                            ORDER</button>
                        <button id="cancel-order" data-id="" type="button" class="btn btn-danger btn-block ml-0">CANCEL
                            ORDER</button>
                        <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!--- End Manage User Ordered Modal !--->

        @guest
        @else
        <!--- Manage User Ordered Modal !--->
        <div class="modal fade" id="userSettingModal" tabindex="-1" role="dialog" aria-labelledby="userSettingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userSettingModalLabel">EDIT {{ Auth::user()->name }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Current password</label>
                                <input id="setting-cur_password" type="password" class="form-control" name="cur_password" value="" required>
                            </div>
                            <div class="form-group col-12">
                                <label>Name</label>
                                <input id="setting-name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label>Email</label>
                                <input id="setting-email" type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label>New password</label>
                                <input id="setting-password" type="password" class="form-control" name="password" value="">
                            </div>
                            <div class="form-group col-12">
                                <label>Confirm new password</label>
                                <input id="setting-confirm-password" type="password" class="form-control" name="password_confirmation" value="">
                            </div>
                            <div class="form-group col-12">
                                <label>Address</label>
                                <input id="setting-address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label>Optional Address</label>
                                <input id="setting-optional_address" type="text" class="form-control" name="optional_address" value="{{ Auth::user()->optional_address }}">
                            </div>
                            <div class="form-group col-12">
                                <label>Mobile</label>
                                <input id="setting-mobile" type="text" class="form-control" name="mobile" value="{{ Auth::user()->mobile }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block !important">
                        <button id="edit-user" type="submit" class="btn btn-primary btn-block">EDIT USER</button>
                        <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!--- End Manage User Ordered Modal !--->
        @endguest
        <script>
            $(document).ready(function () {
                $('#edit-user').click(function (event) {
                    $.post("/api/editNormalUser", {
                        cur_password: $("#setting-cur_password").val(),
                        name: $("#setting-name").val(),
                        email: $("#setting-email").val(),
                        password: $("#setting-password").val(),
                        password_confirmation: $("#setting-confirm-password").val(),
                        address: $("#setting-address").val(),
                        optional_address: $("#setting-optional_address").val(),
                        mobile: $('#setting-mobile').val(),
                    }).done(function (data) {
                        console.log(data);
                        $.notify(data.message, data.status);
                    });
                });

                $("#save-order").click(function () {
                    var curThis = $(this);
                    $.post("/api/saveOrder", {
                        id: curThis.data('id'),
                        time: $("#date-input-order").val(),
                    }).done(function (data) {
                        $.notify(data.message, data.status);
                    });
                });

                $("#cancel-order").click(function () {
                    var curThis = $(this);
                    $.post("/api/cancelOrder", {
                        id: curThis.data('id'),
                    }).done(function (data) {
                        $.notify(data.message, data.status);
                    });
                });

                $("div[id=manageTable]").click(function () {
                    var curThis = $(this);
                    $("#save-order").data("id", curThis.data('id'));
                    $("#cancel-order").data("id", curThis.data('id'));

                    $.post("/api/getBookByID", {
                        id: curThis.data('id'),
                    }).done(function (data) {
                        $("#category-input").html("");
                        var total_price = 0;
                        if (data.status == "success") {
                            $("#manageOrderedModalLabel").html('Order: #' + data.result.id);
                            $("#table-input").html("Table Number: #" + data.result.table_id);
                            $("#total-person-input").html("Total Person: " + data.result
                                .total_person);
                            $.each(data.result.category, function (i, item) {
                                total_price = total_price + item.price;
                                $("#category-input").append(item.name +
                                    '<div class="text-left"><small>₱' + item.price +
                                    '</small></div>');
                            });
                            var tzoffset = (new Date()).getTimezoneOffset() * 60000;
                            var now = new Date(data.result.time);
                            var localISOTime = (new Date(now - tzoffset)).toISOString().slice(0,
                                -1);
                            $("#date-input-order").val(localISOTime);
                            $("#total-price-input").html("₱" + total_price);
                            console.log(total_price);
                        }
                    });
                });


                var totalPerson = 0;
                var typeOrderValue = 0;
                var date = 0;
                $("#submitTotalPerson").click(function () {
                    var curThis = $(this);
                    curThis.attr("disabled", true);
                    totalPerson = $('#totalPersonValue').val();
                    typeOrderValue = $("input[name='type']:checked").val();
                    date = $('#date-input').val();
                    
                    var curDate = new Date();
                    if (date == "") {
                        curThis.attr("disabled", false);
                        $.notify("Date & Time is invalid.", "error");
                        return;
                    }else if(Date.parse(date) <= Date.parse(curDate)){
                        curThis.attr("disabled", false);
                        $.notify("There is soemthing wrong with your date & time", "error");
                        return;
                    }
                    //add loading
                    $.post("/api/getAvailableTable", {
                        totalPerson: totalPerson,
                        typeOrderValue: typeOrderValue,
                        time : date,
                    }).done(function (data) {
                        curThis.attr("disabled", false);
                        if (data.status == "login") {
                            window.location.href = "/login";
                            return;
                        }else if(data.status == "info"){
                            $.notify(data.message, data.status);
                            return;
                        }
                        $('#selectTableAvailable').empty();
                        if (data.status == "success") {
                            $.each(data.result, function (i, item) {
                                $('#selectTableAvailable').append($('<option>', {
                                    value: item,
                                    text: "Table #" + item
                                }));
                            });
                        } else {
                            $('#selectTableAvailable').empty().append($('<option>', {
                                value: 0,
                                text: "No table available"
                            }));

                            $.notify("There is no available tables right now. :(", "info");
                            return;
                        }
                        $('#exampleModal').modal('hide');
                        $('#selectTableModal').modal('show');
                        if (typeOrderValue == 1) {
                            $("#selectPerheadBtn").click();
                            $('#displayPerHead').removeClass("d-none");
                            $('#displayPackage').addClass("d-none");
                        } else {
                            $('#displayPerHead').addClass("d-none");
                            $('#displayPackage').removeClass("d-none");
                        }
                    });
                });

                $('div[id=selectPerheadBtn]').click(function () {
                    var curThis = $(this).parent();
                    //disable class
                    $('div[id=selectPerhead]').each(function (index, value) {
                        var curThis = $(this);
                        curThis.removeClass("active");
                        curThis.find('.form-control').val(0);
                    });

                    curThis.find('.form-control').val(totalPerson)
                    curThis.addClass("active");
                });

                $('#submitSelectTable').click(function () {
                    var tableId = $('#selectTableAvailable').val();
                    var categoryId = [];
                    var categoryQuantity = [];

                    //insert order id's and quantities
                    $('input[type=number]').each(function (index, value) {
                        var curThis = $(this);
                        var id = curThis.data('id');
                        var quantity = curThis.val();
                        if (quantity != 0) {
                            categoryId.push(id);
                            categoryQuantity.push(quantity);
                        }
                    });
                    if (categoryId.length == 0) {
                        alert("You have selected 0 order");
                    } else {
                        $('#enableSelectTable').removeClass('d-none');
                        $('#enableSelectTableBody').addClass('d-none');
                        $.post("/api/saveBook", {
                            tableId: tableId,
                            date: date,
                            totalPerson: totalPerson,
                            categoryId: categoryId,
                            categoryQuantity: categoryQuantity,
                        }).done(function (data) {
                            if (data.status == "login") {
                                window.location.href = "/login";
                                return;
                            }else if(data.status == "fail"){
                                $('#enableSelectTable').addClass('d-none');
                                $('#enableSelectTableBody').removeClass('d-none');
                                $.notify(data.message, 'info');
                                return;
                            }
                            $("#selectTableBody").html('<div class="text-center text-success"><i style="font-size: 150px" class="far fa-check-circle"></i><h1>Redirecting you to PayPal</h1></div>');
                            window.location.href = data.redirect_url;
                        });
                    }
                    //$('#selectPackageModal').modal('show');
                });
            });

        </script>
        @foreach($categories as $category)
        <div class="col-6 col-md-4 p-1">
            <a class="btnMenu" href="#reservation">
                <img src="{{ asset($category->image) }}" class="img-fluid mx-auto d-block" />
            </a>
        </div>
        @endforeach

        <div class="col-md-12 text-center m-4" style="background: #dbdbdb;">
            <h1 class="title">Our Store</h1>
            <div class="hr-border"></div>
            <div class="gallery">
                <div class="mb-3 pics animation all 2">
                    <img class="img-fluid" src="https://scontent-sin2-2.xx.fbcdn.net/v/t1.0-9/71389950_682058208950686_4382768629532327936_n.jpg?_nc_cat=101&_nc_oc=AQmKIaGKRE9l_wjI8iVbc8mOswJQ6tAxXUiJevVet9r2tU6gd9zzcBmSMv7Leiq43V8&_nc_ht=scontent-sin2-2.xx&oh=493d0826857edf02f9b9872dac544c69&oe=5E1E1088" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 1">
                    <img class="img-fluid" src="https://scontent-sin2-2.xx.fbcdn.net/v/t1.0-9/69317229_656814938141680_2239329114148306944_o.jpg?_nc_cat=110&_nc_oc=AQn_B93jGiwwlNcFEZxF6hRNrE8xQ-WViaNrRYUrrD1iApEEA3LzSl409U-YPfJsk_w&_nc_ht=scontent-sin2-2.xx&oh=6792f3b321fbffd938be1ab53632f4bf&oe=5E2B4B58" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 1">
                    <img class="img-fluid" src="https://scontent-sin2-2.xx.fbcdn.net/v/t1.0-9/69357304_657971261359381_4810972758659825664_n.jpg?_nc_cat=111&_nc_oc=AQmbRzFd4D1_-Tb8cHKFBRwaEbwP15rWuVw2LnJyvTkLtj6t6luW0icMS4Uo-fGEBAs&_nc_ht=scontent-sin2-2.xx&oh=02c7a05205ceaac76288680c41d69c49&oe=5E1A2CD5" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 2">
                    <img class="img-fluid" src="https://scontent-sin2-2.xx.fbcdn.net/v/t1.0-9/69578824_657971324692708_2856518452909178880_o.jpg?_nc_cat=103&_nc_oc=AQmsvquQIYx7zwQry_JbdKtz1OStnGf_nYwOd0345T9fLJze8O-n0nGhkpsYvCxFOG4&_nc_ht=scontent-sin2-2.xx&oh=d38041fb2d920b4a9ef80ab53a62e0b7&oe=5E29CF0C" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 2">
                    <img class="img-fluid" src="https://scontent-sin2-2.xx.fbcdn.net/v/t1.0-9/70956511_674458289710678_2505804321304608768_o.jpg?_nc_cat=108&_nc_oc=AQnPNylvNZNsCGgeb3zkbGOIvXnM_jo-fkiMpzRqxv_FVkV5DCT2mth2snyb7CYiFys&_nc_ht=scontent-sin2-2.xx&oh=ed2582727b65cfe0f402f9d8a5a4f356&oe=5E235185" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 1">
                    <img class="img-fluid" src="https://scontent-sin2-2.xx.fbcdn.net/v/t1.0-9/60396721_597851407371367_7576376787509182464_n.jpg?_nc_cat=110&_nc_oc=AQk75oCj_FJGln4nolddRy4-Y4kc001JZQymn6Jwsa1pNP0HEUugij1j_QbixZABCBY&_nc_ht=scontent-sin2-2.xx&oh=dead9a191288e41cb346e1b45c7e063a&oe=5E2FF135" alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".navbar").removeClass("bg-white");

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            $(".navbar").addClass("bg-white");
        } else {
            $(".navbar").removeClass("bg-white");
        }
    });

</script>
@endsection
