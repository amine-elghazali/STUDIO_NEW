<h1> Artists Page ! </h1>


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
    <div class=" pl-5 pr-5 m-auto pt-5">
        <div class="card">
            <div class="card-header">
                <h2> Artists </h2>
            </div>

            <div class="card-body">
                    <table class="table caption-top  text-center ">
                        <caption> List of artists </caption>
                        <thead>
                            <tr class="table-dark">
                                <th> Full name </th>
                                <th> User name</th>
                                <th> Artist name</th>
                                <th> Email</th>
                                <th> Artist Bio</th>
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($Artists as $artist)
                                <tr>
                                    <td>  {{$artist->fullName}}  </td>
                                    <td>  {{$artist->userName}}  </td>
                                    <td>  {{$artist->artistName}}  </td>
                                    <td>  {{$artist->email}}  </td>
                                    <td>  {{$artist->Bio}}  </td>

                                    <td style="display: flex">
                                        <div class="pl-5">
                                            <a type="button" href="Artists/{{$artist->idArtist}}/edit" class="btn btn-info"> mettre à jour </a>
                                        </div>
                                        <div class="pl-5">
                                            <form action="Artists/{{$artist->idArtist}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" > Supprimer </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                Add an artist
                <a href="Artists/create" type="button" class="btn btn-info"> Clickez içi</a>
            </div>
        </div>
    </div>
</html>
