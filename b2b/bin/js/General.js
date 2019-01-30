var General={
	data:{
		timestamp:0,
		location_info_by_id:function(locationInfo,id){
			for(var i in locationInfo){
				if(locationInfo[i].id==''+id){
					return locationInfo[i];
				}
			}
			return false;
		},
		location_name_by_id:function(locationInfo,id){
			var info=General.data.location_info_by_id(locationInfo,id);
			if(info===false){
				return 'Sydney';
			}
			return info.location;
		},
		check_location_available:function(locationFees){
			var ret=[];
			for(var i in locationFees){
				if(locationFees[i].tstavailable==0){
					ret.push(locationFees[i].availablemsg);
				}
			}
			return ret;
		},
		date:function(day_selector,month_selector,year_selector){
			
			
/*			console.log ("EM Alert: ["+parseInt($(day_selector).val())+"] ["+parseInt($(month_selector).val())+"] ["+parseInt($(year_selector).val())+"]");
			var date=new Date();
			date.setDate(parseInt($(day_selector).val()));
			date.setMonth(parseInt($(month_selector).val())-1);
			date.setYear($(year_selector).val());
			var day=('0'+date.getDate()).slice(-2);
			var month=('0'+(date.getMonth()+1)).slice(-2);
			var dateReturn = day +'/'+	month +'/'+	date.getFullYear();
			console.log ("EM DATE Log: ["+dateReturn+"]");
*/
			
			var dateReturn = ($(day_selector).val())+"/"+($(month_selector).val())+"/"+($(year_selector).val());
			
			return dateReturn;
		},
		discount_summary:function(availableCarDetails,carsizeid){
			var ret={};
			for(var i=0;i<availableCarDetails.length;i++){
				if(availableCarDetails[i].carsizeid!=carsizeid){
					continue;
				}
				if(availableCarDetails[i].rate==availableCarDetails[i].rateafterdiscount){
					continue;
				}
				if(typeof(ret[availableCarDetails[i].discountname])=='undefined'){
					ret[availableCarDetails[i].discountname]=0;
				}
				ret[availableCarDetails[i].discountname]+=
					parseFloat(availableCarDetails[i].rate)
					-parseFloat(availableCarDetails[i].rateafterdiscount);
			}
			return ret;
		},
		selected_car:function(availableCars,selected_id){
			for(var i in availableCars){
				if(availableCars[i].carsizeid==selected_id){
					return availableCars[i];
				}
			}
			return false;
		},
		selected_mandatory_fee:function(mandatoryFees,carsizeid){
			var ret=[];
			for(var i in mandatoryFees){
				if(mandatoryFees[i].vehiclesizeid==carsizeid){
					switch(mandatoryFees[i].type){
						case 'Fixed':
							mandatoryFees[i].displaytotal=parseFloat(mandatoryFees[i].fees);
							mandatoryFees[i].displaydaily=mandatoryFees[i].displaytotal;
							mandatoryFees[i].displaytype=mandatoryFees[i].type;
							break;
						case 'Daily':
							mandatoryFees[i].displaytotal=(parseFloat(mandatoryFees[i].fees)*parseFloat(mandatoryFees[i].numofdays));
							mandatoryFees[i].displaydaily=parseFloat(mandatoryFees[i].fees);
							mandatoryFees[i].displaytype=mandatoryFees[i].type;
							if(mandatoryFees[i].displaytotal>=parseFloat(mandatoryFees[i].maxprice)){
								mandatoryFees[i].displaytotal=parseFloat(mandatoryFees[i].maxprice);
								mandatoryFees[i].displaydaily=parseFloat(mandatoryFees[i].maxprice);
								mandatoryFees[i].displaytype='Fixed';
							}
							break;
						default:
							mandatoryFees[i].total=mandatoryFees[i].fees;
							break;
					}
					ret.push(mandatoryFees[i]);
				}
			}
			return ret;
		},
		selected_insurance:function(insuranceOptions,selected_id){
			for(var i in insuranceOptions){
				if(insuranceOptions[i].id==selected_id){
					insuranceOptions[i].displaytype=insuranceOptions[i].type;
					switch(insuranceOptions[i].type){
						case 'Daily':
							insuranceOptions[i].displaydaily=parseFloat(insuranceOptions[i].fees);
							insuranceOptions[i].displaytotal=parseFloat(insuranceOptions[i].fees)*parseFloat(insuranceOptions[i].numofdays);
							insuranceOptions[i].displaytype=insuranceOptions[i].type;
							if(
								parseFloat(insuranceOptions[i].maxprice)!=0
								&&
								insuranceOptions[i].displaytotal>parseFloat(insuranceOptions[i].maxprice)
							){
								insuranceOptions[i].displaytotal=parseFloat(insuranceOptions[i].maxprice);
								insuranceOptions[i].displaydaily=parseFloat(insuranceOptions[i].maxprice);
								insuranceOptions[i].displaytype='Fixed';
							}
							break;
						default:
							insuranceOptions[i].total=insuranceOptions[i].fees;
							break;
					}
					return insuranceOptions[i];
				}
			}
			return false;
		},
		commissionitems:function(car,insurance){
			return parseFloat(car.totalrateafterdiscount)+parseFloat(insurance.displaytotal);
		},
		agent_to_collect:function(availableCars,total,commission_items){
			if(!availableCars[0]||!availableCars[0].agencypaymenttype||!availableCars[0].agentcommissionrate){
				alert('There was an error calculating the agency commission. Please refresh and try again');
				return {
					value:0,
					type:'error'
				};
			}
			if(availableCars[0].agencypaymenttype==3){ // zero payment
				return {
					value:0,
					type:'Zero Payment'
				};
			}
			if(availableCars[0].agencypaymenttype==1){ // full payment
				return {
					value:total,
					type:'Full Payment'
				};
			}
			if(availableCars[0].agencypaymenttype==4){ // commission items
				return {
					value:commission_items,
					type:'Commission Items'
				};
			}
			if(availableCars[0].agencypaymenttype==2){ // commission only
				return {
					value:commission_items*parseFloat(availableCars[0].agentcommissionrate)/100,
					type:'Commission Only'
				};
			}
			return 0;
		},
		vehicle_availability_error:function(error,locationInfo,pickupID,dropoffID,error_template){
			var match=error.match(/This vehicle has a (\d+) day minimum hire period between selected location and dates/);
			if(!match||!match[1]){
				return error;
			}
			if(locationInfo===false){
				return Template.run(
					error_template,
					{
						days:match[1]
					}
				);
			}
			var pickup=false;
			var dropoff=false;
			for(var i in locationInfo){
				if(locationInfo[i].id==pickupID){
					pickup=locationInfo[i].location;
				}
				if(locationInfo[i].id==dropoffID){
					dropoff=locationInfo[i].location;
				}
			}
			if(pickup===false||dropoff===false){
				return error;
			}
			return Template.run(
				error_template,
				{
					dropoff:dropoff,
					pickup:pickup,
					days:match[1]
				}
			);
		},
		unique_errors:function(errors){
			return errors.reduce(function(p,c){
				if(p.indexOf(c)<0){
					p.push(c);
				}
				return p;
			},[]);
		}
	},
	controller:{
		validate_step_2:function(locationFees,locationInfo,availableCars,pickupDateObj,dropoffDateObj,pickupID,dropoffID){
			var available=General.data.check_location_available(locationFees);
			if(available.length>0){
				return available.join('<br/>');
			}
			available=General.controller.check_location_minbookingday(
				locationInfo,locationFees,pickupID,dropoffID,pickupDateObj,dropoffDateObj
			);
			if(available.length>0){
				return available.join('<br/>');
			}
			
			var ct=0;
			for(var i in availableCars){
				if(availableCars[i].available=='0'){
					ct++;
				}
			}
			if(ct==availableCars.length){
				return true;
			}
			
			available=General.controller.check_available_cars(availableCars);
			if(available.length==1){
				return General.data.vehicle_availability_error(
					available[0],locationInfo,pickupID,dropoffID,
					'The minimum Rental period between %pickup and %dropoff for an Internet booking is %days days.'
				);
			}
			return true;
		},
		check_available_cars:function(availableCars){
			var ret=[];
			for(var i in availableCars){
				if(availableCars[i].available=='1'){
					continue;
				}
				ret.push(availableCars[i].availablemsg);
			}
			if(ret.length==availableCars.length){
				return General.data.unique_errors(ret);
			}
			return [];
		},
		check_location_minbookingday:function(locationInfo,locationFees,pickupID,dropoffID,pickupDateObj,dropoffDateObj){
			if(pickupDateObj.getTime()>dropoffDateObj.getTime()){
				return ['Return Date is earlier then Pick up date.'];
			}
			for(var locationInfoIndex in locationInfo){
				if(locationInfo[locationInfoIndex].id==pickupID){
					if(pickupDateObj.getTime()<General.data.timestamp+locationInfo[locationInfoIndex].reduced_noticerequired*24*3600){
						locationInfo[locationInfoIndex].reduced_noticerequired=parseInt(locationInfo[locationInfoIndex].noticerequired)-1;
						return [Template.run(
							'Reservation requests made for %location must be made %reduced_noticerequired days or more prior to vehicle pick up.',
							locationInfo[locationInfoIndex]
						)];
					}
					continue;
				}
			}
			for(var locationFeesIndex in locationFees){
				if(
					(
						locationFees[locationFeesIndex].locationid==pickupID
						||
						locationFees[locationFeesIndex].locationid==dropoffID
					)
					&&
					locationFees[locationFeesIndex].availablemsg!=''
				){
					return [locationFees[locationFeesIndex].availablemsg];
				}
			}
			return [];
		},
		load:{
			agency:function(code,name,promo,code_selector,name_selector,promo_selector){
				$(code_selector).val(code);
				$(name_selector).val(name);
				$(promo_selector).val(promo);
			},
			date:function(day,month,year,day_selector,month_selector,year_selector){
				day=parseInt(day);
				if(day<10){
					day='0'+day;
				}
				day+='';
				month=parseInt(month);
				if(month<10){
					month='0'+month;
				}
				month+='';
				$(day_selector).val(day);
				$(month_selector).val(month);
				$(year_selector).val(year);
			},
			location:{
				pickup:function(location_array,selected,element_selector){
					var html=[];
					for(var i=0;i<location_array.length;i++){
						html.push(
							General.view.option(
								location_array[i].id,
								location_array[i].location+'  &nbsp;',
								selected+''==location_array[i].id
							)
						);
					}
					$(element_selector).html(html.join(''));
				},
				dropoff:function(location_array,selected,element_selector){
					var html=[
						General.view.option(
							'Same',
							'Same As Pickup Location',
							selected+''=='Same'
						)
					];
					for(var i=0;i<location_array.length;i++){
						html.push(
							General.view.option(
								location_array[i].id,
								location_array[i].location+'  &nbsp;',
								selected+''==location_array[i].id
							)
						);
					}
					$(element_selector).html(html.join(''));
				}
			}
		}
	},
	view:{
		option:function(value,text,bool_selected){
			return Template.run(
				"<option value='%value' %selected>%text</option>",
				{
					value:value,
					text:text,
					selected:bool_selected?"selected='selected'":''
				}
			);
		}
	}
};