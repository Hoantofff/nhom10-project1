<div class="font-[sans-serif] bg-white">
    <div class="flex max-sm:flex-col gap-12 max-lg:gap-4  mt-[100px] mb-[50px]">
        <div class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-800 lg:min-w-[370px] sm:min-w-[300px]">
            <div class="relative">
                <div class="px-4 py-8 overflow-auto h-[calc(100vh-100px)]  ">
                    <div class="space-y-4">
                        <!-- THIS IS ONE ITEM -->
                        <?php
                        $total = 0;
                        $count = 0;
                        foreach ($cartItems as $item): ?>
                        <div class="flex items-start gap-4">
                            <div class="w-32 h-full max-lg:w-24 max-lg:h-24 flex p-3 shrink-0 bg-[#fff] rounded-md">
                                <img src=<?= BASE_ASSETS_UPLOADS . $item['pd_image'] ?> class="w-full object-contain"
                                    alt="<?= $item['pd_name'] ?>" />
                            </div>
                            <div class="w-full">
                                <h3 class="text-base text-white"><?= $item['pd_name'] ?></h3>
                                <ul class="text-xs text-gray-300 space-y-2 mt-2">
                                    <li class="flex flex-wrap gap-4">Màu sắc <span
                                            class="ml-auto"><?= $item['color_value'] ?></span></li>
                                    <li class="flex flex-wrap gap-4">Dung lượng <span
                                            class="ml-auto"><?= $item['size_value'] ?></span>
                                    </li>
                                    <li class="flex flex-wrap gap-4">Số lượng <span
                                            class="ml-auto"><?= $item['c_quantity'] ?></span></li>
                                    <li class="flex flex-wrap gap-4">Giá <span
                                            class="ml-auto"><?= number_format($item['c_quantity'] * $item['pd_sale_price']) ?>đ</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                            $count = $item['c_quantity'] * $item['pd_sale_price'];
                            $total += $count;
                        endforeach; ?>
                    </div>
                </div>

                <div class=" bg-gray-800 w-full p-4">
                    <h4 class="flex flex-wrap gap-4 text-base text-white">Tổng tiền <span
                            class="ml-auto"><?= number_format($total) ?>đ</span></h4>
                </div>
            </div>
        </div>
        <div class="max-w-4xl w-full h-max rounded-md px-4 py-8 sticky top-0">
            <h2 class="text-2xl font-bold text-gray-800">Điền hoàn thiện thông tin của bạn để thanh toán</h2>
            <form class="mt-8" action="<?= BASE_URL ?>?act=addToBill" method="POST">
                <div>
                    <h3 class="text-base text-gray-800 mb-4">Thông tin người mua hàng</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <input type="text" placeholder="Tên người nhận" name="user_name"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>


                        <div>
                            <input type="email" placeholder="Email" name="user_email"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>

                        <div>
                            <input type="number" placeholder="Số điện thoại nhận hàng" name="user_phone"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>
                        <div>
                            <input type="text" placeholder="Địa chỉ giao hàng" name="user_address"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>
                        <div>
                            <input type="hidden" name="total" value="<?= $total ?>" />
                        </div>
                    </div>
                </div>
                <div class="flex gap-4 max-md:flex-col mt-8">
                    <button type="button"
                        class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-transparent hover:bg-gray-100 border border-gray-300 text-gray-800 max-md:order-1">Huỷ
                        thanh toán</button>
                    <button
                        class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-blue-600 hover:bg-blue-700 text-white"
                        type="submit" name="redirect">Thanh toán VNPay</button>
                    <button type="submit" name="paymentCod"
                        class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-blue-600 hover:bg-blue-700 text-white">Hoàn
                        tất thanh toán
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>