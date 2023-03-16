<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-vnpayment" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1></br>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
        </div>
        <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-vnpayment" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-merchant"><?php echo $entry_merchant; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="vnpayment_merchant" value="<?php echo $vnpayment_merchant; ?>" placeholder="<?php echo $vnpayment_merchant; ?>" id="input-merchant" class="form-control" />
                        <?php if ($error_merchant) { ?>
                        <div class="text-danger"><?php echo $error_merchant; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-secretkey"><?php echo $entry_secretkey; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="vnpayment_secretkey" value="<?php echo $vnpayment_secretkey; ?>" placeholder="<?php echo $vnpayment_secretkey; ?>" id="input-secretkey" class="form-control" />
                        <?php if ($error_secretkey) { ?>
                        <div class="text-danger"><?php echo $error_secretkey; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-accesscode"><?php echo $entry_access_code; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="vnpayment_access_code" value="<?php echo $vnpayment_access_code; ?>" placeholder="<?php echo $vnpayment_access_code; ?>" id="input-accesscode" class="form-control" />
                        <?php if ($error_access_code) { ?>
                        <div class="text-danger"><?php echo $error_access_code; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-url"><?php echo $entry_url; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="vnpayment_url" value="<?php echo $vnpayment_url; ?>" placeholder="<?php echo $vnpayment_url; ?>" id="input-url" class="form-control" />
                        <?php if ($error_url) { ?>
                        <div class="text-danger"><?php echo $error_url; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-currency"><?php echo $entry_currency; ?></label>
                    <div class="col-sm-10">
                        <select name="vnpayment_currency" id="input-currency" class="form-control">
                            <option value="VND">VNĐ</option>
                        </select>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-types"><?php echo $entry_types; ?></label>
                    <div class="col-sm-10">
                        <select name="vnpayment_types" id="input-types" class="form-control">
                            <option value="other">Thanh toán trực tuyến</option>
                            <option value="topup">Nạp tiền điện thoại</option>
                            <option value="billpayment">Thanh toán hóa đơn</option>
                            <option value="fashion">Thời trang</option>
                        </select>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
                    <div class="col-sm-10">
                        <select name="vnpayment_order_status_id" id="input-order-status" class="form-control">
                            <?php foreach ($order_statuses as $order_status) { ?>
                            <?php if ($order_status['order_status_id'] == $vnpayment_order_status_id) { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                    <div class="col-sm-10">
                        <select name="vnpayment_status" id="input-status" class="form-control">
                            <?php if ($vnpayment_status) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo $footer; ?> 