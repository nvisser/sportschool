@extends('layout.index')
@section('title', 'Profile')
@section('content')
    <h2>@yield('title')</h2>
    <dt>Naam:</dt>
    <dd><?= $user->name ?></dd>
    <dt>Email:</dt>
    <dd><?= $user->email ?></dd>
    <dt>Adres:</dt>
    <dd><?= $user->address ?></dd>
    <dt>Bank:</dt>
    <dd><?= $user->bank ? $user->bank : 'Geen' ?></dd>
    <dt>Registratie datum:</dt>
    <dd><?= $user->created_at->format('Y-m-d') ?></dd>
@stop