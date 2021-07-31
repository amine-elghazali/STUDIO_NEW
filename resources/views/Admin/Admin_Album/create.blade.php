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

                <div class="card bg-dark" >

                    <div class="card-header text-light">
                        <h3> Add an album </h3>
                    </div>

                    <div class="card-body">
                        <form action="/admin/Albums"  method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="id_Artist">Album artist : </label>
                                
                                <select id="id_Artist" class="form-select" name="id_Artist" class="form-control">
                                    <option value="" selected> Select an artist</option>
                                    @foreach ($Artists as $Artist)
                                        
                                            <option value="{{$Artist->idArtist}}">{{$Artist->fullName}}</option>
                                        
                                    @endforeach
                                </select>

                            </div>

                            <div  class="form-group">
                                <label for="albumName">Album name : </label>
                                    <input type="text" id="albumName" name="albumName" class="form-control" placeholder="Album name" >
                            </div>

                            <div class="form-group">
                                <label for="Bio">Album Bio : </label>
                                    <input type="text" id="Bio" name="Bio" class="form-control" placeholder="Album Bio" >
                            </div>

                            <div class="form-group">
                                <label for="albumDate">Album date : </label>
                                    <input type="date" id="albumDate" name="albumDate" class="form-control" >
                            </div>

                            

                            <div class="pt-3">
                                <button type="submit" class="btn btn-secondary"> Add album</button>
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