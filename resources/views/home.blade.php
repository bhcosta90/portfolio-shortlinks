@extends('layouts.app')

@section('body')
    <div class="card">
        <form method="post" action="{{route('w.register')}}">
            @csrf
            <div class="card-header">Encurtador de URL</div>
            <div class="card-body">
                <input type="url" name="endpoint" class="form-control form-control-lg" placeholder="http://google.com"/>
                @error('endpoint')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="card-footer">
                <button class="btn btn-outline-primary">Encurtar</button>
            </div>
        </form>
    </div>
@endsection
