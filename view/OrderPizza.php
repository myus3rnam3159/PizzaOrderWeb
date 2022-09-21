<?php require('./shared/Head.php') ?>
<?php require('./shared/NavBar.php') ?>
<?php require('./shared/BreadCrumb.php') ?>

<table class="table table-hover">
    <thead>
        <tr id="table-headings">
        </tr>
    </thead>

    <tbody id="table-lines">

    </tbody>
</table>

<!--Order detail modal-->
<div class="modal fade" id="order-details" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Đặt hàng thành công</h4>
                <h5 class="modal-title">Chi tiết đơn hàng</h5>
            </div>
            <div class="modal-body" id="order-detail-content">
                <div class="alert alert-success" role="alert">
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!--Select combo modal-->
<div class="modal fade" id="notification" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                </div>
                <div class="alert alert-success" role="alert">
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!--Modal đăng kí thông tin khác hàng-->
<div class="modal fade" id="register-form-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form id="register-form">
          <div class="form-group">
            <label for="customername">Tên khách hàng</label>
            <input type="text" class="form-control" id="customername">
          </div>
          <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" class="form-control" id="phone">
          </div>
          <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address">
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Đặt hàng</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require('./shared/CdnScript.php') ?>
<script src="./scripts/NavBar.js"></script>
<script src="./scripts/BreadCrumb.js"></script>
<script src="./scripts/OrderPizza.js"></script>


<?php require('./shared/End.php') ?>