<?php
session_start();
if (isset($_SESSION['name']) || isset($_SESSION['password'])) {
    print_r($_SESSION);
}
?>
