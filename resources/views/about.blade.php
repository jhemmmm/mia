@extends('layouts.app')

@section('content')
<div class="header" style="background: url(../images/header_3.png) no-repeat center;">
    <div class="container" style="padding-top: 100px">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="text-orange newfont">
                    Our Store
                </h1>
               <p>You Know Our Secrets Of Our Success Too</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">

        <div class="col-md-12 text-center" style="display: inline-grid;">
            <i class="fas fa-utensils"></i>
            <h1 class="text-dark title"> <span class="text-orange">Have You Ever</span> Visited Us?</h1>
        </div>
        <div class="col-md-12 text-center">
            <p>Once You Know Our Secrets, There Is No Leaving Us Until You Are Satisfied </p>
        </div>

        <div class="hovereffect col-md-4 p-2">
            <img src="{{ asset('images/1.jpg') }}?image=251" class="img-fluid rounded">
            <a href="{{ asset('images/1.jpg') }}?image=251" data-toggle="lightbox" data-gallery="gallery" class="overlay">
                <h2 class="title">Click To View</h2><br>
                <i style="font-size: 35px; line-height: 3" class="fas fa-expand-arrows-alt"></i>
            </a>
        </div>

        <div class="hovereffect col-md-4 p-2">
            <img src="{{ asset('images/2.jpg') }}?image=251" class="img-fluid rounded">
            <a href="{{ asset('images/2.jpg') }}?image=251" data-toggle="lightbox" data-gallery="gallery" class="overlay">
                <h2 class="title">Click To View</h2><br>
                <i style="font-size: 35px; line-height: 3" class="fas fa-expand-arrows-alt"></i>
            </a>
        </div>

        <div class="hovereffect col-md-4 p-2">
            <img src="{{ asset('images/3.jpg') }}?image=251" class="img-fluid rounded">
            <a href="{{ asset('images/3.jpg') }}?image=251" data-toggle="lightbox" data-gallery="gallery" class="overlay">
                <h2 class="title">Click To View</h2><br>
                <i style="font-size: 35px; line-height: 3" class="fas fa-expand-arrows-alt"></i>
            </a>
        </div>

        <div class="hovereffect col-md-4 p-2">
            <img src="{{ asset('images/4.jpg') }}?image=251" class="img-fluid rounded">
            <a href="{{ asset('images/4.jpg') }}?image=251" data-toggle="lightbox" data-gallery="gallery" class="overlay">
                <h2 class="title">Click To View</h2><br>
                <i style="font-size: 35px; line-height: 3" class="fas fa-expand-arrows-alt"></i>
            </a>
        </div>

        <div class="hovereffect col-md-4 p-2">
            <img src="{{ asset('images/5.jpg') }}?image=251" class="img-fluid rounded">
            <a href="{{ asset('images/5.jpg') }}?image=251" data-toggle="lightbox" data-gallery="gallery" class="overlay">
                <h2 class="title">Click To View</h2><br>
                <i style="font-size: 35px; line-height: 3" class="fas fa-expand-arrows-alt"></i>
            </a>
        </div>

        <div class="hovereffect col-md-4 p-2">
            <img src="{{ asset('images/6.jpg') }}?image=251" class="img-fluid rounded">
            <a href="{{ asset('images/6.jpg') }}?image=251" data-toggle="lightbox" data-gallery="gallery" class="overlay">
                <h2 class="title">Click To View</h2><br>
                <i style="font-size: 35px; line-height: 3" class="fas fa-expand-arrows-alt"></i>
            </a>
        </div>       
    </div>
</div>

<script>
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
</script>

<div class="container py-5">
    <div class="row justify-content-center">
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
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal"><i class="fas fa-times"></i> CLOSE</button>
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
                        <button id="save-order" data-id="" type="button" class="btn btn-primary btn-block"><i class="fas fa-save"></i> SAVE
                            ORDER</button>
                        <button id="cancel-order" data-id="" type="button" class="btn btn-danger btn-block ml-0"><i class="fas fa-times"></i> CANCEL
                            ORDER</button>
                        <button type="button" class="btn btn-secondary btn-block ml-0" data-dismiss="modal"><i class="fas fa-times"></i> CLOSE</button>
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
            });
        </script>
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
