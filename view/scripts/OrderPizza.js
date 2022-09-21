createTableHeadings();
getPizzaCombo();

function showOrderDetails(orderDe) {
  let temp = `
    <div class="alert alert-success" role="alert">
      Tên khách hàng: ${orderDe.customername}
    </div>

    <div class="alert alert-success" role="alert">
      Số điện thoại: ${orderDe.phone}
    </div>

    <div class="alert alert-success" role="alert">
      Địa chỉ: ${orderDe.address}
    </div>

    <div class="alert alert-success" role="alert">
      Ngày đặt: ${orderDe.createdtime}
    </div>

    <div class="alert alert-success" role="alert">
      Tổng tiền: ${orderDe.amount}
    </div>

    <div class="alert alert-success" role="alert">
      Ghi chú: ${orderDe.note}
    </div>

    <div class="alert alert-success" role="alert">
      Mã đặt hàng: ${orderDe.registercode}
    </div>
  `;
  $("#order-detail-content").html(temp);
  $("#order-details").modal('show');
}

function checkUserInput(userInput, checkPattern, alertMessg, selector) {
  let alertSelector = `${selector} + .alert-danger`;

  if (!RegExp(checkPattern).test(userInput)) {
    if ($(alertSelector).length === 0) {
      $(selector).after(
        `<div class="alert alert-danger" role="alert">
          ${alertMessg}
        </div>`
      );
    }
    return false;
  }

  $(alertSelector).remove();
  return true;
}

function registerOrder(orderInfo) {
  $(`#register-form-modal`).modal("show");

  $("#register-form").submit(function (e) {
    e.preventDefault();

    let alertMs = ["Tên chỉ toàn chữ, không kí tự đặc biệt", "Số điện thoại chỉ toàn số viết liền, độ dài là 10"];
    let regs = ["^[a-zA-Z\\s]*$", "^[0-9]{10}$"];

    let selector = {};

    selector.cusname = "#customername";
    selector.cusphone = "#phone";
    selector.cusadd = "#address";

    orderInfo.customername = $(selector.cusname).val();
    orderInfo.phone = $(selector.cusphone).val();
    orderInfo.address = $(selector.cusadd).val();

    //Test
    console.log(orderInfo);

    ck1 = checkUserInput(orderInfo.customername, regs[0], alertMs[0], selector.cusname);
    ck2 = checkUserInput(orderInfo.phone, regs[1], alertMs[1], selector.cusphone);

    if (ck1 && ck2) {
      $.ajax({
        type: "POST",
        url: "http://localhost:80/controller/OrdersController.php",

        data: JSON.stringify(orderInfo),
        dataType: "JSON",

        beforeSend: function (xhr) {
          xhr.setRequestHeader("Content-Type", "application/json");
        },

        success: function (res) {
          $(`#register-form-modal`).modal("hide");
          
          showOrderDetails(res.data);
        },

        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseJSON);
        },
      });
    }
  });
}

//Kiểm tra kí tự nhập
function checkUpdateInput(checkPattern, inputText) {
  if (inputText.length === 0 || !RegExp(checkPattern).test(inputText)) {
    return false;
  }
  return true;
}

//Thông báo lỗi
function displayAlert(alertMessg, alertName, failed) {
  let alertModalSelector = "#notification";
  let errorSelector = `${alertModalSelector} .alert-danger`;

  $(".modal-title").html(alertName);

  if (failed === true) {
    $(errorSelector).text(alertMessg);
  } else {
    $(errorSelector).remove();
    $(`${alertModalSelector} .alert-success`).text(alertMessg);
  }

  $(alertModalSelector).modal("show");
}

//Nút chọn combo
function onSelect(comboid) {
  $(`#${comboid} .btn.btn-success`).on("click", function () {
    //Kiểm tra chọn trùng
    let selectedId = localStorage.getItem("comboid");

    if (selectedId !== null) {
      let alertMess = "Chỉ được chọn một combo";
      displayAlert(alertMess, "Thông báo", true);

      localStorage.setItem("comboid", comboid);
      return;
    }

    //Số lượng
    quant = $(`#${comboid} .quantity`).text();
    if (!checkUpdateInput("^[1-9][0-9]?$|^100$", quant)) {
      let alertMess = "Số lượng combo phải từ 1 đến 100";
      displayAlert(alertMess, "Lỗi nhập", true);

      return;
    }

    price = parseInt($(`#${comboid} .price`).text());
    var newOrder = {};

    newOrder.status = "DAKHOITAO";
    newOrder.productid = comboid.toString();
    newOrder.quantity = $(`#${comboid} .quantity`).text();
    newOrder.amount = (parseInt(quant) * price).toString();
    newOrder.note = $(`#${comboid} .note`).text();

    //Tạo order mới
    registerOrder(newOrder);
  });
}

//Thêm nội dung combo vào giao diện
function appendCombos(comboArr) {
  let comboNum = comboArr.length;
  let comboTemplate = "";

  let i = 0;
  while (i < comboNum) {
    comboTemplate += `
        <tr class="table-info" id="${comboArr[i].productid}">
            <td class = "comboname" contenteditable="false">${comboArr[i].comboname}</td>
            <td class = "price" contenteditable="false">${comboArr[i].price}</td>
            <td class = "quantity" contenteditable="true">0</td>
            <td class = "note" contenteditable="true">Ghi chú ở dây</td>
            <td>
                <button type="button" class="btn btn-success">Chọn</button>
            </td>
        </tr>
        <script>
              onSelect(${comboArr[i].productid});
        </script>
        `;
    i++;
  }
  $("#table-lines").html(comboTemplate);
}
//Lấy pizza combo lên
function getPizzaCombo() {
  let baseUrl = "http://localhost:80/controller/PizzasController.php";
  $.ajax({
    type: "GET",
    url: baseUrl,
  }).done(function (result) {
    appendCombos(result.data.combos);
  });
}
//Tạo tiêu đề bảng
function createTableHeadings() {
  //Danh sách tên cột
  let colHeadings = ["Combo", "Đơn giá", "Số lượng", "Ghi chú", "Chọn"];
  let headingNum = colHeadings.length;
  let headingsTemplate = "";

  let i = 0;
  while (i < headingNum) {
    headingsTemplate += `<th scope="col">${colHeadings[i]}</th>`;
    i++;
  }

  $("#table-headings").append(headingsTemplate);
}
