
<div class="col-md-12">
    <div class="panel panel-default" style="display:none;">
      
      <div class="panel-body" >
        <?php foreach ($filter_groups as $filter_group) { ?>
        <div class="col-sm-6 col-xs-6 col-md-2 col-sp-6" >
            <a class="list-group-item-title"><?php echo $filter_group['name']; ?></a>
            <div class="list-group-item">
              <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>">
                <?php foreach ($filter_group['filter'] as $filter) { ?>
                <div class="checkbox">
                  <label class="label_filter">
                    <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>" />
                    <?php echo $filter['name']; ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
        </div>
        <?php } ?>
      </div>

      <div class="panel-footer text-right">
        <button type="button" id="button-filter" class="btn btn-primary"><?php echo $button_filter; ?></button>
      </div>

    </div>
    <script type="text/javascript"><!--
    $('#button-filter').on('click', function() {
    	filter = [];
    
    	$('input[name^=\'filter\']:checked').each(function(element) {
    		filter.push(this.value);
    	});
    
    	location = '<?php echo $action; ?>&filter=' + filter.join(',');
    });
    //--></script>
    </div>
