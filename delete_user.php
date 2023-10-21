<?php
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$id = NULL;
if(isset($_SESSION['token']) && isset($_GET['token'])){
    if(!empty($_GET['id']) && $_SESSION['token'] == $_GET['token']){
        $id = $_GET['id'];
        $userModel->deleteUserById($id);
        header('location: list_users.php');
    }
}else{
    echo "<script>alert('Bị tấn công csrf');
                document.location.href = 'list_users.php';
    </script>";
}
?>