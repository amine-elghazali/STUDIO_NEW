@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <h1> Hii Admin {{ Auth::user()->name }}</h1>
                    <hr>
                    <h2>This is the Dashboard</h2>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="/admin/Artists" class="btn btn-info"> Artists</a>
                        <a href="/admin/Albums" class="btn btn-info"> Albums</a>
                        <a href="/admin/Songs" class="btn btn-info"> Songs</a>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
