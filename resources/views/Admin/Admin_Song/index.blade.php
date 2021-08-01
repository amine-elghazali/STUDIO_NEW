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
    <div class="m-auto pt-5">
        <div class="card bg-dark">
            <div class="card-header text-light">
                <h2> Songs </h2>
            </div>

            <div class="card-body">
                    <table class="table caption-top  text-center text-light ">
                        <caption> List of Songs </caption>
                        <thead>
                            <tr>

                                <th></th>
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
                                        <td>{{$song->songPic}}</td>
                                        <td>  {{$song->name}}  </td>
                                        <td>  {{$song->Bio}}  </td>
                                        <td>  {{$song->fullName}}  </td>
                                        <td>
                                           <div>
                                               {{$song->path}}
                                           </div>
                                        </td>
                                        <td>  {{$song->extension}}  </td>
                                        <td>  {{$song->size}}  </td>
                                        <td>  {{$song->songDate}}  </td>

                        
                                        <td style="display: flex">
                                            <div class="pl-5">
                                                <a type="button" href="Songs/{{$song->idSong}}/edit" class="btn btn-warning"> <i class="uil-edit"></i> </a>
                                            </div>
                                            <div class="pl-5">
                                                <form action="Songs/{{$song->idSong}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger ml-2" > <i class="uil-trash"></i> </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                <a href="Songs/create" type="button" class="btn btn-secondary ml-2">Add an song</a>
            </div>
        </div>
    </div>
</html>

@endsection
