<?php
session_start();
if (!isset($_SESSION['id_username'])) {
  header('Location: halamanlogin.php');
  exit;
}