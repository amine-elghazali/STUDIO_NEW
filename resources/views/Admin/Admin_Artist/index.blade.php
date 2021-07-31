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


            <div class=" pl-5 pr-5 m-auto pt-5">
                <div class="card bg-dark">
                    <div class="card-header">
                        <h2> Artists </h2>
                    </div>

                    <div class="card-body">
                            <table class="table caption-top text-center  text-light ">
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
                                                <a type="button" href="Artists/{{$artist->idArtist}}/edit" class="btn btn-warning"> <i class="uil-edit"></i></a>

                                                <form action="Artists/{{$artist->idArtist}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger ml-2" > <i class="uil-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div class="card-footer">
                        Add an artist
                        <span class="iconify" data-icon="uil:focus-add" data-inline="false"><a href="Artists/create" type="button" class="btn btn-info"> Clickez içi</a></span> 
                    </div>
                </div>
            </div>
        </html>

@endsection