@extends('layout/index')
@section('title', 'Profile')
@section('content')
    <h2>@yield('title')</h2>
    <form action="<?= route('auth.updateprofile') ?>" method="post" accept-charset="utf-8"
          autocomplete="off">
        <?= csrf_field() ?>
        <?= method_field('put'); ?>
        @include('_errors')
        <div class="row">
            <div class="six columns">
                <label for="lName">Your Name</label>
                <input name="name" id="lName" type="text" class="u-full-width" placeholder="Name"
                       value="<?= old('name', $user->name) ?>">
            </div>
            <div class="six columns">
                <label for="lEmail">Your Email</label>
                <input name="email" id="lEmail" type="text" class="u-full-width" placeholder="Email"
                       value="<?= old('email', $user->email) ?>">
            </div>
        </div>

        <div class="row">
            <div class="twelve columns">
                <label for="lAddress">Adres</label>
                <input name="address" type="text" placeholder="Adres" id="lAddress" class="u-full-width" value="<?= old('address', $user->address) ?>">
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <label for="lBank">Bankrekening</label>
                <input name="bank" type="text" placeholder="Bankrekening" id="lBank" class="u-full-width"
                       value="<?= old('bank', $user->bank) ?>" readonly="readonly">
            </div>
        </div>

        <div class="row">
            <div class="twelve columns">
                <button type="submit" class="button-primary">Save</button>
            </div>
        </div>
    </form>
@stop