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
    <div class="card w-50 m-auto">

        <div class="card-header">
            <h3> Edit an artist </h3>
        </div>

        <div class="card-body">
            <form action="/admin/Artists/{{$artist->idArtist}}"  method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div  class="form-group">
                    <label for="fullName">Full name : </label>
                        <input type="text" id="fullName" name="fullName" class="form-control" value="{{$artist->fullName}}" >
                </div>

                <div class="form-group">
                    <label for="userName">User name : </label>
                        <input type="text" id="userName" name="userName" class="form-control" value="{{$artist->userName}}" >
                </div>

                <div class="form-group">
                    <label for="artistName">Artist name : </label>
                        <input type="text" id="artistName" name="artistName" class="form-control" value="{{$artist->artistName}}" >
                </div>

                <div class="form-group">
                    <label for="role_id">Role : </label>
                    <input type="text" class="form-control"  disabled name="role_id" id="role_id" value="{{$Role}}">

                </div>

                <div class="form-group">
                    <label for="email">Artist Email : </label>
                        <input type="email" id="email" name="email" class="form-control" value="{{$artist->email}}" >
                </div>

                <div class="form-group">
                    <label for="Bio">Artist Bio : </label>
                        <input type="text" id="Bio" class="form-control" name="Bio" value="{{$artist->Bio}}">
                </div>

                <div class="form-group">
                    <label for="password">Artist Password : </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="********" >
                </div>

                <div class="m-3">
                    <button type="submit"  class="btn btn-info"> Update artist</button>
                </div>

                <div class="m-3">
                    <a href="admin/Artist" class="btn btn-warning"> Cancel edit</a>
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
