@extends('layouts.app')

@section('content')
<div class="header">
  <div class="header-container container">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h1 class="title">Annyeong Samgyupsal <br>
          Reservation Online System
        </h1>
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
        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary btn-block">Table Reservation</button>
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
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Available Table:</label>
                    <div class="col-12">
                      <select id="selectTableAvailable" class="form-control" name="selectTableAvailable">
                      </select>
                    </div>
                </div>

                <div class="form-group row">
                  <label for="date-input" class="col-12 col-form-label">Date & Time:</label>
                  <div class="col-12">
                    <input class="form-control" type="datetime-local" value="" id="date-input">
                  </div>
                </div>

                <div id="selectPackageBody" class="modal-body">
                  <div class="row">
                    @foreach($categories as $category)
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

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button id="submitSelectTable" type="button" class="btn btn-primary">CONTINUE</button>
              </div>
            </div>
          </div>
      </div>

      <script>
      $(document).ready(function() {
          var totalPerson = 0;
          $("#submitTotalPerson").click(function(){
              totalPerson = $('#totalPersonValue').val();
              //add loading
              $.post( "/api/getAvailableTable", {
                totalPerson : totalPerson,
              }).done(function( data ) {
                if(data.status == "login"){
                  window.location.href = "/login";
                  return;
                }
                if(data.status == "success"){
                  $.each(data.result, function (i, item) {
                      $('#selectTableAvailable').empty().append($('<option>', {
                          value: item,
                          text : "Table #" + item
                      }));
                  });
                }else{
                  $('#selectTableAvailable').empty().append($('<option>', {
                      value: 0,
                      text : "No table available"
                  }));
                }
                $('#exampleModal').modal('hide');
                $('#selectTableModal').modal('show')
              });
          });

          $('#submitSelectTable').click(function(){
            var tableId = $('#selectTableAvailable').val();
            var date = $('#date-input').val();
            var categoryId = [];
            var categoryQuantity = [];

            $('input[type=number]').each(function (index, value) {
                var curThis = $(this);
                var id = curThis.data('id');
                var quantity = curThis.val();
                if(quantity != 0){
                  categoryId.push(id);
                  categoryQuantity.push(quantity);
                }
            });

            if(date == ""){
              alert("Invalid time.");
              return;
            }
            if(categoryId.length == 0){
              alert("You have selected 0 order");
            }else{
              $.post( "/api/saveBook", {
                tableId : tableId,
                date : date,
                totalPerson : totalPerson,
                categoryId : categoryId,
                categoryQuantity : categoryQuantity,
              }).done(function( data ) {
                if(data.status == "login"){
                  window.location.href = "/login";
                  return;
                }
                console.log(data);
              });
            }
            //$('#selectPackageModal').modal('show');
          });
      });
      </script>
      @foreach($categories as $category)
      <div class="col-6 col-md-4 p-1">
        <a class="btnMenu" href="#reservation">
          <img src="{{ asset($category->image) }}" class="img-fluid mx-auto d-block"/>
        </a>
      </div>
      @endforeach

      <div class="col-md-12 text-center m-4" style="background: #dbdbdb;">
        <h1 class="title">Our Store</h1>
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

</script>

<script>
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
        $(".navbar").addClass("bg-white");
    }else{
      $(".navbar").removeClass("bg-white");
    }
  });
</script>
@endsection
