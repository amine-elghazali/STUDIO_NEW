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
<body>
    <div class=" pl-5 pr-5 m-auto pt-5">
        <div class="card">
            <div class="card-header">
                <h2> Songs </h2>
            </div>

            <div class="card-body">
                    <table class="table caption-top  text-center ">
                        <caption> List of Songs </caption>
                        <thead>
                            <tr class="table-dark">

                                <th> Song name </th>
                                <th> Song bio </th>
                                <th> Song FullName</th>
                                <th> Song Path</th>
                                <th> Song extension</th>
                                <th> Song Size </th>
                                <th> Song date </th>
                                <th> Action </th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($songs as $song)

                                    <tr>
                                        <td>  {{$song->name}}  </td>
                                        <td>  {{$song->Bio}}  </td>
                                        <td>  {{$song->fullName}}  </td>
                                        <td>  {{$song->path}}  </td>
                                        <td>  {{$song->extension}}  </td>
                                        <td>  {{$song->size}}  </td>
                                        <td>  {{$song->songDate}}  </td>


                                        <td style="display: flex">
                                            <div class="pl-5">
                                                <a type="button" href="Artists/{{$song->idSong}}/edit" class="btn btn-info"> mettre à jour </a>
                                            </div>
                                            <div class="pl-5">
                                                <form action="songs/{{$song->idSong}}" method="POST">
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
                Add an song
                <a href="Songs/create" type="button" class="btn btn-info"> Clickez içi</a>
            </div>
        </div>
    </div>
</html>
