<!DOCTYPE html>
<html>
<head>
    <title>Login - POS System</title>
</head>
<body>

    <h1>POS Login</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red;">
            <?= esc(session()->getFlashdata('error')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <p style="color:red;"><?= esc($error) ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="/login" method="post">

        <?= csrf_field() ?>

        <label>Username</label><br>
        <input
            type="text"
            name="username"
            value="<?= old('username') ?>"
        >

        <br><br>

        <label>Password</label><br>
        <input
            type="password"
            name="password"
        >

        <br><br>

        <button type="submit">Login</button>

    </form>

</body>
</html>