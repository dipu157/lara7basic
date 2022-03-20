<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables-select.min.css') }}">
</head>

<body class="fix-header fix-sidebar">

    <div class="container">
        <div class="row justify-content-center d-flex mt-5 mb-5">
            <div class="card">

                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Registration Form</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <!-- Default form register -->
                    <form class="text-center border border-light p-5 registerForm" action=" ">

                        <p class="h4 mb-4">Sign up</p>

                        <input type="text" id="name" name="name" value="" class="form-control mb-4"
                                    placeholder="Full name">

                        <!-- E-mail -->
                        <input type="email" id="email" name="email" value="" class="form-control mb-4"
                            placeholder="E-mail">

                        <!-- Password -->
                        <input type="password" id="password" name="password" value="" class="form-control"
                            placeholder="Password">
                        <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                            At least 8 characters and 1 digit
                        </small>

                        <!-- Newsletter -->
                        {{-- <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter">
                            <label class="custom-control-label" for="defaultRegisterFormNewsletter">Subscribe to our
                                newsletter</label>
                        </div> --}}

                        <!-- Sign up button -->
                        <button class="btn btn-info my-4 btn-block" type="submit">Sign Up</button>

                        <!-- Social register -->
                        <p>or sign up with:</p>

                        <a href="#" class="mx-2" role="button"><i
                                class="fab fa-facebook-f light-blue-text"></i></a>
                        <a href="#" class="mx-2" role="button"><i
                                class="fab fa-twitter light-blue-text"></i></a>
                        <a href="#" class="mx-2" role="button"><i
                                class="fab fa-linkedin-in light-blue-text"></i></a>
                        <a href="#" class="mx-2" role="button"><i
                                class="fab fa-github light-blue-text"></i></a>

                        <hr>

                        <!-- Terms of service -->
                        <p>By clicking
                            <em>Sign up</em> you agree to our
                            <a href="" target="_blank">terms of service</a>
                        </p>

                        <!-- Register -->
                        <p>Already member?
                            <a href="{!! url('/') !!}">Login</a>
                        </p>

                    </form>
                    <!-- Default form register -->
                    <!-- Form -->

                </div>

            </div>
        </div>
    </div>

    </div>
    </div>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('js/custom.min-2.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>


    <script type="text/javascript">
        $('.registerForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serializeArray();
           
            var name = formData[0]['value'];
            var email = formData[1]['value'];
            var password = formData[2]['value'];

            axios.post('/userRegister', {
                    name: name,
                    email: email,
                    pass: password
                })
                .then(function(response) {

                    if (response.status == 200 && response.data == 1) {
                        window.location.href = "/dashboard";
                    } else {
                        toastr.error('Registration Filed! Try Again');
                    }

                }).catch(function(error) {
                    toastr.error('Registration Filed! Try Again');
                })
        })
    </script>
</body>

</html>
