<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/UserView.css">
    <title>User Registration</title>
</head>

<body>
    <div>
        <form action="../Controller/UserController.php/createUser" method="POST">
            <h2>User Registration</h2>
            <input type="text" name="name" placeholder="Nome" required>
            <input type="text" name="surname" placeholder="Cognome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
        <h5>Già registrato? Clicca <a href="./UserLogIn.php">qui</a></h5>
    </div>
</body>

</html>