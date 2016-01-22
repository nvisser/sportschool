@extends('layout.index')
@section('title', 'Request advice')
@section('content')
    <h2>@yield('title')</h2>
    <form action="<?= route('auth.postadvice') ?>" method="post" accept-charset="utf-8"
          autocomplete="off">
        <?= csrf_field() ?>
        @include('_errors')
        <div class="row">
            <div class="twelve columns">
                <label for="lSubject">Subject</label>
                <select name="equipment" id="lSubject" class="u-full-width">
                    <option value="Not applicable">Not applicable</option>
                    <?php foreach ($equipment as $eq): ?>
                    <option value="<?= $eq->name ?>"><?= $eq->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <label for="lQuestion">Your question</label>
                <textarea name="question" id="lQuestion" cols="30" rows="10" placeholder="Your question" class="u-full-width"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="twelve columns">
                <button type="submit" class="button-primary">Send</button>
            </div>
        </div>
    </form>
@stop