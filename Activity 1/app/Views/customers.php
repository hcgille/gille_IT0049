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
    </nav>

    <hr>

    <h1>Customer Accounts</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>

        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone']) ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>