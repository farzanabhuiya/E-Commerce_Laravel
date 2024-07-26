
@extends('layouts.dashboardlayouts')
@section('backend')


        <section class="content-header">					
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Cupon Code</h1>
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
                <form action="{{route('discountCupon.story')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                
                  
                
                <div class="card">
                    <div class="card-body">	
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif							
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">code</label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="code">	
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                </div>
                            </div>
                         	

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Max Uses</label>
                                    <input type="number" name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">	
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Max Uses_User</label>
                                    <input type="text" name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max_uses_user">	
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Type</label>
                                    <select name="type" id='type' class="form-control">
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Discount_amount</label>
                                    <input type="text" name="discount_amount" id="discount_amount" class="form-control" placeholder="discount_amount">	
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Min Amount</label>
                                    <input type="text" name="min_amount" id="min_amount" class="form-control" placeholder="min_amount">	
                                </div>
                            </div>
                            

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id='status' class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Starts_at</label>
                                    <input autocomplete="off" type="text" name="starts_at" id="starts_at" class="form-control" placeholder="Starts_at">	
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Expires_at</label>
                                    <input autocomplete="off" type="text" name="expires_at" id="expires_at" class="form-control" placeholder="Expires_at">	
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                </div>
                            </div> 

                         

                            
                        </div>
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </section>



        
@push('customJs')


<script>
    $(document).ready(function(){
        $('#starts_at').datetimepicker({
            // options here
            format:'Y-m-d H.i.s',
        });
    });


    $(document).ready(function(){
        $('#expires_at').datetimepicker({
            // options here
            format:'Y-m-d H:i:s',
        });
    });
</script>

@endpush


        
    
    @endsection





