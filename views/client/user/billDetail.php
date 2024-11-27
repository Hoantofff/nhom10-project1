<div class="font-[sans-serif] bg-white">
    <div class="flex max-sm:flex-col gap-12 max-lg:gap-4  mt-[100px] mb-[50px]">
        <div class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-800 lg:min-w-[370px] sm:min-w-[300px]">
            <div class="relative">
                <div class="px-4 py-8 overflow-auto h-[calc(100vh-100px)]  ">
                    <div class="space-y-4">
                        <!-- THIS IS ONE ITEM -->
                        <?php for ($i = 0; $i < 6; $i++) { ?>
                        <div class="flex items-start gap-4">
                            <div class="w-32 h-full max-lg:w-24 max-lg:h-24 flex p-3 shrink-0 bg-[#fff] rounded-md">
                                <img src=<?= BASE_ASSETS_UPLOADS . "img/1731608844-iphone-15-plus_1__1.webp" ?>
                                    class="w-full object-contain" />
                            </div>
                            <div class="w-full">
                                <h3 class="text-base text-white">Iphone 15</h3>
                                <ul class="text-xs text-gray-300 space-y-2 mt-2">
                                    <li class="flex flex-wrap gap-4">Màu sắc <span class="ml-auto">Hồng</span></li>
                                    <li class="flex flex-wrap gap-4">Dung lượng <span class="ml-auto">8GB/256GB</span>
                                    </li>
                                    <li class="flex flex-wrap gap-4">Số lượng <span class="ml-auto">2</span></li>
                                    <li class="flex flex-wrap gap-4">Giá <span class="ml-auto">15.000.000đ</span></li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class=" bg-gray-800 w-full p-4">
                    <h4 class="flex flex-wrap gap-4 text-base text-white">Tổng tiền <span
                            class="ml-auto">150.000.000đ</span></h4>
                </div>
            </div>
        </div>

        <div class="max-w-4xl w-full h-max rounded-md px-4 py-8 sticky top-0">
            <h2 class="text-2xl font-bold text-gray-800">Điền hoàn thiện thông tin của bạn để thanh toán</h2>
            <form class="mt-8">
                <div>
                    <h3 class="text-base text-gray-800 mb-4">Thông tin người mua hàng</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <input type="text" placeholder="Tên người nhận"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>



                        <div>
                            <input type="email" placeholder="Email"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>

                        <div>
                            <input type="number" placeholder="Số điện thoại nhận hàng"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>
                        <div>
                            <input type="text" placeholder="Địa chỉ giao hàng"
                                class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                        </div>
                    </div>
                </div>
                <div class="flex gap-4 max-md:flex-col mt-8">
                    <button type="button"
                        class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-transparent hover:bg-gray-100 border border-gray-300 text-gray-800 max-md:order-1">Huỷ
                        thanh toán</button>
                    <button type="button"
                        class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-blue-600 hover:bg-blue-700 text-white">Hoàn
                        tất thanh toán
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>