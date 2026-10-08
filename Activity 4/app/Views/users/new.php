<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
</head>

<body>

<h1>Add New User</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/users/create" method="post">

    <?= csrf_field() ?>

    <label>Username</label><br>
    <input
        type="text"
        name="username"
        value="<?= old('username') ?>"
    >

    <br><br>

    <label>Full Name</label><br>
    <input
        type="text"
        name="full_name"
        value="<?= old('full_name') ?>"
    >

    <br><br>

    <button type="submit">Add User</button>

</form>

<p>
    <a href="/users">Back to User Accounts</a>
</p>

</body>
</html>