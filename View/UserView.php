<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./View/css/UserView.css">
    <title>Lista utenti</title>
</head>
<body>
    <h1>Lista Utenti</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= $user['nome'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>