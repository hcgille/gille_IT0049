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

<form action="<?= site_url('users/create') ?>"
      method="post"
      enctype="multipart/form-data">

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

    <br><br>

    <label>Password</label><br>
    <input
        type="password"
        name="password"
        required
        minlength="8"
        autocomplete="new-password"
    >

    <br><br>

    <label>Confirm Password</label><br>
    <input
        type="password"
        name="confirm_password"
        required
        minlength="8"
        autocomplete="new-password"
    >

    <br><br>

    <button type="submit">Add User</button>

</form>

<p>
    <a href="/users">Back to User Accounts</a>
</p>

</body>
</html>