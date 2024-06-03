@extends('layouts.frontendlayouts')
@section('frontend')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('front.homepage')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">            
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="accordion accordion-flush" id="accordionExample">
                                @foreach ($categorie as $key=>$category)
                                    
                            
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        
                                        <div  class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$key}}" aria-expanded="false" aria-controls="collapseOne-{{$key}}">
                                            <a href="{{route('front.shopPage',$category->slug)}}" class="nav-item nav-link {{($categorySeleted==$category->id)? 'text-primary':''}}">{{$category->name}}</a>
                                            {{-- {{$category->name}} --}}
                                        </div>
                                    </h2>
                                    <div id="collapseOne-{{$key}}" class="accordion-collapse collapse {{($categorySeleted==$category->id) ? 'show':'' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <div class="navbar-nav">
                                                @foreach ($category->Subcategorie as $subcategorie)
                                                <a href="{{route('front.shopPage',[$category->slug,$subcategorie->slug])}}" class="nav-item nav-link {{($subcategorieSeleted==$subcategorie->id)? 'text-primary':''}}">{{$subcategorie->name}}</a>
                                                @endforeach                                      
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                                @endforeach
                                          
                            </div>
                        </div>
                    </div>

























                      {{-- <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                  @if($categorie->isNotEmpty())
                                    @foreach ($categorie as $key=>$category)
                                   <div class="accordion-item">
                                    @if($category->subcategorie->isNotEmpty())
                                    <h2 class="accordion-header" id="headingOne">
                                        <button  class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$key}}" aria-expanded="false" aria-controls="collapseOne-{{$key}}">
                                           
                                            {{$category->name}}
                                        </button>
                                    </h2>
                                    @else

                                    <a href="{{route('front.shopPage',$category->slug)}}" class="nav-item nav-link {{($categorySeleted==$category->id)? 'text-primary':''}}">{{$category->name}}</a>
                                         @endif

                                         
                                         @if($category->subcategorie->isNotEmpty())
                                    <div id="collapseOne-{{$key}}" class="accordion-collapse collapse {{($categorySeleted==$category->id) ? 'show':'' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <div class="navbar-nav">
                                               
                                                @forelse ($category->Subcategorie as $subcategorie)
                                                <a href="{{route('front.shopPage',[$category->slug,$subcategorie->slug])}}" class="nav-item nav-link {{($subcategorieSeleted==$subcategorie->id)? 'text-primary':''}}">{{$subcategorie->name}}</a>
                                                    @endforeach        
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>  

                                @endforeach 
                              @endif
                            </div>
                        </div>
                    </div>  --}}





                    <div class="sub-title mt-5">
                        <h2>Brand</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @foreach ($brands as $brand )
                        
                            <div class="form-check mb-2">
                                <input {{(in_array($brand->id, $brandsArray)) ? "checked":''}} class="form-check-input brand-label"
                                 type="checkbox" name='brand[]' value="{{$brand->id}}" id="brand-{{ $brand->id }}">
                                <label class="form-check-label" for="brand-{{ $brand->id }}">
                                  {{$brand->name}}
                                </label>
                            </div> 
                                    
                            @endforeach            
                        </div>
                    </div>



                    <div class="sub-title mt-5">
                        <h2>Price</h2>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                           <input type="text" class="js-range-slider" name="my_rang" value=""/>
                        </div>
                    </div>
                </div>



                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                {{-- <div class="ml-2">
                                                                
                                <select name="sort" id="sort" class="form-control">
                                    <option value="latest" {{ ($sort == 'latest' ? 'seleted' : '')}}>Latest</option>
                                    <option value="price_desc" {{ ($sort == 'price_desc' ? 'seleted' : '')}}>Price High</option>
                                    <option value="price_asc"{{ ($sort == 'price_asc' ? 'seleted' : '')}}>Price Low</option>
                                </select>
                                
                                </div> --}}
                            </div>
                        </div>


                        @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{route('front.product',$product->slug)}}" class="product-img"><img class="card-img-top" src="{{asset('storage/product/'.$product->image)}}" alt=""></a>
                                    <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                                    <div class="product-action">
                                        <a class="btn btn-dark" href="#">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>                            
                                    </div>
                                </div>                        
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="product.php">{{$product->title}}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{$product->price}}</strong></span>
                                        <span class="h6 text-underline"><del>${{$product->compare_price}}</del></span>
                                    </div>
                                </div>                        
                            </div>                                               
                        </div>  
                        @endforeach
                        




                        <div class="col-md-12 pt-5">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
 
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 



  @push('customJs')
  <script>
       rangeSlider = $(".js-range-slider").ionRangeSlider({
        type:"double",
        min:0,
        max:100000,
        from:{{($priceMin)}},
        step:10,
        to:{{($priceMax)}},
        skin:"round",
        max_postfix: "+",
        prefixe:"$",
        
       onFinish:function(){
        apply_filters()
       }
    });
    var slider = $(".js-range-slider").data("ionRangeSlider");



  $(".brand-label").change(function(){
      apply_filters();
  });

    // $("#sort").change(function()){
    //     apply_filters();
    // }

      function apply_filters(){
      var brands = [];
     $(".brand-label").each(function(){
         if($(this).is(":checked") == true){
          brands.push($(this).val());
       }
     });



     var url ='{{url()->current() }}?';
     url += "&price_min"+slider.result.from+'&price_max='+slider.result.to;
        //brand filter
     if(brands.length > 0){
        url+='&brand='+brands.toString()
     }

    //  //price range filter
    // //  url += "&price_min" +slider.result.from+ '&price_max='+slider.result.to;
     

     //sorting
     //url += '&sort='+$('#sort').val()
     window.location.href = url;
     }

     </script>

        @endpush

    




         @endsection  









    


    

