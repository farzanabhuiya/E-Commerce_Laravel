
@extends('layouts.dashboardlayouts')
@section('backend')


        <section class="content-header">					
            <div class="container-fluid my-2">
                @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
                  @endif
                  
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create User</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{route('User.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{route('User.story')}}" method="post"  enctype="multipart/form-data" >
                    @csrf
                    @method('post')
                    
                
                <div class="card">
                    <div class="card-body">
                    									
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Email</label>
                                    <input type="text" name="email" id="email"  class="form-control" placeholder="Email">	
                                </div>
                            </div>	
               
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">PassWord</label>
                                    <input type="text" name="password" id="password"  class="form-control" placeholder="Password">	
                                </div>
                            </div>	

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Phone</label>
                                    <input type="text" name="mobile" id="slug"  class="form-control" placeholder="Phone">	
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




                            <div>
                                <input name="image" type="file" class="form-control my-3">
                            </div>

                  

                        

                            
                        </div>
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button class="{{route('User.index')}}">Create</button>
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





