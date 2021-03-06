@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Base de Dados
@endsection

@section('main-content')
    {{--<div class="col-md-4 col-md-offset-2">--}}
        {{--<a href="club/upsheet/create"><i class='fa fa-plus-square fa-5x' aria-hidden="true" style="vertical-align: middle;"></i></a>--}}
        {{--<span> Adicionar Cliente</span>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-md-offset-2">--}}
        {{--<a href="club/upsheet"><i class='fa fa-search fa-5x' aria-hidden="true" style="vertical-align: middle;"></i></a>--}}
        {{--<span> Pesquisar Cliente</span>--}}
    {{--</div>--}}
@endsection

@section('phrases-content')
    @if(\Request::is('database/*') || \Request::is('database'))
        <div class="bottom-navbar" align="center">
            <h4>"{{\App\Phrase::all()->random(1)->first()->phrase}}"</h4>
        </div>
    @endif
@endsection