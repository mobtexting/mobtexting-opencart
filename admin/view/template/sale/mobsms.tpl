<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
	<button type="submit" form="form-mobsms" data-toggle="tooltip" title="<?php echo $button_send; ?>" class="btn btn-primary"><?php echo $button_send; ?></button>
	<a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i> <?php echo $button_cancel; ?></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-mobsms" class="form-horizontal">
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#tab-general" id="button-general" data-toggle="tab"><?php echo $tab_mobsms_general; ?></a></li>
	    <li><a href="#tab-report" id="button-report" data-toggle="tab"><?php echo $tab_mobsms_report; ?></a></li>
	  </ul>
	  <div class="tab-content">
	    <div class="tab-pane active" id="tab-general">
	      <div class="form-group">
		<label class="col-sm-2 control-label" for="view-balance"><?php echo $entry_mobsms_balance; ?></label>
		<div class="col-sm-9">
		  <label class="form-control"><?php echo $mobsms_balance; ?></label>
		</div>
	      </div>
	      <div class="form-group">
		<label class="col-sm-2 control-label" for="input-to"><?php echo $entry_to; ?></label>
		<div class="col-sm-9">
		  <select name="to" id="input-to" class="form-control">
		    <?php if ($to == 'customer_all') { ?>
		    <option value="customer_all" selected="selected"><?php echo $text_customer_all; ?></option>
		    <?php } else { ?>
		    <option value="customer_all"><?php echo $text_customer_all; ?></option>
		    <?php } ?>
		    <?php if ($to == 'customer_group') { ?>
		    <option value="customer_group" selected="selected"><?php echo $text_customer_group; ?></option>
		    <?php } else { ?>
		    <option value="customer_group"><?php echo $text_customer_group; ?></option>
		    <?php } ?>
		    <?php if ($to == 'customer') { ?>
		    <option value="customer" selected="selected"><?php echo $text_customer; ?></option>
		    <?php } else { ?>
		    <option value="customer"><?php echo $text_customer; ?></option>
		    <?php } ?>
		  </select>
		</div>
	      </div>
	      <div id="to-customer-group" class="to">
		<div class="form-group">
		  <label class="col-sm-2 control-label" for="input-to-customer-group"><?php echo $entry_customer_group; ?></label>
		  <div class="col-sm-9">
		    <select name="customer_group_id" id="input-to-customer-group" class="form-control">
		      <?php foreach ($customer_groups as $customer_group) { ?>
		      <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
		      <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
		      <?php } else { ?>
		      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
		      <?php } ?>
		      <?php } ?>
		    </select>
		  </div>
		</div>
	      </div>
	      <div id="to-customer" class="to">
		<div class="form-group">
		  <!--<label class="col-sm-2 control-label" for="input-to-customer"><?php echo $entry_customer; ?></label>-->
		  <label class="col-sm-2 control-label" for="input-to-customer"><span data-toggle="tooltip" title="<?php echo $help_customer; ?>"><?php echo $entry_customer; ?></span></label>
		  <div class="col-sm-9">
		    <input type="text" name="customers" value="" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
		    <div id="customer" class="well well-sm" style="height: 150px; overflow: auto;"></div>
		    <!--<input type="text" name="customers" value="" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
		    <div id="customer" class="well well-sm" style="height: 150px; overflow: auto;"></div>-->
		  </div>
		</div>
	      </div>
	      <div class="form-group">
		<label class="col-sm-2 control-label" for="input-type"><?php echo $entry_message_type ?></label>
		<div class="col-sm-9">
		  <select name="mobsms_message_type" id="input-type" class="form-control">
		    <?php if ($mobsms_message_type == 1) { ?>
		    <option value="1" selected="selected">Normal (Eg. English, B. Melayu, etc)</option>
		    <option value="2" >Unicode (Eg. Chinese, Japanese, etc)</option>
		    <?php } else { ?>
		    <option value="1">Normal (Eg. English, B. Melayu, etc)</option>
		    <option value="2" selected="selected">Unicode (Eg. Chinese, Japanese, etc)</option>
		    <?php } ?>
		  </select>
		</div>
	      </div>
	      <div class="form-group required">
		<label class="col-sm-2 control-label" for="input-message"><?php echo $entry_message ?></label>
		<div class="col-sm-9">
		  <textarea id=input-message name="message" class="form-control" rows="10" cols="100" ><?php echo $message ?></textarea>
		</div>
	      </div>
	    </div>
	    <div class="tab-pane" id="tab-report">
	      <div class="well">
		<div class="row">
		  <div class="col-sm-3">
		    <div class="form-group">
		      <label class="control-label" for="input-id"><?php echo $column_id; ?></label>
		      <input type="text" name="filter_id" value="<?php echo $filter_id; ?>" placeholder="<?php echo $column_id; ?>" id="input-filter-id" class="form-control" />
		    </div>
		    <div class="form-group">
		      <label class="control-label" for="input-source"><?php echo $column_source; ?></label>
		      <input type="text" name="filter_source" value="<?php echo $filter_source; ?>" placeholder="<?php echo $column_source; ?>" id="input-filter-source" class="form-control" />
		    </div>
		  </div>
		  <div class="col-sm-3">
		    <div class="form-group">
		      <label class="control-label" for="input-destination"><?php echo $column_destination; ?></label>
		      <input type="text" name="filter_destination" value="<?php echo $filter_destination; ?>" placeholder="<?php echo $column_destination; ?>" id="input-filter-destination" class="form-control" />
		    </div>
		    <div class="form-group">
		      <label class="control-label" for="input-message"><?php echo $column_message; ?></label>
		      <input type="text" name="filter_message" value="<?php echo $filter_message; ?>" placeholder="<?php echo $column_message; ?>" id="input-filter-message" class="form-control" />
		    </div>
		  </div>
		  <div class="col-sm-3">
		    <div class="form-group">
		      <label class="control-label" for="input-message-type"><?php echo $column_message_type; ?></label>
		      <select name="filter_message_type" id="input-message-type" class="form-control">
			<option value="*"></option>
			<?php if ($filter_message_type == "1") { ?>
			<option value="1" selected="selected"><?php echo $text_ascii; ?></option>
			<?php } else { ?>
			<option value="1"><?php echo $text_ascii; ?></option>
			<?php } ?>
			<?php if ($filter_message_type == "2") { ?>
			<option value="2" selected="selected"><?php echo $text_unicode; ?></option>
			<?php } else { ?>
			<option value="2"><?php echo $text_unicode; ?></option>
			<?php } ?>
		      </select>
		    </div>
		    <div class="form-group">
		      <label class="control-label" for="input-status"><?php echo $column_server_status; ?></label>
		      <input type="text" name="filter_server_status" value="<?php echo $filter_server_status; ?>" placeholder="<?php echo $column_server_status; ?>" id="input-filter-status" class="form-control" />
		    </div>
		  </div>
		  <div class="col-sm-3">
		    <div class="form-group">
		      <label class="control-label" for="input-sent-on"><?php echo $column_sent_on; ?></label>
		      <div class="input-group date">
			<input type="text" name="filter_sent_on" value="<?php echo $filter_sent_on; ?>" placeholder="<?php echo $column_sent_on; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
			<span class="input-group-btn">
			<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
			</span></div>
		    </div>
		    <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
		  </div>
		</div>
	      </div>
	      <div class="table-responsive">
		<table class="table table-bordered table-hover">
		  <thead>
		    <tr>
		      <td class="text-left">
			<?php if ($sort == 'mobsms_report_id') { ?>
			<a href="<?php echo $sort_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_id; ?></a>
			<?php } else { ?>
			<a href="<?php echo $sort_id; ?>"><?php echo $column_id; ?></a>
			<?php } ?>
		      </td>
		      <td class="text-left">
			<?php if ($sort == 'mobsms_source') { ?>
			<a href="<?php echo $sort_source; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_source; ?></a>
			<?php } else { ?>
			<a href="<?php echo $sort_source; ?>"><?php echo $column_source; ?></a>
			<?php } ?>
		      </td>
		      <td class="text-left">
			<?php if ($sort == 'mobsms_destination') { ?>
			<a href="<?php echo $sort_destination; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_destination; ?></a>
			<?php } else { ?>
			<a href="<?php echo $sort_destination; ?>"><?php echo $column_destination; ?></a>
			<?php } ?>
		      </td>
		      <td class="text-left">
			<?php if ($sort == 'mobsms_message') { ?>
			<a href="<?php echo $sort_message; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_message; ?></a>
			<?php } else { ?>
			<a href="<?php echo $sort_message; ?>"><?php echo $column_message; ?></a>
			<?php } ?>
		      </td>
		      <td class="text-left">
			<?php if ($sort == 'mobsms_message_type') { ?>
			<a href="<?php echo $sort_message_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_message_type; ?></a>
			<?php } else { ?>
			<a href="<?php echo $sort_message_type; ?>"><?php echo $column_message_type; ?></a>
			<?php } ?>
		      </td>
		      <td class="text-left">
			<?php if ($sort == 'mobsms_server_status') { ?>
			<a href="<?php echo $sort_server_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_server_status; ?></a>
			<?php } else { ?>
			<a href="<?php echo $sort_server_status; ?>"><?php echo $column_server_status; ?></a>
			<?php } ?>
		      </td>
		      <td class="text-left">
			<?php if ($sort == 'mobsms_sent_on') { ?>
			<a href="<?php echo $sort_sent_on; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sent_on; ?></a>
			<?php } else { ?>
			<a href="<?php echo $sort_sent_on; ?>"><?php echo $column_sent_on; ?></a>
			<?php } ?>
		      </td>
		      <td class="right">
			<?php echo $column_action; ?>
		      </td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php if ($mobsms_reports) { ?>
		    <?php foreach ($mobsms_reports as $report) { ?>
		    <tr>
		      <td class="text-left"><?php echo $report['mobsms_report_id']; ?></td>
		      <td class="text-left"><?php echo $report['mobsms_source']; ?></td>
		      <td class="text-left"><?php echo $report['mobsms_destination']; ?></td>
		      <td class="text-left"><?php echo $report['mobsms_message']; ?></td>
		      <td class="text-left"><?php echo $report['mobsms_message_type']; ?></td>
		      <td class="text-left"><?php echo $report['mobsms_server_status']; ?></td>
		      <td class="text-left"><?php echo $report['mobsms_sent_on']; ?></td>
		      <td class="right">&nbsp;</td>
		    </tr>
		    <?php } ?>
		    <?php } else { ?>
		    <tr>
		      <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
		    </tr>
		    <?php } ?>
		  </tbody>
		</table>
	      </div>
	    </div>
	  </div>
	</form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--	
$('textarea[name=\'message\']').keyup(function () {
	
	if($('input[name=\'mobsms_message_type\']:checked').val() == 1) var max = 159;
	else if($('input[name=\'mobsms_message_type\']:checked').val() == 2) var max = 69;
	
	var len = $(this).val().length; //alert(len);
	if (len >= max) {
		$(this).val($(this).val().substr(0, max));
		$('#charNum').text($(this).val().length + ' character(s), you have reached the limit');
	} else {
		//var char = max - len;
		$('#charNum').text(len + ' character(s)');
	}
});

$('input[name=\'mobsms_message_type\']').change(function () {
	
	if($(this).val()==1) var max = 159;
	else if($(this).val()==2) var max = 69;
	
	var len = $('textarea[name=\'message\']').val().length; //alert(len);
	if (len >= max) {
		$('textarea[name=\'message\']').val($('textarea[name=\'message\']').val().substr(0, max));
		$('#charNum').text($('textarea[name=\'message\']').val().length + ' character(s), you have reached the limit');
	} else {
		//var char = max - len;
		$('#charNum').text(len + ' character(s)');
	}
});

$('select[name=\'to\']').bind('change', function() {
	$('#tab-general .to').hide();
	
	$('#tab-general #to-' + this.value.replace('_', '-')).show();
});

$('select[name=\'to\']').trigger('change');
//--></script>
<script type="text/javascript"><!--
//$.widget('custom.catcomplete', $.ui.autocomplete, {
//	_renderMenu: function(ul, items) {
//		var self = this, currentCategory = '';
//		
//		$.each(items, function(index, item) {
//			if (item.category != currentCategory) {
//				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
//				
//				currentCategory = item.category;
//			}
//			
//			self._renderItem(ul, item);
//		});
//	}
//});

//$('input[name=\'customers\']').catcomplete({
//	delay: 500,
//	source: function(request, response) {
//		$.ajax({
//			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
//			dataType: 'json',
//			success: function(json) {	
//				response($.map(json, function(item) {
//					return {
//						category: item.customer_group,
//						label: item.name,
//						value: item.customer_id
//					}
//				}));
//			}
//		});
//		
//	}, 
//	select: function(event, ui) {
//		$('#customer' + ui.item.value).remove();
//		
//		$('#customer').append('<div id="customer' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="customer[]" value="' + ui.item.value + '" /></div>');
//
//		$('#customer div:odd').attr('class', 'odd');
//		$('#customer div:even').attr('class', 'even');
//				
//		return false;
//	},
//	focus: function(event, ui) {
//      	return false;
//   	}
//});
$('input[name=\'customers\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'customers\']').val('');
		
		$('#customer' + item['value']).remove();
		
		$('#customer').append('<div id="customer' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="customer[]" value="' + item['value'] + '" /></div>');	
	}	
});

$('#customer').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

//$('#customer div img').live('click', function() {
//	$(this).parent().remove();
//	
//	$('#customer div:odd').attr('class', 'odd');
//	$('#customer div:even').attr('class', 'even');	
//});
//--></script>
<script type="text/javascript"><!--
//$('#tabs a').tabs();
$('#<?php echo $filter_tab; ?>').trigger('click');
//--></script> 
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {  
  url = 'index.php?route=sale/mobsms&token=<?php echo $token; ?>';
	
	var filter_id = $('input[name=\'filter_id\']').val();
	
	if (filter_id) {
		url += '&filter_id=' + encodeURIComponent(filter_id);
	}
	
	var filter_source = $('input[name=\'filter_source\']').val();
	
	if (filter_source) {
		url += '&filter_source=' + encodeURIComponent(filter_source);
	}
	
	var filter_destination = $('input[name=\'filter_destination\']').val();
	
	if (filter_destination) {
		url += '&filter_destination=' + encodeURIComponent(filter_destination);
	}
	
	var filter_message = $('input[name=\'filter_message\']').val();
	
	if (filter_message) {
		url += '&filter_message=' + encodeURIComponent(filter_message);
	}
	
	var filter_message_type = $('select[name=\'filter_message_type\']').val();
	
	if (filter_message_type != '*') {
		//url += '&filter_message_type=' + encodeURIComponent(1);
		url += '&filter_message_type=' + encodeURIComponent(filter_message_type);
	}	
	
	var filter_server_status = $('input[name=\'filter_server_status\']').val();
	
	if (filter_server_status) {
		url += '&filter_server_status=' + encodeURIComponent(filter_server_status);
	}
		
	var filter_sent_on = $('input[name=\'filter_sent_on\']').val();
	
	if (filter_sent_on) {
		url += '&filter_sent_on=' + encodeURIComponent(filter_sent_on);
	}
	
	url += '&filter_tab=' + encodeURIComponent("button-report");
	
	location = url;
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<?php echo $footer; ?>