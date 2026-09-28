<h1>New Customer</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/customers/create" method="post">

    <?= csrf_field() ?>

    <label>Full Name</label><br>
    <input type="text" name="full_name"
           value="<?= old('full_name') ?>">
    <br><br>

    <label>Email</label><br>
    <input type="email" name="email"
           value="<?= old('email') ?>">
    <br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"
           value="<?= old('phone') ?>">
    <br><br>

    <button type="submit">Add Customer</button>

</form>

<p><a href="/customers">Back to Customers</a></p>