@extends('layout.index')
@section('title', 'Equipment')
@section('content')
    <h2 class="u-pull-left">@yield('title')</h2>
    <a class="u-pull-right button button-primary equal-button" href="<?= route('equipment.create') ?>">New</a>
    <table class="u-full-width">
        <thead>
        <tr>
            <th>Name</th>
            <th>Calories per minute</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($equipment as $eq)
            <tr>
                <td>
                    {{ $eq->name }}
                </td>
                <td>
                    {{ $eq->calories_pm }}
                </td>
                <td>
                    <!-- @todo check in/check out -->
                    <a class="button" href="<?= route('equipment.checkin', $eq->id) ?>">Check in</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No equipment</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@stop
