<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/UserView.css">
    <title>User Login</title>
</head>

<body>
    <div>
        <form action="../Controller/UserController.php" method="POST">
            <h2>User Login</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <h5>Non ancora registrato? Clicca <a href="./UserRegistration.php">qui</a></h5>
    </div>
</body>

</html>