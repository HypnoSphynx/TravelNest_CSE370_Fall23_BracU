<!-- destroying session using logout -->
<?php
session_start();
session_unset();
session_destroy();
header("Location: owner_login_front.php");

?>