<h2><?= esc($title) ?></h2>

<?= session()->getFlashData('error') ?>
<?= service('validation')->listErrors() ?>

<form action="/topics/create" method= "post">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input type="input" name="title" /><br />

    <label for="text">Text</label>
    <textarea name="body" cols="45" rows="4"></textarea><br />

    <input type="submit" name="submit" value="Create topics item">
</form>
