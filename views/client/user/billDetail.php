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
             <form class="mt-8" method="POST" action="<?= BASE_URL ?>?act=startPay">
                 <div>
                     <h3 class="text-base text-gray-800 mb-4">Thông tin người mua hàng</h3>
                     <div class="grid md:grid-cols-2 gap-4">
                         <div>
                             <input type="text" value="" placeholder="Tên người nhận"
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
                     <button type="submit"
                         class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-transparent hover:bg-gray-100 border border-gray-300 text-gray-800 max-md:order-1">Huỷ
                         thanh toán</button>
                     <button type="submit" name="redirect"
                         class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-transparent hover:bg-gray-100 border border-gray-300 text-gray-800 max-md:order-1">
                         Thanh toán vnPay</button>
                     <button type="submit"
                         class="rounded-md px-6 py-3 w-full text-sm tracking-wide bg-blue-600 hover:bg-blue-700 text-white">Hoàn
                         tất thanh toán
                     </button>
                 </div>

             </form>
         </div>
     </div>
 </div>

 <?php if (isset($_SESSION['msg'])): ?>
     <div class="alert <?= $_SESSION['success'] ? 'alert-success' : 'alert-danger'; ?>">
         <?= $_SESSION['msg']; ?>
     </div>
     <?php unset($_SESSION['msg'], $_SESSION['success']); ?>
 <?php endif; ?>
 <div class="container-fluid px-4">
     <!-- <h1 class="mt-4"></h1> -->
     <ol class="breadcrumb mb-4">
         <!-- <li class="breadcrumb-item active"></li> -->
     </ol>
     <?php
        if (isset($_SESSION['success'])) {
            $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

            echo "<div class='alert $class'>{$_SESSION['msg']}</div>";

            unset($_SESSION['success']);
            unset($_SESSION['msg']);
        }
        ?>
     <div class="card mb-4" style="margin-top: 100px;">
         <div class="card-header">
             <i class="fas fa-table me-1"></i>
             <?php echo "Thông tin hóa đơn"  ?>
         </div>
         <div class="card-body">
             <table id="datatablesSimple">
                 <thead>
                     <tr>
                         <th>Dữ Liệu</th>
                         <th>Giá trị</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                         <th>id</th>
                         <th>name</th>
                     </tr>
                 </tfoot>
                 <tbody>
                     <?php foreach ($billData as $key => $value): ?>
                         <tr>
                             <td class="border">
                                 <?php switch ($key) {
                                        case 'id':
                                            echo "ID hóa đơn";
                                            break;
                                        case 'total':
                                            echo "Tổng tiền";
                                            break;
                                        default:
                                            echo $key;
                                            break;
                                    } ?>
                             </td>
                             <td class="border">
                                 <?php
                                    switch ($value) {
                                        case 'total':
                                            echo number_format($value, 0, ',', '.') . "đ";
                                            break;
                                        case 'bill_status':
                                            echo $statusLabels[$value];
                                            break;
                                        case 'payment_type':
                                            echo $paymentLabels[$value];
                                            break;
                                        default:
                                            echo $value;
                                            break;
                                    }
                                    ?>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
             <?php var_dump($billData); ?>
         </div>
     </div>
 </div>

 <!-- Danh sách hóa đơn -->
 <!-- <table class="w-full">
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
                        <td class="p-[10px] w-[10%] text-center"><?= $item['product_name'] ?></td>
                        <td class="p-[10px] w-[10%]">
                            <img class="w-[140px] object-cover" src="<?= BASE_ASSETS_UPLOADS . $item['product_img'] ?>" alt="">
                        </td>
                        <td>Màu</td>
                        <td class="p-[10px] w-[10%] text-center"><?= number_format($item['product_price'], 0, ',', '.') ?>đ</td>
                        <td>Dung lượng</td>
                        <td class="p-[10px] w-[10%] text-center"><?= $item['quantity'] ?></td>
                        <td class="p-[10px] w-[10%] text-center">
                            <?= number_format($item['product_price'] * $item['quantity']) ?>đ
                        </td>
                        <td class="p-[10px] w-[5%] text-nowrap">
                            <a href="#"><i class="fa-solid fa-trash text-[35px] text-[#e1042b]"></i></a>
                        </td>
                    </tr>
                    <tr class="w-full border-b-[3px] border-solid border-[#222]"></tr>
            <?php
                $count = $item['product_price'] * $item['quantity'];
                $total += $count;
            endforeach;
            // var_dump($cartItems);
            ?>
        </tbody>
        <div>
            <br>
            <h1>Tổng tiền : <?= $total ?> </h1>
        </div>    
    </table> -->
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
        <a href="?act=bills-delete&id=<?= $billData['id'] ?>"
        class="px-[20px] py-[10px] border-[1px] rounded-[10px] bg-[#e1042b] text-center text-[#fff] font-bold">Hủy đơn hàng</a>
    </div> -->