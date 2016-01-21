@extends('layout.index')
@section('title', 'User information')
@section('content')
    <h2>@yield('title')</h2>
    <dt>Total users:</dt>
    <dd><?= $total ?></dd>
    <dt>Premium users:</dt>
    <dd><?= $premium ?></dd>
    <dt>Logged in users:</dt>
    <dd><?= $loggedin ?></dd>
@stop