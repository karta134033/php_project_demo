<?php
require dirname(__FILE__) . "/include/head.php";

if (!isset($_SESSION['login'])) {
  header("Location: ./login.php");
  exit();
}
?>