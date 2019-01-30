var oAPI=new rcmAPI();
var Step4={
	data:{
		found_us			:'',
		country				:'AU',
		timeout_resource	:null,
		timeout_triggered	:false
	},
	controller:{
		submit:{
			enable:function(){
				$('input[type="submit"]').prop('disabled','');
			},
			disable:function(){
				$('input[type="submit"]').prop('disabled','disabled');
			}
		},
		callback:{
			on_alert:function(){
				Log.add('on_alert start');
				if(Step4.data.timeout_triggered){
					Log.add('on_alert timeout triggered');
					Step4.data.timeout_triggered=false;
					clearTimeout(Step4.data.timeout_resource);
					return;
				}
				clearTimeout(Step4.data.timeout_resource);
				if(rcmAlert!=''){
					alert(rcmAlert);
					Log.add('on_alert rcmAlert end');
					return;
				}
				Log.add('on_alert end');
				return;
			},
			step3:function(){
				Log.add('step4.js: step3 start');
				var quotation={};
				quotation.car=General.data.selected_car(rcmAvailableCars,Data.controller.get('CarSizeID'));
				if(!quotation.car){
					Log.add('step4.js: step3 no car');
					alert('There was an error processing your request. Please refresh the page and try again.');
					return;
				}
				quotation.insurance=General.data.selected_insurance(rcmInsuranceOptions,Data.controller.get('InsuranceID'));
				if(!quotation.insurance){
					Log.add('step4.js: step3 no insurance');
					alert('There was an error processing your request. Please refresh the page and try again.');
					return;
				}
				quotation.mandatory=General.data.selected_mandatory_fee(rcmMandatoryFees,Data.controller.get('CarSizeID'));
				if(!quotation.mandatory){
					Log.add('step4.js: step3 no mandatory');
					alert('There was an error processing your request. Please refresh the page and try again.');
					return;
				}
				quotation.total=Step4.controller.total(
					quotation.car,
					quotation.insurance,
					quotation.mandatory
				);
				quotation.gst=Step4.controller.gst(Step4.controller.total(
					quotation.car,
					quotation.insurance,
					quotation.mandatory
				));
				quotation.day_avg=Step4.controller.day_avg(Step4.controller.total(
					quotation.car,
					quotation.insurance,
					quotation.mandatory
				),quotation.car.numofdays);
				quotation.discount_summary=General.data.discount_summary(
					rcmAvailableCarDetails,
					quotation.car.carsizeid
				);
				quotation.agent_to_collect=General.data.agent_to_collect(
					rcmAvailableCars,
					quotation.total,
					General.data.commissionitems(quotation.car,quotation.insurance)
				);
				if(quotation.agent_to_collect===0){
					alert('Unknown agency commission type '+availableCars[0].agencypaymenttype+'. Please refresh and try again');
				}
				Data.controller.set('Cost_Object',JSON.stringify(quotation));
				Data.controller.set('Agent_Object',JSON.stringify(rcmAgentInfo));
				Step4.controller.view_quotation(
					quotation.car,
					quotation.insurance,
					quotation.mandatory,
					quotation.total,
					quotation.gst,
					quotation.day_avg,
					quotation.agent_to_collect.value,
					quotation.agent_to_collect.type,
					quotation.discount_summary
				);
				Log.add('step4.js: step3 end');
			},
			booking:function(p1,error,p2){
				Data.controller.set('ReservationRef',	oAPI.ReservationRef());
				Data.controller.set('ReservationNo',	oAPI.ReservationNo());
				if(
					Data.controller.get('ReservationNo')==''
					||
					Data.controller.get('ReservationRef')==''
				){
					alert('There was an error: '+error);
					return;
				}
				window.top.location.href='step5.php';
			}
		},
		view_quotation:function(
			car,insurance,mandatory,total,gst,day_avg,
			agent_to_collect_value,agent_to_collect_type,discount
		){
			var html=Step4.view.head();
			html+=Step4.view.days(car);
			html+=Step4.view.insurance(insurance);
			html+=Step4.view.mandatory(mandatory);
			html+=Step4.view.discount(discount);
			html+=Step4.view.footer(
				total,
				gst,
				car.numofdays,
				day_avg,
				agent_to_collect_value,
				agent_to_collect_type
			);
			$('#reservation-quotation').html(html);
		},
		validate:function(){
			Log.add('validate: start');
			Step4.controller.submit.disable();
			
			Data.controller.set_from_name('firstname');
			Data.controller.set_from_name('lastname');
			Data.controller.set_from_name('AgentEmail');
			Data.controller.set_from_name('CustomerEmail');
			Data.controller.set_from_name('Phone');
			Data.controller.set_from_name('NoTravelling');
			Data.controller.set_from_name('ReferenceNo');
			
			Step4.controller._set_customer_data(
				Data.controller.get('firstname'),
				Data.controller.get('lastname'),
				Data.controller.get('CustomerEmail'),
				Data.controller.get('Phone'),
				Data.controller.get('NoTravelling')
			);
	
			if(oAPI.CheckCustomerDataOK()==false){
				Log.add('validate: CheckCustomerDataOK is false');
				if(rcmAlert==''){
					Log.add('validate: '+rcmAlert);
					alert(rcmAlert);
				}else{
					Log.add('validate: rcmAlert is empty, undefined error');
					alert('There was an error. Please refresh the page and try again.');
				}
				Step4.controller.submit.enable();
				return false;
			}
			Log.add('validate: CheckCustomerDataOK is ok');
			Step4.controller._booking();

			Log.add('validate: end');
			return false;
		},
		_booking:function(){
			Log.add('_booking: start');
			
			oAPI.ClearOptionalItems();
			Log.add('_booking: cleared optional items');
			
			oAPI.SetInsurance(Data.controller.get('InsuranceID'));
			Log.add('_booking: set insurance');

			oAPI.OnBookingDone(Step4.controller.callback.booking);
			oAPI.MakeBooking(
				Data.controller.get('CategoryTypeInfoID'),
				Data.controller.get('PickupLocationID'),
				Data.controller.get('PickupDay')+'/'+Data.controller.get('PickupMonth')+'/'+Data.controller.get('PickupYear'),
				Data.controller.get('PickupTime'),
				Data.controller.get('DropoffLocationID'),
				Data.controller.get('DropoffDay')+'/'+Data.controller.get('DropoffMonth')+'/'+Data.controller.get('DropoffYear'),
				Data.controller.get('ReturnTime'),
				Data.controller.get('Age'),
				Data.controller.get('CarSizeID'),
				2,
				'', // refid
				Data.controller.get('PromoCode'),
				Data.controller.get('AgencyCode'),
				Data.controller.get('AgencyName'),
				Data.controller.get('ReferenceNo'),
				1,
				Data.controller.get('AgentEmail')
			);
		},
		_set_customer_data:function(firstname,lastname,customeremail,phone,notravelling){
			oAPI.SetCustomerData(
				firstname,
				lastname,
				customeremail,
				phone,
				'', //Mobile
				'', //dob
				'', //license
				'', //issuedin
				'', //expire
				'', //address
				'', //city
				'', //txtState
				'', //postcode
				'', //country
				'', //Fax
				Step4.data.found_us, //foundus
				'', // Remarks
				notravelling,
				'', //txtFlightNo
				'', // flight no out
				'', //txtCollectionPoint
				'', // return point
				''
			);
		},
		day_avg:function(total,days){
			return total/days;
		},
		gst:function(total){
			if(Step4.data.country=='AU'){
				return total/11;
			}
			if(Step4.data.country=='NZ'){
				return total* 3 / 23;
			}
			return 0;
		},
		total:function(car,insurance,mandatory_array){
			var total=0;
			total+=parseFloat(car.total);
			total+=parseFloat(insurance.displaytotal);
			for(var i in mandatory_array){
				total+=parseFloat(mandatory_array[i].displaytotal);
			}
			return total;
		},
		start:function(){
			Log.add('start start');
			$('#reservation-quotation').html(Step4.view.head()+Step4.view.loading());
			oAPI.OnAlerts(Step4.controller.callback.on_alert);
			oAPI.OnReadyStep3(Step4.controller.callback.step3);
			Step4.data.timeout_resource=setTimeout(Step4.controller.callback.api_timeout,45000);
			oAPI.GetStep3(
				Data.controller.get('CategoryTypeInfoID'),
				Data.controller.get('PickupLocationID'),
				Data.controller.get('PickupDay')+'/'+Data.controller.get('PickupMonth')+'/'+Data.controller.get('PickupYear'),
				Data.controller.get('PickupTime'),
				Data.controller.get('DropoffLocationID'),
				Data.controller.get('DropoffDay')+'/'+Data.controller.get('DropoffMonth')+'/'+Data.controller.get('DropoffYear'),
				Data.controller.get('ReturnTime'),
				Data.controller.get('Age'),							Data.controller.get('CarSizeID'),
				Data.controller.get('PromoCode'),			1,		Data.controller.get('AgencyCode')
			);
			Data.controller.get_to_name('firstname');
			Data.controller.get_to_name('lastname');
			Data.controller.get_to_name('AgentEmail');
			Data.controller.get_to_name('CustomerEmail');
			Data.controller.get_to_name('Phone');
			Data.controller.get_to_name('NoTravelling');
			Data.controller.get_to_name('ReferenceNo');
			Log.add('start end');
		}
	},
	view:{
		discount:function(discount){
			var html='';
			for(var name in discount){
				html+=Template.run(
					$('#html-reservation-quotation-discount').html(),
					{
						fees:Template.number_to_money(discount[name]),
						name:name
					}
				);
			}
			return html;
		},
		days:function(availableCar){
			availableCar.totrate=Template.number_to_money(parseFloat(availableCar.totrate));
			availableCar.avgrate=Template.number_to_money(parseFloat(availableCar.avgrate));
			return Template.run(
				$('#html-reservation-quotation-days').html(),
				availableCar
			);
		},
		insurance:function(insuranceOption){
			insuranceOption.displaydaily=Template.number_to_money(parseFloat(insuranceOption.displaydaily));
			insuranceOption.displaytotal=Template.number_to_money(parseFloat(insuranceOption.displaytotal));
			insuranceOption.name=insuranceOption.name.replace(' (AGENT)','');
			return Template.run(
				$('#html-reservation-quotation-excess').html(),
				insuranceOption
			);
		},
		mandatory:function(mandatoryFees){
			var html='';
			for(var i in mandatoryFees){
				mandatoryFees[i].displaydaily=Template.number_to_money(parseFloat(mandatoryFees[i].displaydaily));
				mandatoryFees[i].displaytotal=Template.number_to_money(parseFloat(mandatoryFees[i].displaytotal));
				html+=Template.run(
					$('#html-reservation-quotation-mandatory').html(),
					mandatoryFees[i]
				);
			}
			return html;
		},
		footer:function(total,gst,days,day_avg,agent_to_collect_value,agent_to_collect_type){
			return Template.run(
				$('#html-reservation-quotation-footer').html(),
				{
					total:Template.number_to_money(total),
					days:days,
					day_avg:Template.number_to_money(day_avg),
					gst:Template.number_to_money(gst),
					agent:Template.number_to_money(agent_to_collect_value),
					type:agent_to_collect_type
				}
			);
		},
		head:function(){
			return $('#html-reservation-quotation-head').html();
		},
		loading:function(){
			return $('#html-reservation-quotation-loading').html();
		}
	}
};
$(document).ready(function(){
	if(Data.controller.get('AgencyCode')===null||Data.controller.get('AgencyCode')==''){
		window.top.location.href='index.php';
		return;
	}
	Step4.controller.start();
});