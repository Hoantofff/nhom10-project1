<?php if (!empty($_SESSION['user_admin']) || !empty($_SESSION['user_client'])): ?>
    <?php
    // if (isset($_SESSION['success'])) {
    //     $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    //     echo "<div class='alert $class'>{$_SESSION['msg']}</div>";

    //     unset($_SESSION['success']);
    //     unset($_SESSION['msg']);
    // }
    ?>
    <form
        class="w-[1290px] mt-[100px] pb-[30px] border-[1px] border-[#ccc] rounded-[15px] px-[10px] mx-auto my-[0]"
        action="<?= BASE_URL ?>?act=update-cart"
        method="POST">
        <table class="w-full">
            <thead>
                <tr class="flex justify-between font-bold">
                    <th class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center">Sản phẩm</th>
                    <th class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center">Giá</th>
                    <th class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center">Màu sắc</th>
                    <th class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[15%] text-center">Dung lượng</th>
                    <th class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center">Số lượng</th>
                    <th class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center">Thành tiền</th>
                    <th class="p-[10px] w-[5%]"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $count = 0;
                foreach ($cartItems as $item): ?>
                    <tr class="flex justify-between font-bold">
                        <td class="p-[10px] w-[10%] text-center">
                            <img
                                class="w-[140px] object-cover"
                                src="<?= BASE_ASSETS_UPLOADS . $item['pd_image'] ?>"
                                alt="<?= $item['pd_name'] ?>">
                        </td>
                        <td class="p-[10px] w-[10%] text-center"><?= number_format($item['pd_sale_price'], 0, ',', '.') ?>đ</td>
                        <td class="p-[10px] w-[10%] text-center"><?= $item['color_value'] ?></td>
                        <td class="p-[10px] w-[15%] text-center"><?= $item['size_value'] ?></td>
                        <td class="p-[10px] w-[10%] text-center">
                            <input
                                class="w-[40px] h-[40px] border-[1px] border-[#ccc] rounded-[5px] text-center"
                                type="number"
                                name="products[<?= $item['variant_id'] ?>][quantity]" 
                            value="<?= $item['c_quantity'] ?>"
                            min="1">
                            <input type="hidden" name="products[<?= $item['variant_id'] ?>][product_id]" value="<?= $item['pd_id'] ?>">
                            <input type="hidden" name="products[<?= $item['variant_id'] ?>][variant_id]" value="<?= $item['variant_id'] ?>"> 
                        </td>
                        <td class="p-[10px] w-[10%] text-center"><?= number_format($item['c_quantity'] * $item['pd_sale_price']) ?>đ</td>
                        <td class="p-[10px] w-[5%] text-center">
                            <a href="<?= BASE_URL ?>?act=remove-item-from-cart&user_id=<?= $userId ?>&product_id=<?= $item['pd_id'] ?>&variant_id=<?= $item['variant_id'] ?>" 
                                class="text-[#e1042b]">
                                <i class="fa-solid fa-trash text-[35px]"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="w-full border-b-[3px] border-solid border-[#222]"></tr>

                <?php
                    $count = $item['c_quantity'] * $item['pd_sale_price'];
                    $total += $count;
                endforeach; ?>
            </tbody>
        </table>

        <div class="mt-[20px]">
            <h2 class="font-bold text-[20px] text-right">Tổng tiền: <?= number_format($total, 0, ',', '.') ?>đ</h2>
            <input type="hidden" name="total" value="<?= $total ?>">
        </div>

        <div class="w-full flex flex-row-reverse mt-[20px]">
            <button
                type="submit"
                class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-[#fff] font-bold">
                Lưu và Cập nhật giỏ hàng
            </button>
        </div>
    </form>




    <!-- form 2 -->
    <form class="w-[1290px] mt-[100px] pb-[30px]  border-[1px] border-[#ccc] rounded-[15px] px-[10px] mx-auto my-[0]"
        action="<?= BASE_URL ?>?act=addToBill" method="POST">
        <div class="">
            <label for="user_name">Tên người nhận</label>
            <input type="text" value="Nguyễn Văn A" id="address" name="user_name"
                class="rounded-[10px] p-[5px] border-[#d3d3d3] border-[1px] border-solid">
        </div>
        <div class="">
            <label for="user_address">Địa chỉ nhận hàng:</label>
            <input type="text" value="HaNoi, Nam Tu Liem" id="address" name="user_address"
                class="rounded-[10px] p-[5px] border-[#d3d3d3] border-[1px] border-solid">
        </div>
        <div class="">
            <label for="user_phone">Số điện thoại:</label>
            <input type="number" value="012345689" id="phone" name="user_phone"
                class="rounded-[10px] p-[5px] border-[#d3d3d3] border-[1px] border-solid">
        </div>
        <input type="hidden" name="total" value="<?= $total ?>">
        <h1>Tổng tiền : <?= $total ?> </h1>
        <div class="w-full flex flex-row-reverse mt-[20px]">
            <!-- Nút Đặt hàng -->
            <button type="submit" class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">
                Đặt hàng
            </button>
        </div>
    </form>
<?php else: ?>
    <div class="w-[1290px] mt-[100px] pb-[30px] text-center  border-[1px] border-[#ccc] rounded-[15px] px-[10px] mx-auto my-[0]">
        <a class="px-6 py-3 bg-blue-500 font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all" href="<?= BASE_URL ?>?act=show-form-login">Bạn phải đăng nhập để xem giỏ hàng</a>
    </div>
<?php endif; ?>
</div>