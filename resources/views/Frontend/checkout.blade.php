@extends('layouts.frontendlayouts')
@section('frontend')



<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{route('front.homepage')}}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{route('front.shopPage')}}">Shop</a></li>
                <li class="breadcrumb-item">Checkout</li>
            </ol>
        </div>
    </div>
</section>
                    
{{-- @if (Session::has('success'))
<div class="alert alert-success">{{Session('success')}}</div>
@endif --}}
<section class="section-9 pt-4">


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="sub-title">
                    <h2>Shipping Address</h2>
                </div>
                <div class="card shadow-lg border-0">
                    <div class="card-body checkout-form">
                        <div class="row">
         
                         <form action="{{route('front.processCheckout')}}" method="post" >
                            @csrf
                            @method('post')
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{(!empty($CustomerAddersse)) ? $CustomerAddersse->first_name : ""}}" placeholder="First Name">
                                    @error('first_name')
                                    <span class="text-danger">{{$message }}</span>
                                   @enderror
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{(!empty($CustomerAddersse)) ? $CustomerAddersse->last_name : ""}}">
                                    @error('last_name')
                                    <span class="text-danger">{{$message }}</span>
                                   @enderror
                                </div>            
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{(!empty($CustomerAddersse)) ? $CustomerAddersse->email : ""}}">
                                    @error('email')
                                    <span class="text-danger">{{$message }}</span>
                                   @enderror
                                </div>            
                            </div>

                             <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="country" id="countrie_id" class="form-control">
                                        <option disabled selected >Select a Country</option>
                                         @forelse ($countries as $countrie )
                                               <option {{(!empty($CustomerAddersse) && $CustomerAddersse->countrie_id == $countrie->id)? 'selected' : ""}} value="{{$countrie->id}}">{{$countrie->name}}</option>
                                     {{-- <option value="{{$countrie->id}}">{{$countrie->name}}</option> --}}
                                         @empty
                                             
                                         @endforelse 
                                         <option value="rest">Rest the world</option>
                                 
                                    </select>
                                </div>            
                            </div> 

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control" value="{{(!empty($CustomerAddersse)) ? $CustomerAddersse->address : ""}}"></textarea>
                                </div>            
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="apartment" id="appartment" class="form-control"  placeholder="Apartment, suite, unit, etc. (optional)" value="{{(!empty($CustomerAddersse)) ? $CustomerAddersse->apartment : ""}}">
                                </div>            
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{(!empty($CustomerAddersse)) ? $CustomerAddersse->city : ""}}" >
                                </div>            
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="state" id="state" class="form-control" placeholder="State">
                                </div>            
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip">
                                </div>            
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No.">
                                    @error('mobile')
                                    <span class="text-danger">{{$message }}</span>
                                   @enderror
                                </div>            
                            </div>
                            

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control"></textarea>
                                </div>            
                            </div>

                        
                       
                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-md-4">
                <div class="sub-title">
                    <h2>Order Summery</h3>
                </div>                    
                <div class="card cart-summery">
                    <div class="card-body">
                        
                        @foreach (Cart::content() as $item )
                        <div class="d-flex justify-content-between pb-2">
                            <div class="h6">{{$item->name}} X {{$item->qty}}</div>
                            <div class="h6">${{$item->price*$item->qty}}</div>
                        </div>
                        @endforeach
                        
 
            
                    <div class="d-flex justify-content-between summery-end">
                        <div class="h6"><strong>Subtotal</strong></div>
                        <div class="h6"><strong>${{Cart::subtotal()}}</strong></div>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <div class="h6"><strong>Discount</strong></div>
                        <div class="h6"><strong id="discount_value">${{$discount}}</strong></div>
                    </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="h6"><strong>Shipping</strong></div>
                            <div class="h6"><strong id="shippingamount">${{number_format($totalshipping,2)}}</strong></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 summery-end">
                            <div class="h5"><strong>Total</strong></div>
                            <div class="h5"><strong id="grandTotal">${{number_format($grandTotal,2)}}</strong></div>
                        </div>                            
                    </div>
                </div>  
                        
                <div class="input-group apply-coupan mt-4">
                    <input type="text" name="code" placeholder="Coupon Code" class="form-control" name="discount_code" id="discount_code">
                    <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                </div>

                <div id="discount_res_wrapper">
                @if (Session::has('code')) 
                <div class="mt-4" id="discount_res">
                    <strong>{{ Session::get('code')->code}}</strong>
                    <a class="btn btn-sm btn-danger" id="remove_discount"><i class="fa fa-times"></i></a>
                </div> 
                @endif
            </div>
                
                <div class="card payment-form "> 
                        <h3 class="card-title h5 mb-3">Payment Method</h3> 
                        <div>
                           
                            <input type="radio" checked name="payment_method_1" value="cod" id="payment_method_one">
                            <label for="payment_method_one">Cash on Delivery</label>

                        </div>

                        <div>
                           
                            <input type="radio"  name="payment_method_1" value="COD" id="payment_method_tow">
                            <label for="payment_method_tow">Strip</label>

                        </div>
                  
                    <div class="card-body p-0 d-none "  id="card-payment-form">
                        <div class="mb-3">
                            <label for="card_number" class="mb-2">Card Number</label>
                            <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="expiry_date" class="mb-2">Expiry Date</label>
                                <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="expiry_date" class="mb-2">CVV Code</label>
                                <input type="text" name="expiry_date" id="expiry_date" placeholder="123" class="form-control">
                            </div>
                        </div>
                     
                    </div>  
                    <div class="pt-4">
                       
                        <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                    </div>                       
                </div>
            </form>

               
                <!-- CREDIT CARD FORM ENDS HERE -->
                
            </div>
        </div>
    </div>
</section>




@push('customJs')
<script>
    $('#payment_method_one').click(function(){
       if( $(this).is(':checked')==true){

            $('#card-payment-form').addClass('d-none');

       }
    });



    $('#payment_method_tow').click(function(){
       if( $(this).is(':checked')==true){

            $('#card-payment-form').removeClass('d-none');

       }
    });


$('#countrie_id').change(function(){
    $.ajax({
        url:"{{route('front.getorderSummery')}}",
        type:'post',
        data:{countrie_id:$(this).val()},
        dataType:'json',
        success:function(response){
            if(response.status == true){
                $('#shippingamount').html('$'+response.shipping);
                $('#grandTotal').html('$'+response.grandTotal);
            }
        }
    });
});

</script>



<script>

    $("#apply-discount").click(function(){
    $.ajax({
        url:"{{ route('front.applyCoupon') }}",
        type:'POST',
        data:{
            code:$("#discount_code").val(),
            countrie_id:$("#countrie_id").val()
    },
        dataType:'json',
        success:function(response){
    //    console.log(response.shipping);
         if(response.status == true){
            $('#shippingamount').html('$'+response.shipping);
            $('#grandTotal').html('$'+response.grandTotal); 
            $('#discount_value').html('$'+response.discount);
            $('#discount_res_wrapper').html(response.discountString);
         }else{
         $('#discount_res_wrapper').html("<span class='text-danger'>"+response.message+"</span>");
         }
  
        }

    });
});


             
 $('body').on('click',"#remove_discount",function(){
// $("#remove_discount").click(function(){
    $.ajax({
        url:"{{ route('front.removeCoupon') }}",
        type:'POST',
        data:{countrie_id:$("#country").val()},
        dataType:'json',
        success:function(response){
         if(response.status == true){
            $('#shippingamount').html('$'+response.shipping);
            $('#grandTotal').html('$'+response.grandTotal); 
            $('#discount_value').html('$'+response.discount);
            $('#discount_res').html('');
            $("#discount_code").val('');
         }
  
        }

    });
});
//  });


// });





</script>
@endpush
    
@endsection