<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
</head>
<body>

    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a>
    </nav>

    <hr>

    <h1>User Accounts</h1>

    <p>
        <a href="/users/new">Add New User</a>
    </p>

    <table border="1" cellpadding="10">
        <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php if (!empty($user['avatar'])): ?>

                        <img
                            src="/uploads/avatars/<?= esc($user['avatar']) ?>"
                            alt="User Avatar"
                            width="80"
                            height="80"
                        >

                    <?php else: ?>

                        <img
                            src="/uploads/avatars/placeholder.png"
                            alt="Default Avatar"
                            width="80"
                            height="80"
                        >

                    <?php endif; ?>
                </td>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td><?= esc($user['created_at']) ?></td>
                <td>
                    <a href="/users/edit/<?= esc($user['id']) ?>">
                        Edit
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>