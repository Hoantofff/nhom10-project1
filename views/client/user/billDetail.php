<?php if (isset($_SESSION['msg'])): ?>
<div class="alert <?= $_SESSION['success'] ? 'alert-success' : 'alert-danger'; ?>">
  <?= $_SESSION['msg']; ?>
</div>
<?php unset($_SESSION['msg'], $_SESSION['success']); ?>
<?php endif; ?>
<div class="container-fluid px-4">
  <?php
    if (isset($_SESSION['success'])) {
        $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

        echo "<div class='alert $class'>{$_SESSION['msg']}</div>";

        unset($_SESSION['success']);
        unset($_SESSION['msg']);
    }
    ?>
</div>



<!-- Danh sách hóa đơn -->
<div style="margin: 120px 0;">
  <h1 style="font-size: 26px; font-weight: 600; margin-bottom: 20px;">Thông tin người nhận</h1>
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
      </tr>
    </thead>
    <tbody>
      <tr class="flex justify-between font-bold ">
        <td class="p-[10px] w-[10%] text-center"><?=$billData['id']?></td>
        <td class="p-[10px] w-[10%] text-center">
          <?= date('d/m/Y', strtotime($billData['create_at'])) ?>
        </td>
        <td class="p-[10px] w-[10%] text-center"><?= $statusLabels[$billData['bill_status']] ?? 'Unknown' ?></td>
        <td class="p-[10px] w-[10%] text-center"><?= $paymentLabels[$billData['payment_type']] ?? 'Unknown' ?></td>
        <td class="p-[10px] w-[10%] text-center"><?=$billData['user_name']?></td>
        <td class="p-[10px] w-[10%] text-center"><?=$billData['user_address']?></td>
        <td class="p-[10px] w-[10%] text-center"><?=$billData['user_phone']?></td>
      </tr>
    </tbody>
  </table>

  <?php if(!empty($cartItems)): ?>
  <h1 style="font-size: 26px; font-weight: 600; margin-bottom: 20px;">Chi tiết đơn hàng</h1>
  <table class="w-full">
    <thead>
      <tr class="flex justify-between font-bold ">
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Sản phẩm
        </td>
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Ảnh</td>
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Màu
          sắc
        </td>
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Giá</td>
        <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
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
        <!-- <td class="border-b-[3px] border-solid border-[#e1042b] p-[10px] w-[10%] text-center  text-nowrap">
          Xóa sản phẩm
        </td> -->
      </tr>
    </thead>
    <tbody>
      <?php
      $total=0;
      $count=0;
      foreach ($cartItems as $item): ?>
      <tr class="flex justify-between font-bold">
        <td class="p-[10px] w-[10%] text-center"><?=$item['product_name']?></td>
        <td class="p-[10px] w-[10%]">
          <img class="w-full object-cover" src="<?= BASE_ASSETS_UPLOADS . $item['product_img'] ?>" alt="">
        </td>
        <td class="p-[10px] w-[10%] text-center">Màu</td>
        <td class="p-[10px] w-[10%] text-center"><?= number_format($item['product_price'], 0, ',', '.') ?>đ</td>
        <td class="p-[10px] w-[10%] text-center">Dung lượng</td>
        <td class="p-[10px] w-[10%] text-center"><?= $item['quantity']?></td>
        <td class="p-[10px] w-[10%] text-center">
          <?= number_format($item['product_price'] * $item['quantity']) ?>đ
        </td>
        <!-- <td class="p-[10px] w-[10%] text-center">
          <a href="?act=bill-item-delete&id=<?=$item['id']?>"
            class="bg-[#e1042b] text-white font-bold py-2 px-4 rounded">
            <i class="fa-solid fa-trash"></i>
            </i>
          </a>
        </td> -->
      </tr>
      <?php 
      $count=$item['product_price'] * $item['quantity'];
      $total+=$count;
      endforeach;
    ?>
    </tbody>
  </table>
  <h1 style="font-size: 26px; margin-bottom: 30px;">
    Tổng tiền:
    <span class="text-[#e1042b]" style="font-weight: 700;"><?= number_format($total, 0, ',', '.') ?>đ</span>
  </h1>
  <?php endif; ?>
  <a href="?act=goToBill"
    class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">Quay lại</a>
  <!-- <a href="?act=bills-delete&id=<?=$billData['id']?>"
    class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">Hủy đơn
    hàng</a> -->
</div>
<!-- </table> -->

<!-- <div class="mt-[20px]">
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
    </div> -->

<!-- <div class="w-full flex flex-row-reverse mt-[20px]">
        <button type="submit" class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">
            Cập nhật giỏ hàng
        </button> -->
<!-- <a href="?act=goToBill"
  class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">Quay lại</a>
<a href="?act=bills-delete&id=<?=$billData['id']?>"
  class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">Hủy đơn
  hàng</a> -->
</div>