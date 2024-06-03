@extends('layouts.dashboardlayouts')
@section('backend')
<section id="profile">

    <div class="container mt-5 pt-4" >
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-success-subtle">
                    <div class="card-header">
                        <h3>profile page </h3>
                    </div>
         
            <div class="card-body ">

  <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method('put')

    <input name="name" value="{{auth()->user()->name}}"  type="text" class=" from-control my-2  " placeholder="First Name">
    @error('name')
    <span class="text-danger">{{$message }}</span>
    @enderror
    
    <input name="email"  value="{{auth()->user()->email}}"  type="text" class=" from-control my-2 " placeholder="Emai Name">
  @error('email')
  <span class="text-danger">{{$message }}</span>   
  @enderror
    
    <label for="" class="my-2 d-block">
    <input name="profile_img" type="file" class=" from-control my-2 " placeholder="choice File">
    @error('profile_img')
    <span class="text-danger">{{$message }}</span>
    @enderror
    </label>

    <button class="btn btn-primary" type="submit">Update Profile</button>



  </form>


            </div>
        </div>
    </div>






            <div class="col-lg-4">
                <div class="card bg-success-subtle">
                    <div class="card-header  ">
                        <h3>Password Upadate</h3>
                    </div>
                    <div class="card-body ">
                     
   <form action=""  method="">

  @csrf
     @method('put')
    <input name="old" type="text" class=" from-control my-2  " placeholder="old password">
    @error('old')
    <span style="color: red" >{{ $message }}</span>
    @enderror
    <input name="new"  type="text" class=" from-control my-2  " placeholder="New password">
    @error('new')
    <span style="color: red" >{{ $message }}</span>
    @enderror
    <input name="password_confirmation"  type="text" class=" from-control my-2  " placeholder="confirme password">
    @error('password_confirmation')
    <span style="color: red" >{{ $message }}</span>
    @enderror
    <button class="btn btn-primary" type="submit"> Password Update</button>
   </form>


                    </div>
            </div>
        </div>

    </div>

</section>



@endsection