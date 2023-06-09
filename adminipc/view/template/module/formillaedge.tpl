<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-formillaedge" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-formillaedge" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" data-trigger="click" data-html="true" title="<?php echo htmlspecialchars($help_code); ?>"><?php echo $entry_plugin_id; ?></span></label>
            <div class="col-sm-10">
             <input type="text" maxlength="36" size="36" name="formillaedge_plugin_id" id="input-code" class="form-control" value="<?php echo $formillaedge_plugin_id; ?>">
              <?php if ($error_code) { ?>
              <div class="text-danger"><?php echo $error_code; ?></div>
              <?php } ?>
			  <br> Enter the Plugin ID you receive upon <a href="https://www.formilla.com/sign-up?u=oc&source=1" target="_blank">signing up</a> for a Formilla Edge account. &nbsp; Set status to Enabled and click Save. </br> <br />
            </div>
          </div>	
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="formillaedge_status" id="input-status" class="form-control">
                <?php if ($formillaedge_status) { ?>
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
</div>
<?php echo $footer; ?>