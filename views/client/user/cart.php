<?php if(!empty($_SESSION['user_admin']) || !empty($_SESSION['user_client'])): ?>
<form class="w-[1290px] mt-[100px] pb-[30px]  border-[1px] border-[#ccc] rounded-[15px] px-[10px] mx-auto my-[0]"
    action="<?= BASE_URL ?>?act=update-cart" method="POST">
    <table class="w-full">
        <thead>
            <tr class="flex justify-between font-bold ">
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Sản phẩm
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Giá</td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Màu
                    sắc
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[15%] text-center  text-nowrap">
                    Dung
                    lượng
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Số
                    lượng
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Thành
                    tiền
                </td>
                <td class="p-[10px] w-[5%]  text-nowrap"></td>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                    <tr class="flex justify-between font-bold">
                        <td class="p-[10px] w-[10%]">
                            <img class="w-[140px] object-cover" src="<?= BASE_ASSETS_UPLOADS . $item['pd_image'] ?>" alt="">
                        </td>
                        <td class="p-[10px] w-[10%] text-center"><?= number_format($item['pd_sale_price'], 0, ',', '.') ?>đ</td>
                        <td class="p-[10px] w-[10%] text-center">Đen</td>
                        <td class="p-[10px] w-[15%] text-nowrap text-center">256GB/8GB RAM</td>
                        <td class="p-[10px] w-[10%] text-center">
                            <input class="w-[40px] h-[40px] border-[1px] border-[#ccc] rounded-[5px] text-center"
                                type="number"
                                name="products[<?= $item['pd_id'] ?>][quantity]"
                                value="<?= $item['c_quantity'] ?>"
                                min="1">
                            <input type="hidden" name="products[<?= $item['pd_id'] ?>][product_id]" value="<?= $item['pd_id'] ?>">
                        </td>
                        <td class="p-[10px] w-[10%] text-center">
                            <?= number_format($item['c_quantity'] * $item['pd_sale_price']) ?>đ
                        </td>
                        <td class="p-[10px] w-[5%] text-nowrap">
                            <a href="#"><i class="fa-solid fa-trash text-[35px] text-[#e1042b]"></i></a>
                        </td>
                    </tr>
                    <tr class="w-full border-b-[3px] border-solid border-[#222]"></tr>
                    <input type="hidden" name="product_id" value="<?= $item['pd_id'] ?>">
            <?php endforeach ?>

        </tbody>
    </table>
    <div class="mt-[20px]">
        <h3 class=" font-bold">Chọn hình thức thanh toán</h3>
        <div class="payCodBox flex flex-wrap items-center gap-[15px] mb-[15px]">
            <div class="inputPayCod w-full flex items-center gap-[15px]">
                <input class="" type="radio" name="paymentMethod" id="payCod">
                <label for="payCod">Thanh toán khi nhận được hàng</label>
            </div>
            <div class="payFormCod flex flex-wrap gap-[20px]">

            </div>
        </div>
        <div class="payOnlineBox flex items-center gap-[15px] flex-wrap">
            <div class="inputPayOnline w-full flex items-center gap-[15px]">
                <input class="" type="radio" name="paymentMethod" id="payOnline">
                <label for="payOnline">Thanh toán Online</label>
            </div>
            <div class="payForm">
            </div>
        </div>
    </div>
    <div class="w-full flex flex-row-reverse mt-[20px]">
        <button type="submit" class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">
            Cập nhật giỏ hàng
        </button>
        <a href="?action=cartStatus"
            class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">Đặt
            hàng</a>
    </div>
</form>
<?php else: ?>
<div class="w-[1290px] mt-[100px] pb-[30px] text-center  border-[1px] border-[#ccc] rounded-[15px] px-[10px] mx-auto my-[0]">
    <a class="px-6 py-3 bg-blue-500 font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all" href="<?= BASE_URL ?>?act=show-form-login">Bạn phải đăng nhập để xem giỏ hàng</a>
</div>
<?php endif; ?>