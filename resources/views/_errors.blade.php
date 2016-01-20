<?php if (count($errors) > 0): ?>
<div class="row">
    <strong>Errors:</strong>
    <ul>
        <?php foreach ($errors->all() as $error): ?>
        <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>