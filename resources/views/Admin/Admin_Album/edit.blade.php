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
            <div class= " pl-5 pr-5 m-auto pt-5 text-light">

            
                <div class="card bg-dark">

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
                                <button type="submit"  class="btn btn-secondary"> Update album</button>
                            </div>

                            <div class="m-3">
                                <a href="/admin/Albums" class="btn btn-warning"> Cancel edit</a>
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
            </div>

        </body>
        </html>


@endsection 