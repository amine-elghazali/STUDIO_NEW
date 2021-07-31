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
                <div class="card-header text-light">
                    <h2> Albums </h2>
                </div>

                <div class="card-body">
                        <table class="table caption-top  text-center text-light">
                            <caption> List of Albums </caption>
                            <thead>
                                <tr class="table-dark">
                                    <th> Album name </th>
                                    <th> Album bio</th>
                                    <th> Artist</th>
                                    <th> Album date </th>
                                    <th> Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($albums as $Album)
                                    <tr>
                                        <td>  {{$Album->albumName}}  </td>
                                        <td>  {{$Album->Bio}}  </td>
                                        <td>  {{  App\Models\Artist::where('idArtist',$Album->id_Artist)->value("fullName")  }}  </td>
                                        <td>  {{$Album->albumDate}}  </td>

                                        <td style="display: flex">
                                            <div class="pl-5">
                                                <a type="button" href="Albums/{{$Album->idAlbum}}/edit"class="btn btn-warning"> <i class="uil-edit"></i></a>
                                            </div>
                                            <div>
                                                <form action="Albums/{{$Album->idAlbum}}" method="POST">
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
                    
                    <a href="Albums/create" type="button" class="btn btn-secondary ml-2"> Add an Album</a>
                </div>
            </div>
        </div>
    </html>
@endsection
