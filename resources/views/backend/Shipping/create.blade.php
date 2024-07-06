
@extends('layouts.dashboardlayouts')
@section('backend')


        <section class="content-header">					
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Shipping</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{route('shipping.story')}}" method="post"  enctype="multipart/form-data" >
                    @csrf
                    
                
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <select name="country" id="countrie_id" class="form-control">
                                        <option value="">Select a Country</option>
                                         @forelse ($countries as $countrie )
                                               {{-- <option {{(!empty($CustomerAddersse) && $CustomerAddersse->countrie_id == $countrie->id)? 'seleted' : ""}} value="{{$countrie->id}}">{{$countrie->name}}</option> --}}
                                     <option value="{{$countrie->id}}">{{$countrie->name}}</option>
                                         @empty
                                             
                                         @endforelse 
                                         <option value="rest">Rest of the world</option>
                                 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="slug">Amount</label>
                                    <input type="text" name="amount" id="amount"  class="form-control" placeholder="amount">	
                                </div>
                            </div>	

                            <div class="pb-5 pt-3">
                                <button class="btn btn-primary">Create</button>
                              
                            </div>
                        </div>

                    </div>							
                </div>
              
                </form>

                 <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                          <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($shippings as $shipping)
                                <tr>

                                    <td>{{$shipping->id}}</td>
                                <td>{{$shipping->name}}</td>
                                <td>${{$shipping->amount}}</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-primary">Deleted</a>
                                </td>

                                </tr>
                            @endforeach
                          </table>

                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- /.card -->
        </section>
@endsection




