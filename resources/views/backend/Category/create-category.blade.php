
		@extends('layouts.dashboardlayouts')
		@section('backend')
		

				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Category</h1>
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
						<form action="{{route('category.store')}}" method="post"  enctype="multipart/form-data" >
							@csrf
							
						
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
											<label for="slug">Slug</label>
											<input type="text" name="slug" id="slug"  class="form-control" placeholder="Slug">	
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
											<label for="status">Show on Home</label>
											<select name="showhome" id='showhome' class="form-control">
												<option value="yes">Yes</option>
												<option value="no">No</option>
											</select>
										</div>
									</div>

									<div>
										<input name="image" type="file" class="form-control my-3">
									</div>

                          

									{{-- <div   class="col-md-6">
										<div   class="mb-3">
											<label  for="image">image</label>
												      
											<div name='image' id='image' class="dropzone dz-clickable">
												<div  name='image'class= "dz-message needsclick">
													<br>Drop file here or click to upload.<br><br>
												</div>
											</div>
										</div> 
									</div>  --}}
								

									
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




//      Dropzone.options.image = {
//          maxFilesize: 1, // MB
//          acceptedFiles: "image/*",
//          init: function () {
//              this.on("success", function (file, response) {
//                  console.log(response);
//            });
//          }
//  };



















 
//  Dropzone.autoDiscover = false;
// 	   const dropzone = $('#image').dropzone({
// 		init:function(){
// 			this.on('addedfile',function(file){
// 				 if(this.file.length > 1){
// 					this.removeFile(this.files[0]);
// 				 }
// 			});
// 		},
// 		
// 		maxFiles: 1,
// 		paramName:'image',
// 		addRemoveLinks: true,
// 		acceptedFiles:"image/jpeg,image/png,image/gif",
// 		headers:{
// 			'x-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
// 		}, success: function(file, response){
// 			$("#image_id").val(response.image_id);
// 			//console.log(response)

// 		}

// 	   });

</script>

@endpush

  
				
			
			@endsection





