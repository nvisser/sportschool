@extends('layout/index')
@section('title', 'Login')
@section('content')
    <h2>Login</h2>
    <form action="<?= action('Auth\AuthController@postLogin') ?>" method="post" accept-charset="utf-8"
          autocomplete="off">
        <?= csrf_field() ?>
        @include('_errors')
        <div class="row">
            <div class="six columns">
                <label for="lEmail">Your Email</label>
                <input name="email" id="lEmail" type="text" class="u-full-width" placeholder="Email"
                       value="">
            </div>
            <div class="six columns">
                <label for="lPassword">Your Password</label>
                <input name="password" id="lPassword" type="password" class="u-full-width" placeholder="Password">
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <button type="submit" class="button-primary">Login</button>
            </div>
        </div>
    </form>
@stop