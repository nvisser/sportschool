@extends('layout/index')
@section('title', 'Register')
@section('content')
    <h2>@yield('title')</h2>
    <form action="<?= action('Auth\AuthController@postRegister') ?>" method="post" accept-charset="utf-8"
          autocomplete="off">
        <?= csrf_field() ?>
        @include('_errors')
        <div class="row">
            <div class="six columns">
                <label for="lName">Your Name</label>
                <input name="name" id="lName" type="text" class="u-full-width" placeholder="Name"
                       value="Niek Visser">
            </div>
            <div class="six columns">
                <label for="lEmail">Your Email</label>
                <input name="email" id="lEmail" type="text" class="u-full-width" placeholder="Email"
                       value="niek@bcome.nl">
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="lPassword">Your Password</label>
                <input name="password" id="lPassword" type="password" class="u-full-width" placeholder="Password">
            </div>
            <div class="six columns">
                <label for="lPasswordConfirm">Repeat your password</label>
                <input name="password_confirmation" id="lPasswordConfirm" type="password" class="u-full-width"
                       placeholder="Password">
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <label for="lSubscription">Subscription</label>
                <select name="subscription" id="lSubscription" class="u-full-width">
                    <option value="free">Free</option>
                    <option value="premium">Premium</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="twelve columns">
                <label for="lAddress">Adres</label>
                <input name="address" type="text" placeholder="Adres" id="lAddress" class="u-full-width">
            </div>
        </div>
        <div class="row switcheroo hidden">
            <div class="twelve columns">
                <label for="lBank">Bankrekening</label>
                <input name="bank" type="text" placeholder="Bankrekening" id="lBank" class="u-full-width">
            </div>
        </div>

        <div class="row">
            <div class="twelve columns">
                <button type="submit" class="button-primary">Login</button>
            </div>
        </div>
    </form>
@stop
@section('scripts')
    <script>
        var switcheroo = document.querySelector('#lSubscription');
        var extrafields = document.querySelector('.switcheroo');
        switcheroo.addEventListener('change', function (e) {
            extrafields.className = switcheroo.value === 'premium' ? 'row switcheroo' : 'row switcheroo hidden';
        });
    </script>
@stop