<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create Account</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Zimbawe Teachers Leave and Transfer Management System</h1>
                            </div>
                            {{-- <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Full Name" name="full_name">
                                    </div>

                                    <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" name="email">
                                    </div>

                                    <div class="col-sm-6">
                                        <select class="form-control form-control-user" id="exampleLastName"
                                                placeholder="Gender">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <a href="login.html" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form> --}}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-group">
                                        @foreach($errors->all() as $error)
                                            <li class="list-group-item text-danger">
                                                {{$error}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                             @if (Session::has('success'))
                            <div class= "alert alert-success" role="alert">
                            {{ Session::get('success')}}
                            </div>
                            {{-- @elseif (session::has('updated'))
                            <div class="alert alert-info" role="alert">
                                {{Session::get('updated')}}
                            </div>

                            @elseif (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('error')}}
                            </div> --}}
                            @endif
                                <h1 class="alert alert-success">You have succesffuly Registered</h1>
                            <form method="POST" action="{{ route('teacher.store')}}">
                            @csrf
                                <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name">
                                </div>
                                <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                                </div>
                                <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                <option value="user">Teacher</option>
                                <option value="admin">Admin</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
                                </div>
                                <div class="form-group">
                                <label for="id_no">ID Number</label>
                                <input type="text" class="form-control" name="id_no" id="id_no" placeholder="Enter your ID number">
                                </div>
                                <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob">
                                </div>
                                <div class="form-group">
                                <label for="grade_level">Grade Level</label>
                                <select class="form-control" id="grade_level" name="grade_level">
                                <option value="grade 1">Grade 1</option>
                                <option value="grade 2">Grade 2</option>
                                <option value="grade 3">Grade 3</option>
                                <option value="grade 4">Grade 4</option>
                                <option value="grade 5">Grade 5</option>
                                <option value="grade 6">Grade 6</option>
                                <option value="grade 7">Grade 7</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" class="form-control" id="district" name="district" placeholder="Enter your district">
                                </div>
                                <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province" placeholder="Enter your province">
                                </div>
                                <div class="form-group">
                                <label for="class_course">Class Course</label>
                                <input type="text" class="form-control" id="class_course" name="class_course" placeholder="Enter your class course">
                                </div>
                                <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Enter your qualification">
                                </div>
                                <div class="form-group">
                                <label for="school">School</label>
                                <input type="text" class="form-control" id="school" name="school" placeholder="Enter your school">
                                </div>
                                <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>