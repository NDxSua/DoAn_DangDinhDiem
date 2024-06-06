@extends('layouts.main')

@section('content')
<main class="main">
    <section style="background-color: #f4f5f7;">
<div class="container py-5 h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col col-lg-6 mb-4 mb-lg-0">
  <div class="card mb-3" style="border-radius: .5rem;">
    <div class="container">
      <div class="col-md-4 text-center text-white d-flex justify-content-start align-items-center"
        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
        <img src="{{url('assets')}}/images/clients/client-1.jpg"
          alt="Avatar" class="img-fluid my-5 mb-0" style="width: 120px;" />
        <div class="d-flex justify-content-center align-items-center flex-column p-3" style="justify-content: start !important;">
          <h5 class="mt-3 mb-1">Đặng Đình Điềm</h5>
          <p>Customer</p>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card-body p-4" style="max-width: 550px">
          <p style="width: max-content; border-radius: 6px;" class="p-1 m-1">
            <span class="m-1"><i class="fas fa-edit"></i></span>
            <a href="#!" style="color: black;">Edit Profile</a>
          </p>
          <hr class="mt-0 mb-4">
          <div class="row pt-1">
            <div class="col-6 mb-3">
              <h6>Email</h6>
              <p class="text-muted">diem12@gmail.com</p>
            </div>
            <div class="col-6 mb-3">
              <h6>Phone</h6>
              <p class="text-muted">123 456 789</p>
            </div>
          </div>
          <h6></h6>
          <hr class="mt-0 mb-4">
          <div class="row pt-1">
            <div class="col-6 mb-3">
              <h6>My Order</h6>
              <p class="text-muted"><a href="http://127.0.0.1:8000/order">View Order (0)</a></p>
            </div>
            <div class="col-6 mb-3">
              <h6>Link</h6>
              <p class="text-muted"></p>
            </div>
          </div>
          <div class="d-flex justify-content-start">
            <a href="#!" class="m-2"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
            <a href="#!" class="m-2"><i class="fab fa-twitter fa-lg me-3"></i></a>
            <a href="#!" class="m-2"><i class="fab fa-instagram fa-lg"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</section>  
</main><!-- End .main -->
    
@endsection