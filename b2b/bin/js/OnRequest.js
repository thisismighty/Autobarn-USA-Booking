var oAPI=new rcmAPI();
var OnRequest={
	data:{
		carsizeid:0,
		timeout_triggered:false,
		timeout_resource:false
	},
	controller:{
		submit:{
			enable:function(){
				$('input[name="submit2"]').prop('disabled','');
			},
			disable:function(){
				$('input[name="submit2"]').prop('disabled','disabled');
			}
		},
		start:function(){
			Log.add('start start');
			OnRequest.controller.submit.disable();
			oAPI.OnAlerts(OnRequest.controller.callback.on_alert);
			oAPI.OnReadyStep1(OnRequest.controller.callback.step1);
			OnRequest.data.timeout_resource=setTimeout(OnRequest.controller.callback.api_timeout,45000);
			oAPI.GetStep1();
			Log.add('start end');
		},
		callback:{
			api_timeout:function(){
				OnRequest.data.timeout_triggered=true;
				alert("There was an error retrieving the data. Please reload the page and try again.");
			},
			on_alert:function(){
				Log.add('on_alert start');
				if(OnRequest.data.timeout_triggered){
					Log.add('on_alert timeout triggered');
					OnRequest.data.timeout_triggered=false;
					clearTimeout(OnRequest.data.timeout_resource);
					return;
				}
				clearTimeout(OnRequest.data.timeout_resource);
				if(rcmAlert!=''){
					Data.controller.set('_error',rcmAlert);
					OnRequest.view.error(rcmAlert+' <a href="index.php">Go back to the booking system and try again</a>.');
					Log.add('on_alert rcmAlert end');
					return;
				}
				Log.add('on_alert end');
				return;
			},
			step1:function(){
				Log.add('step1 start');
				if(OnRequest.data.timeout_triggered){
					Log.add('step1 timeout triggered');
					OnRequest.data.timeout_triggered=false;
					clearTimeout(OnRequest.data.timeout_resource);
					return;
				}
				clearTimeout(OnRequest.data.timeout_resource);
				OnRequest.data.timeout_resource=setTimeout(OnRequest.controller.callback.api_timeout,45000);
				oAPI.OnReadyStep2(OnRequest.controller.callback.step2);
				oAPI.GetStep2(
					Data.controller.get('CategoryTypeInfoID'),
					Data.controller.get('PickupLocationID'),
					Data.controller.get('PickupDay')+'/'+Data.controller.get('PickupMonth')+'/'+Data.controller.get('PickupYear'),
					Data.controller.get('PickupTime'),
					Data.controller.get('DropoffLocationID'),
					Data.controller.get('DropoffDay')+'/'+Data.controller.get('DropoffMonth')+'/'+Data.controller.get('DropoffYear'),
					Data.controller.get('PickupTime'),
					Data.controller.get('Age'),
					Data.controller.get('PromoCode'),
					0,
					Data.controller.get('AgencyCode'),
					Data.controller.get('AgencyName')
				);
				Log.add('step1 end');
			},
			step2:function(){
				Log.add('step2 start');
				if(OnRequest.data.timeout_triggered){
					Log.add('step2 timeout triggered');
					OnRequest.data.timeout_triggered=false;
					clearTimeout(OnRequest.data.timeout_resource);
					return;
				}
				clearTimeout(OnRequest.data.timeout_resource);
				var valid=General.controller.validate_step_2(
					rcmLocationFees,rcmLocationInfo,rcmAvailableCars,
					Template.str_date_to_object(
						Data.controller.get('PickupDay')+'/'+Data.controller.get('PickupMonth')+'/'+Data.controller.get('PickupYear')
					),
					Template.str_date_to_object(
						Data.controller.get('DropoffDay')+'/'+Data.controller.get('DropoffMonth')+'/'+Data.controller.get('DropoffYear')
					),
					Data.controller.get('PickupLocationID'),
					Data.controller.get('DropoffLocationID')
				);
				if(valid!==true){
					Log.add('step2 not valid');
					Log.add(valid);
					OnRequest.view.error(valid+' <a href="index.php">Go back to the booking system and try again</a>.');
					return;
				}
				var found=false;
				for(var i=0;i<rcmAvailableCars.length;i++){
					if(rcmAvailableCars[i].carsizeid==OnRequest.data.carsizeid){
						found=true;
						break;
					}
				}
				if(!found){
					Log.add('step2 not valid, vehicle id not found');
					OnRequest.view.error('The vehicle was not found. <a href="index.php">Go back to the booking system and try again</a>.');
					return;
				}
				oAPI.OnReadyStep3(OnRequest.controller.callback.step3);
				OnRequest.data.timeout_resource=setTimeout(OnRequest.controller.callback.api_timeout,45000);
				oAPI.GetStep3(
					Data.controller.get('CategoryTypeInfoID'),
					Data.controller.get('PickupLocationID'),
					Data.controller.get('PickupDay')+'/'+Data.controller.get('PickupMonth')+'/'+Data.controller.get('PickupYear'),
					Data.controller.get('PickupTime'),
					Data.controller.get('DropoffLocationID'),
					Data.controller.get('DropoffDay')+'/'+Data.controller.get('DropoffMonth')+'/'+Data.controller.get('DropoffYear'),
					Data.controller.get('PickupTime'),
					Data.controller.get('Age'),		OnRequest.data.carsizeid,
					'',				1,				Data.controller.get('AgencyCode')
				);
				Log.add('step2 end');
			},
			step3:function(){
				Log.add('step3 start');
				if(OnRequest.data.timeout_triggered){
					Log.add('step3 timeout triggered');
					OnRequest.data.timeout_triggered=false;
					clearTimeout(OnRequest.data.timeout_resource);
					return;
				}
				clearTimeout(OnRequest.data.timeout_resource);
				OnRequest.view.insurance.view(OnRequest.view.insurance.rows(rcmInsuranceOptions,['93']));
				OnRequest.controller.submit.enable();
				Log.add('step3 end');
			}
		}
	},
	view:{
		error:function(msg){
			$('#api_error .msg').html(msg);
			$('#api_error').show();
		},
		insurance:{
			view:function(html){
				$('#excess').html(html);
			},
			rows:function(insuranceOptions,blacklist_array){
				insuranceOptions.reverse();
				var html='';
				for(var i in insuranceOptions){
					if(blacklist_array.indexOf(insuranceOptions[i].id)!=-1){
						continue;
					}
					html+=OnRequest.view.insurance.row(insuranceOptions[i]);
				}
				return html;
			},
			row:function(insuranceOption){
				insuranceOption.excessfee=Template.number_to_money(parseFloat(insuranceOption.excessfee));
				insuranceOption.fees=Template.number_to_money(parseFloat(insuranceOption.fees));
				insuranceOption.checked='';
				if(insuranceOption.fees=='0.00'){
					insuranceOption.checked='selected="selected"';
				}
				insuranceOption.name=insuranceOption.name.replace(' (AGENT)','');
				insuranceOption.encoded_extradesc=btoa(insuranceOption.extradesc);
				return Template.run(
					$('#html-insurance-options-row').html(),
					insuranceOption
				);
			}
		}
	}
};
