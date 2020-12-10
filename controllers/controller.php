<?php
require_once './models/model.php';

use Model\Model_BD;

class StartController {

protected $model;

public function __construct()
{
   $this->model = new Model_BD;
}

public function actionStart()
{
   require_once './views/start/view.php';
}

public function actionSignUp()
{
   if($this->model->funcEmailCheck($_POST['email'])) {
       $_SESSION['email_has'] = $_POST['email'];
       $_SESSION['email'] = $_POST['email'];
       header('location:?page=start');     
   } else {
       if($this->model->funcValidate($_POST['email'])) {
           $res = $this->model->funcSignUp($_POST['email']);
             if($res) $email_res = $this->model->funcEmailSend($_POST['email']);
             $_SESSION['success'] = $email_res;
             header('location:?page=start');
	   } else {
           $_SESSION['email_error'] = $this->model->error_validation;
           $_SESSION['email'] = $_POST['email'];
           header('location:?page=start');
	   }
   }
}

}

?>
