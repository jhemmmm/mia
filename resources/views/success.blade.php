@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                Transaction details
                <div class="float-right">
                    <a onclick="printDiv()" href="#"><i class="fas fa-print"></i> PRINT</a>
                </div>
                </div>
                <div class="card-body" id="DivIdToPrint">
                   <div class="text-center text-success">
                        <i style="font-size: 150px" class="far fa-check-circle"></i>
                        <h1>You have successfully paid reservation #{{ $book->id }}</h1>
                   </div>
                   <hr>
                   <div class="row">
                        <div class="col-6 text-left">
                            Reservation# {{ $book->id }} <br>
                            Date: {{ $book->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a') }}
                        </div>
                        <div class="col-6 text-right">
                            <h1>₱ -{{ $total }}</h1>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h5 style="background: #ffffff9e;">Items</h5>
                            @foreach($book->category as $category)
                            <div class="float-left"><b>{{ $category->name }}</b></div>  
                            <div class="float-right">
                                ₱ {{ $category->price }}
                            </div>
                            @endforeach
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
$( document ).ready(function() {
    Email.send({
        Host : "smtp25.elasticemail.com",
        Username : "warrockph24@gmail.com",
        Password : "d8490dfe-be04-40cc-a361-1af431da7226",
        To : 'maejhem1@gmail.com',
        From : "warrockph24@gmail.com",
        Subject : "Order #" + <?php echo $book->id; ?> + " Has been successfully paid",
        Body : $('#DivIdToPrint').html()
    }).then( message => console.log(message));
});
function printDiv() 
{
  var divToPrint=document.getElementById('DivIdToPrint');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
}
</script>
@endsection
