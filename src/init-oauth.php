<?php

$discord_url = "https://discord.com/api/oauth2/authorize?client_id=1077215236798558218&redirect_uri=http%3A%2F%2Flocalhost%3A1201%2Fsrc%2Fproccess-oauth.php&response_type=code&scope=identify%20guilds";
header("Location: $discord_url");
exit;

?>