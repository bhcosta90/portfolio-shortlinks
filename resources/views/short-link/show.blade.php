@extends('layouts.app')

@section('body')
    <div class="card">
        <div class="card-header">Encurtador: {{$hash}}</div>
        <table class="table table-striped table-hover m-0">
            <thead>
            <tr>
                <th style="width:30%">URL</th>
                <th style="width:60%">Endpoint</th>
                <th class="text-end" style="width:10%">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    @if($isDateValid)
                        <a href="{{$url}}" target="_blank">{{$url}}</a>
                    @else
                        {{$url}}
                    @endif
                </td>
                <td><a href="{{$endpoint}}" target="_blank">{{$endpoint}}</a></td>
                <td class="text-end">{{$total}}</td>
            </tr>
            </tbody>
        </table>
        <div class="card-footer"><a class="btn btn-outline-primary" href="{{route('w.home')}}">Novo encurtador</a></div>
    </div>

    @if(count($histories))
        <div class="card mt-2">
            <div class="card-header">Clicks <small class="text-muted">({{$total}})</small></div>
            <table class="table table-striped table-hover m-0">
                <thead>
                <tr>
                    <th class="w-50">IP</th>
                    <th class="w-50">Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td>{{$history->ip_address}}</td>
                        <td>{{now()->parse($history->created_at)->format('d/m/Y H:i:s')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($histories->lastPage() > 1)
                <div class="card-footer">{{ $histories->appends(request()->all())->links() }}</div>
            @endif
        </div>
    @endif
@endsection
