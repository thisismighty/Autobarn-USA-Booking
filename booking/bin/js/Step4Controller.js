Step4.controller.deposit=function(){
	// if(Step4.data.total_price>511){
		// return 511;
	// }
	// return parseFloat(Step4.data.total_price);
	var deposit=Step4.data.total_price*0.2;
	
	return deposit;
};

Step4.controller.deposit_currency=function(){
	if(Step4.data.country=='NZ'){
		return 'NZD';
	}else if(Step4.data.country=='US'){
		return '';
	}
	return 'AUD';
};

Step4.controller._build_daily_rate=function(rates){
	if(!rates){
		return '';
	}
	Log.add(rates);
	return Step4.view.daily_rate(
		rates.numberofdays,rates.avgrate,rates.total
	);
};
Step4.controller._build_insurance=function(insurance){
	if(!insurance){
		return '';
	}
	Log.add(insurance);
	return Step4.view.insurance(
		insurance.name,insurance.fees,insurance.total,insurance.type
	);
};
Step4.controller._build_discount=function(discount){
	if(!discount){
		return '';
	}
	Log.add(discount);
	return Step4.view.discount(discount);
};
Step4.controller._build_extra_fees=function(extra_fees){
	if(!extra_fees||!extra_fees.mandatoryfee||extra_fees.mandatoryfee.length==0){
		return '';
	}
	Log.add(extra_fees);
	return Step4.view.mandatoryfee(
		extra_fees.mandatoryfee
	);
};
Step4.controller._build_optional_extras=function(optional_extras){
	if(!optional_extras||optional_extras.length==0){
		return '';
	}
	Log.add(optional_extras);
	return Step4.view.optional_extras(optional_extras);
};
Step4.controller.validate_firstname=function(value){
	value=value+0;
	if(isNaN(value)){
		return false;
	}
	if(value<1){
		return false;
	}
	return value;
};
Step4.controller.validate_text=function(value){
	if(value==""){
		return false;
	}
	return value;
};
Step4.controller.validate_phone=function(value){
	if(!$.isNumeric(value)){
		return false;
	}
	return value;
};
Step4.controller.validate_email=function(value){
	
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var result = re.test(String(value).toLowerCase());
	
	if(!result){
		return false;
	}
	return value;
};
Step4.controller.validate_notraveling=function(value){
	value=parseFloat(value)+0;
	if(isNaN(value)){
		return false;
	}
	if(value<1){
		return false;
	}
	return value;
};
