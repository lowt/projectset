/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function($) {

	var config = $('html').data('config') || {};

	// Social buttons
	$('article[data-permalink]').socialButtons(config);

    // Fixed headerbar

    var doc     = $(document),
        header  = $('.tm-headerbar');

    if ($('body').hasClass('tm-navbar-fixed')) {

        doc.on('scroll', function(){

            if(doc.scrollTop() > 100){
                header.addClass('tm-headerbar-small');
            } else{
                header.removeClass('tm-headerbar-small');
            }

        });

    }

});

	jQuery(window).scroll(function(){
					if (jQuery(this).scrollTop() > 50) {
					jQuery(".tm-headerbar").addClass("tm-headerbar-small");	
					jQuery("#slogan").addClass("s_logo");				
					} else {
					 jQuery(".tm-headerbar").removeClass("tm-headerbar-small");		
					jQuery("#slogan").removeClass("s_logo");
					}
	});


	jQuery("#lightbox-secNav-btnClose").click(function(){
	});
//Filter
	
/*	jQuery(document).on("change","#canon",function(){
		if(jQuery("#canon").prop("checked")) {
		jQuery.cookie('can_check', 1);
		jQuery(".products li").addClass('canon_hh');
		//jQuery(".products li").hide();
			//var modelArray = [];
			jQuery(".products li").each(function(index){
				var strNames = jQuery(this).children().children().children().html();
				var names = strNames.split(' ');
					if(names[0]=='Canon')
					{
						//var schet = 0;
					//	jQuery.each(modelArray,function(i){
						//if(modelArray[i]==names[2]) {
						//	 schet++;	
						//	}
						//});
						//if(schet==0){
							//modelArray[modelArray.length] = names[2];
							//jQuery("#model").append("<label class='can'><input style='margin-top: -3px; margin-right: 10px;' type='checkbox'><span class='model_name'>"+
						//	names[1]+" "+names[2]+"</span></label>");
						//}
						jQuery(this).removeClass('canon_hh');
						jQuery(this).removeClass('nikon_hh');
						jQuery(this).addClass("canon_hide");
					}
			});
		}
		else{
			jQuery(".products li").removeClass("canon_hide");
			jQuery.cookie('can_check', 0);
			jQuery("#model").children(".can").remove();
			if(!jQuery("#nikon").prop("checked")){
			//jQuery(".products li").show();
			
			
			jQuery(".products li").removeClass('canon_hh');
			jQuery(".products li").removeClass('nikon_hh');
			jQuery(".products li").removeClass('canon_hide');
			jQuery(".products li").removeClass('nikon_hide');
			}
		}
		
	});*/
	
	jQuery(document).on("change","#canon",function(){
		if(!jQuery("#canon").prop("checked")) {
			jQuery.cookie('can_check', 2);
			jQuery(".products li:visible").each(function(index){
				var strNames = jQuery(this).children().children().children().html();
				var names = strNames.split(' ');
					if(names[0]=='Canon')
					{
						jQuery(this).addClass("canon_hide");
					}
			});
		}
		else{
			jQuery.cookie('can_check', 1);
			jQuery(".products li").each(function(index){
				var strNames = jQuery(this).children().children().children().html();
				var names = strNames.split(' ');
					if(names[0]=='Canon')
					{
						jQuery(this).removeClass("canon_hide");
					}
			});
		}
	});
	
	jQuery(document).on("change","#nikon",function(){
		if(!jQuery("#nikon").prop("checked")) {
			jQuery.cookie('nik_check', 2);
			jQuery(".products li:visible").each(function(index){
				var strNames = jQuery(this).children().children().children().html();
				var names = strNames.split(' ');
					if(names[0]=='Nikon')
					{
						jQuery(this).addClass("nikon_hide");
					}
			});
		}
		else{
			jQuery.cookie('nik_check', 1);
			jQuery(".products li").each(function(index){
				var strNames = jQuery(this).children().children().children().html();
				var names = strNames.split(' ');
					if(names[0]=='Nikon')
					{
						jQuery(this).removeClass("nikon_hide");
					}
			});
		}
	});
	
	jQuery(document).on("change","#sony",function(){
		if(!jQuery("#sony").prop("checked")) {
			jQuery.cookie('son_check', 2);
			jQuery(".products li:visible").each(function(index){
				var strNames = jQuery(this).children().children().children().html();
				var names = strNames.split(' ');
					if(names[0]=='Sony')
					{
						jQuery(this).addClass("sony_hide");
					}
			});
		}
		else{
			jQuery.cookie('son_check', 1);
			jQuery(".products li").each(function(index){
				var strNames = jQuery(this).children().children().children().html();
				var names = strNames.split(' ');
					if(names[0]=='Sony')
					{
						jQuery(this).removeClass("sony_hide");
					}
			});
		}
	});
	
	/*jQuery(document).on("change","#nikon",function(){
		if(jQuery("#nikon").prop("checked")) {
		jQuery.cookie('nik_check', 1);
		jQuery(".products li").addClass('nikon_hh');
		//jQuery(".products li").hide();
		//var modelArray = [];
		jQuery(".products li").each(function(index){
			var strNames = jQuery(this).children().children().children().html();
			var names = strNames.split(' ');
					if(names[0]=='Nikon')
					{
						//var schet = 0;
						//jQuery.each(modelArray,function(i){
						//	if(modelArray[i]==names[2]) {
						//	 schet++;	
						//	}
						//});
						//if(schet==0){
						//	modelArray[modelArray.length] = names[2];
						//	jQuery("#model").append("<label class='nik'><input style='margin-top: -3px; margin-right: 10px;' type='checkbox'><span class='model_name'>"+
						//	names[1]+" "+names[2]+"</span></label>");
						//}
						jQuery(this).removeClass('nikon_hh');
						jQuery(this).removeClass('canon_hh');
						jQuery(this).addClass("nikon_hide");
					}
				});
		}
		else{
			jQuery(".products li").removeClass("nikon_hide");
			jQuery.cookie('nik_check', 0);
			jQuery("#model").children(".nik").remove();
			if(!jQuery("#canon").prop("checked")) {
			//jQuery(".products li").show();
			
			jQuery(".products li").removeClass('canon_hh');
			jQuery(".products li").removeClass('nikon_hh');
			jQuery(".products li").removeClass('canon_hide');
			jQuery(".products li").removeClass('nikon_hide');
			}
		}
	});*/
	
	jQuery(document).on("change","#sorting",function(){
		if(jQuery("#sorting").val()=="По убыванию") {
			jQuery.cookie('sort',1);
			for ( var i = 0; i < jQuery('.products li').length; i++ ) {	
				for(var j = 0; j < jQuery('.products li').length - i - 1; j++){
					var costs = jQuery('.products li:nth-child('+(j+1)+')').children().children().children(".price_sort").html().split(' ');
					var costs2 = jQuery('.products li:nth-child('+(j+2)+')').children().children().children(".price_sort").html().split(' ');
					if(parseInt(costs[0])<parseInt(costs2[0])) {
					var curr_li = jQuery('.products li:nth-child('+(j+1)+')');
					var prev_li = jQuery('.products li:nth-child('+(j+2)+')');
					curr_li.insertAfter(prev_li);
					}
					//console.log(costs[0]);
				}
			}
		}
		if(jQuery("#sorting").val()=="По возрастанию") {
			jQuery.cookie('sort',2);
			for ( var i = 0; i < jQuery('.products li').length; i++ ) {	
				for(var j = 0; j < jQuery('.products li').length - i - 1; j++){
					var costs = jQuery('.products li:nth-child('+(j+1)+')').children().children().children(".price_sort").html().split(' ');
					var costs2 = jQuery('.products li:nth-child('+(j+2)+')').children().children().children(".price_sort").html().split(' ');
					if(parseInt(costs[0])>parseInt(costs2[0])) {
					var curr_li = jQuery('.products li:nth-child('+(j+1)+')');
					var prev_li = jQuery('.products li:nth-child('+(j+2)+')');
					prev_li.insertBefore(curr_li);
					}
					//console.log(costs[0]);
				}
			}
		}
	});
	
	jQuery(document).on("change","#cost_from",function(){
	if(jQuery("#cost_from").val()>0) {
		jQuery.cookie('costt_from',jQuery("#cost_from").val());
		}
		else {
			jQuery.cookie('costt_from',null);
		}
		jQuery(".products li").each(function(index){
			var costs = jQuery(this).children().children().children(".price_sort").html().split(' ');
			if (parseInt(costs[0])<parseInt(jQuery("#cost_from").val())){
				jQuery(this).addClass('cost_from_hide');
			}
			else{
				jQuery(this).removeClass('cost_from_hide');
			}
			console.log(costs[0]);
		});
	});
	
	jQuery(document).on("change","#cost_to",function(){
		if(jQuery("#cost_to").val()>0) { 
			jQuery.cookie('costt_to',jQuery("#cost_to").val());
		}
		else {
			jQuery.cookie('costt_to',null);
		}
		jQuery(".products li").each(function(index){
			var costs = jQuery(this).children().children().children(".price_sort").html().split(' ');
			if (parseInt(costs[0])>parseInt(jQuery("#cost_to").val())){
				jQuery(this).addClass('cost_to_hide');
			}
			else{
				jQuery(this).removeClass('cost_to_hide');
			}
			console.log(costs[0]);
		});
	});
	
	jQuery(document).on("click","#reset",function(){
		jQuery("#canon").prop("checked",true);
		jQuery("#nikon").prop("checked",true);
		jQuery("#sony").prop("checked",true);
		
		jQuery("#cost_from").val("");
		jQuery("#cost_to").val("");
		
		jQuery("#sorting :nth-child(1)").attr("selected", "selected");
		
		jQuery("#canon").change();
		jQuery("#nikon").change();
		jQuery("#sony").change();
		jQuery("#cost_from").change();
		jQuery("#cost_to").change();
		jQuery("#sorting").change();
		
		jQuery.cookie('can_check',null);
		jQuery.cookie('nik_check',null);
		jQuery.cookie('son_check',null);
		jQuery.cookie('sort',null);
		jQuery.cookie('costt_from',null);
		jQuery.cookie('costt_to',null);
		
		
	});
	
	jQuery(document).ready(function(){
	
	//var date = jQuery.now();
   // var x = Math.floor((Math.random() * date) + 1);
    //jQuery(".pixel").html('<img src="http://pixel.afrek.ru/?goid=1254&iid='+x+'" width="1" height="1"/>');
	
	
	for ( var i = 0; i < jQuery('.products li').length; i++ ) {	
		for(var j = 0; j < jQuery('.products li').length - i - 1; j++){
			var costs = jQuery('.products li:nth-child('+(j+1)+')').children().children().children(".price_sort").html().split(' ');
			var costs2 = jQuery('.products li:nth-child('+(j+2)+')').children().children().children(".price_sort").html().split(' ');
			if(parseInt(costs[0])<parseInt(costs2[0])) {
			var curr_li = jQuery('.products li:nth-child('+(j+1)+')');
			var prev_li = jQuery('.products li:nth-child('+(j+2)+')');
			curr_li.insertAfter(prev_li);
			}
			//console.log(costs[0]);
		}
	}

	jQuery("#canon").prop("checked",true);
	jQuery("#nikon").prop("checked",true);
	jQuery("#sony").prop("checked",true);
	
	if(jQuery.cookie('can_check')==2){
		jQuery("#canon").prop("checked",false);
		jQuery("#canon").change();
	}
	
	if(jQuery.cookie('nik_check')==2){
		jQuery("#nikon").prop("checked",false);
		jQuery("#nikon").change();
	}
	
	if(jQuery.cookie('son_check')==2){
		jQuery("#sony").prop("checked",false);
		jQuery("#sony").change();
	}
	
	if(jQuery.cookie('costt_from')>0){
		jQuery("#cost_from").val(jQuery.cookie('costt_from'));
		jQuery("#cost_from").change();
	}
	else{
		jQuery("#cost_from").empty();
		jQuery("#cost_from").change();
	}
	if(jQuery.cookie('costt_to')>0){
		jQuery("#cost_to").val(jQuery.cookie('costt_to'));
		jQuery("#cost_to").change();
	}
	else{
		jQuery("#cost_to").empty();
		jQuery("#cost_to").change();
	}
	/*if(jQuery.cookie('nik_check')==0){
		jQuery("#nikon").prop("checked",false);
		jQuery("#nikon").change();
	}
	if(jQuery.cookie('can_check')==0){
		jQuery("#canon").prop("checked",false);
		jQuery("#canon").change();
	}*/
	if(jQuery.cookie('sort')==2){
	jQuery("#sorting :nth-child(2)").attr("selected", "selected");
		for ( var i = 0; i < jQuery('.products li').length; i++ ) {	
			for(var j = 0; j < jQuery('.products li').length - i - 1; j++){
				var costs = jQuery('.products li:nth-child('+(j+1)+')').children().children().children(".price_sort").html().split(' ');
				var costs2 = jQuery('.products li:nth-child('+(j+2)+')').children().children().children(".price_sort").html().split(' ');
				if(parseInt(costs[0])>parseInt(costs2[0])) {
				var curr_li = jQuery('.products li:nth-child('+(j+1)+')');
				var prev_li = jQuery('.products li:nth-child('+(j+2)+')');
				prev_li.insertBefore(curr_li);
				}
				//console.log(costs[0]);
			}
		}
	}
	//alert(jQuery.cookie('nik_check'));
	//jQuery("#canon").change();
	
	
	
	//Сортировка
		
	});
	
