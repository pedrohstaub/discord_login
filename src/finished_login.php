<?php

session_start();

if (!$_SESSION['logged_in']) {
    header("Location: error_login.php");
    exit;
}
extract($_SESSION['userData']);

$avatar_url = "https://cdn.discordapp.com/avatars/$discord_id/$avatar.jpg";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nice</title>
</head>

<body>
    <div class="logged_in">
        <img src="<?php echo $avatar_url; ?>">
        <h3><?php echo $name; ?></h3>
        <a href="logout.php">Logout</a>
    </div>
</body>

<style>
    body {
        background-color: #272727;
    }

    h3 {
        color: #fff;
    }

    img {
        border-radius: 100px;
    }

    a {
        text-decoration: none;
        color: #fff;
    }

    a:hover {
        color: #ccc;
    }

    .logged_in {
        text-align: center;
        vertical-align: middle;
        margin-top: 30vh;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

</html>