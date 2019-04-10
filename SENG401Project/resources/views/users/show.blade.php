@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to {{$user -> playlist_title}} <br>
                    This is the page of {{ $user->name }}! <br>
                    <img src= {{$user->picture_url}}> <br>


                    <a href = "/users/{{ $user->id }}/edit">
                        <button>Edit Profile</button>
                    </a>

                    <form method= 'POST' action="/videos/addvideo">
                        @csrf

                        Input Video URL:<br>
                        <input type="text" name="url">
                        <br><br>
                        <input type="submit">
                    </form>
                </div>

                @if ($user->videos->count())
                <div>
                    @foreach ($videos as $video)
                        $videoObject = 

                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
