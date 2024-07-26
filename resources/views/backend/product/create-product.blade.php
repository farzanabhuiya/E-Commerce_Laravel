@extends('layouts.dashboardlayouts')
@section('backend')


				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Product</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('Product.all')}}" class="btn btn-primary">Back</a>
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
                        <form action="{{route('Product.story')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                           
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">	
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">shipping and Returns</label>
                                                    <textarea name="shipping_returns" id="shipping_returns" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                                </div>
                                            </div>   
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Short Description</label>
                                                    <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                                </div>
                                            </div> 

                                        </div>
                                    </div>	                                                                      
                                </div>



                                
									<div>
										<input name="image" type="file" class="form-control my-3">
									</div>

                                 
                          
                                {{-- <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Media</h2>								
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">    
                                                <br>Drop files here or click to upload.<br><br>                                            
                                            </div>
                                        </div>
                                    </div>	                                                                      
                                </div> --}}


                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">	
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="compare_price">Compare at Price</label>
                                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                                    <p class="text-muted mt-3">
                                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                                    </p>	
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Inventory</h2>								
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">	
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                                </div>
                                            </div>   
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="d-none" type="text" value="no" name="track_qty" >
                                                        <input class="custom-control-input" type="checkbox" id="track_qty" value="yes" name="track_qty" checked>
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">	
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>	                                                                      
                                </div>



                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Related products</h2>
                                        <div class="mb-3">
                                       <select multiple class="related_product w-100" name="related_products[]" id="related_products">
                                              
                                       </select>
                                        </div>
                                    </div>
                                </div> 






                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category"  class="form-control categorySelect ">
                                                @forelse ($categories as $category )
                                                <option  value="{{  $category->id }}">{{ $category->name }}</option>
                                             
												@empty
										        <option disabled selected>No catrgory found</option>
										      @endforelse
                                                
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category">Sub category</label>
                                            <select name="subcategorie" id="sub_category" class="form-control subcategorieSelect">
                                                <option disabled selected>Select SubCategory </option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product brand</h2>
                                        <div class="mb-3">
                                            {{-- <select name="status" id="status" class="form-control"> --}}
                                                  <select name="brand" id="status" class="form-control">
                                                @forelse ($brands as $brand )
                                                <option  value="{{  $brand->id }}">{{ $brand->name }}</option>
                                             
												@empty
										        <option disabled selected>No brand found</option>
										      @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Featured product</h2>
                                        <div class="mb-3">
                                            <select name="is_featured" id="status" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>                                 
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button class="btn btn-primary">Create</button>
							<a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
                    </form>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->

			


@push('customJs')

<script>
$('.categorySelect').change(getSubcategories)
function getSubcategories(){
    $.ajax({
        url:`{{route('Subcategorie.get')}}`,
        method:'get',
        data:{
            categoryId:$(this).val()
        },
        success:function(res){
            let options=[]

            if(res.length >0){

                res.forEach(subcategorie=>{
                let optionTag=`<option value ='${subcategorie.id}'>${subcategorie.name}</option>`
                options.push(optionTag)
            })
              $('.subcategorieSelect').html(options)

            }else{
                
                let optionTag= `<option disable selected>Subcategories has been no found </option>`
                $('.subcategorieSelect').html(optionTag)
            }
            
        }
    });
};






$('.related_product').select2({
    ajax: {
        url: '{{ route("Product.related") }}',
        dataType: 'json',
        tags: true,
        multiple: true,
        minimumInputLength: 3,
        processResults: function (data) {
            return {
                results: data.tags
            };
        }
    }
}); 

</script>
@endpush

@endsection