
@extends('layouts.dashboardlayouts')
@section('backend')


        <section class="content-header">					
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Page</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{route('Page.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{route('Page.story')}}" method="post"  enctype="multipart/form-data" >
                    @csrf
                    
                
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                          @endif									
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug"  class="form-control" placeholder="Slug">	
                                </div>
                            </div>	

                         


                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Description</label>
                                    <textarea name="content" id="content" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
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

</script>

@endpush


        
    
    @endsection





