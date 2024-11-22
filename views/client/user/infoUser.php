<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./build/tailwind.css" />
    <title>Document</title>
</head>

<body>
    <p class=" font-bold text-[#000]">Tài khoản: <?= $user['user_name'] ?> <a href="?action=index"
            class=" underline text-blue-600">Thoát</a></p>
    <form action="?action=startUpdateUser&id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data"
        class="max-w-sm mx-auto mt-[100px]">
        <div class="mb-5">
            <label for="img" class="block mb-2 text-sm font-medium text-gray-900">
                Ảnh đại diện</label>
            <div
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <img class="rounded-[50%] h-[50px]" src="./img/<?= $user['avatar'] ?>" alt="">
                <span class=" mb-2 text-sm font-medium text-gray-900">Đổi ảnh đại diện:</span>
                <input type="file" id="img" name="img" class="" value="" />
            </div>
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                Mật khẩu cũ</label>
            <input type="password" id="password" name="password"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                value="" />
            <p class="error text-[red]"><?php
                                        if (isset($_SESSION['errorPasswordOld'])) {
                                            echo $_SESSION['errorPasswordOld'];
                                        }
                                        unset($_SESSION['errorPasswordOld']);
                                        ?></p>
        </div>
        <div class="mb-5">
            <label for="newPassword" class="block mb-2 text-sm font-medium text-gray-900">
                Mật khẩu mới</label>
            <input type="password" id="newPassword" name="newPassword"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                value="" />
        </div>
        <div class="mb-5">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900">
                Địa chỉ</label>
            <input type="text" id="address" name="address"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                value="<?= $user['address'] ?>" />
        </div>
        <input name="userName" type="hidden" value="<?= $user['user_name'] ?>">
        <button type="submit" name="btn-updateUser"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
            Đổi thông tin </button>
    </form>
</body>

</html>