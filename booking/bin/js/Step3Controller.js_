Step3.controller.optional_extras=function(){
	var html='';
	var type='';
	var filename='';
	// console.log(rcmOptionalFees);
	for(var i in rcmOptionalFees){
		if(!rcmOptionalFees[i]._display){
			continue;
		}
		type='option_unknown';
		if(rcmOptionalFees[i].qtyapply==true){
			if(rcmOptionalFees[i].type=='Daily'){
				type='option_quantity_daily';
			}else if(rcmOptionalFees[i].type=='Percentage'){
				type='option_quantity_percentage';
			}else{
				type='option_quantity_unknown';
			}
		}else if(rcmOptionalFees[i].qtyapply==false){
			if(rcmOptionalFees[i].type=='Daily'){
				type='option_daily';
			}else if(rcmOptionalFees[i].type=='Percentage'){
				type='option_percentage';
			}else{
				type='option_unknown';
			}
		}
		
		if( rcmOptionalFees[i].id == 37 || rcmOptionalFees[i].id == 38 || rcmOptionalFees[i].id == 39 ) //if extra is one-way-fee then pass it
			continue;
		// console.log(rcmOptionalFees[i]);
		if(rcmOptionalFees[i].feedescription1 && rcmOptionalFees[i].feedescription1.indexOf('.png') >= 0){
			filename = rcmOptionalFees[i].feedescription1;
		}else{
			filename = 'noimage.png';
		}
		
		html+=Step3.view[type](
			rcmOptionalFees[i].name
			,rcmOptionalFees[i].id
			,filename
			,rcmOptionalFees[i].extradesc
			,rcmOptionalFees[i]._fees
			// ,rcmOptionalFees[i]._unitfee
			,rcmOptionalFees[i].totalfeeamount
			,Step3.controller.pop_get_data(rcmOptionalFees[i].extradesc)
		);
	}
	if(html==''){
		return;
	}
	$('#optional-extras').html(Template.run($('#optional_extras_header_html').html(),{	content:html	}));
};
Step3.controller.optional_extras_check=function(){
	Log.add('optional_extras_check start');
	if(!Step3.data.optional_extras_json){
		Log.add('optional_extras_check data.optional_extras_json not available');
		return;
	}
	var opt=JSON.parse(Step3.data.optional_extras_json);
	if(!opt){
		Log.add('optional_extras_check data.optional_extras_json invalid');
		return;
	}
	Log.add(opt);
	for(var i in opt){
		if(!opt[i].id||isNaN(opt[i].qty)){
			Log.add('optional_extras_check invalid key '+i);
			continue;
		}
		if($('#OptionalExtras'+opt[i].id).length==0){
			Log.add('optional_extras_check error optional extras not found: #OptionalExtras'+opt[i].id);
			continue;
		}
		$('#OptionalExtras'+opt[i].id).prop('checked','checked');
		$('#OptionalExtras'+opt[i].id).parents('.box-wrap').find('.btn:contains("Select")').html('Selected').addClass('selected');
		$('#OptionalExtras'+opt[i].id).parents('.box-wrap').find('.btn:contains("Add")').html('Added').addClass('added');
		if($('#qtyOptionalExtras'+opt[i].id).length==0){
			Log.add('optional_extras_check optional extras qty not found: #qtyOptionalExtras'+opt[i].id);
			continue;
		}
		if(!opt[i].qty){
			opt[i].qty=1;
		}
		$('#qtyOptionalExtras'+opt[i].id).val(opt[i].qty);
	}
};
	
Step3.controller.insurance_options=function(){
	var html=[];
	var fees=0;
	var numberofdays=0;
	var checked=null;
	var lowest_fee=999999;
	// console.log(rcmInsuranceOptions);
	if(!rcmInsuranceOptions.length){
		$('#insurance-options').remove();
		return false;
	}
	for (var i in rcmInsuranceOptions) {
		if(rcmInsuranceOptions[i].isdefault=="true"){
			checked=false;
			break;
		}
	}
	if(checked===null){
		for (var i in rcmInsuranceOptions) {
			fees=parseFloat(rcmInsuranceOptions[i].fees);
			if(fees<lowest_fee){
				lowest_fee=fees;
				checked=i;
				continue;
			}
		}
	}
	for (var i in rcmInsuranceOptions) {
		var insurancename;
		var description;
		var extradesc;
		var priceInfo;
		
		// console.log(rcmInsuranceOptions[i]);
		insurancename = rcmInsuranceOptions[i].name;
		description = rcmInsuranceOptions[i].feedescription && rcmInsuranceOptions[i].feedescription.indexOf('.html') < 0 ? rcmInsuranceOptions[i].feedescription : rcmInsuranceOptions[i].name;
		// description = rcmInsuranceOptions[i].name;
		// console.log(rcmInsuranceOptions[i].feedescription.indexOf('.html'));		
		extradesc = rcmInsuranceOptions[i].extradesc ? rcmInsuranceOptions[i].extradesc : rcmInsuranceOptions[i].feedescription;	
		fees=parseFloat(rcmInsuranceOptions[i].fees);
		
		numberofdays=parseFloat(rcmInsuranceOptions[i].numberofdays);
		// if(
			// (rcmInsuranceOptions[i].locationid!=Step3.data.PickupLocationID&&rcmInsuranceOptions[i].locationid!='0')
			// ||
			// (rcmInsuranceOptions[i].vehiclecategoryid!=rcmAvailableCars[0].vehiclecategoryid&&rcmInsuranceOptions[i].vehiclecategoryid!='0')
		// ){
			// continue;
		// }
		if(
			(rcmInsuranceOptions[i].vehiclecategoryid!=rcmAvailableCars[0].vehiclecategoryid&&rcmInsuranceOptions[i].vehiclecategoryid!='0')
		){
			continue;
		}
		var maxprice=parseFloat(rcmInsuranceOptions[i].maxprice);
		if(rcmInsuranceOptions[i].type=='Daily'){
			var price=numberofdays*fees;
			
			if(maxprice!=0&&price>maxprice){
				price=maxprice;
			}
			
			priceInfo = ' @ $' + rcmInsuranceOptions[i].fees.toFixed(2) + ' Per Day' ;
			description = rcmInsuranceOptions[i].feedescription && rcmInsuranceOptions[i].feedescription.indexOf('.html') < 0 ? description : description + priceInfo;
			
			html.push([
				Step3.view.insurance_option_daily(
					insurancename
					,description
					,rcmInsuranceOptions[i].id
					,extradesc
					,fees
					,price
					,rcmInsuranceOptions[i].isdefault=="true"||checked===i
					,Step3.controller.pop_get_data(extradesc)
				),
				numberofdays*fees
			]);
			continue;
		}
		if(rcmInsuranceOptions[i].type=='Percentage'){
			var price=Step3.data.base.total*fees/100;
			if(maxprice!=0&&price>maxprice){
				price=maxprice;
			}
			html.push([
				Step3.view.insurance_option_percentage(
					insurancename
					,description
					,rcmInsuranceOptions[i].id
					,extradesc
					,fees
					,price
					,rcmInsuranceOptions[i].isdefault=="true"||checked===i
					,Step3.controller.pop_get_data(extradesc)
				),
				Step3.data.base.total*fees/100
			]);
			continue;
		}
		html.push([
			Step3.view.insurance_option_unknown(
				insurancename
				,description
				,rcmInsuranceOptions[i].id
				,fees
				,extradesc
				,fees
				,rcmInsuranceOptions[i].isdefault=="true"||checked===i
				,Step3.controller.pop_get_data(extradesc)
			),
			fees
		]);
		continue;
	}
	if(html.length==0){
		return;
	}
	html=html.sort(Step3.controller.insurance_options_sort);
	var ret='';
	for(var i=0;i<html.length;i++){
		ret+=html[i][0];
	}
	
	// console.log('html' + html);
	// console.log('ret' + ret);
	$('#insurance-options').html(Template.run($('#insurance_options_header_html').html(),{
		content:ret
	}));
};
Step3.controller.insurance_options_sort=function(a,b){
	if(a[1]==b[1]){
		return 0;
	}
	if(a[1]<b[1]){
		return -1;
	}
	return 1;
};
Step3.controller.insurance_options_check=function(){
	if(!Step3.data.insurance_json){
		return;
	}
	var insurance=JSON.parse(Step3.data.insurance_json);
	if(!insurance){
		return;
	}
	if($('#Insurance'+insurance.id).length==0){
		return;
	}
	$('#Insurance'+insurance.id).prop('checked','checked');
};
Step3.controller.km_charges_options=function(){
	var html='';
	var numberofdays=0;
	var extradesc;
	var description;
	var priceInfo;
	
	// console.log(rcmKmCharges);
	for (var i=rcmKmCharges.length-1 ; i>=0 ; i--) {
		extradesc = rcmKmCharges[i].notes;
		description = rcmKmCharges[i].notes && rcmKmCharges[i].notes.indexOf('.html') < 0  ? rcmKmCharges[i].notes : rcmKmCharges[i].description;
		numberofdays=parseFloat(rcmKmCharges[i].numberofdays);
		if(rcmKmCharges[i].vehiclecategoryid!=rcmKmCharges[0].vehiclecategoryid&&rcmKmCharges[i].vehiclecategoryid!='0')
		{
			continue;
		}
		if( typeof(rcmKmCharges[i].dailyrate)!='undefined' /* &&rcmKmCharges[i].dailyrate>0 */ ){
			priceInfo = ', $' + rcmKmCharges[i].dailyrate.toFixed(2) + ' Per Day' ;
			description = rcmKmCharges[i].notes && rcmKmCharges[i].notes.indexOf('.html') < 0  ? description : description + priceInfo;
			
			html+=Step3.view.km_charges_daily(
				rcmKmCharges[i].id
				,description
				,extradesc
				,parseFloat(rcmKmCharges[i].numberofkmsfree)
				,parseFloat(rcmKmCharges[i].feeforeachadditionalkm)
				,parseFloat(rcmKmCharges[i].dailyrate)
				,parseFloat(rcmKmCharges[i].totalamount)
				,typeof(rcmKmCharges[i].isdefault)!='undefined'&&rcmKmCharges[i].isdefault
				,Step3.controller.pop_get_data(extradesc)
			);
			continue;
		}else{
			
			// priceInfo = ', $' + rcmKmCharges[i].dailyrate.toFixed(2) + ' Per Day' ;
			// description = rcmKmCharges[i].notes && rcmKmCharges[i].notes.indexOf('.html') < 0  ? rcmKmCharges[i].notes : description + priceInfo;
			
			html+=Step3.view.km_charges_unknown(
				rcmKmCharges[i].id
				,description
				,extradesc
				,parseFloat(rcmKmCharges[i].numberofkmsfree)
				,parseFloat(rcmKmCharges[i].feeforeachadditionalkm)
				,rcmKmCharges[i].totalamount+'.00'
				,typeof(rcmKmCharges[i].isdefault)!='undefined'&&rcmKmCharges[i].isdefault
				,Step3.controller.pop_get_data(extradesc)
			);			
			continue;
		}
	}
	if(html==''){
		return;
	}
	$('#km_charges_options').html(Template.run($('#km_charges_header_html').html(),{
		content:html
	}));
};
Step3.controller.km_charges_options_check=function(){
	if(!Step3.data.km_charges_json){
		return;
	}
	var km_charges=JSON.parse(Step3.data.km_charges_json);
	if(!km_charges){
		return;
	}
	if($('#ExtraKmOut'+km_charges.id).length==0){
		return;
	}
	$('#ExtraKmOut'+km_charges.id).prop('checked','checked');
};

Step3.controller.calculate_totals=function(){
	var total=0.0;
	var totalCalcGst=0.0;
	var totalCalcStampDuty=0.0;
	var deposit=0.0;
	var gst=0.0;
	var CountryTax = 1.0 + oAPI.GetTax();
	var StateTax = 1.0 + Controller.StateTax();
	var rcmTaxRate = Controller.StateTax();
	// console.log('rcmTaxRate: ' + rcmTaxRate);
	total+=Step3.data.base.total;
		
	var extra_fees=Step3.controller.extra_fees(
		parseInt(rcmAvailableCars[0].numberofdays)
		,typeof(rcmAvailableCars[0].relocfee)=='undefined'?false:parseFloat(rcmAvailableCars[0].relocfee)
		,parseInt(rcmAvailableCars[0].relocdaysnocharge)
		,rcmLocationFees
		,rcmMandatoryFees
		,Step3.data.PickupLocationID
		,rcmAvailableCars[0].vehiclecategoryid
		,total
	);
		
	var optionalExtrasTotal=Step3.controller.calculate_total_optional_extras();
	var insuranceTotal=Step3.controller.calculate_total_insurance_options();
	var km_chargesTotal=Step3.controller.calculate_total_km_charges_options();
	// console.log(extra_fees);
	
	total=extra_fees.total;
	totalCalcGst=extra_fees.totalCalcGst;	
	totalCalcStampDuty=extra_fees.totalCalcStampDuty;
	
	total+=optionalExtrasTotal.total;
	total+=insuranceTotal.total;
	total+=km_chargesTotal.total;
	// total+=Step3.data.base.discount;
	
	totalCalcGst+=optionalExtrasTotal.totalCalcGst;
	totalCalcGst+=insuranceTotal.totalCalcGst;
	totalCalcGst+=km_chargesTotal.totalCalcGst;
	
	totalCalcStampDuty+=optionalExtrasTotal.totalCalcStampDuty;
	totalCalcStampDuty+=insuranceTotal.totalCalcStampDuty;
	totalCalcStampDuty+=km_chargesTotal.totalCalcStampDuty;
	
	// console.log(rcmAvailableCars[0]);
	//set rate to cart
	var numberofdays=parseInt(rcmAvailableCars[0].numberofdays);
	var avgrate=parseFloat(rcmAvailableCars[0].avgrate);
	// var totalRate=numberofdays*avgrate;
	var totalRate=parseFloat(rcmAvailableCars[0].totalrateafterdiscount).toFixed(2);
	$('#cart .daily-rate .item-name').html(numberofdays + ' days @ $' + avgrate);
	$('#cart .daily-rate .item-price').html('$'+totalRate);
	
	//set discount to cart
	var totaldiscountamount=rcmAvailableCars[0].totaldiscountamount;
	if(totaldiscountamount){
		$('#cart .discount .item-title').html('**PROMOTIONAL RATE APPLIED**');
	}	
	
	//set gst to cart
	gst = (Step3.controller.tax(totalCalcStampDuty,rcmTaxRate)).toFixed(2);	
	$('#cart .widget-head .pricing .tax .dynamic').html('$'+gst);
	$('#cart .tax .item-name').html('$'+gst);
	$('#cart .tax .item-price').html('$'+gst);
	
	//set price to cart
	var priceInclTax=parseFloat(total)+parseFloat(gst);
	priceSplit = Controller.price_rounding(priceInclTax,Step3.data.country).toFixed(2).split(".");
	$('#cart .widget-head .price-num').html(priceSplit[0]);
	$('#cart .widget-head .small').html('.'+priceSplit[1]);
	
	//set deposit to cart	
	// deposit = ( Step3.data.base.total + insuranceTotal.total) * 0.2;
	deposit = 200; //fixed deposit
	depositSplit = Controller.price_rounding(deposit,Step3.data.country).toFixed(2).split(".");
	$('#cart .deposit .price-num').html(depositSplit[0]);
	$('#cart .deposit .small').html('.'+depositSplit[1]);
	
	//set mileage to cart
	var mileage=$('input[name=ExtraKmOut]:checked');
	var id=mileage.val();
	var name=mileage.attr('mileage_name');
	var notes=mileage.parents('.option').find('.option-text').html();
	var price=mileage.parents('.option').find('.total-price').html();
	add='<div class="items row"><div class="col-xs-8"><span class="item-name">'+ name +'</span></div><div class="col-xs-4"><span class="item-price">'+ price +'</span></div></div>';
	$('#cart .mileage .items').remove();
	$('#cart .mileage').append(add);
	var saveMileage={
		id:  id,
		name:  name,
		desc:  notes,
		price: price,
	};
		
	//set insurance to cart
	var insurance=$('input[name=Insurance]:checked');
	var id=insurance.val();
	var name=insurance.attr('insurance_name');
	var desc=insurance.parents('.option').find('.option-text a').html();
	var price=insurance.parents('.option').find('.total-price').html();
	add='<div class="items row"><div class="col-xs-8"><span class="item-name">'+ name +'</span></div><div class="col-xs-4"><span class="item-price">'+ price +'</span></div></div>';
	$('#cart .insurance .items').remove();
	$('#cart .insurance').append(add);
	var saveInsurance={
		id:  id,
		name:  name,
		desc:  desc,
		total: price,
	};
		
	//save session
	$('form input[name="total_price"]').val(total.toFixed(2));
	$('form input[name="total_deposit"]').val(deposit.toFixed(2));
	$('form input[name="total_gst"]').val(gst);	
	$('form input[name="price_table_html"]').val($('#cart .widget-head .pricing').html());
	$('form input[name=km_charges_json]').val(JSON.stringify(saveMileage));	
	$('form input[name=insurance_json_2]').val(JSON.stringify(saveInsurance));
};

Step3.controller.calculate_total_insurance_options=function(){
	var chk=null,tot=null,ischecked=false;
	var total=0.0,fees=0.0,numberofdays=0.0,subtotal=0.0;
	var maxprice=0;
	var calcGst=0.0, calcStampDuty=0.0, totalCalcGst=0.0, totalCalcStampDuty=0.0;
	var StateTax = 1.0 + Controller.StateTax();
	var CountryTax = 1.0 + oAPI.GetTax();
	
	for (var i in rcmInsuranceOptions) {
		calcGst=0.0;
		calcStampDuty=0.0;
		
		fees=parseFloat(rcmInsuranceOptions[i].fees);
		numberofdays=parseFloat(rcmInsuranceOptions[i].numberofdays);
		maxprice=parseFloat(rcmInsuranceOptions[i].maxprice);
		if(rcmInsuranceOptions[i].vehiclecategoryid!=rcmAvailableCars[0].vehiclecategoryid&&rcmInsuranceOptions[i].vehiclecategoryid!='0')
		{
			continue;
		}
		chk=$('#Insurance'+rcmInsuranceOptions[i].id);
		if($(chk).length==0){
			Log.add('no element chk found for rcmInsuranceOptions id '+rcmInsuranceOptions[i].id);
			continue;
		}
		tot=$('#InsuranceTotal'+rcmInsuranceOptions[i].id);
		if($(tot).length==0){
			Log.add('no element tot found for rcmInsuranceOptions id '+rcmInsuranceOptions[i].id);
			continue;
		}
		$(tot).removeClass('active');
		ischecked=$(chk).prop('checked');
		if(rcmInsuranceOptions[i].type=='Daily'){
			subtotal=numberofdays*fees;
			if(maxprice!=0&&subtotal>maxprice){
				subtotal=maxprice;
			}			
		}
		else if(rcmInsuranceOptions[i].type=='Percentage'){
			subtotal=Step3.data.base.total*fees/100;
			if(maxprice!=0&&subtotal>maxprice){
				subtotal=maxprice;
			}			
		}
		else{
			subtotal=fees;			
		}
		
		if (rcmTaxInclusive == false) {
			if(rcmInsuranceOptions[i]["gst"] == true) calcGst=parseFloat(subtotal) * parseFloat(CountryTax);
			if(rcmInsuranceOptions[i]["stampduty"] == true) calcStampDuty=parseFloat(subtotal) * parseFloat(StateTax);
		}else{
			if(rcmInsuranceOptions[i]["gst"] == true) calcGst=parseFloat(subtotal);
			if(rcmInsuranceOptions[i]["stampduty"] == true) calcStampDuty=parseFloat(subtotal);
		}
		
		if(ischecked){
			$(tot).addClass('active');
			total+=subtotal;
			totalCalcGst+=calcGst;
			totalCalcStampDuty+=calcStampDuty;
		}
				
	}
	return {total: total, totalCalcGst: totalCalcGst, totalCalcStampDuty:totalCalcStampDuty};
};

Step3.controller.calculate_total_km_charges_options=function(){
	var total=0.0,subtotal=0.0,chk=null,tot=null,ischecked=null;
	var numberofdays=0;
	var calcGst=0.0, calcStampDuty=0.0, totalCalcGst=0.0, totalCalcStampDuty=0.0;
	var StateTax = 1.0 + Controller.StateTax();
	var CountryTax = 1.0 + oAPI.GetTax();
	
	for (var i in rcmKmCharges) {
		
		calcGst=0.0;
		calcStampDuty=0.0;
		
		numberofdays=parseFloat(rcmKmCharges[i].numberofdays);
		if(rcmKmCharges[i].vehiclecategoryid!=rcmKmCharges[0].vehiclecategoryid&&rcmKmCharges[i].vehiclecategoryid!='0')
		{
			continue;
		}
		chk=$('#ExtraKmOut'+rcmKmCharges[i].id);
		if($(chk).length==0){
			Log.add('no element chk found for rcmKmCharges id '+rcmKmCharges[i].id);
			continue;
		}
		tot=$('#ExtraKmOutTotal'+rcmKmCharges[i].id);
		if($(tot).length==0){
			Log.add('no element tot found for rcmKmCharges id '+rcmKmCharges[i].id);
			continue;
		}
		$(tot).removeClass('active');
		ischecked=$(chk).prop('checked');
		if(typeof(rcmKmCharges[i].dailyrate)!='undefined'&&rcmKmCharges[i].dailyrate>0){
			subtotal=numberofdays*parseFloat(rcmKmCharges[i].dailyrate);
			
			if (rcmTaxInclusive == false) {
				calcGst=parseFloat(subtotal) * parseFloat(CountryTax);
				calcStampDuty=parseFloat(subtotal) * parseFloat(StateTax);
			}else{
				calcGst=parseFloat(subtotal);
				calcStampDuty=parseFloat(subtotal);
			}
			
			if(ischecked){
				$(tot).addClass('active');
				total+=subtotal;
				totalCalcGst+=calcGst;
				totalCalcStampDuty+=calcStampDuty;
			}
			continue;
		}		
	}
	return {total: total, totalCalcGst: totalCalcGst, totalCalcStampDuty:totalCalcStampDuty};
};

Step3.controller.calculate_total_optional_extras=function(){
	var chk=null,qty=null,tot=null,numqty=1,ischecked=false;
	var total=0.0,subtotal=0.0;
	var calcGst=0.0, calcStampDuty=0.0, totalCalcGst=0.0, totalCalcStampDuty=0.0;
	var StateTax = 1.0 + Controller.StateTax();
	var CountryTax = 1.0 + oAPI.GetTax();
	
	for(var i in rcmOptionalFees){
		if(!rcmOptionalFees[i]._display){
			continue;
		}
		
		calcGst=0.0;
		calcStampDuty=0.0;
		
		chk=$('#OptionalExtras'+rcmOptionalFees[i].id);
		tot=$('#OptionalExtrasTotal'+rcmOptionalFees[i].id);
		if($(chk).length==0||$(tot).length==0){
			Log.add('no element chk/tot found for rcmOptionalFees id '+rcmOptionalFees[i].id);
			continue;
		}
		$(tot).removeClass('active');
		ischecked=$(chk).prop('checked');
		numqty=1;
		if(rcmOptionalFees[i].qtyapply==true){
			qty=$('#qtyOptionalExtras'+rcmOptionalFees[i].id);
			if($(qty).length==0){
				Log.add('no element qty found for rcmOptionalFees id '+rcmOptionalFees[i].id);
				continue;
			}
			if(!isNaN(parseInt($(qty).val()))){
				numqty=parseInt($(qty).val());
			}
			if(numqty<1){
				numqty=1;
			}
			if(ischecked){
				$(qty).val(numqty);
			}
		}
		// subtotal=numqty*rcmOptionalFees[i]._unitfee;
		subtotal=numqty*rcmOptionalFees[i].totalfeeamount;
		$(tot).html('$'+subtotal.toFixed(2));
		
		if (rcmTaxInclusive == false) {
			if(rcmOptionalFees[i]["gst"] == true) calcGst=parseFloat(subtotal) * parseFloat(CountryTax);
			if(rcmOptionalFees[i]["stampduty"] == true) calcStampDuty=parseFloat(subtotal) * parseFloat(StateTax);
		}else{
			if(rcmOptionalFees[i]["gst"] == true) calcGst=parseFloat(subtotal);
			if(rcmOptionalFees[i]["stampduty"] == true) calcStampDuty=parseFloat(subtotal);
		}
		
		if(ischecked){
			$(tot).addClass('active');
			total+=subtotal;
			totalCalcGst+=calcGst;
			totalCalcStampDuty+=calcStampDuty;
		}
	}
	return {total: total, totalCalcGst: totalCalcGst, totalCalcStampDuty:totalCalcStampDuty};
};

Step3.controller.api_feed_optional_extras=function(){
	oAPI.ClearOptionalItems();
	var chk=null,qty=null;
	for(var i in rcmOptionalFees){
		chk=$('#OptionalExtras'+rcmOptionalFees[i].id).prop('checked');
		if(typeof(chk)=='undefined'){
			Log.add('#OptionalExtras'+rcmOptionalFees[i].id+' does not exist');
			continue;
		}
		if(chk==false){
			Log.add('#OptionalExtras'+rcmOptionalFees[i].id+' is not checked');
			continue;
		}
		qty=$('#qtyOptionalExtras'+rcmOptionalFees[i].id).val();
		if(typeof(qty)=='undefined'){
			Log.add('#qtyOptionalExtras'+rcmOptionalFees[i].id+' does not exist, default qty to 1');
			qty=1;
		}else{
			qty=parseInt(qty);
		}
		oAPI.AddToOptionalItems(parseInt(rcmOptionalFees[i].id), qty);
		Log.add('OptionalExtras '+rcmOptionalFees[i].id+' added with quantity '+qty);
	}
};

Step3.controller.api_feed_insurance_options=function(){
	oAPI.SetInsurance(0);
	var chk=null;
	for (var i in rcmInsuranceOptions) {
		chk=$('#Insurance'+rcmInsuranceOptions[i].id).prop('checked');
		if(typeof(chk)=='undefined'){
			Log.add('#Insurance'+rcmInsuranceOptions[i].id+' does not exist');
			continue;
		}
		if(chk==false){
			Log.add('#Insurance'+rcmInsuranceOptions[i].id+' is not checked');
			continue;
		}
		oAPI.SetInsurance(parseInt(rcmInsuranceOptions[i].id));
		Log.add('Insurance '+rcmInsuranceOptions[i].id+' added');
	}
};

Step3.controller.api_feed_km_charges_options=function(){
	oAPI.SetExtraKms(0);
	var chk=null;
	for (var i in rcmKmCharges) {
		chk=$('#ExtraKmOut'+rcmKmCharges[i].id).prop('checked');
		if(typeof(chk)=='undefined'){
			Log.add('#ExtraKmOut'+rcmKmCharges[i].id+' does not exist');
			continue;
		}
		if(chk==false){
			Log.add('#ExtraKmOut'+rcmKmCharges[i].id+' is not checked');
			continue;
		}
		oAPI.SetExtraKms(parseInt(rcmKmCharges[i].id));
		Log.add('ExtraKmOut '+rcmKmCharges[i].id+' added');
	}
};
Step3.controller.pop_get_data=function(extradesc){
	for(var i=0;i<Step3.data.popups.length;i++){
		if(Step3.data.popups[i][0]==extradesc){
			return Step3.data.popups[i][1];
		}
	}
	return false;
};
Step3.controller.pop=function(extradesc){
	Log.add('pop up');
	var display=Step3.controller.pop_get_data(extradesc);
	if(!display){
		Log.add(extradesc+' not found');
		return;
	}
	Log.add(extradesc+' is found');
	$('#popup_booking .content').html("<div>"+display+"</div>");
	// $('#lightbox .content').html("<div>"+display+"</div>");
	// $('#lightbox').addClass('show');
	// $('body').addClass('lightbox');
	
	$.magnificPopup.open({
	  items: {
		src: '#popup_booking'
	  },
	  type: 'inline',
	  closeOnBgClick: true,
	  enableEscapeKey: true,
	});

};
Step3.controller.pop_close=function(){
	$('#lightbox').removeClass('show');
	$('body').removeClass('lightbox');
};
Step3.controller.price_details={
	main:function(){
		$('#price_details').html(
			'<table style="display:none;" class="details" cellspacing="0">'
			+Step3.data.price_table_html.replace(/class\=\"total\"/,'class="total-details"')
			+'</table>'
		);
	},
	show:function(el){
		$(el).parent().find('.show').hide();
		$(el).parent().find('.hide').show();
		$(el).parents('.car').find('.details').show();
	},
	hide:function(el){
		$(el).parent().find('.show').show();
		$(el).parent().find('.hide').hide();
		$(el).parents('.car').find('.details').hide();
	}
};
Step3.controller.prepare_optional_fees=function(){
	for(var i=0;i<rcmOptionalFees.length;i++){
		rcmOptionalFees[i]._display=false;
		rcmOptionalFees[i]._fees=parseFloat(rcmOptionalFees[i].fees);
		rcmOptionalFees[i]._maxprice=parseFloat(rcmOptionalFees[i].maxprice);
		rcmOptionalFees[i]._numberofdays=parseFloat(rcmOptionalFees[i].numberofdays);
		rcmOptionalFees[i]._unitfee=rcmOptionalFees[i]._fees;
		if(
			(rcmOptionalFees[i].locationid		!=Step3.data.PickupLocationID	&&rcmOptionalFees[i].locationid		!='0')
			||
			(rcmOptionalFees[i].vehiclecategoryid	!=rcmAvailableCars[0].vehiclecategoryid	&&rcmOptionalFees[i].vehiclecategoryid	!='0')
		){
			continue;
		}
		rcmOptionalFees[i]._display=true;
		if(rcmOptionalFees[i].type=='Daily'){
			rcmOptionalFees[i]._unitfee=rcmOptionalFees[i]._fees*rcmOptionalFees[i]._numberofdays;
			continue;
		}
		if(rcmOptionalFees[i].type=='Percentage'){
			rcmOptionalFees[i]._unitfee=rcmOptionalFees[i]._fees*Step3.data.base.total/100;
			continue;
		}
	}
	for(i=0;i<rcmOptionalFees.length;i++){
		if(rcmOptionalFees[i]._maxprice!=0&&rcmOptionalFees[i]._unitfee>rcmOptionalFees[i]._maxprice){
			rcmOptionalFees[i]._unitfee=rcmOptionalFees[i]._maxprice;
		}
	}
};
