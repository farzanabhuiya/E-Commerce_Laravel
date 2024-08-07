@extends('layouts.frontendlayouts')
@section('frontend')
    



<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{route('front.homepage')}}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{route('front.shopPage')}}">Shop</a></li>
                <li class="breadcrumb-item">Cart</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-9 pt-4">
    <div class="container">
        <div class="row">
      
            @if (Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                         {{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
            @endif



            @if (Session::has('error'))
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     {{Session::get('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
        @endif




            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table" id="cart">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($cartContents as $item)
                            
                      
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/product/'.$item->image)}}" >
                                        <h2>{{$item->name}}</h2>
                                    </div>
                                </td>
                                <td>${{$item->price}}</td>
                                <td>
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-id="{{$item->rowId}}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{$item->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-id="{{$item->rowId}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                   $ {{$item->price*$item->qty}}
                                </td>

                                <td>
                                    <button id="deleteBtn" class="btn btn-sm btn-danger "><i class="fa fa-times"></i></button>
                                    <form action="{{ route('front.deleteCart',$item->rowId) }}" method="post">
                                        @csrf
                                    @method('DELETE')
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                                                         
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">            
                <div class="card cart-summery">
                    <div class="sub-title">
                        <h2 class="bg-white">Cart Summery</h3>
                    </div> 
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2">
                            <div>Subtotal</div>
                            <div>${{Cart::subtotal()}}</div>
                        </div>
                        {{-- <div class="d-flex justify-content-between pb-2">
                            <div>Shipping</div>
                            <div>$0</div> --}}
                        </div>
                        <div class="d-flex justify-content-between summery-end">
                            <div>Total</div>
                             <div>${{Cart::subtotal()}}</div> 
                        </div>
                        <div class="pt-5">
                            <a href="{{route('front.checkout')}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>     
                
            </div>
        </div>
    </div>
</section>





               @push('customJs')
              
               <script>

               $('.add').click(function(){
                    var qtyElement = $(this).parent().prev(); // Qty Input
                    var qtyValue = parseInt(qtyElement.val());
                    if (qtyValue < 10) {
                       
                         qtyElement.val(qtyValue+1);
                         var rowId = $(this).data('id');
                         var newQty = qtyElement.val();
                         updateCart(rowId,newQty)
                     }            
                 });

                 $('.sub').click(function(){
                    var qtyElement = $(this).parent().next(); 
                    var qtyValue = parseInt(qtyElement.val());
                    if (qtyValue > 1) {
                        qtyElement.val(qtyValue-1);

                        var rowId = $(this).data('id');
                         var newQty = qtyElement.val();
                        updateCart(rowId,newQty)
                    }        
                 });


                 function updateCart(rowId,qty){
                    $.ajax({
                        url:"{{route('front.updateCart')}}",
                        type:'post',
                        data:{rowId:rowId, qty:qty},
                        dataType:'json',
                        success:function(response) {

                            if(response.status == true){
                                window.location.href= '{{route("front.cart")}}';
                            }
                            
                        }

                    });
                 }
               </script>
              


            
                 
                 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

$('#deleteBtn').click(function (event){

  event.preventDefault()
    Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
   $(this).next('form').submit().prev()
  }
});

});

    </script>
@endpush


 
@endsection