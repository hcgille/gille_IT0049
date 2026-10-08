<!DOCTYPE html>
<html>
<head>
    <title>Customer Accounts</title>
</head>
<body>

    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a>

        <?php if (session()->get('logged_in')): ?>
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login</a>
        <?php endif; ?>
    </nav>

    <hr>

    <h1>Customer Accounts</h1>

    <p>
        <a href="/customers/new">Add New Customer</a>
    </p>

    <table border="1" cellpadding="10">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone']) ?></td>
                <td>
                    <a href="/customers/edit/<?= esc($customer['id']) ?>">
                        Edit
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>