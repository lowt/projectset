<script type="text/javascript">
(function($) {
	$.fn.clearJShoppingUltraForm = function() {
		return this.each(function() {
			$('input,select,textarea', this).clearJShoppingUltraFields();
		});
	};

	$.fn.clearJShoppingUltraFields = function() {
		return this.each(function() {
			var t = this.type, tag = this.tagName.toLowerCase();
			if (t == 'text' || t == 'password' || tag == 'textarea')
				this.value = '';
			else if (t == 'checkbox')
				this.checked = false;
			else if (t == 'radio')
				if (this.value == 0) {
					this.checked= true;
				}
			else if (tag == 'select')
				this.selectedIndex = -1;
		});
	};
})(jQuery);
</script>
<div class="jshop_ultra_filters">
<form action="<?php print $_SERVER['REQUEST_URI'];?>" method="post" id="jshop_ultra_filters" name="jshop_ultra_filters">

    <?php if (is_array($filter_categorys) && count($filter_categorys)) {?>
	<div class="uf_label"><?php print JText::_('UF_CATEGORY').":"?></div>
    <div>    
		<input type="hidden" name="categorys[]" value="0" />
		<?php foreach($filter_categorys as $v){ ?>
        <input type="checkbox" name="categorys[]" value="<?php print $v->id;?>" <?php if (in_array($v->id, $categorys)) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <a href="<?php print SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id=' . $v->id);?>" title="<?php print $v->name;?>"><?php print $v->name;?></a><br />
        <?php }?>
    </div>
    <?php }?>

    <?php if (is_array($filter_manufactures) && count($filter_manufactures)) {?>
    <div class="uf_label"><?php print JText::_('UF_MANUFACTURER').":"?></div>
	<div>
		<input type="hidden" name="manufacturers[]" value="0" />
		<?php foreach($filter_manufactures as $v){ ?>
        <input type="checkbox" name="manufacturers[]" value="<?php print $v->id;?>" <?php if (in_array($v->id, $manufacturers)) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <a href="<?php print SEFLink('index.php?option=com_jshopping&controller=manufacturer&task=view&manufacturer_id=' . $v->id);?>" title="<?php print $v->name;?>"><?php print $v->name;?></a><br />
        <?php }?>
	</div>
    <?php }?>
    
    <?php if (is_array($filter_labels) && count($filter_labels)) {?>
    <div class="uf_label"><?php print JText::_('UF_LABELS').":"?></div>
    <div>
		<input type="hidden" name="labels[]" value="0" />
		<?php foreach($filter_labels as $v){ ?>
        <input type="checkbox" name="labels[]" value="<?php print $v->id;?>" <?php if (in_array($v->id, $labels)) print "checked";?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print $v->name;?><br />
        <?php }?>
    </div>
    <?php }?>
	
    <?php if (is_array($filter_vendors) && count($filter_vendors)) {?>
    <div class="uf_label"><?php print JText::_('UF_VENDOR').":"?></div>
    <div>
		<input type="hidden" name="vendors[]" value="0" />
		<?php foreach($filter_vendors as $v){ ?>
        <input type="checkbox" name="vendors[]" value="<?php print $v->id;?>" <?php if (in_array($v->id, $vendors)) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print $v->shop_name;?><br />
        <?php }?>
    </div>
	<?php }?>
	
    
	<?php if (is_array($filter_delivery_time) && count($filter_delivery_time)) {?>
    <div class="uf_label"><?php print JText::_('UF_DELIVERY_TIME').":"?></div>
    <div>
		<input type="hidden" name="delivery_times[]" value="0" />
		<?php foreach($filter_delivery_time as $k=>$v){ ?>
        <input type="checkbox" name="delivery_times[]" value="<?php print $k;?>" <?php if (in_array($k, $delivery_times)) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print $v;?><br />
        <?php }?>
    </div>
	<?php }?>
	
	
    <?php if ($show_photos) {?>
    <div class="uf_label"><?php print JText::_('UF_FILTER_PHOTO').":"?></div>
	<div>
		<input type="radio" name="photo" value="0" <?php if (!$photo) echo 'checked="checked"'?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_ALL') ?><br />
		<input type="radio" name="photo" value="1" <?php if ($photo==1) echo 'checked="checked"'?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_WITHPHOTO') ?><br />
		<input type="radio" name="photo" value="2" <?php if ($photo==2) echo 'checked="checked"'?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_WITHOUTPHOTO') ?><br />
    </div>
	<?php }?>
	
    <?php if ($show_availabilitys) {?>
	<div class="uf_label"><?php print JText::_('UF_FILTER_AVAILABILITY').":"?></div>
	<div>
		<input type="radio" name="availability" value="0" <?php if (!$availability) echo 'checked="checked"'?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_ALL') ?><br />
		<input type="radio" name="availability" value="1" <?php if ($availability==1) echo 'checked="checked"'?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_INSTOCK') ?><br />
		<input type="radio" name="availability" value="2" <?php if ($availability==2) echo 'checked="checked"'?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_UNAVAILABLE') ?><br />
    </div>
    <?php }?>
	
    <?php if ($show_sales) {?>
	<div class="uf_label">    
		<input type="hidden" name="sales[]" value="0" />
		<input type="checkbox" name="sales[]" value="1" <?php if ($sales) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_SALES_ONLY') ?><br />
    </div>
    <?php }?>

	<?php if ($show_additional_price) {?>
	<div class="uf_label">    
		<input type="hidden" name="additional_price[]" value="0" />
		<input type="checkbox" name="additional_price[]" value="1" <?php if ($additional_price) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_ADDITIONAL_PRICE') ?><br />
    </div>
    <?php }?>

	<?php if ($show_reviews) {?>
	<div class="uf_label">
		<input type="hidden" name="reviews[]" value="0" />
        <input type="checkbox" name="reviews[]" value="1" <?php if ($reviews) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print JText::_('UF_WITH_REVIEWS') ?><br />
    </div>
	<?php }?>
	
    <?php if (is_array($characteristic_displayfields) && count($characteristic_displayfields)){?>
	<?php foreach($characteristic_displayfields as $ch_id){?>
	<?php if (is_array($characteristic_fieldvalues[$ch_id])){?>
	<div class="uf_label"><?php print $characteristic_fields[$ch_id]->name;?></div>
	<div>
		<input type="hidden" name="extra_fields[<?php print $ch_id?>][]" value="0" />
		<?php foreach($characteristic_fieldvalues[$ch_id] as $val_id=>$val_name){?>
		<input type="checkbox" name="extra_fields[<?php print $ch_id?>][]" value="<?php print $val_id;?>" <?php if (is_array($extra_fields_active[$ch_id]) && in_array($val_id, $extra_fields_active[$ch_id])) print 'checked="checked"';?> <?php if (!$update_form_submit_only) print 'onclick="document.jshop_ultra_filters.submit();"';?> /> <?php print $val_name;?><br/>
		<?php }?>
	</div>
	<?php } ?>
	<?php }?>
    <?php } ?>    

	<?php if ($show_prices){?>
    <div class="uf_label"><?php print JText::_('UF_PRICE')?>
        <div id="price_slider"></div>
        <span class="box_price_from">
            <?php print JText::_('UF_FROM')?> 
            <input type = "text" class = "inputbox" name = "fprice_from" id="fprice_from" size="3" value="<?php if ($fprice_from>0) print $fprice_from?>" />
        </span>
        <span class="box_price_to">
            <?php print JText::_('UF_TO')?> 
            <input type = "text" class = "inputbox" name = "fprice_to"  id="fprice_to" size="4" value="<?php if ($fprice_to>0) print $fprice_to?>" />
            <?php print $jshopConfig->currency_code?>
        </span>
    </div>    
    <?php }?> 
	
	<div>	
	<span>
		<input type="submit" class="button" value="<?php print JText::_('UF_YES')?>" />
	</span>  
	<span>
		<input type="button" class="button" value="<?php print JText::_('UF_RESET_FILTER')?> " onclick="jQuery('#jshop_ultra_filters').clearJShoppingUltraForm(); document.jshop_ultra_filters.submit(); return false;" />
	</span>  
	</div>
</form>
</div>