<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('backend/css/homecss.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('icofont/icofont.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="row m-0">
        <div class="col-lg-1">  
                <svg class="text_admin">
                    <!-- Symbol-->
                    <symbol id="s-text">
                        <text text-anchor="middle" x="50%" y="50%" dy=".35em">ADMIN</text>
                    </symbol>
                    <!-- Duplicate symbols-->
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                </svg>
            <div class="menu_admin">
                <div class="btn_show_menu mt-4">
                    <span class="btn btn-info">
                        <div class="btn-group dropend">
                            <a type="button" class="text-decoration-none text-light dropdown-toggle ps-5" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{asset('/add-category')}}">Add Category</a></li>
                            </ul>
                        </div>
                    </span>
                    <span class="btn btn-info">
                        <div class="btn-group dropend">
                            <a type="button" class="text-decoration-none text-light dropdown-toggle ps-5" data-bs-toggle="dropdown" aria-expanded="false">
                                Product
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{asset('/add-product')}}">Add Product</a></li>
                                <li><a class="dropdown-item" href="{{asset('/list-product')}}">List Product</a></li>
                            </ul>
                        </div>
                    </span>
                </div>
            </div>
        </div>  
        <div class="col-lg-11">
            <div class="che_chu_admin border-3 border-bottom border-end mb-5"></div>
                @if(Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @elseif(Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                @endif
            @yield('content')
        </div>
    </div>

<!-- script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <!-- script -->
<script>
    CKEDITOR.replace('editor');

    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });//hiện thông báo 

    var text_err = $('.error-message span');
    if(text_err.text()){
        $(".error-message").fadeTo(7000, 500).slideUp(500, function(){
            $(".error-message").slideUp(500);
        });
    }else{
        $(".error-message").css("display","none");
    } //hiện thông báo lỗi
</script>

@yield('script')

</body>
</html>