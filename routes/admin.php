<?php



$act = $_GET['act'] ?? '/';

<<<<<<< HEAD
=======
if (!empty($_SESSION['user_client'])) {
    echo '<script>
        alert("Bạn không có quyển truy cập.");
        window.location.href = "' . BASE_URL . '";
        </script>';
    exit();
}
>>>>>>> parent of 33f6b4a (Merge pull request #10 from Hoantofff/DucManh)
if (
    empty($_SESSION['user'])
    && !in_array($act, ['show-form-login', 'login'])
) {
    header('Location: ' . BASE_URL_ADMIN . '&act=show-form-login');
    exit();
}
<<<<<<< HEAD
match($act){
=======
match ($act) {
>>>>>>> parent of 33f6b4a (Merge pull request #10 from Hoantofff/DucManh)
    '/' => (new DashboardController)->index(),
    'test-show' => (new TestController)->show(),

    //Authen
    'show-form-login'       => (new AuthenController)->showFormLogin(),
    'login'                 => (new AuthenController)->login(),
    'logout'                => (new AuthenController)->logout(),
    
    // CRUD User
    'users-index' => (new UserController)->index(),
    'users-create' => (new UserController)->create(),
    'users-store' => (new UserController)->store(), // Lưu Dữ Liệu Thêm Mới
    'users-edit' => (new UserController)->edit(), 
    'users-update' => (new UserController)->update(), // Lưu Dữ Liệu Update
    'users-show' => (new UserController)->show(),
    'users-delete' => (new UserController)->delete(),
<<<<<<< HEAD

=======
>>>>>>> parent of 33f6b4a (Merge pull request #10 from Hoantofff/DucManh)
};
