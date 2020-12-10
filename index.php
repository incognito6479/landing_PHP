<?php
session_start();
if(isset($_GET['page'])) {
   $page = './views/' . $_GET['page'] . '/index.php';
} else {
   $page = './views/start/index.php';
}
require_once $page;
?>
