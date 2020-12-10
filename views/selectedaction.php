<?php
if(!isset($_POST['hook']) && !isset($_GET['hook'])) {$hook='Start'; $parametr = '';} else {
    if(isset($_POST['hook'])) $hook = $_POST['hook'];
    if(isset($_GET['hook'])) $hook = $_GET['hook'];
    if(strpos($hook, '/')) {
       $arr_hook = explode('/', $hook);
       $hook = $arr_hook[0];
       $parametr = $arr_hook[1];
    }
    else {
       $parametr = '';    
    }
}
$action='action'.$hook;
$controller->$action($parametr);
?>
