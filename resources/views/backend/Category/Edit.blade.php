
@extends('layouts.dashboardlayouts')
@section('backend')


        <section class="content-header">					
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{route('category')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{$category->name}}" name="name" id="name" class="form-control" placeholder="Name">	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug"  class="form-control" placeholder="Slug">	
                                </div>
                            </div>	
                          

                            <div>
                                <input value="{{$category->image}}" name="image" type="file" class="form-control my-3">
                            </div> 
                  

                        
                        </div>
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create Update</button>
                    <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </section>



        
@push('customJs')



<script>


</script>

@endpush


        
    
    @endsection





