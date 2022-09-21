<?php require('./shared/Head.php') ?>
<?php require('./shared/NavBar.php') ?>
<?php require('./shared/BreadCrumb.php') ?>

<!--Tra cứ mã đặt hàng-->
<form class="d-flex m-lg-1" id="register-code-search-form">
    <input class="form-control" type="text" placeholder="Tra cứu đơn hàng ở đây">
    <button class="btn btn-secondary " type="submit">Tìm</button>
</form>

<table class="table table-hover">
    <thead>
        <tr id="table-headings">
        </tr>
    </thead>

    <tbody id="table-lines">

    </tbody>
</table>

<!--Edit Order Modal-->
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

<?php require('./shared/CdnScript.php') ?>
<script src="./scripts/NavBar.js"></script>
<script src="./scripts/BreadCrumb.js"></script>
<script src="./scripts/EditPizzaOrder.js"></script>
<?php require('./shared/End.php') ?>