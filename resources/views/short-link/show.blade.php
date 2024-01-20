@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-header">Encurtador: {{$hash}}</div>
        <table class="table table-striped table-hover m-0">
            <thead>
            <tr>
                <th class="w-50">URL</th>
                <th class="w-25">Endpoint</th>
                <th class="w-25">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="{{$url}}" target="_blank">{{$url}}</a></td>
                <td><a href="{{$endpoint}}" target="_blank">{{$endpoint}}</a></td>
                <td>{{$total}}</td>
            </tr>
            </tbody>
        </table>
        <div class="card-footer"><a class="btn btn-outline-primary" href="{{route('w.home')}}">Novo encurtador</a></div>
    </div>
@endsection
