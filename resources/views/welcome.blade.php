@extends('layouts.app')

@section('content')
<div class="header">
    <div class="header-container container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <i><h1>ANNYEONG SAMGYUPSAL <br>
                    Online Reservation  System </i>
                    <br>
                </h1>
                <div class="hr-border"></div>
               <i><marquee> <p>ANNYEONGHASEYO..Welcome to ANNYEONG SAMGYUPSAL ONLINE RESERVATION...</p></marquee></i>
            </div>
        </div>
    </div>
    <div class="header-footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center p-4" style="font-size: 20px;font-weight: bold;text-transform: uppercase;text-shadow: 0px 2px 2px rgb(61, 51, 30);">
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
                <button data-toggle="modal" data-target="#contactUsModal" class="btn btn-primary btn-block">Contact US</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1 class="text-white title">Our Menu</h1>
            <div class="hr-border"></div>
        </div>
         <!--- Contact Us Modal !--->
        <div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="contactUsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contactUsModalLabel">CONTACT US</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="subject-input" class="col-12 col-form-label">Subject</label>
                            <div class="col-12">
                                <input class="form-control" type="text" value="" id="subject-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message-input" class="col-12 col-form-label">Body</label>
                            <div class="col-12">
                                <textarea id="message-input" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="sendContact" type="button" class="btn btn-primary btn-block">SEND</button>
                        <button type="button" class="btn btn-secondary btn-block m-0" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!--- End Contact Us Modal !--->

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
                                <label class="radio-inline"><input id="typeOrderValue" type="radio" name="type" value="1" checked> PAX</label>
                            </div>
                            <div class="col-6 text-center">
                                <label class="radio-inline"><input id="typeOrderValue" type="radio" name="type" value="0"> PACKAGE</label>
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
                                            <input data-id="{{ $category->id }}" type="number" class="form-control text-center" value="0" min="0" max="50">
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
                                            <input data-id="{{ $category->id }}" type="number" class="form-control text-center" value="0" min="0" max="20">
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
                                 <b>Created At:</b> </br>{{ $book->created_at->isoFormat('LLLL') }}<br></br>
                                 <b>Reservation Time:</b> </br>{{ $book->time->isoFormat('LLLL') }}
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
                        $.notify(data.message, { position: "right bottom", className : data.status });
                        if(data.status != "error"){
                            $.notify('Refreshing the website', { position: "right bottom", className : 'info' });
                            setTimeout(function(){
                                window.location.href = "/";
                            }, 2000);
                        }
                    });
                });

                $("#save-order").click(function () {
                    var curThis = $(this);
                    $.post("/api/saveOrder", {
                        id: curThis.data('id'),
                        time: $("#date-input-order").val(),
                    }).done(function (data) {
                        $.notify(data.message, { position: "right bottom", className : data.status });
                        if(data.status != "error"){
                            $.notify('Refreshing the website', { position: "right bottom", className : 'info' });
                            setTimeout(function(){
                                window.location.href = "/";
                            }, 2000);
                        }
                    });
                });

                $("#cancel-order").click(function () {
                    var curThis = $(this);
                    var reason = prompt("Your reason for canceling:", "");
                    if(reason == null || reason == "")
                    {
                        $.notify('Unable to cancel your order, please input your reason.', { position: "right bottom", className : 'danger' });
                    }else{
                        $.post("/api/cancelOrder", {
                            id: curThis.data('id'),
                            reason: reason,
                        }).done(function (data) {
                            $.notify(data.message, { position: "right bottom", className : data.status });
                            if(data.status != "error"){
                            $.notify('Refreshing the website', { position: "right bottom", className : 'info' });
                            setTimeout(function(){
                                window.location.href = "/";
                            }, 2000);
                        }
                        });
                    }
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
                        $.notify("Date & Time is invalid.", { position: "right bottom", className : "error" });
                        return;
                    }else if(Date.parse(date) <= Date.parse(curDate)){
                        curThis.attr("disabled", false);
                        $.notify("There is soemthing wrong with your date & time", { position: "right bottom", className : "error" });
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
                        }else if(data.status == "verify"){
                            window.location.href = "/email/verify";
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

                            $.notify("There is no available tables right now. :(", { position: "right bottom", className : "info" });
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

                //check boxk
                $('div[id=selectPerheadBtn]').click(function () {
                    var curThis = $(this).parent();
                    //disable class
                    $('div[id=selectPerhead]').each(function (index, value) {
                        var curThis = $(this);
                        curThis.removeClass("active");
                        curThis.find('.form-control').val(0);
                        curThis.find('.form-control').attr('min', totalPerson);
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
                        if(confirm("Note: Annyeonghaseyo! Ma'am/Sir. We will remind you that after completing your reservation, you will not able to change your orders. If you have any concern after completing your process, kindly contact us!. are you sure that you want to continue?"))
                        {
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
                                    $.notify(data.message, { position: "right bottom", className : "info" });
                                    return;
                                }
                                $("#selectTableBody").html('<div class="text-center text-success"><i style="font-size: 150px" class="far fa-check-circle"></i><h1>Redirecting you to PayPal</h1></div>');
                                window.location.href = data.redirect_url;
                            });
                        }
                    }
                    //$('#selectPackageModal').modal('show');
                });
            });

        </script>

       
<div class="container">
	<div class="row">
		<div class="MultiCarousel" data-items="2,3,3,3" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                @foreach($categories as $category)
                <div class="item">
                    <div class="pad15">
                        <img src="{{ asset($category->image) }}" style="width: 100%" />
                    </div>
                </div>
                @endforeach
            </div>
            <button class="btn leftLst"><i style="font-size: 150%" class="text-white fas fa-chevron-circle-left"></i></button>
            <button class="btn rightLst"><i style="font-size: 150%" class="text-white fas fa-chevron-circle-right"></i></button>
        </div>
	</div>
    
    <script>
        $(document).ready(function () {
        var itemsMainDiv = ('.MultiCarousel');
        var itemsDiv = ('.MultiCarousel-inner');
        var itemWidth = "";

        $('.leftLst, .rightLst').click(function () {
            var condition = $(this).hasClass("leftLst");
            if (condition)
                click(0, this);
            else
                click(1, this)
        });

        ResCarouselSize();

        $(window).resize(function () {
            ResCarouselSize();
        });

        //this function define the size of the items
        function ResCarouselSize() {
            var incno = 0;
            var dataItems = ("data-items");
            var itemClass = ('.item');
            var id = 0;
            var btnParentSb = '';
            var itemsSplit = '';
            var sampwidth = $(itemsMainDiv).width();
            var bodyWidth = $('body').width();
            $(itemsDiv).each(function () {
                id = id + 1;
                var itemNumbers = $(this).find(itemClass).length;
                btnParentSb = $(this).parent().attr(dataItems);
                itemsSplit = btnParentSb.split(',');
                $(this).parent().attr("id", "MultiCarousel" + id);


                if (bodyWidth >= 1200) {
                    incno = itemsSplit[3];
                    itemWidth = sampwidth / incno;
                }
                else if (bodyWidth >= 992) {
                    incno = itemsSplit[2];
                    itemWidth = sampwidth / incno;
                }
                else if (bodyWidth >= 768) {
                    incno = itemsSplit[1];
                    itemWidth = sampwidth / incno;
                }
                else {
                    incno = itemsSplit[0];
                    itemWidth = sampwidth / incno;
                }
                $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                $(this).find(itemClass).each(function () {
                    $(this).outerWidth(itemWidth);
                });

                $(".leftLst").addClass("over");
                $(".rightLst").removeClass("over");

            });
        }

        //this function used to move the items
        function ResCarousel(e, el, s) {
            var leftBtn = ('.leftLst');
            var rightBtn = ('.rightLst');
            var translateXval = '';
            var divStyle = $(el + ' ' + itemsDiv).css('transform');
            var values = divStyle.match(/-?[\d\.]+/g);
            var xds = Math.abs(values[4]);
            if (e == 0) {
                translateXval = parseInt(xds) - parseInt(itemWidth * s);
                $(el + ' ' + rightBtn).removeClass("over");

                if (translateXval <= itemWidth / 2) {
                    translateXval = 0;
                    $(el + ' ' + leftBtn).addClass("over");
                }
            }
            else if (e == 1) {
                var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                translateXval = parseInt(xds) + parseInt(itemWidth * s);
                $(el + ' ' + leftBtn).removeClass("over");

                if (translateXval >= itemsCondition - itemWidth / 2) {
                    translateXval = itemsCondition;
                    $(el + ' ' + rightBtn).addClass("over");
                }
            }
            $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
        }

        //It is used to get some elements from btn
        function click(ell, ee) {
            var Parent = "#" + $(ee).parent().attr("id");
            var slide = $(Parent).attr("data-slide");
            ResCarousel(ell, Parent, slide);
        }

        });
    </script>

        <div class="col-md-12 text-center my-4 p-4" style="background: #212529;">
            <h1 class="title text-white">Our Store</h1>
            <div class="hr-border"></div>
            <div class="gallery">
                <div class="mb-3 pics animation all 2">
                    <img class="img-fluid" src="{{ asset('images/1.jpg') }}" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 1">
                    <img class="img-fluid" src="{{ asset('images/2.jpg') }}" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 1">
                    <img class="img-fluid" src="{{ asset('images/3.jpg') }}" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 2">
                    <img class="img-fluid" src="{{ asset('images/4.jpg') }}" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 2">
                    <img class="img-fluid" src="{{ asset('images/5.jpg') }}" alt="Card image cap">
                </div>
                <div class="mb-3 pics animation all 1">
                    <img class="img-fluid" src="{{ asset('images/6.jpg') }}" alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
$( document ).ready(function() {
    $('#sendContact').click(function(){
        Email.send({
            Host : "smtp25.elasticemail.com",
            Username : "warrockph24@gmail.com",
            Password : "d8490dfe-be04-40cc-a361-1af431da7226",
            To : "<?php echo $admin->email; ?>",
            From : "warrockph24@gmail.com",
            Subject : $('#subject-input').val(),
            Body : $('#message-input').val()
        }).then( message => $.notify(message, 'info'));
    });
});

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
