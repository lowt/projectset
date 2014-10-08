<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
error_reporting(E_ALL & ~E_NOTICE);
jimport('joomla.plugin.plugin');

/*JPlugin::loadLanguage( 'plgJshoppingproductsUltra_filters' );*/

class plgJshoppingproductsUltra_filters extends JPlugin {

	function plgJshoppingproductsUltra_filters( &$subject ) {
		parent::__construct( $subject );
	}

    function onBeforeQueryGetProductList ( $type, &$adv_result, &$adv_from, &$adv_query, &$order_query, &$filters=Array() ) {
		require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");

		$mod = JModuleHelper::getModule('mod_jshopping_ajax_filters');
		if ($mod->id) return '';
		
		$mod = JModuleHelper::getModule('mod_jshopping_ultra_filters');
		$modParams = new JRegistry();
		$modParams->loadString($mod->params);
		
		$mainframe = &JFactory::getApplication(); 
		$category_id = JRequest::getInt('category_id');
		$manufacturer_id = JRequest::getInt('manufacturer_id');
		$contextfilter = "";
		if (JRequest::getVar("controller")=="category"){
			$contextfilter = "jshoping.list.front.product.cat.".$category_id;
		}
		if (JRequest::getVar("controller")=="manufacturer"){
			$contextfilter = "jshoping.list.front.product.manf.".$manufacturer_id;
		}
		if ($modParams->get('show_photos', '')) {
			$photo = JRequest::getInt('photo');
			$photo = $mainframe->getUserStateFromRequest( $contextfilter.'photo', 'photo');
			if ($photo) {
				$adv_query .= ' AND prod.product_name_image'.($photo==1?'<>':'=').'""';
			}
		}

		if ($modParams->get('show_availabilitys', '')) {
			$availability = JRequest::getInt('availability');
			$availability = $mainframe->getUserStateFromRequest( $contextfilter.'availability', 'availability');
			if ($availability) {
				if ($availability == 1) {
					$adv_query .= ' AND (prod.product_quantity > 0 OR prod.unlimited <> 0)';
				} else {
					$adv_query .= ' AND (prod.product_quantity = 0 AND prod.unlimited = 0)';
				}
			}
		}

		if ($modParams->get('show_sales', '')) {
			$sales = JRequest::getVar('sales');
			$sales = $mainframe->getUserStateFromRequest( $contextfilter.'sales', 'sales');
			$sales = filterAllowValue($sales, "int+");
			if ($sales) {
				$adv_query .= ' AND prod.product_old_price > prod.product_price';
			}
		}

		if ($modParams->get('show_additional_price', '')) {
			$additional_price = JRequest::getVar('additional_price');
			$additional_price = $mainframe->getUserStateFromRequest( $contextfilter.'additional_price', 'additional_price');
			$additional_price = filterAllowValue($additional_price, "int+");
			if ($additional_price) {
				$adv_query .= ' AND prod.product_is_add_price <> 0';
			}
		}

		if ($modParams->get('show_reviews', '')) {
			$reviews = JRequest::getVar('reviews');
			$reviews = $mainframe->getUserStateFromRequest( $contextfilter.'reviews', 'reviews');
			$reviews = filterAllowValue($reviews, "int+");
			if ($reviews) {
				$adv_query .= ' AND prod.reviews_count > 0';
			}
		}

		if ($modParams->get('show_delivery_times', '')) {
			$delivery_time = JRequest::getVar('delivery_time');
			$delivery_time = $mainframe->getUserStateFromRequest( $contextfilter.'delivery_time', 'delivery_time', array());
			$delivery_time = filterAllowValue($delivery_time, "int+");
			if (is_array($delivery_time) && count($delivery_time)) {
				$adv_query .= ' AND prod.delivery_times_id IN ('.implode(",",$delivery_time).')';
			}
		}

	}

}
?>