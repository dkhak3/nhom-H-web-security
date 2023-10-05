<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$_id = NULL;

if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $user = $userModel->findUserById($_id);//Update existing user
}

// Thêm đoạn code mã hóa version ngay khi truy cập vào trang
$versionEncode = base64_encode($user[0]['version']);

// Kiểm tra version lấy từ database có trùng với hàm getVersionByUserId không
if (!empty($_POST['submit'])) {
    // get version hiện tại ở trên database
    $versionCurrentByUserId = $userModel->getVersionByUserId($_id);

    if (!empty($_id)) {
        // kiểm tra version của user có khớp với version hiện tại hay không
        // dùng base64_decode() để giải mã giá trị của $versionEncode
        if (base64_decode($_POST['version']) === $versionCurrentByUserId) {
            // nếu khớp sẽ cho phép cập nhật dữ liệu
            $userModel->updateUser($_POST, $versionCurrentByUserId);
            header('location: list_users.php');
        }
        else {
            // không khớp không cho update và hiển thị thông báo
            echo '<script>alert("Đã có người cập nhật trước bạn, Vui lòng thử lại");</script>';
        }
    } else {
        $userModel->insertUser($_POST);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">

        <?php if ($user || !isset($_id)) { ?>
                <div class="alert alert-warning" role="alert">
                    User form
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $_id ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" placeholder="Name" value='<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>'>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                            <!-- Trường ẩn để lưu phiên bản của dữ liệu -->
                        <input type="text" name="version" value="<?php echo $versionEncode  ?>">
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    User not found!
                </div>
            <?php } ?>
    </div>
</body>
</html>