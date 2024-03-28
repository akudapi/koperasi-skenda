@extends('layout.main')

@section('content')
<div class="content-wrapper">

    <div class="container-pkks" style="font-family: 'Poppins'; ">

        <div class="title">
            <h2>Tambah Data User</h2>                
        </div>
        <div class="hr-3">
            <hr>
        </div>

        <form class="form-user" action="{{ route('admin.user.store') }}" method="post">
            @csrf
            <div class="card-user">
                <p>Form Tambah Data User</p>
                
            </div>    
            
            <div class="form-pad">

                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama">
                        @error('name')
                        <small>{{ $message }}</small>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email">
                        @error('email')
                        <small>{{ $message }}</small>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="level">Level :</label>
                    <select class="form-control" name="level">
                        <option value="admin">Admin</option>
                        <option value="user" selected>User</option>
                    </select>
                        @error('level')
                        <small>{{ $message }}</small>
                        @enderror
                </div> 

                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
                        @error('password')
                        <small>{{ $message }}</small>
                        @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>

        </form>
        
    </div>

</div>
@endsection