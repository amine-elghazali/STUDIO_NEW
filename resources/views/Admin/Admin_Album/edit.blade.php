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
            <h3> Edit an album </h3>
        </div>

        <div class="card-body">
            <form action="/admin/Albums/{{$album->idAlbum}}"  method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="albumArtist">Album artist : </label>

                    <select id="albumArtist" name="id_Artist" class="form-control">

                            @foreach ($Artists as $Artist)
                             
                                    <option value="{{$Artist->idArtist}}">{{$Artist->fullName}}</option>
                            
                            @endforeach
                    </select>

                </div>

                <div  class="form-group">
                    <label for="albumName">Album name : </label>
                        <input type="text" id="albumName" name="albumName" class="form-control" value="{{$album->albumName}}" >
                </div>

                <div class="form-group">
                    <label for="Bio">Album bio : </label>
                        <input type="text" id="Bio" name="Bio" class="form-control" value="{{$album->Bio}}" >
                </div>

                <div class="form-group">
                    <label for="albumDate">Artist date : </label>
                        <input type="date" id="albumDate" name="albumDate" class="form-control" value="{{$album->albumDate}}" >
                </div>

                <div class="m-3">
                    <button type="submit"  class="btn btn-info"> Update album</button>
                </div>

                <div class="m-3">
                    <a href="Admin/Albums" class="btn btn-warning"> Cancel edit</a>
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
