@extends('components.login')

@section('css')
<style>
 .authentication-wrapper {
  display: grid;
  place-items: center;
}
</style>
@endsection

@section('content')
<div class="container">
  <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
    <div class="authentication-inner py-6">

      <!-- Login -->
      <div class="card p-md-7 p-1" style="width: 45%;margin-left:250px;">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
              <span style="color:#666cff;">
                <svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z" fill="currentColor"></path>
                  <path d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z" fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4"></path>
                  <path d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z" fill="currentColor"></path>
                  <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="currentColor"></path>
                  <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4"></path>
                  <path d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z" fill="currentColor"></path>
                  <defs>
                    <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                      <stop offset="0" stop-opacity="1"></stop>
                      <stop offset="1" stop-opacity="0"></stop>
                    </linearGradient>
                    <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                      <stop offset="0" stop-opacity="1"></stop>
                      <stop offset="1" stop-opacity="0"></stop>
                    </linearGradient>
                  </defs>
                </svg>
              </span>
            </span>
            <span class="app-brand-text demo text-heading fw-semibold">Materialize</span>
          </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-1">
          <h4 class="mb-1">Welcome to Materialize! 👋</h4>
          <p class="mb-5">Please sign-in to your account and start the adventure</p>

          <form class="row g-4 form-save"  >
            <!-- Email input -->
            <div class="form-floating form-floating-outline">
              <input type="text" id="email" name="email" class="form-control" placeholder="email" value=""/>
              <label for="email">Email</label>
            </div>
          
            <!-- Password input -->
            <div class="form-floating form-floating-outline">
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" value=""/>
              <label for="paswword">Password</label>
            </div>
          
            <!-- 2 column grid layout for inline styling -->
            {{-- <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>
          
              <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
              </div>
            </div> --}}
          
            <!-- Submit button -->
            <div class="col-12 text-end">
              <button type="button" class="btn btn-primary me-sm-3 btn-submit me-1"><i
                class="mdi mdi-check-all me-1"></i>Sign In</button>
            </div>
           
          
            <!-- Register buttons -->
            {{-- <div class="text-center">
              <p>Not a member? <a href="#!">Register</a></p>
              <p>or sign up with:</p>
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
              </button>
          
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-google"></i>
              </button>
          
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-twitter"></i>
              </button>
          
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-github"></i>
              </button>
            </div> --}}
          </form>

          {{-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="auth-register-basic.html">
              <span>Create an account</span>
            </a>
          </p>

          <div class="divider my-5">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center gap-2">
            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook waves-effect waves-light">
              <i class="tf-icons ri-facebook-fill"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-twitter waves-effect waves-light">
              <i class="tf-icons ri-twitter-fill"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-github waves-effect waves-light">
              <i class="tf-icons ri-github-fill"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google-plus waves-effect waves-light">
              <i class="tf-icons ri-google-fill"></i>
            </a>
          </div> --}}
        </div>
      </div>
      {{-- <!-- /Login -->
      <img alt="mask" src="../../assets/img/illustrations/auth-basic-login-mask-light.png" class="authentication-image d-none d-lg-block" data-app-light-img="illustrations/auth-basic-login-mask-light.png" data-app-dark-img="illustrations/auth-basic-login-mask-dark.png"> --}}
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $('.btn-submit').click((e) => {
        e.preventDefault()
        let obj = new FormData($('.form-save')[0])
        console.log(obj)
        $.ajax({
                url: "{{ route('aksi_login') }}",
                type: 'POST',
                data: obj,
                async: true,
                cache: false,
                contentType: false,
                processData: false
            }).done((data) => {
                console.log(data)
                $('.form-save').validate(data, 'has-error')
                if (data.status == 'success') {
                    toastr.success(data.message);
                    // window.location.href = "/";
                    window.location.href = data.redirect;
                }else if (data.status == 'error'){
                    Swal.fire({
                    icon: "error",
                    title: "Maaf",
                    text: "Akun Tidak Dapat Ditemukan, Silahkan Cek Kembali Email Anda",
                    });
                }
            })
            .fail(function(xhr, status, error) {
                console.log(xhr.status)
                console.log(status)
                console.log(error)
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    console.log(errors)
                    $.each(errors, function(key, value) {
                        var input = $('[name="' + key + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                    });
                } else {
                    toastr.error('Terjadi kesalahan, silakan coba lagi.');
                    console.log("Request failed: " + status + ", " + error);
                }
            });
    })
</script>
 @endsection
   