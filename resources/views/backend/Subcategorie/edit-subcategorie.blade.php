@extends('layouts.dashboardlayouts')
@section('backend')
	

				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Sub Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('Subcategorie.story')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					@if (session('success'))
					<div class="alert alert-success">{{session('success')}}</div>
				    @endif
					<!-- Default box -->
					<div class="container-fluid">
						<form action="{{route('Subcategorie.update',$subcategorie->id)}}" method="post" >
							@csrf
							@method('put')
							
						<div class="card">
							<div class="card-body">								
								<div class="row">
                                    <div class="col-md-12">
										<div class="mb-3">
											{{-- <label for="name">Category</label>
											<select name="category_id" id="category" class="form-control">
												@forelse ($categories as $category )
                                                <option  value="{{  $category->id }}">{{ $category->name }}</option>
                                             
												@empty
										        <option disabled selected>No catrgory found</option>
										      @endforelse
                                            </select> --}}
										</div>
									</div>

									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input value="{{$subcategorie->name}}" type="text" name="name" id="name" class="form-control" placeholder="Name">	
										</div>
									</div>
									{{-- <div class="col-md-6">
										<div class="mb-3">
											<label for="email">Slug</label>
											<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">	
										</div>
									</div>									 --}}
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button class="btn btn-primary">Update</button>
							<a href="subcategory.html" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</form>
					</div>
					<!-- /.card -->
				</section>
				@endsection