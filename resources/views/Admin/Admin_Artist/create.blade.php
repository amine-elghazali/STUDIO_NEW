@extends('layouts.admin')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="bg-secondary  pt-5">
    <div class="card border-info w-50 m-auto">

        <div class="card-header">
            <h3 class="card-title"> Add an artist </h3>
        </div>


        <div class="card-body">
            <form action="/admin/Artists"  method="POST" enctype="multipart/form-data">
                @csrf

                <div  class="form-group">
                    <label for="fullName">Full name : </label>
                        <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Full Name" >
                </div>

                <div class="form-group">
                    <label for="userName">User name : </label>
                        <input type="text" id="userName" name="userName" class="form-control" placeholder="User Name" >
                </div>

                <div class="form-group">
                    <label for="artistName">Artist name : </label>
                        <input type="text" id="artistName" name="artistName" class="form-control" placeholder="Artist Name " >
                </div>

                <div class="form-group">
                    <label for="role_id">Role : </label>
                    <input type="text" class="form-control"  disabled name="role_id" id="role_id" value="{{$Role}}">

                </div>

                <div class="form-group">
                    <label for="email">Artist Email : </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemple@gmail.com" >
                </div>

                <div class="form-group">
                    <label for="Bio">Artist Bio : </label>
                        <textarea name="Bio" id="Bio" cols="90" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="password">Artist Password : </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="********" >
                </div>

                <div class="pt-3">
                    <button type="submit" class="btn btn-info"> Add artist</button>
                </div>

            </form>
        </div>

        <!--    PRINTING ERRORS     -->

        @if ($errors->any())
            <div class="card-footer">
                <div class="text-danger text-center m-auto ">
                    @foreach ($errors->all() as $error)
                        <li class="list-unstyled">
                            {{ $error }}
                        </li>
                    @endforeach
                </div>
            </div>
        @endif

    </div>


</body>
</html>
