<?php
session_start();
session_destroy(); // Destroy all sessions
header('Location: /assignment'); // Redirect to home
exit();
?>
