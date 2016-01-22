@extends('layout.index')
@section('title', 'My stats')
@section('content')
    <div class="row">
        <div class="twelve columns">
            <h2>@yield('title')</h2>
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <h3>This month</h3>
            <dt>Calories burned on the worst day this month:</dt>
            <dd><span title="<?= round($current['min'], 2) ?>">~<?= round($current['min']) ?></span></dd>
            <dt>Calories burned on the best day this month:</dt>
            <dd><span title="<?= round($current['max'], 2) ?>">~<?= round($current['max']) ?></span></dd>
            <dt>Total calories burned this month:</dt>
            <dd><span title="<?= round($current['total'], 2) ?>">~<?= round($current['total']) ?></span></dd>
        </div>
        <div class="six columns">
            <h3>Last month</h3>
            <dt>Calories burned on the worst day last month:</dt>
            <dd><span title="<?= round($previous['min'], 2) ?>">~<?= round($previous['min']) ?></span></dd>
            <dt>Calories burned on the best day last month:</dt>
            <dd><span title="<?= round($previous['max'], 2) ?>">~<?= round($previous['max']) ?></span></dd>
            <dt>Total calories burned last month:</dt>
            <dd><span title="<?= round($previous['total'], 2) ?>">~<?= round($previous['total']) ?></span></dd>
        </div>
    </div>
    <div class="row">
        <div class="twelve columns">
            <h3>Advice</h3>
            <?php if ($current['total'] < $previous['total']): ?>
            You have burned
            <strong>
                <span title="<?= round($difference, 2) ?>">~<?= round($difference) ?></span>
            </strong> less calories than last month so far, would you like to train on something more intensive? Try the
            <strong><?= $suggestion->name ?></strong>, which will burn a whopping
            <strong><?= $suggestion->calories_pm ?></strong> calories per minute, letting you catch after using it for
            <strong><?= round($difference / $suggestion->calories_pm) ?></strong> minutes!
            <?php else: ?>
            You're doing great! More calories burned than last month. Keep it up!
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="twelve columns">
            <a href="<?= route('auth.advice') ?>" class="button button-primary">Request personal advice</a>
        </div>
    </div>
@stop