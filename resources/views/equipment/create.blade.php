@extends('layout.index')
@section('title', 'New Equipment')
@section('content')
    <h2>@yield('title')</h2>
    <form action="<?= route('equipment.store') ?>" method="post" accept-charset="utf-8"
          autocomplete="off">
        <?= csrf_field() ?>
        @include('_errors')
        <div class="row">
            <div class="twelve columns">
                <label for="lName">Name</label>
                <input name="name" id="lName" type="text" class="u-full-width" placeholder="Name">
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="lEmail">Calories per minute</label>
                <input name="calories_pm" id="lCaloriespm" type="text" class="u-full-width" placeholder="Calories per minute">
            </div>
            <div class="six columns">
                <label for="lPassword">Weight</label>
                <input name="weight" id="lWeight" type="text" class="u-full-width" placeholder="Weight">
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <button type="submit" class="button-primary">Create</button>
            </div>
        </div>
    </form>
@stop
