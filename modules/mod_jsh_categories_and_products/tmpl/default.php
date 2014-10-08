<script type="text/javascript" src="http://photods.ru/templates/yoo_digit/js/jquery.cookie.js"></script>
<table id="filter" style="margin-top: -60px;margin-bottom: 30px;" border=0 cellpadding=10>
	<tr>
		<th>Выберите фирму:</th>
		<!--<th>Выберите модель:</th>-->
		<th>Цена от:</th>
		<th>до:</th>
		<th>Сортировать по цене:</th>
	</tr>
	<tr>
		<td>
			<label><input style="margin-top: -3px; margin-right: 10px;" type="checkbox" id="canon">Canon</label>
			<label><input style="margin-top: -3px; margin-right: 10px;" type="checkbox" id="nikon">Nikon</label>
			<label><input style="margin-top: -3px; margin-right: 10px;" type="checkbox" id="sony">Sony</label>
		</td>
		<!--<td id="model">
			
		</td>-->
		<td>
			<input style="margin-top: 10px;" type="number" step="500" id="cost_from">
		</td>
		<td>
			<input type="number" style="margin-top: 10px;" step="500" id="cost_to">
		</td>
		<td style="padding-top: 19px;">
			<select id="sorting">
				<option>По убыванию</option>
				<option>По возрастанию</option>
			</select>
		</td>
		<td colspan=2>
			<input type="button" id="reset" class="order-button second-order-button" style="display: block; float: right; margin-top: 5px;" class="form_button" value="Сбросить фильтр"/>
		</td>
	</tr>
</table>
<?php 
if ($params->get('css') == 1) {
	JHtml::stylesheet(JURI::base().'modules/mod_jsh_categories_and_products/css/style.css', array(), true); 
} ?>
<ul class="jscat-and-prod<?php echo htmlspecialchars($params->get('moduleclass_sfx')) ?>"> 
<?php 
  foreach($categories as $category){ ?>
  <?php 
  		$category_class = 'category';
		if (count($category->subcategories) or (count($category->products) && $params->get('products') == 1)) {
			$category_class .= ' parent';
		}
		if ($category->category_link == JUri::getInstance()->toString(array('path', 'query'))) {
			$category_class .= ' current';
		}
		if (in_array($category->category_id, $categories_id)) { 
			$indicator='<span onClick=\'return toggleShow(".sub'.$category->category_id.'" ,this)\' class="open"></span>';
			$category_ul='';
			$category_class .= ' active';
			$indicator_class=' class="open"';
		} else { 
        	$indicator='<span onClick=\'return toggleShow(".sub'.$category->category_id.'" ,this)\' class="closed"></span>';
			$category_ul='style="display:none"';
			$indicator_class=' class="closed"';
		} 
		if ($params->get('accordion') == 0) {
			$indicator='';
			$category_ul='';
			$indicator_class='';
		} else {
			$click_name='';
			if ($params->get('click_name') == 1){
				$indicator='';
				$click_name=' onClick=\'return toggleShow(".sub'.$category->category_id.'" ,this)\'';						
			} else {
				$indicator_class='';
			}
		}
		
	?>
	<li class="<?php echo $category_class; ?>"> 
    		<?php if (count($category->subcategories)  or (count($category->products) && $params->get('products') == 1)){ ?>
        		<?php echo $indicator ?>
        	<?php } else {
				$indicator_class='';
				$click_name='';
				} ?>
    		
            <?php if($category->products && $params->get('products') == 1) { ?>
			<div style="text-align: center; padding-left: 0!important;">
                	<ul  style="display: inline-block;" class="products <?php echo 'sub'.$category->category_id ?>" <?php echo $category_ul ?>>
						<?php foreach($category->products as $product): ?>
                        	<?php 
							$product_class = '';
							$product_name = $product->name;
							if ($product->product_link == JUri::getInstance()->toString(array('path', 'query'))) {
								$product_class = 'current';
							} 
                            if ($params->get('ean') == 1 && $product->product_ean) {
								$product_name = $product->product_ean;
							}
		 					?>    
							<li  style="float: left; padding: 6px;" class="product-<?php echo $product->product_id; ?> <?php echo $product_class; ?> <?php echo $category->category_id;?>"> 
								
									<a style="text-decoration: none; font-family: arial; color: #616161;" href="<?php echo $product->product_link?>">
									<div class="prod-div">
       	                          	<div style="height:40px;"><?php echo $product_name; ?></div>
                                	<?php if ($show_product_image && $product->image){?>
                   						<img style="display: inline-block; margin-top: 20px; /*height: 167px;*/" src = "<?php echo $product->image?>" alt = "<?php print $product->name?>" />
                					<?php } ?>
									<span class="price_sort" style="display: block; text-underline-style: none;"><?php echo$product->product_price;?> RUB</span>
									<div class="hover-div"><div style="margin-top: 40%;" ><?php echo $product_name; ?></div></div>
									
									<!--style="color: white; font-family: arial; font-size: 19px;"-->
									</div>
                    			</a>
								
								
                        	</li>
                        <?php endforeach ?>
                    </ul>
					</div>
            <?php } 
						require JModuleHelper::getLayoutPath('mod_jsh_categories_and_products', $params->get('layout', 'default').'_subcategories'); ?>
	</li>      
  <?php
  }
?>
</ul>
<?php if ($params->get('accordion') == 1) { ?>
<script type="text/javascript">
	function toggleShow(child,elem) {
		elem.className = (elem.className == 'open' ? 'closed' : 'open');
		jQuery(child).slideToggle(200);
		return false;
	} 	
	
</script>
<?php } ?>