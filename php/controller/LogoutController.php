<?php
session_start();

unset($_SESSION['user']);
session_destroy();
session_abort();

echo "<script type='text/javascript'>";
echo "location.href='/TODO-LIST/'";
echo "</script>";

?>