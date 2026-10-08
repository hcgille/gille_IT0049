<h1>Edit Customer</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/customers/update/<?= esc($customer['id']) ?>" method="post">

    <?= csrf_field() ?>

    <label>Full Name</label><br>
    <input type="text" name="full_name"
           value="<?= esc($customer['full_name']) ?>">
    <br><br>

    <label>Email</label><br>
    <input type="email" name="email"
           value="<?= esc($customer['email']) ?>">
    <br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"
           value="<?= esc($customer['phone']) ?>">
    <br><br>

    <button type="submit">Update Customer</button>

</form>

<p><a href="/customers">Back to Customers</a></p>