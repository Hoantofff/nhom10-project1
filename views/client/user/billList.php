<form class="pb-[30px] border-[1px] border-[#ccc] rounded-[15px] px-[10px] w-full" action="" style="margin: 120px 0;">
  <table class="w-full">
    <thead>
      <tr class="flex justify-between font-bold ">
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Mã đơn</td>
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Ngày đặt</td>
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Trạng thái</td>
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Hình thức TT
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
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Xem chi tiết
        </td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data as $item) : ?>
      <tr class="flex justify-between font-bold ">
        <td class="p-[10px] w-[10%] text-center"><?=$item['id']?></td>
        <td class="p-[10px] w-[10%] text-center">
          <?= date('d/m/Y', strtotime($item['create_at'])) ?>
        </td>
        <td class="p-[10px] w-[10%] text-center"><?= $statusLabels[$item['bill_status']] ?? 'Unknown' ?></td>
        <td class="p-[10px] w-[10%] text-center"><?= $paymentLabels[$item['payment_type']] ?? 'Unknown' ?></td>
        <td class="p-[10px] w-[10%] text-center"><?=$item['user_name']?></td>
        <td class="p-[10px] w-[10%] text-center"><?=$item['user_address']?></td>
        <td class="p-[10px] w-[10%] text-center"><?=$item['user_phone']?></td>
        <td class="p-[10px] w-[10%] text-center"><?=number_format($item['total'], 0, ',', '.')?>đ</td>
        <td class="p-[10px] w-[10%] text-center">
          <a href="?act=bills-detail&id=<?=$item['id']?>" class="bg-[#e1042b] text-white font-bold py-2 px-4 rounded">
            <i class="fa-solid fa-eye"></i>
            </i>
          </a>
        </td>
      </tr>
      <?php  endforeach; ?>
    </tbody>
  </table>
</form>