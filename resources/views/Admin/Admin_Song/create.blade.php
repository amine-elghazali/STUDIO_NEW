<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    

    <form action="/admin/Songs"  method="POST" enctype="multipart/form-data" class="w-50 m-5">

        @csrf

        <label for="id_Artist"> Artist :</label>
            <select name="id_Artist" id="id_Artist" class="form-select form-select-sm"  select-box">
                <option value="" selected></option>

                @foreach ($Artists as $Artist)
                        <option value="{{$Artist->idArtist}}">{{$Artist->fullName}}</option>
                @endforeach
            </select>

        <label for="id_Album"> Album :</label>
            <select name="id_Album" id="id_Album" class="form-select form-select-sm" ">
                <option value="" selected></option>

                @foreach ($Albums as $Album)
                        <option value="{{$Album->idAlbum}}">{{$Album->albumName}}</option>
                @endforeach
            </select>


        <label for="name">Song name :</label>
            <input type="text" name="name" class="form-control" id="name">

        <label for="Bio">Song bio : </label>
            <input type="text" name="Bio" class="form-control" id="Bio">

        <label for="file">Song File : </label>
            <input type="file" name="file" class="form-control" id="file">

        <label for="songDate">Song date : </label>
            <input type="date" name="songDate" class="form-control" id="songDate">
            
            <button type="submit" class="btn btn-info mt-5"> Submit </button>

    </form>


</body>
</html>