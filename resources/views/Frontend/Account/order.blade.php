
@extends('layouts.frontendlayouts')
@section('frontend')



<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">My Order</li>
                </ol>
            </div>
        </div>
    </section>



    <section class=" section-11 ">    
        <div class="container  mt-5">
            <form action="{{route('account.order')}}">
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
                <a href=""  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i>My Orders</a>
            </li>
            <li class="nav-item">
                <a href="wishlist.php"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-heart"></i> Wishlist</a>
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
                            <h2 class="h5 mb-0 pt-2 pb-2">My Order</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> 
                                        
                                        <tr>
                                            <th>Orders #</th>
                                            <th>Date Purchased</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        @if ($orders->isNotEmpty())

                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{route('account.orderDetail',$order->id)}}">{{$order->id}}</a>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M,Y')}}</td>
                                            <td>
                                                @if ($order->status =="pending")
                                                <span class="badge bg-danger">Pending</span>  
                                                @elseif ($order->status =="shipped")
                                                <span class="badge bg-info">Shipped</span>
                                                @elseif ($order->status =="delivered") 
                                                <span class="badge bg-success">Delivered</span>
                                                @else
                                                <span class="badge bg-danger">Cancelled</span>
                                                @endif
                                               
                                                
                                            </td>
                                            <td>${{number_format($order->grand_total,2)}}</td>
                                        </tr>
                                        @endforeach
                                            
                                        @else
                                          <tr>
                                            <td colspan="3">order not found</td>
                                        </tr>  
                                        @endif
                                        
                                       
                                                                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        

    </section>
</main>








@endsection

