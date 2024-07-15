

@extends('layouts.dashboardlayouts')
@section('backend')

				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Order#</h1>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="card">
							<form action="" method="get">
							<div class="card-header">
								   <div class="card-title">
									<button type="button" onclick="window.location.href='{{route('order.index')}}'" class="btn btn-primary bt-sm">Reset</button>
								   </div>
								
								<div class="card-tools">
									<div class="input-group input-group" style="width: 250px;">
										<input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
					
										<div class="input-group-append">
										  <button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										  </button>
										</div>
									  </div>
								</div>
						
							</div>
						</form>
							<div class="card-body table-responsive p-0">								
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th>Customer Name</th>
											<th>Email</th>
                                            <th>Phone</th>
											<th width="100">Status</th>
											<th>Total</th>
                                            <th>Date Purchased</th>
										</tr>
									</thead>
									<tbody>
										@foreach ( $orders as $order)
											
										<tr>
											{{-- <td>{{$categories->firstITEM()  +$key}}</td> --}}
											<td><a href="{{route('order.detail',[$order->id])}}">{{$order->id}}</a></td>
											<td>{{$order->name}}</td>
											<td>{{$order->email}}</td>
                                            <td>{{$order->mobile}}</td>
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
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M,Y')}}</td>


										</tr>
								
										@endforeach
										
									</tbody>
								</table>
								{{$orders->links()}}										
							</div>
						
						</div>
					</div>
				
				</section>
				
	@endsection
			