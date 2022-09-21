var getParams = {};

createTableHeadings();
onSearchOrderId();

function onDelete(oid){}

function onUpdate(oid, oldQuant) {
  $(`#${oid} .btn.btn-danger`).on("click", function () {

    let editedVals = {};

    editedVals.orderid = oid;

    editedVals.customername = $(`#${oid} .customername`).text();
    editedVals.phone = $(`#${oid} .phone`).text();
    
    editedVals.address = $(`#${oid} .address`).text();
    editedVals.quantity = $(`#${oid} .quantity`).text();
    
    editedVals.note = $(`#${oid} .position`).text();
    editedVals.amount = $(`#${oid} .amount`).text();

    const pric = parseInt(editedVals.amount) / oldQuant;
    editedVals.amount = (pric * parseInt(editedVals.quantity)).toString();

    $.ajax({
      type: "PATCH",
      url: `http://localhost:80/controller/OrdersController.php}`,
      success: function (res) {
      
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseJSON);
      },
    });
  });
}

function appendOrders(orderArr) {
  let orderN = orderArr.length;
  let orderTempl = "";

  let i = 0;
  while (i < orderN) {
    orderTempl += `
            <tr class="table-info" id="${orderArr[i].orderid}">
                <td class = "customername" contenteditable="true">${orderArr[i].customername}</td>
                <td class = "phone" contenteditable="true">${orderArr[i].phone}</td>
                <td class = "address" contenteditable="true">${orderArr[i].address}</td>
                <td class = "createdtime" contenteditable="false">${orderArr[i].createdtime}</td>
                <td class = "status" contenteditable="false">${orderArr[i].status}</td>
                <td class = "quantity" contenteditable="true">${orderArr[i].quantity}</td>
                <td class = "amount" contenteditable="false">${orderArr[i].amount}</td>
                <td class = "note" contenteditable="true">${orderArr[i].note}</td>
                <td>
                  <button type="button" class="btn btn-danger" >Hủy</button>
                </td>
                <td>
                  <button type="button" class="btn btn-success">Cập nhật</button>
                </td>
            </tr>
            <script>
              onDelete(${orderArr[i].orderid}, ${orderArr[i].quantity});
              onUpdate(${orderArr[i].orderid});
            </script>
        `;
    i++;
  }
  $("#table-lines").html(orderTempl);
}

function getPlayers(getParams) {
  let baseUrl = "http://localhost:80/controller/OrdersController.php";

  $.ajax({
    type: "GET",
    url: baseUrl + `?registerCode=${getParams.search}`,
  }).done(function (result) {
    appendOrders(result.data);
  });
}

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

function onSearchOrderId() {
  //Khi search
  let formIdSelector = "#register-code-search-form";
  $(formIdSelector).on("click", "button", function (e) {
    //Tạm dừng event
    e.preventDefault();
    let inputSelector = `${formIdSelector} input`;

    let inputVal = $(inputSelector).val();
    if (!RegExp("^[0-9]*$").test(inputVal)) {
      displayAlert("Mã không hợp lệ", "Lỗi nhập", true);
      return;
    }
    

    getParams.search = inputVal;
    //Giữ nguyên giá trị tại form
    $(inputSelector).val(inputVal);
    getPlayers(getParams);
  });
}

function createTableHeadings() {
  //Danh sách tên cột
  let colHeadings = ["Tên khách hàng", "Số điện thoại", "Địa chỉ", "Ngày đặt", "Trạng thái", "Số lượng", "Tổng tiền", "Ghi chú", "Hủy", "Cập nhật"];
  let headingNum = colHeadings.length;
  let headingsTemplate = "";

  let i = 0;
  while (i < headingNum) {
    headingsTemplate += `<th scope="col">${colHeadings[i]}</th>`;
    i++;
  }

  $("#table-headings").append(headingsTemplate);
}
