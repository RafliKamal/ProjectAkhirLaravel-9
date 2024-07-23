<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="corona/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="corona/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="corona/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="corona/assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="corona/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="corona/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <div class="text-center">
                  <h3 class="card-title text-center mb-3 mt-3">Sistem Informasi Manajemen Ujian</h3>
                  <img width="150px"  src="https://045042.sgp1.digitaloceanspaces.com/sikad/gambar/Logo.MtOnvco5l0.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&amp;X-Amz-Credential=DO00HKV7BJTGPCB4T4BN%2F20240723%2Fsgp1%2Fs3%2Faws4_request&amp;X-Amz-Date=20240723T074859Z&amp;X-Amz-Expires=86400&amp;X-Amz-SignedHeaders=host&amp;x-id=GetObject&amp;X-Amz-Signature=c0482e9c68c572de00f3c3048a94e9dc4a8be9b16439d1bec8f033d3e20a7d5c" >
                </div>
                <form method="POST" action="/login">
                  @csrf
                  @if (session()->has('loginError'))
                      {{session('loginError')}}  <br>             
                  @endif
                  <div class="form-group mt-3">
                    <label>Email</label>
                    <input type="text" class="form-control p_input" name="email">
                    @error('email')
                        {{$message}} <br>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control p_input" name="password">
                  </div>
                  <div class="text-center d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Masuk</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script href="corona/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script href="corona/assets/js/off-canvas.js"></script>
    <script href="corona/assets/js/misc.js"></script>
    <script href="corona/assets/js/settings.js"></script>
    <script href="corona/assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>