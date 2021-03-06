@extends('layouts.admin')


@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
</head>
<body>
    
    <form action="/admin/Songs"  method="POST" enctype="multipart/form-data" class="w-50 m-5 text-light">

        @csrf

        <label for="id_Artist"> Artist :</label>
            <select name="id_Artist" id="id_Artist" class="form-select form-select-sm"  select-box">
                <option value="" selected> Select an artist</option>

                @foreach ($Artists as $Artist)
                        <option value="{{$Artist->idArtist}}">{{$Artist->fullName}}</option>
                @endforeach
            </select>

        <label for="id_Album"> Album :</label>
            <select name="id_Album" id="id_Album" class="form-select form-select-sm">
                <option value="" selected> Select the album</option>

                @foreach ($Albums as $Album)
                        <option value="{{$Album->idAlbum}}">{{$Album->albumName}}</option>
                @endforeach
            </select>


        <label for="name">Song name :</label>
            <input type="text" name="name" class="form-control" id="name">

        <label for="Bio">Song bio : </label>
            <input type="text" name="Bio" class="form-control" id="Bio">

        <label for="songFile">Song File : </label>
            <input type="file" name="songFile" class="form-control" id="songFile">

        <label for="songDate">Song date : </label>
            <input type="date" name="songDate" class="form-control" id="songDate">

        <label for="songPic">Song picture : </label>
            <input type="file" name="songPic" class="form-control" id="songPic">
            
            <button type="submit" class="btn btn-info mt-5"> Submit </button>

    </form>


</body>
</html>

@endsection