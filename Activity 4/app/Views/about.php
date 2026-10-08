<!DOCTYPE html>
<html>
<head>
    <title>About - POS System</title>
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

    <h1>About</h1>

    <p>
        This is a basic Point-of-Sale system created using
        CodeIgniter 4 and the MVC pattern.
    </p>

</body>
</html>