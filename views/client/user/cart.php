<?php if (!empty($_SESSION['user_admin']) || !empty($_SESSION['user_client'])): ?>
<?php
    // if (isset($_SESSION['success'])) {
    //     $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    //     echo "<div class='alert $class'>{$_SESSION['msg']}</div>";

    //     unset($_SESSION['success']);
    //     unset($_SESSION['msg']);
    // }
    ?>
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
            <?php
                $total = 0;
                $count = 0;
                foreach ($cartItems as $item): ?>
            <tr class="flex justify-between font-bold">
                <td class="p-[10px] w-[10%]">
                    <img class="w-[140px] object-cover" src="<?= BASE_ASSETS_UPLOADS . $item['pd_image'] ?>" alt="">
                </td>
                <td class="p-[10px] w-[10%] text-center"><?= number_format($item['pd_sale_price'], 0, ',', '.') ?>đ</td>
                <td class="p-[10px] w-[10%] text-center">Đen</td>
                <td class="p-[10px] w-[15%] text-nowrap text-center">256GB/8GB RAM</td>
                <td class="p-[10px] w-[10%] text-center">
                    <input class="w-[40px] h-[40px] border-[1px] border-[#ccc] rounded-[5px] text-center" type="number"
                        name="products[<?= $item['pd_id'] ?>][quantity]" value="<?= $item['c_quantity'] ?>" min="1">
                    <input type="hidden" name="products[<?= $item['pd_id'] ?>][product_id]"
                        value="<?= $item['pd_id'] ?>">
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
            <?php
                    $count = $item['c_quantity'] * $item['pd_sale_price'];
                    $total += $count;
                endforeach ?>

        </tbody>
    </table>
    <div class="w-full flex flex-row-reverse mt-[20px]">
        <button type="submit"
            class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">
            Cập nhật giỏ hàng
        </button>
        <a href="?act=goToPayment"
            class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">Thanh
            toán</a>
    </div>
</form>

</tbody>
</table>
<div>
    <br>
    <h1>Tổng tiền : <?= $total ?> </h1>
</div>
<input type="hidden" value="<?= $total ?>">
<div class="w-full flex flex-row-reverse mt-[20px]">
    <!-- Nút Lưu và Cập nhật giỏ hàng -->
    <button type="submit"
        class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">
        Lưu và Cập nhật giỏ hàng
    </button>
</div>
</form>