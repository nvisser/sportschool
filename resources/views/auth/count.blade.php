@extends('layout.index')
@section('title', 'User information')
@section('content')
    <h2>@yield('title')</h2>
    <dt>Total users:</dt>
    <dd><?= $total ?></dd>
    <dt>Premium users:</dt>
    <dd><?= $premium ?></dd>
    <dt>Logged in users:</dt>
    <dd><?= count($loggedin) ?></dd>
    <table class="u-full-width">
        <thead>
        <tr>
            <th>Location</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        <?php $oldloc = ''; ?>
        <?php foreach($loggedinusers as $location => $users): ?>
        <?php foreach ($users as $user): ?>
        <tr>
            <?php if ($oldloc !== $location): ?>
            <th><?= $location ?></th>
            <?php else: ?>
            <td>&nbsp;</td>
            <?php endif ?>
            <?php $oldloc = $location ?>
            <td><?= $user->name ?></td>
        </tr>
        <?php endforeach ?>
        <?php endforeach ?>
        </tbody>
    </table>
@stop