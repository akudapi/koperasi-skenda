<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KOPERASI SKENDA | Log in</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link
    rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}"
    />

    <style>


        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 45px;
        }

        .logo img {
            width: 100px;
            margin-top: 60px;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #F0F0F0;
            border-radius: 10px;
            width: 500px;
            height: 450px;
        }

        .main-content h1 {
            margin-top: 50px;
            font-family: "Poppins", sans-serif;
            font-size: 40px;
            font-weight: 400;
        }

        .main-content form {
            width: 350px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .box-input {
            display: flex;
            justify-content: space-between;
            margin: 10px;
            border-bottom: 2px solid #000000;
            padding: 8px 0;
        }

        .box-input i {
            font-size: 23px;
            color: #000000;
            padding: 5px 0;
        }

        .box-input input {
            width: 85%;
            padding: 5px 0;
            background: none;
            border: none;
            outline: none;
            color: #000000;
            font-size: 18px;
        }

        .box-input input::placeholder {
            color: #000000;
        }

        .side-input {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin: 20px 10px 0 6px;
        }

        .btn {
            display: flex;
            justify-content: center;
        }

        .btn button{
            width: 100px;
            height: 30px;
            margin-top: 40px;
            background-color: #68B2A0;
            color: #ffffff;
            border: none;
            border-radius: 15px
        }

    </style>

</head>
<body>

    <main>
        <div class="logo">
            <img src="{{ asset('image/smkn2.png') }}" alt="logo skenda">
        </div>

        <div class="main-content">
            <h1>Login</h1>

            <form action="{{ route('login-proses') }}" method="post">
                
                @csrf
                <div class="box-input">
                    <input type="email" name="email" placeholder="Email">
                    <i class="fas fa-envelope"></i>
                </div>
                @error('email')
                <small>{{ $message }}</small>
                @enderror
                <div class="box-input">
                    <input type="password" name="password" placeholder="Password">
                    <i class="fas fa-key"></i>
                </div>
                @error('password')
                <small>{{ $message }}</small>
                @enderror

                <div class="side-input">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" />
                        <label for="remember"> Remember </label>
                    </div>
                    <div>
                        <a href="{{ route('register') }}">Register</a>
                    </div>
                </div>

                <div class="btn">
                    <button type="submit">
                      Sign In
                    </button>
                </div>

            </form>
            
        </div>
    </main>


    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if($message = Session::get('success'))
        <script>
            Swal.fire('{{ $message }}');  
        </script>
    @endif

    @if($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');  
        </script>
    @endif

    
</body>
</html>