<?php echo $header; ?><?php echo $column_left; ?>
<style>
    .custom-form input, textarea, select {
        width: 20%;
        border: 1px solid grey;
        padding: 5px;
        color: black;
        font-weight: normal;
    }

    .custom-form textarea {
        height: 100px;
        color: black;
        font-weight: normal;
    }

    .custom-button {
        border-radius: 0px !important;
        background: darkolivegreen !important;
        border: 1px solid #696969 !important;
    }

    .custom-button:hover {
        background: graytext !important;
    }
</style>

<div id="content">
  <div class="page-header">
    <div class="container">     
      <h1><?php echo $heading_title; ?></h1>
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
</div>
<div class="box">
 <div class="heading">
    <div class="buttons pull-right">
         <button type="submit" form="form-mobsmssms" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
    </div>
<div class="content" style="background: #EAF0EE;">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-mobsmssms" class="form-horizontal">

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-order-id"><h4><?php echo $entry_mobsms_balance; ?></h4></label>
                    <div class="col-sm-8">
                        <label class="control-label col-sm-4" for="input-order-id"><h4><?php echo $mobsms_balance; ?></h4></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-order-id"><span class="required">*</span><?php echo $entry_mobsms_username; ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="mobsms_username" value="<?php echo $mobsms_username; ?>" placeholder="Sender Id" id="input-order-id" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-reference"><span class="required">*</span><?php echo $entry_mobsms_password; ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="mobsms_password" value="<?php echo $mobsms_password; ?>" placeholder="API Key" id="input-reference" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-reference"><?php echo $order_enabled; ?></label>
                    <div class="col-sm-8">
                        <select name="mobsms_order_enabled_value" id="input-filter-status" class="form-control">
                            <option value="1"
                            <?php if($mobsms_order_enabled_value==1):?> selected="selected" <?php endif; ?>>Yes</option>
                            <option value="2"
                            <?php if($mobsms_order_enabled_value!=1):?> selected="selected" <?php endif; ?>>No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                            <b>{{order_id}}, {{firstname}}, {{lastname}} , {{email}}, {{total}}, {{currency_code}}, {{invoice_no}}, {{shipping_company}}, {{shipping_address_1}}, {{shipping_address_2}}, {{shipping_city}}, {{shipping_postcode}}, {{shipping_zone}}, {{shipping_country}}, {{payment_method}}
                        </b>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-reference"><span class="required">*</span> <?php echo $order_message; ?></label>
                    <div class="col-sm-8">
                        <textarea class="required form-control" cols="30" style="width:500px;height:100px;" name="mobsms_order_message_value" placeholder="Thank you for placing your order with www.yourdomain.com. Your order ID is {{order_id}} and is currently being processed. Your Store."><?php echo $mobsms_order_message_value; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">On Order Status Changed</label>
                    <div class="col-sm-8">
                        <select name="mobsms_order_status_enabled" class="form-control">
                            <option value="1"
                            <?php if($mobsms_order_status_enabled==1):?> selected="selected" <?php endif; ?>>Yes</option>
                            <option value="2"
                            <?php if($mobsms_order_status_enabled!=1):?> selected="selected" <?php endif; ?>>No</option>
                        </select>
                    </div>
                </div>
                <?php foreach($status_list as $key => $value): ?>
                <div class="form-group">
                    <label class="control-label col-sm-4"><span class="required"></span>
                     <?php 
                      $len = strlen('_message_of_order_status');
                      echo substr($key, 0,-$len) . ' Message';
                      ?>
                    </label>
                    <div class="col-sm-8">
                    <textarea style="width:500px;height:100px;" class="form-control" name="<?php echo $key; ?>" placeholder="Your order ID {{order_id}} has been marked as {{order_status}}. Thanks for shopping at www.yourdomain.com"><?php echo $value;?></textarea>
                    </div>
                </div>
                <?php endforeach; ?>
                 <div class="form-group">
                    <label class="control-label col-sm-4" for="input-reference">Include Ordered Item</label>
                    <div class="col-sm-8"> 
                        <input type="checkbox" name="mobsms_admin_alert_include_items"  value="1" <?php echo ($mobsms_admin_alert_include_items==1?'checked':''); ?> >  <?php echo $text_admin_alert_include_items; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-reference"><span class="required">*</span><?php echo $notify_admin; ?></label>
                    <div class="col-sm-8">
                        <select id="mobsms_notify_admin" name="mobsms_notify_admin" class="form-control">
                            <option value="1"
                            <?php if($mobsms_notify_admin==1):?> selected="selected" <?php endif; ?>>Yes</option>
                            <option value="2"
                            <?php if($mobsms_notify_admin!=1):?> selected="selected" <?php endif; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-reference"><span class="required">*</span><?php echo $admin_telephone; ?></label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="mobsms_admin_telephone_value" value="<?php echo $mobsms_admin_telephone_value; ?>"
                               placeholder="ex: 447767123123"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="input-reference"><span class="required">*</span><?php echo $entry_mobsms_admin_alert; ?></label>
                    <div class="col-sm-8">
                        <input type="checkbox" name="mobsms_admin_alert_customer_register"
                               value="1" <?php echo ($mobsms_admin_alert_customer_register==1?'checked':''); ?>
                        > <?php echo $text_admin_alert_customer_register; ?> <br>
                        <input type="checkbox" name="mobsms_admin_alert_customer_checkout"
                               value="1" <?php echo ($mobsms_admin_alert_customer_checkout==1?'checked':''); ?>
                        > <?php echo $text_admin_alert_customer_checkout; ?> <br>
                        <input type="checkbox" name="mobsms_admin_alert_order_status"
                               value="1" <?php echo ($mobsms_admin_alert_order_status==1?'checked':''); ?>
                        > <?php echo $text_customer_alert_order_status; ?> <br>
                    </div>
                </div>
                
            </div>
            </div>
        </div>           
        </div>
    </form>
</div>
  </div>
</div>
<?php echo $footer; ?>