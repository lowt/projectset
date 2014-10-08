<?php
/**
* @version      3.3.0 02.01.2012
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
* @powered      Dmitry Stashenko http://nevigen.com
*/

defined('_JEXEC') or die();

if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'jshopping.php')){
	JError::raiseError(500,"Please install component \"joomshopping\"");
} 

$document = &JFactory::getDocument();
$document->addStyleSheet(JURI::base().'modules/mod_jshopping_ultra_filters/css/style.css');

$display_fileters = 0;
if (JRequest::getVar("controller")=="category" && JRequest::getInt("category_id")) $display_fileters = 1;
if (JRequest::getVar("controller")=="manufacturer" && JRequest::getInt("manufacturer_id")) $display_fileters = 1;
if (!$display_fileters) return "";

require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");        
JSFactory::loadCssFiles();
JSFactory::loadLanguageFile();
$db =& JFactory::getDBO();            
$jshopConfig = &JSFactory::getConfig();
$user = &JFactory::getUser();
$lang = &JSFactory::getLang();
$mainframe = &JFactory::getApplication(); 
$show_manufacturers = $params->get('show_manufacturers');         
$show_labels = $params->get('show_labels');         
$show_vendors = $params->get('show_vendors');         
$show_categorys = $params->get('show_categorys');         
$show_prices = $params->get('show_prices');         
$show_characteristics = $params->get('show_characteristics');
$show_photos = $params->get('show_photos');
$show_availabilitys = $params->get('show_availabilitys');
$show_sales = $params->get('show_sales');
$show_reviews = $params->get('show_reviews');
$show_delivery_times = $params->get('show_delivery_times');
$show_additional_price = $params->get('show_additional_price');
$update_form_submit_only = $params->get('update_form_submit_only');

$category_id = JRequest::getInt('category_id');
$manufacturer_id = JRequest::getInt('manufacturer_id');

$contextfilter = "";
if (JRequest::getVar("controller")=="category"){
	$contextfilter = "jshoping.list.front.product.cat.".$category_id;
}
if (JRequest::getVar("controller")=="manufacturer"){
	$contextfilter = "jshoping.list.front.product.manf.".$manufacturer_id;
}

if ($category_id && $show_manufacturers){
	$category = &JTable::getInstance('category', 'jshop');
	$category->load($category_id);
	
	$manufacturers = $mainframe->getUserStateFromRequest( $contextfilter.'manufacturers', 'manufacturers', array());
	$manufacturers = filterAllowValue($manufacturers, "int+");    
	
	$filter_manufactures = $category->getManufacturers();
}

if ($manufacturer_id && $show_categorys){
	$manufacturer = &JTable::getInstance('manufacturer', 'jshop');        
	$manufacturer->load($manufacturer_id);
	
	$categorys = $mainframe->getUserStateFromRequest( $contextfilter.'categorys', 'categorys', array());
	$categorys = filterAllowValue($categorys, "int+");
	
	$filter_categorys = $manufacturer->getCategorys();
	
	foreach ($filter_categorys as $v) {
		$category_id_arr[] = $v->id;
	}
}

if ($show_labels){
	$labels = $mainframe->getUserStateFromRequest( $contextfilter.'labels', 'labels', array());
	$labels = filterAllowValue($labels, "int+");

	$adv_query = "";
	$groups = implode(',', $user->getAuthorisedViewLevels());
	$adv_query .=' AND prod.access IN ('.$groups.')';
	if ($jshopConfig->hide_product_not_avaible_stock){
		$adv_query .= " AND prod.product_quantity > 0";
	}
	if ($category_id) {
		$query = "SELECT distinct lab.id as id, lab.name as name FROM `#__jshopping_products` AS prod
				  LEFT JOIN `#__jshopping_products_to_categories` AS categ USING (product_id)
				  LEFT JOIN `#__jshopping_product_labels` as lab on prod.label_id=lab.id 
				  WHERE categ.category_id = '".$db->getEscaped($category_id)."' AND prod.product_publish = '1' AND prod.label_id!=0 ".$adv_query." order by name";
		$db->setQuery($query);
		$filter_labels = $db->loadObjectList();
	}
	if ($manufacturer_id) {
		$query = "SELECT distinct lab.id as id, lab.name as name FROM `#__jshopping_products` AS prod
				  LEFT JOIN `#__jshopping_product_labels` as lab on prod.label_id=lab.id 
				  WHERE prod.product_manufacturer_id = '".$db->getEscaped($manufacturer_id)."' AND prod.product_publish = '1' AND prod.label_id!=0 ".$adv_query." order by name";
		$db->setQuery($query);
		$filter_labels = $db->loadObjectList();
	}
}

if ($show_photos){
	$photo = $mainframe->getUserStateFromRequest( $contextfilter.'photo', 'photo');
}

if ($show_availabilitys){
	$availability = $mainframe->getUserStateFromRequest( $contextfilter.'availability', 'availability');
}

if ($show_sales){
	$sales = $mainframe->getUserStateFromRequest( $contextfilter.'sales', 'sales');
	$sales = filterAllowValue($sales, "int+");
}

if ($show_additional_price){
	$additional_price = $mainframe->getUserStateFromRequest( $contextfilter.'additional_price', 'additional_price');
	$additional_price = filterAllowValue($additional_price, "int+");
}

if ($show_reviews){
	$reviews = $mainframe->getUserStateFromRequest( $contextfilter.'reviews', 'reviews');
	$reviews = filterAllowValue($reviews, "int+");
}

if ($show_delivery_times){
	$adv_query = "";
	$groups = implode(',', $user->getAuthorisedViewLevels());
	$adv_query .=' AND prod.access IN ('.$groups.')';
	if ($jshopConfig->hide_product_not_avaible_stock){
		$adv_query .= " AND prod.product_quantity > 0";
	}
	if ($category_id) {
		$query = "SELECT distinct deliv.id as id, deliv.`".$lang->get('name')."` as name FROM `#__jshopping_products` AS prod
				  LEFT JOIN `#__jshopping_products_to_categories` AS categ USING (product_id)
				  LEFT JOIN `#__jshopping_delivery_times` as deliv on prod.delivery_times_id=deliv.id 
				  WHERE categ.category_id = '".$db->getEscaped($category_id)."' AND prod.product_publish = '1' AND prod.delivery_times_id!=0 ".$adv_query." order by name";
		$db->setQuery($query);
		$_rows = $db->loadObjectList();
		$filter_delivery_time = array();
		foreach($_rows as $row){
			$filter_delivery_time[$row->id] = $row->name;
		}
		unset($_rows);
	}
	if ($manufacturer_id) {
		$query = "SELECT distinct deliv.id as id, deliv.`".$lang->get('name')."` as name FROM `#__jshopping_products` AS prod
				  LEFT JOIN `#__jshopping_delivery_times` as deliv on prod.delivery_times_id=deliv.id 
				  WHERE prod.product_manufacturer_id = '".$db->getEscaped($manufacturer_id)."' AND prod.product_publish = '1' AND prod.delivery_times_id!=0 ".$adv_query." order by name";
		$db->setQuery($query);
		$_rows = $db->loadObjectList();
		$filter_delivery_time = array();
		foreach($_rows as $row){
			$filter_delivery_time[$row->id] = $row->name;
		}
		unset($_rows);
	}
	$delivery_times = $mainframe->getUserStateFromRequest( $contextfilter.'delivery_times', 'delivery_times', array());
	$delivery_times = filterAllowValue($delivery_times, "int+");
}

if ($show_vendors){
	$vendors = $mainframe->getUserStateFromRequest( $contextfilter.'vendors', 'vendors', array());
	$vendors = filterAllowValue($vendors, "int+");
	$filter_vendors = &JSFactory::getAllVendor();
	unset($filter_vendors[0]);
}

if ($show_prices){
	$fprice_from = $mainframe->getUserStateFromRequest( $contextfilter.'fprice_from', 'fprice_from');
	$fprice_from = saveAsPrice($fprice_from);
	$fprice_to = $mainframe->getUserStateFromRequest( $contextfilter.'fprice_to', 'fprice_to');
	$fprice_to = saveAsPrice($fprice_to);
}

if ($show_characteristics && $jshopConfig->admin_show_product_extra_field){
	$characteristic_fields = &JSFactory::getAllProductExtraField();
	$characteristic_fieldvalues = &JSFactory::getAllProductExtraFieldValueDetail();
	if ($category_id) {
		$characteristic_displayfields = &JSFactory::getDisplayFilterExtraFieldForCategory($category_id);
	} else {
		$characteristic_displayfields = array();
		$list = &JSFactory::getAllProductExtraField();
		foreach($list as $val){
			if ($val->allcats || array_intersect($category_id_arr, $val->cats)){
				$characteristic_displayfields[] = $val->id;
			}
		}
		
		$jshopConfig = &JSFactory::getConfig();
		$config_list = $jshopConfig->getFilterDisplayExtraFields();
		foreach($characteristic_displayfields as $k=>$val){
			if (!in_array($val, $config_list)) unset($characteristic_displayfields[$k]);
		}
	}
	$extra_fields_active = $mainframe->getUserStateFromRequest($contextfilter.'extra_fields', 'extra_fields', array());
	$extra_fields_active = filterAllowValue($extra_fields_active, "array_int_k_v+");        
}

require(JModuleHelper::getLayoutPath('mod_jshopping_ultra_filters'));        
?>