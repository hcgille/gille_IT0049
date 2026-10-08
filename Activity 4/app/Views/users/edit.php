<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>

<body>

<h1>Edit User</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form
    action="/users/update/<?= esc($user['id']) ?>"
    method="post"
    enctype="multipart/form-data"
>

    <?= csrf_field() ?>

    <label>Username</label><br>
    <input
        type="text"
        name="username"
        value="<?= esc($user['username']) ?>"
    >

    <br><br>

    <label>Full Name</label><br>
    <input
        type="text"
        name="full_name"
        value="<?= esc($user['full_name']) ?>"
    >

    <br><br>

    <label>New Password (Optional)</label><br>
    <input
        type="password"
        name="password"
        minlength="8"
        autocomplete="new-password"
    >

    <br><br>

    <label>Confirm New Password</label><br>
    <input
        type="password"
        name="confirm_password"
        minlength="8"
        autocomplete="new-password"
    >

    <p>Leave both fields blank to keep the current password.</p>

    <br><br>

    <label>Profile Picture</label><br>
    <input
        type="file"
        name="avatar"
        accept=".jpg,.jpeg,.png"
    >

    <?php if (!empty($user['avatar'])): ?>

    <p>Current Profile Picture:</p>

    <img
        src="/uploads/avatars/<?= esc($user['avatar']) ?>"
        alt="Current Avatar"
        width="100"
        height="100"
    >

    <br><br>

    <label>
        <input type="checkbox" name="remove_avatar" value="1">
        Remove current profile picture
    </label>

    <?php endif; ?>

    <br><br>

    <button type="submit">Update User</button>

</form>

<p>
    <a href="/users">Back to User Accounts</a>
</p>

</body>
</html>