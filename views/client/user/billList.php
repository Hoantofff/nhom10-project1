<form class="w-[1290px] mt-[100px] pb-[30px]  border-[1px] border-[#ccc] rounded-[15px] px-[10px] mx-auto my-[0]"
    action="">
    <table class="w-full">
        <thead>
        <?php echo $_SESSION['user_client']['id']; ?>
            <tr class="flex justify-between font-bold ">
                <!-- <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Id
                </td> -->
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Mã đơn</td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                Trạng thái</td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Hình thức TT
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[15%] text-center  text-nowrap">
                    Trạng thái TT
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Người nhận
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Địa chỉ
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    SĐT
                </td>
                <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
                    Tổng tiền
                </td>
                <td class="p-[10px] w-[5%]  text-nowrap"></td>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $item) : ?>


                <tr class="flex justify-between font-bold ">
                    <!-- <td class="p-[10px] w-[10%] "> <img class="w-[140px]  object-cover"
                            src="<?= BASE_ASSETS_UPLOADS ?>/img/iphone-14_1.webp" alt="">
                    </td> -->
                    <td class="p-[10px] w-[10%] text-center "><?=$item['id']?></td>
                    <td class="p-[10px] w-[10%] text-center "><?=$item['bill_status']?></td>
                    <td class="p-[10px] w-[10%] text-center "><?=$item['payment_type']?></td>
                    <td class="p-[10px] w-[10%] text-center "><?=$item['payment_status']?></td>
                    <td class="p-[10px] w-[10%] text-center "><?=$item['user_name']?></td>
                    <td class="p-[10px] w-[10%] text-center "><?=$item['user_address']?></td>
                    <td class="p-[10px] w-[10%] text-center "><?=$item['user_phone']?></td>
                    <td class="p-[10px] w-[10%] text-center "><?=$item['total']?></td>
                    <!-- <td class="p-[10px] w-[15%] text-nowrap text-center ">256GB/8GB RAM
                    </td>
                    <td class="p-[10px] w-[10%] text-center "><input
                            class="w-[40px] h-[40px] border-[1px] border-[#ccc] rounded-[5px] text-center" type="number"
                            value="1">
                    </td>
                    <td class="p-[10px] w-[10%] text-center ">25.000.000đ
                    </td> -->
                    <td class="p-[10px] w-[5%]  text-nowrap">
                        <a href="#">Xem chi tiết</i></a>
                    </td>
                </tr>
                <tr class="w-full border-b-[3px] border-solid border-[#222]"></tr>

            <?php  endforeach; ?>
        </tbody>
    </table>
</form>