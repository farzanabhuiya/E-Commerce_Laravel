
@extends('layouts.frontendlayouts')
@section('frontend')

<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">    
        <div class="container  mt-5">
            <form action="{{route('account.wishlist')}}" method="post" id="wishlist" name="wishlist">
                @csrf
            <div class="row">



    <div class="col-lg-4 pt-5">
     <div class="card bg-success-subtle">
      <div class="card-body ">
    <form action=""  method="">
    @csrf
        <ul id="account-panel" class="nav nav-pills flex-column" >
            <li class="nav-item">
                <a href="account.php"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-login" aria-expanded="false"><i class="fas fa-user-alt"></i> My Profile</a>
            </li>
            <li class="nav-item">
                <a href="{{route('account.order')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i>My Orders</a>
            </li>
            <li class="nav-item">
                <a href="{{route('account.wishlist')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-heart"></i> Wishlist</a>
            </li>
            <li class="nav-item">
                <a href="change-password.php"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-lock"></i> Change Password</a>
            </li>
            <li class="nav-item">
                <a href="login.php" class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
        </form>           
          </div>
            </div>
              </div>

        
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                        </div>
                        <div class="card-body p-4">
                            @foreach ($wishlists as $wishlist )
                                
                           
                            <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{route('front.product',$wishlist->product->slug)}}" style="width: 10rem;"><img src="" alt="Product"></a>
                                    <div class="pt-2">
                                        <h3 class="product-title fs-base mb-2"><a href="{{route('front.product',$wishlist->product->slug)}}">{{$wishlist->product->title}}</a></h3>                                        
                                        <div class="fs-lg text-accent pt-2">
                                            <span class="h5"><strong>${{$wishlist->product->price}}</strong></span>
                                
                               
                                            <span class="h6 text-underline"><del>${{$wishlist->product->compare_price}}</del></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                    <button onclick="removeWishlist({{ $wishlist->product_id}});" id="deleteBtn" class="btn btn-outline-danger btn-sm" type="button"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                                
                                      </div>
                                </div>
                            </div>  
                            @endforeach
                       
                            
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        

    </section>
</main>



@push('customJs')

<script type="text/javascript">
   function removeWishlist(id){
    $.ajax({
        url:"{{route('wishlisht.delete')}}",
        type:'post',
        data:{id:id},
        dataType:'json',
        success:function(response){
            if(response.status == true){
                alert(response.message);
                // $('#deleteBtn').html(response.message);
                window.location.href="{{route('account.wishlist')}}";
            }

        }
    })
   }
</script>

@endpush
@endsection






