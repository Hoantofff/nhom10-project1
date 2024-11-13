<!DOCTYPE html>
<html lang="en" class="relative">
<div class="openShowCategories w-screen h-full z-30 absolute top-0 animate-fadeInLogin hidden">
    <div class="menu-main w-[225px] mt-[20px] rounded-[15px] shadow-menu bg-[#ffffff] absolute top-[59px] left-[80px]">
        <?php foreach ($category as $value) { ?>
        <a href="?action=goToType&id=<?php echo $value['id'] ?>"
            class="menu-item flex justify-between items-center hover:bg-[#ddd] py-[10px] px-[10px] rounded-[5px]">
            <p class="flex items-center gap-[5px]">
                <i class="  fa-solid <?php echo $value['icon'] ?> text-black text-[25px]"></i>
                <span class="text-[12px] font-bold text-[#343a40]">
                    <?php echo $value['category_name'] ?></span>
            </p>
            <i class="fa-solid fa-chevron-right"></i>
        </a>
        <?php  } ?>
    </div>
</div>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_ASSETS_CLIENT ?>/build/tailwind.css" />
    <link rel="stylesheet" href="<?= BASE_ASSETS_CLIENT ?>/css/style.css" />
    <script src="https://kit.fontawesome.com/84084c404d.js" crossorigin="anonymous"></script>
</head>

<body class="scroll-smooth">
    <div class="container relative h-auto" id="showHere">
        <?php session_start(); ?>
        <header class="h-[64px] pl-[50px] w-screen bg-[#e1042b] fixed top-[0] z-10">
            <nav class="w-full h-full flex items-center gap-[5px]">
                <a href="?action=index"><img src="<?= BASE_ASSETS_CLIENT ?>/img/Logo.png"
                        class="h-full w-[161px] object-cover" alt="" /></a>
                <div id="showCategories"
                    class="flex gap-[5px] justify-between items-center h-[42px] rounded-[10px] px-[3px] py-[5px] bg-[#ffffff33] text-white cursor-pointer">
                    <i class="fa-regular fa-rectangle-list text-[20px]"></i>
                    <p class="text-[12px]">Danh mục</p>
                </div>
                <a href="#"
                    class="flex gap-[8px] justify-between items-center h-[42px] rounded-[10px] px-[8px] py-[5px] bg-[#ffffff33] text-white">
                    <i class="fa-solid fa-location-dot text-[20px]"></i>
                    <div class="nav-text-location text-center">
                        <p class="text-[10px] font-bold">
                            Xem giá tại <i class="fa-solid fa-angle-down"></i>
                        </p>
                        <p class="text-[14px]">Hà Nội</p>
                    </div>
                </a>
                <form action="?action=searchProduct" method="post" class="w-[300px] h-[34px] relative">
                    <label for="search" class="absolute top-[50%] translate-y-[-50%] left-[10px]">
                        <i class="fa-solid fa-magnifying-glass text-[#707070] cursor-pointer"></i>
                    </label>
                    <input type="text" name="nameProduct" class="w-full h-full rounded-[10px] px-[30px]"
                        placeholder="Bạn cần tìm gì ?" />
                    <button type="none" id="search"></button>
                </form>
                <a href="?action=goToContact"
                    class="flex justify-center items-center gap-[10px] hover:bg-[#ffffff33] hover:h-[55px] h-[42px] rounded-[10px] px-[8px] py-[5px]">
                    <i class="fa-solid fa-phone text-[20px] text-white"></i>
                    <div class="nav-text-phone text-[12px] text-white">
                        <p>Liên hệ</p>
                        <p>Góp ý</p>
                    </div>
                </a>
                <a href="#"
                    class="flex justify-center items-center gap-[10px] hover:bg-[#ffffff33] hover:h-[55px] h-[42px] rounded-[10px] px-[8px] py-[5px]">
                    <i class="fa-solid fa-location-dot text-[20px] text-white"></i>
                    <p class="text-white text-[12px]">
                        Cửa hàng
                        <br />
                        gần bạn
                    </p>
                </a>
                <a href="?action=goToInfoWeb"
                    class="flex justify-center items-center gap-[10px] hover:bg-[#ffffff33] hover:h-[55px] h-[42px] rounded-[10px] px-[8px] py-[5px]">
                    <i class="fa-solid fa-circle-info text-[20px] text-white"></i>
                    <p class="text-white text-[12px]">
                        Giới thiệu
                        <br />
                        về CellphoneS
                    </p>
                </a>
                <a href="?action=test"
                    class="flex justify-center items-center gap-[10px] hover:bg-[#ffffff33] hover:h-[55px] h-[42px] rounded-[10px] px-[8px] py-[5px]">
                    <i class="fa-solid fa-cart-shopping text-[20px] text-white"></i>
                    <p class="text-white text-[12px]">
                        Giỏ
                        <br />
                        hàng
                    </p>
                </a>
                <?php if (isset($_SESSION['user_name']) && $_SESSION['role'] == 0) { ?>
                <div class="user w-[130px] flex">
                    <span class="text-[#fff] text-[12px]">Xin chào: <?= $_SESSION['user_name'] ?>
                        <a class="text-[#fff] text-[12px] underline"
                            href="?action=infoUser&userName=<?= $_SESSION['user_name'] ?>">Thông tin tài khoản</a>
                    </span>
                </div>
                <a href="?action=logout"
                    class="flex flex-wrap justify-center items-center gap-[5px] bg-[#ffffff33] h-[55px] rounded-[10px] px-[8px] py-[5px] cursor-pointer ">
                    <i class="fa-solid fa-right-from-bracket text-white text-[20px] w-full text-center"></i>
                    <p class="text-[12px] text-white">Đăng xuất</p>
                </a>
                <?php  } else if (isset($_SESSION['user_name']) && $_SESSION['role'] == 1) { ?>
                <a href="?action=admin&id=1"
                    class="flex flex-wrap justify-center items-center gap-[5px] bg-[#ffffff33] h-[55px] rounded-[10px] px-[8px] py-[5px] cursor-pointer">
                    <i class="fa-solid fa-user text-white text-[20px] w-full text-center"></i>
                    <p class="text-[12px] text-white">Đến trang quản trị</p>
                </a>
                <a href="?action=logout"
                    class="flex flex-wrap justify-center items-center gap-[5px] bg-[#ffffff33] h-[55px] rounded-[10px] px-[8px] py-[5px] cursor-pointer ">
                    <i class="fa-solid fa-right-from-bracket text-white text-[20px] w-full text-center"></i>
                    <p class="text-[12px] text-white">Đăng xuất</p>
                </a>
                <?php } else { ?>
                <span id="openLogin"
                    class="flex flex-wrap justify-center items-center gap-[5px] bg-[#ffffff33] h-[55px] rounded-[10px] px-[8px] py-[5px] cursor-pointer">
                    <i class="fa-solid fa-user text-white text-[20px] w-full text-center"></i>
                    <p class="text-[12px] text-white">Đăng nhập</p>
                </span>
                <?php if (isset($_SESSION['errorsLogin']) && $_SESSION['errorsLogin'] == true) { ?>
                <script>
                let errorsLogin = true;
                </script>
                <?php
                        session_destroy();
                    } ?>
                <?php if (isset($_SESSION['errorsSignIn']) && $_SESSION['errorsSignIn'] == true) { ?>
                <script>
                let errorsSignIn = true;
                </script>
                <?php
                        session_destroy();
                    }
                    ?>
                <?php if (isset($_SESSION['errorForgot']) && $_SESSION['errorForgot'] == true) { ?>
                <script>
                let errorForgot = true;
                </script>
                <?php } ?>
                <?php session_destroy();
                } ?>
            </nav>

        </header>
        <main class="w-screen px-[100px] mt-[50px] bg-[#fcfcfc]">
            <section class="flex justify-between gap-[20px]">
                <!-- MENU  -->
                <div class="menu-main w-[225px] mt-[20px] rounded-[15px] shadow-menu bg-[#ffffff]">
                    <?php foreach ($category as $value) { ?>
                    <a href="?action=goToType&id=<?php echo $value['id'] ?>"
                        class="menu-item flex justify-between items-center hover:bg-[#ddd] py-[10px] px-[10px] rounded-[5px]">
                        <p class="flex items-center gap-[5px]">
                            <i class="  fa-solid <?php echo $value['icon'] ?> text-black text-[25px]"></i>
                            <span class="text-[12px] font-bold text-[#343a40]">
                                <?php echo $value['category_name'] ?></span>
                        </p>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                    <?php  } ?>
                </div>
                <!-- SLIDER -->
                <div class="slider w-[767.5px] h-[450px] mt-[20px] rounded-b-[10px] shadow-menu bg-[#ffffff]">
                    <div id="slider-container-img" class=" w-full h-[75%] relative overflow-hidden">
                        <?php foreach ($sliders as $slider) { ?>
                        <img src="<?=BASE_ASSETS_CLIENT?>/img/<?= $slider['img'] ?>"
                            class="w-full h-full object-cover absolute first:left-[0%] left-[-100%]" alt="" />
                        <?php } ?>
                    </div>
                    <div class="slider-title w-full h-[25%] flex">
                        <?php foreach ($sliders as $slider) { ?>
                        <div
                            class="slider-title-item w-[20%] hover:bg-[#eee] cursor-pointer flex items-center justify-center  ">
                            <p class="text-[13px]">
                                <?= $slider['slider_product_name'] ?>
                                <br />
                                <?= $slider['content'] ?>
                            </p>
                        </div>
                        <?php  } ?>
                    </div>
                </div>
                <script src="./assets/js/slider.js"></script>
                <!-- RIGHT BANNER -->
                <div class="right-banner w-[265px] h-[450px] flex flex-wrap justify-between flex-col mt-[20px]">
                    <a href="#" class="shadow-menu h-[25%] block w-full rounded-[10px]">
                        <img src="<?=BASE_ASSETS_CLIENT?>/img/right-banner-1.webp"
                            class="w-full h-full object-cover rounded-[10px]" alt="" />
                    </a>
                    <a href="#" class="shadow-menu h-[25%] block w-full rounded-[10px]">
                        <img src="<?=BASE_ASSETS_CLIENT?>/img/right-banner-2.webp"
                            class="w-full h-full object-cover rounded-[10px]" alt="" />
                    </a>
                    <a href="#" class="shadow-menu h-[25%] block w-full rounded-[10px]">
                        <img src="<?=BASE_ASSETS_CLIENT?>/img/right-banner-3.webp"
                            class="w-full h-full object-cover rounded-[10px]" alt="" />
                    </a>
                </div>
            </section>
            <a href="#" class="banner w-full mt-[15px] block">
                <img class="w-full rounded-[10px] shadow-menu" src="<?=BASE_ASSETS_CLIENT?>/img/banner.gif" alt="" />
            </a>
            <?php foreach ($data as $value) { ?>
            <section class="flex flex-wrap mt-[20px] min-h-[250px] mb-[10px]">
                <?php foreach ($value['title'] as $titles) { ?>
                <?php foreach ($titles as $title) { ?>
                <div class="product-list-title flex justify-between w-full mb-[20px]">
                    <h2 class="uppercase text-[#444] font-semibold text-[22px] mr-[20px] text-nowrap w-[30%]">
                        <?php echo $title ?>
                    </h2>
                    <?php } ?>
                    <?php } ?>
                    <div class="list-item-tag flex justify-end gap-3">
                        <?php foreach ($value['type'] as $types) { ?>
                        <?php foreach ($types as $type) { ?>
                        <a href="#"
                            class="flex items-center justify-center  last:mr-0 bg-[#f3f4f6] border-[1px] border-solid border-[#e5e7eb] rounded-[10px] text-[#444] text-[13px] h-[34px] px-[10px] py-[10px] text-nowrap">
                            <p class=""><?php echo $type ?></p>
                        </a>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="list-items w-full flex gap-[20px]  justify-between overflow-hidden">
                    <!-- ITEM IN HERE -->
                    <?php foreach ($value['products'] as $products) { ?>
                    <div class="item px-[15px] w-[25%] rounded-[15px] shadow-menu relative">
                        <div class="sale-item-tag absolute top-0 left-0 h-[31px] w-[80px]">
                            <img class="w-full h-full" src="<?=BASE_ASSETS_CLIENT?>/img/sale-tag.png" alt="" />
                            <p
                                class="sale-price absolute top-[50%] translate-y-[-70%] left-[10px] text-[#fff] text-[12px] font-bold">
                                Giảm <?php echo $products['product_sale'] ?>%
                            </p>
                        </div>
                        <a href="?action=productDetails&id=<?= $products['product_id'] ?>" class="text-[#444]">
                            <div class="item-img w-full mt-[25px] flex justify-center">
                                <img class="w-[160px]"
                                    src="<?=BASE_ASSETS_CLIENT?>/img/<?php echo $products['product_img'] ?>" alt="" />
                            </div>
                            <div class="item-title mb-[5px]">
                                <h3 class="text-[#444] line-clamp-3 text-[14px] font-semibold h-[65px] mt-[20px]">
                                    <?php echo $products['product_name'] ?>
                                </h3>
                            </div>
                            <div class="item-price text-nowrap mb-[5px]">
                                <p class="inline-block new-price text-[16px] text-[#d70018] font-bold">
                                    <?php echo $products['product_new_price'] ?>đ
                                </p>
                                <p class="inline-block old-price text-[14px] text-[#707070] line-through font-semibold">
                                    <?php echo $products['product_old_price'] ?>đ
                                </p>
                            </div>
                            <div class="item-member text-[#444] mb-[5px] text-[11px] flex items-center gap-[3px]">
                                <span class="text-nowrap">Smember giảm thêm đến</span>
                                <span
                                    class="text-[14px] text-[#d70018] font-bold"><?php echo $products['product_smember'] ?>đ</span>
                            </div>
                            <div
                                class="item-promotion mb-[50px] border-[1px] border-solid border-[#e5e7eb] bg-[#f3f4f6] rounded-[5px] text-[12px] p-[5px]">
                                <p class="line-clamp-2">
                                    Không phí chuyển đổi khi trả góp 0% qua thẻ tín dụng kỳ hạn
                                    3-6 tháng
                                </p>
                            </div>
                        </a>
                        <div class="item-bottom flex justify-between mb-[10px]">
                            <div class="item-rating">
                                <i class="fa-solid fa-star text-[#f59e0b] text-[15px]"></i>
                                <i class="fa-solid fa-star text-[#f59e0b] text-[15px]"></i>
                                <i class="fa-solid fa-star text-[#f59e0b] text-[15px]"></i>
                                <i class="fa-solid fa-star text-[#f59e0b] text-[15px]"></i>
                                <i class="fa-solid fa-star text-[#f59e0b] text-[15px]"></i>
                            </div>
                            <div class="item-like">
                                <span class="inline-block text-[#777] text-[12px]">Yêu thích
                                </span>
                                <a href="#">
                                    <i class="fa-regular text-[#777] fa-heart text-[15px] cursor-pointer"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </section>
            <?php } ?>
            <section class="mt-[20px]">
                <div class="brand-banner mt-[20px] mb-[20px]">
                    <a href="#" class="banner-title uppercase text-[#444] text-[22px] font-semibold">Ưu đãi sinh
                        viên</a>
                </div>
                <div class="banner-container flex justify-between w-full gap-[10px]">
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-sale-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-sale-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-sale-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-sale-1.webp" alt="" />
                    </a>
                </div>
            </section>
            <section class="mt-[20px]">
                <div class="brand-banner mt-[20px] mb-[20px]">
                    <a href="#" class="banner-title uppercase text-[#444] text-[22px] font-semibold">Ưu đãi thanh
                        toán</a>
                </div>
                <div class="banner-container flex justify-between w-full gap-[10px]">
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-pay-sale-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-pay-sale-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-pay-sale-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-pay-sale-1.webp" alt="" />
                    </a>
                </div>
            </section>
            <section class="mt-[20px]">
                <div class="brand-banner mt-[20px] mb-[20px]">
                    <a href="#" class="banner-title uppercase text-[#444] text-[22px] font-semibold">Chuyên trang thương
                        hiệu</a>
                </div>
                <div class="banner-container flex justify-between w-full gap-[10px]">
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-brand-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-brand-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-brand-1.webp" alt="" />
                    </a>
                    <a href="#" class="w-[25%]">
                        <img class="rounded-[10px]" src="<?=BASE_ASSETS_CLIENT?>/img/banner-brand-1.webp" alt="" />
                    </a>
                </div>
            </section>
            <section class="mt-[20px] mb-[50px]">
                <div class="news-title mt-[20px] mb-[20px]">
                    <a href="#" class="uppercase text-[#444] text-[22px] font-semibold">TIN CÔNG NGHỆ</a>
                </div>
                <div class="news-container flex justify-between w-full gap-[20px]">
                    <a href="#"
                        class="border pb-[10px] border-solid border-[#dedede] rounded-[15px] text-[#000] w-[25%] duration-500 ease-in-out hover:scale-105">
                        <img src="<?= BASE_ASSETS_CLIENT ?>/img/news-1.jpeg"
                            class="h-[160px] w-full p-[5px] object-cover rounded-t-[15px]" alt="" />
                        <p class="line-clamp-2 px-[5px] text-[#444] text-[16px] h-[48px] font-semibold">
                            6 tính năng của Android mà iOS 18 vẫn chưa có
                        </p>
                    </a>
                    <a href="#"
                        class="border pb-[10px] border-solid border-[#dedede] rounded-[15px] text-[#000] w-[25%] duration-500 ease-in-out hover:scale-105">
                        <img src="<?= BASE_ASSETS_CLIENT ?>/img/news-1.jpeg"
                            class="h-[160px] w-full p-[5px] rounded-t-[15px] object-cover" alt="" />
                        <p class=" line-clamp-2 px-[5px] text-[#444] text-[16px] h-[48px] font-semibold">
                            Đây là smartphone 5G nhỏ nhất thế giới: Chip Dimensity 7300,
                            12GB RAM và pin 4000mAh
                        </p>
                    </a>
                    <a href="#"
                        class="border pb-[10px] border-solid border-[#dedede] rounded-[15px] text-[#000] w-[25%] duration-500 ease-in-out hover:scale-105">
                        <img src="<?= BASE_ASSETS_CLIENT ?>/img/news-1.jpeg"
                            class="h-[160px] w-full p-[5px] rounded-t-[15px] object-cover" alt="" />
                        <p class="line-clamp-2 px-[5px] text-[#444] text-[16px] h-[48px] font-semibold">
                            Huawei ra mắt FreeBuds 6i với công nghệ chống ồn chủ động thông
                            minh được nâng cấp, giá 1.79 triệu đồng
                        </p>
                    </a>
                    <a href="#"
                        class="border pb-[10px] border-solid border-[#dedede] rounded-[15px] text-[#000] w-[25%] duration-500 ease-in-out hover:scale-105">
                        <img src="<?= BASE_ASSETS_CLIENT ?>/img/news-1.jpeg"
                            class="h-[160px] w-full p-[5px] rounded-t-[15px] object-cover" alt="" />
                        <p class="line-clamp-2 px-[5px] text-[#444] text-[16px] h-[48px] font-semibold">
                            S-News Cuối Tuần #37: Red Magic 9S Pro Series ra mắt, AnTuTu
                            chia sẻ 10 smartphone có hiệu năng mạnh nhất
                        </p>
                    </a>
                </div>
            </section>
        </main>
        <footer class="w-screen min-h-[200px]">
            <div class="footer-border-top h-[1px] shadow-menu w-full"></div>
            <div class="footer-top p-[15px] bg-[#fff]">
                <div class="footer-top-container box-border my-0 mx-auto w-[1200px] flex justify-between gap-[10px]">
                    <div class="footer-call w-[25%] text-[#4a4a4a]">
                        <div class="footer-call mb-[10px]">
                            <p class="title text-[16px] font-medium text-[#363636]">
                                Tổng đài hỗ trợ miễn phí
                            </p>
                            <div class="footer-phone-number mt-[10px]">
                                <ul class="list-link">
                                    <li class="link" mb-[5px]>
                                        <div class="text-nowrap text-[12px] ml-[10px]">
                                            <span>Gọi mua hàng</span>
                                            <a href="tel:18002097"> <strong>1800.2097</strong> </a>
                                            <span>(7h30 - 22h00)</span>
                                        </div>
                                    </li>
                                    <li class="link" mb-[5px]>
                                        <div class="text-nowrap text-[12px] ml-[10px]">
                                            <span> Gọi khiếu nạn</span>
                                            <a href="tel:180020637"> <strong>1800.2063</strong> </a>
                                            <span> (8h00 - 21h30)</span>
                                        </div>
                                    </li>
                                    <li class="link" mb-[5px]>
                                        <div class="text-nowrap text-[12px] ml-[10px]">
                                            <span>Gọi bảo hành</span>
                                            <a href="tel:18002064"> <strong>1800.2064</strong> </a>
                                            <span>(8h00 - 21h00)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-pay-way">
                            <p class="title text-[16px] font-medium text-[#363636]">
                                Phương thức thanh toán
                            </p>
                            <div class="pay-way-container pl-[10px]">
                                <ul class="list-pays">
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?= BASE_ASSETS_CLIENT?>/img/apple-pay-og.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/vnpay-logo.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/momo_1.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/onepay-logo.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/mpos-logo.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/kredivo-logo.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/zalopay-logo.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/alepay-logo.webp" alt="" />
                                        </a>
                                    </li>
                                    <li
                                        class="pay inline-block text-[12px] mb-[5px] rounded-[3px] border-[1px] border-solid border-[#dee2e6] h-[32px] w-[50px] align-middle">
                                        <a href="#" class="w-full h-full">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/fundiin.webp" alt="" />
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="footer-subcriber-form" class="mt-[10px]">
                            <p class="text-[#4a4a4a] text-[16px] font-normal">
                                ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI
                            </p>
                            <p class="text-[#d70018] text-[14px]">
                                (*) Nhận ngay voucher 10%
                            </p>
                            <p class="text-[#111] text-[13px] mb-[10px]">
                                *Voucher sẽ được gửi sau 24h, chỉ áp dụng cho khách hàng mới
                            </p>
                            <form action="" method="POST">
                                <input placeholder="Email *" type="text"
                                    class="py-[3px] px-[10px] h-[30px] w-full border-[1px] border-[#dbdbdb] rounded-[4px] text-[#363636] bg-[#fff] shadow-form mb-[20px]" />
                                <input placeholder="Số điện thoại" type="text"
                                    class="py-[3px] px-[10px] h-[30px] w-full border-[1px] border-[#dbdbdb] rounded-[4px] text-[#363636] bg-[#fff] shadow-form mb-[10px]" />
                                <label class="subcribe-rule flex items-center gap-[5px]" for="check-rule">
                                    <input type="checkbox" disabled="disabled" class="text-[#7a7a7a]" id="check-rule" />
                                    <p class="text-[#d70018] text-[13px] inline-block">
                                        Tôi đồng ý với điều khoản của CellphoneS
                                    </p>
                                </label>
                                <button
                                    class="btn-rule mt-[20px] bg-[#d70018] rounded-[7px] text-[#fff] text-[14px] font-semibold w-full p-[7px] text-center text-nowrap">
                                    ĐĂNG KÝ NGAY
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="footer-policy w-[25%] text-[#4a4a4a]">
                        <p class="title text-[16px] font-medium text-[#363636]">
                            Thông tin và chính sách
                        </p>
                        <div class="title-policies mt-[10px]">
                            <ul class="list-link text-[12px]">
                                <li class="link mb-[5px]">
                                    <a href="#">Mua hàng và thanh toán Online</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Mua hàng trả góp Online</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Mua hàng trả góp bằng thẻ tín dụng</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Chính sách giao hàng</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Tra điểm Smember</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Xem ưu đãi Smember</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Tra thông tin bảo hành</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Tra cứu hoá đơn điện tử</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Thông tin hoá đơn mua hàng</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Trung tâm bảo hành chính hãng</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Quy định về việc sao lưu dữ liệu</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Chính sách khui hộp sản phẩm Apple</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-services w-[25%] text-[#4a4a4a]">
                        <p class="title text-[16px] font-medium text-[#363636]">
                            Dịch vụ và thông tin khác
                        </p>
                        <div class="title-services">
                            <ul class="list-link text-[12px]">
                                <li class="link mb-[5px]">
                                    <a href="#">Khách hàng doanh nghiệp (B2B)</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Ưu đãi thanh toán</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Quy chế hoạt động</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Chính sách bảo mật thông tin cá nhân</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Chính sách Bảo hành</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Liên hệ hợp tác kinh doanh</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Tuyển dụng</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <a href="#">Dịch vụ bảo hành mở rộng</a>
                                </li>
                                <li class="link mb-[5px]">
                                    <div class="download-app">
                                        <p class="flex gap-[5px] items-center text-nowrap">
                                            <svg width="15" height="15" viewBox="0 0 38 38" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect x="0.5" y="0.5" width="37" height="37" rx="5.5"
                                                    fill="url(#pattern0_1350_26900)" stroke="white"></rect>
                                                <defs>
                                                    <pattern id="pattern0_1350_26900"
                                                        patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_1350_26900"
                                                            transform="scale(0.00444444)">
                                                        </use>
                                                    </pattern>
                                                    <image id="image0_1350_26900" width="225" height="225"
                                                        xlink:href="data:image/png;base64,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">
                                                    </image>
                                                </defs>
                                            </svg>
                                            Smember: Tích điểm & sử dụng ưu đãi
                                        </p>
                                        <div class="qr-app flex mt-[5px]">
                                            <img src="<?=BASE_ASSETS_CLIENT?>/img/QR_appGeneral.webp"
                                                class="w-[40%] h-[40%] object-cover" alt="" />
                                            <div class="flex flex-wrap w-[55%]">
                                                <a href="#" class="p-[3px]">
                                                    <img src="<?=BASE_ASSETS_CLIENT?>/img/downloadANDROID.webp"
                                                        class="w-full h-[auto]" alt="" /></a>
                                                <a href="#" class="p-[3px]">
                                                    <img src="<?=BASE_ASSETS_CLIENT?>/img/downloadiOS.webp"
                                                        class="w-full h-[auto]" alt="" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-connect">
                        <p class="title text-[16px] font-medium text-[#363636]">
                            Kết nối với CellphoneS
                        </p>
                        <div class="icons-social flex gap-[5px]">
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/cellphones-youtube.webp" class="p-[5px]"
                                    alt="" /></a>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/cellphones-facebook.webp" class="p-[5px]"
                                    alt="" /></a>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/cellphones-instagram.webp" class="p-[5px]"
                                    alt="" /></a>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/cellphones-tiktok.webp" class="p-[5px]"
                                    alt="" /></a>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/cellphones-zalo.webp" class="p-[5px]"
                                    alt="" /></a>
                        </div>
                        <p class="title text-[16px] font-medium text-[#363636]">
                            Website thành viên
                        </p>
                        <div class="website-member mt-[5px]">
                            <p class="text-[#3f3f3f] text-[12px] font-normal mb-[5px]">
                                Hệ thống bảo hành sửa chữa Điện thoại - Máy tính
                            </p>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/dienthoaivui.webp" alt="" /></a>
                            <p class="text-[#3f3f3f] text-[12px] font-normal mb-[5px]">
                                Trung tâm bảo hành uỷ quyền Apple
                            </p>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/Logo_CareS_1.webp" alt="" /></a>
                            <p class="text-[#3f3f3f] text-[12px] font-normal mb-[5px]">
                                Kênh thông tin giải trí công nghệ cho giới trẻ
                            </p>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/schanel.webp" alt="" /></a>
                            <p class="text-[#3f3f3f] text-[12px] font-normal mb-[5px]">
                                Trang thông tin công nghệ mới nhất
                            </p>
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/sforum.webp" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom bg-[#f8f8f8] min-h-[100px] p-[15px] text-[#4a4a4a] text-[12px]">
                <div class="footer-bottom-container w-[1200px] my-[0] mx-[auto] box-border">
                    <div class="bottom-title mb-[5px]">
                        <div class="row flex justify-between">
                            <div class="col-3 basis-0 grow-[1] shrink-[1] p-[10px]">
                                <span class="title block text-nowrap mb-[10px]">
                                    <span class="">
                                        <span><a href="#">Back to School là gì</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Điện thoại</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Điện thoại iPhone</a></span>
                                    </span>
                                </span>
                                <span class="title block text-nowrap">
                                    <span class="">
                                        <span><a href="#">Điện thoại iPhone 15</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Điện thoại iPhone 15 Pro Max</a></span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-3 basis-0 grow-[1] shrink-[1] p-[10px]">
                                <span class="title block text-nowrap mb-[10px]">
                                    <span class="">
                                        <span><a href="#">Điện thoại Vivo</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Điện thoại OPPO</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Điện thoại Xiaomi</a></span>
                                    </span>
                                </span>
                                <span class="title block text-nowrap">
                                    <span class="">
                                        <span><a href="#">Điện thoại Samsung Galaxy</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Samsung Galaxy A</a></span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-3 basis-0 grow-[1] shrink-[1] p-[10px]">
                                <span class="title text-nowrap block mb-[10px]">
                                    <span class="">
                                        <span><a href="#">Laptop</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Laptop Acer</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Laptop Dell</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Laptop HP</a></span>
                                    </span>
                                </span>
                                <span class="title text-nowrap block">
                                    <span class="">
                                        <span><a href="#">Tivi</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Tivi Samsung</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Tivi Sony</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Tivi LG</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Tivi TCL</a></span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-3 basis-0 grow-[1] shrink-[1] p-[10px]">
                                <span class="title block text-nowrap mb-[10px]">
                                    <span class="">
                                        <span><a href="#">Nhà thông minh</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Máy hút bụi gia đình</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Cân điện tử</a></span>
                                    </span>
                                </span>
                                <span class="title block text-nowrap">
                                    <span class="">
                                        <span><a href="#">Đồ gia dụng</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Nồi chiên không dầu giá rẻ</a></span>
                                        <span> – </span>
                                    </span>
                                    <span class="">
                                        <span><a href="#">Nồi cơm điện</a></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-infor">
                        <div class="bottom-infor-text text-center mb-[5px]">
                            <p class="text-[#00000080] text-[10px]">
                                Công ty TNHH Thương Mại và Dịch Vụ Kỹ Thuật DIỆU PHÚC -
                                GPĐKKD: 0316172372 cấp tại Sở KH & ĐT TP. HCM. Địa chỉ văn
                                phòng: 350-352 Võ Văn Kiệt, Phường Cô Giang, Quận 1, Thành phố
                                Hồ Chí Minh, Việt Nam. Điện thoại: 028.7108.9666.
                            </p>
                        </div>
                        <div class="bottom-infor-img flex items-center justify-center gap-[3px]">
                            <a href="#"><img src="<?=BASE_ASSETS_CLIENT?>/img/footer-info-1.webp" alt="" /></a>
                            <a href="#"><img class="h-[20px]" src="<?=BASE_ASSETS_CLIENT?>/img/footer-info-2.png"
                                    alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php include './includes/loginForm.php' ?>
        <?php include './includes/signInForm.php' ?>
        <?php include './includes/forgotForm.php' ?>
    </div>
    <!-- UpdateUserSuccess -->
    <?php if (isset($_SESSION['updateUserSuccess'])) { ?>
    <script>
    alert("Thay đổi thông tin tài khoản thành công")
    </script>
    <?php unset($_SESSION['updateUserSuccess']);
    } ?>
</body>
<script src="./assets/js/home.js"></script>

</html>