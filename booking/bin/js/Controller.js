var Controller={
	vehicle_min_booking_day:function(cars){
		var match=false;
		for(var i=0;i<cars.length;i++){
			if(cars[i].available==1){
				continue;
			}
			match=cars[i].availablemessage.match(
				/This vehicle has a (\d+) day minimum hire period between selected location and dates/
			);
			if(match&&match[1]){
				return match[1];
			}
		}
		return false;
	},
	unattendedfee:function(locationFees,html_function){
		var ret={
			html:''
			,total:0.0
		};
		for(var i in locationFees){
			if(typeof(locationFees[i].unattendedfee)=='undefined'){
				continue;
			}
			if(locationFees[i].unattendedfee>0){
				ret.html+=html_function(locationFees[i].location,locationFees[i].unattendedfee);
				ret.total+=parseFloat(locationFees[i].unattendedfee);
			}
		}
		return ret;
	},
	afterhourfee:function(locationFees,html_function){
		var ret={
			html:''
			,total:0.0
		};
		for(var i in locationFees){
			if(typeof(locationFees[i].afterhourfee)=='undefined'){
				continue;
			}
			if(locationFees[i].afterhourfee>0){
				ret.html+=html_function(locationFees[i].location,locationFees[i].afterhourfee);
				ret.total+=parseFloat(locationFees[i].afterhourfee);
			}
		}
		return ret;
	},
	freedays:function(freedays,avgrate,html_function){
		if(freedays>0){
			return {
				html:html_function(freedays,parseFloat(avgrate),parseFloat(avgrate)*parseFloat(freedays))
				,total:parseFloat(avgrate)*parseFloat(freedays)
			};
		}
		return {
			html:''
			,total:0.0
		};
	},
	totaldiscount:function(totaldiscount,html_function,discount_type,discount_rate){
		if(totaldiscount>0){
			var discount_text = '**PROMOTIONAL RATE APPLIED**';
			
			if(discount_type=="p"){
				discount_text="**"+discount_rate+"% OFF DAILY RATE APPLIED**"				
			}else{
				discount_text="**$"+discount_rate+" OFF DAILY RATE APPLIED**"			
			}
			
			return {
				html:html_function(discount_text)
				,total:-totaldiscount
			};
		}
		return {
			html:''
			,total:0.0
		};
	},
	mandatoryfee:function(mandatoryFees,locId,sizeId,numberofdays,total
		,html_function_daily,html_function_percentage,html_function_unknown
	){
		var ret={
			html:''
			,html_incl:''
			,html_incl_free:''
			,html_govt:''
			,individual:[]
			,total:total
			,totalCalcGst:0
			,totalCalcStampDuty:0
		};
		var subtotal=0;
		var discount=false;
		var name;
		var altname;
		var calcGst=0.0, calcStampDuty=0.0, totalCalcGst=0.0, totalCalcStampDuty=0.0;
		var StateTax = 1.0 + Controller.StateTax();
		var CountryTax = 1.0 + oAPI.GetTax();
		var used = [];
		
		if (rcmTaxInclusive == false) {
			ret.totalCalcGst+=total*CountryTax;
			ret.totalCalcStampDuty+=total*StateTax;
		}else{
			ret.totalCalcGst+=total;
			ret.totalCalcStampDuty+=total;
		}
		
		// console.log(mandatoryFees);
		for(var i in mandatoryFees){
			// if(
				// (mandatoryFees[i].locationid!=locId&&mandatoryFees[i].locationid!=0)
				// ||
				// (mandatoryFees[i].vehiclecategoryid!=sizeId&&mandatoryFees[i].vehiclecategoryid!=0)
			// ){
				// continue;
			// }
			// console.log( 'sizeId : ' + sizeId);
			if(
				(used.indexOf(mandatoryFees[i].id) != -1)
				||
				(mandatoryFees[i].vehiclecategoryid!=sizeId&&mandatoryFees[i].vehiclecategoryid!=0)
			){
				continue;
			}
			
			used.push(mandatoryFees[i].id);
			
			calcGst=0.0;
			calcStampDuty=0.0;
			
			name = mandatoryFees[i].feedescription ? mandatoryFees[i].feedescription : mandatoryFees[i].name;
			// name = name.replace('Government','Govt');
			
			if(name.includes('Govt') || name.includes('Government')){
				altname = name + ' @ $'+ mandatoryFees[i].fees +' Per Day';
				altname = altname.replace('Fees','Fee');
			}else{				
				altname = name;
			}
			
			discount=false;
			if(mandatoryFees[i].fees<0){
				discount=true;
			}
			switch(mandatoryFees[i].type){
				case 'Daily':
					subtotal=numberofdays*parseFloat(mandatoryFees[i].fees);
					ret.html+=html_function_daily(name,altname,mandatoryFees[i].fees,subtotal);					
					if(name.includes('Govt') || name.includes('Government')){						
						ret.html_govt+=html_function_daily(name,altname,mandatoryFees[i].fees,subtotal);
					}else if(!mandatoryFees[i].fees){
						ret.html_incl_free+=html_function_daily(name,altname,mandatoryFees[i].fees,subtotal);
					}else{						
						ret.html_incl+=html_function_daily(name,altname,mandatoryFees[i].fees,subtotal);
					}					
					
					break;
				case 'Percentage':
					subtotal=ret.total*(parseFloat(mandatoryFees[i].fees)/100);
					ret.html+=html_function_percentage(name,subtotal);
					if(name.includes('One-Way') || name.includes('Government')){						
						ret.html_govt+=html_function_percentage(name,subtotal);
					}else if(!mandatoryFees[i].fees){						
						ret.html_incl_free+=html_function_percentage(name,subtotal);
					}else{						
						ret.html_incl+=html_function_percentage(name,subtotal);
					}					
					
					break;
				default:
					subtotal=parseFloat(mandatoryFees[i].fees);
					ret.html+=html_function_unknown(mandatoryFees[i].type,name,parseFloat(mandatoryFees[i].fees));
					if(name.includes('One-Way') || name.includes('Government')){						
						ret.html_govt+=html_function_unknown(mandatoryFees[i].type,name,parseFloat(mandatoryFees[i].fees));
					}else if(!mandatoryFees[i].fees){						
						ret.html_incl_free+=html_function_unknown(mandatoryFees[i].type,name,parseFloat(mandatoryFees[i].fees));
					}else{						
						ret.html_incl+=html_function_unknown(mandatoryFees[i].type,name,parseFloat(mandatoryFees[i].fees));
					}
					
					break;
			}	
			
			if (rcmTaxInclusive == false) {
				// console.log(mandatoryFees[i]);
				if(mandatoryFees[i]["gst"] == true) calcGst=parseFloat(subtotal) * parseFloat(CountryTax);
				if(mandatoryFees[i]["stampduty"] == true){ calcStampDuty=parseFloat(subtotal) * parseFloat(StateTax);
				// console.log(mandatoryFees[i]);
				}
				// console.log('====');
			}else{
				if(mandatoryFees[i]["gst"] == true) calcGst=parseFloat(subtotal);
				if(mandatoryFees[i]["stampduty"] == true) calcStampDuty=parseFloat(subtotal);
			}
			
			ret.total+=subtotal;
			ret.totalCalcGst+=calcGst;
			ret.totalCalcStampDuty+=calcStampDuty;
			ret.individual.push({
				type:mandatoryFees[i].type
				,discount:discount
				,fees:mandatoryFees[i].fees
				,name:name
				,total:subtotal
			});
		}		
			
		if(ret.html_incl){ // add sub title
			// ret.html_incl = '<span class="sub-title">What’s included:</span>' + ret.html_incl;
		}
		
		return ret;
	},
	check_location_available:function(locationFees){
		var ret=[];
		for(var i in locationFees){
			if(locationFees[i].tstavailable==0){
				ret.push(locationFees[i].availablemessage);
			}
		}
		return ret;
	},
	price_rounding:function(price,country){
		if(country=='NZ'){
			return Math.ceil(parseFloat(price));
		}
		return price;
	},
	check_most_popular:function(vehicledescriptionurl,mostpopularpath){
		var vd=document.createElement('a');
		vd.href=vehicledescriptionurl;
		var path=vd.pathname;
		if(path.substr(0,1)=='/'){
			path=path.substr(1);
		}
		if(path.substr(-1,1)=='/'){
			path=path.substr(0,path.length-1);
		}
		for(var i in mostpopularpath){
			if(mostpopularpath[i]==path){
				return true;
			}
		}
		return false;
	},
	StateTax:function(){
		var StateTax = oAPI.GetStateTax();
		
		if(StateTax==0.11) //special case, don't know why this happen
			StateTax=0.105;
		
		return StateTax;
	},
	
};
