var oAPI=new rcmAPI();
var Step2={
	data:{
		timeout_resource:null,
		timeout_triggered:false
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
		get:{
			pickup:{
				location_id:function(){
					return $('select[name="PickupLocationID"]').val();
				},
				date:function(){
					return General.data.date(
						'select[name="PickupDay"]',		'select[name="PickupMonth"]',	'select[name="PickupYear"]'
					);
				}
			},
			dropoff:{
				location_id:function(){
					return $('select[name="DropoffLocationID"]').val()!='Same'
						?$('select[name="DropoffLocationID"]').val()
						:$('select[name="PickupLocationID"]').val();
				},
				date:function(){
					return General.data.date(
						'select[name="DropoffDay"]',	'select[name="DropoffMonth"]',	'select[name="DropoffYear"]'
					);
				}
			}
		},
		callback:{
			api_timeout:function(){
				Step2.data.timeout_triggered=true;
				alert("There was an error retrieving the data. Please reload the page and try again.");
			},
			on_alert:function(){
				Log.add('on_alert start');
				if(Step2.data.timeout_triggered){
					Log.add('on_alert timeout triggered');
					Step2.data.timeout_triggered=false;
					clearTimeout(Step2.data.timeout_resource);
					return;
				}
				clearTimeout(Step2.data.timeout_resource);
				if(rcmAlert!=''){
					Data.controller.set('_error',rcmAlert);
					window.location.href='index.php';
					Log.add('on_alert rcmAlert end');
					return;
				}
				Log.add('on_alert end');
				return;
			},
			step1:function(){
				Log.add('step1 start');
				if(Step2.data.timeout_triggered){
					Log.add('step1 timeout triggered');
					Step2.data.timeout_triggered=false;
					clearTimeout(Step2.data.timeout_resource);
					return;
				}
				clearTimeout(Step2.data.timeout_resource);
				General.controller.load.location.pickup(
					rcmLocationInfo,Data.controller.get('PickupLocationID'),'select[name="PickupLocationID"]'
				);
				General.controller.load.location.dropoff(
					rcmLocationInfo,Data.controller.get('DropoffLocationID'),'select[name="DropoffLocationID"]'
				);
				Step2.data.timeout_resource=setTimeout(Step2.controller.callback.api_timeout,45000);
				oAPI.OnReadyStep2(Step2.controller.callback.step2);
				oAPI.GetStep2(
					Data.controller.get('CategoryTypeInfoID'),
					Step2.controller.get.pickup.location_id(),
					Step2.controller.get.pickup.date(),
					Data.controller.get('PickupTime'),
					Step2.controller.get.dropoff.location_id(),
					Step2.controller.get.dropoff.date(),
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
				Log.add('step2 start stop');
				if(Step2.data.timeout_triggered){
					Log.add('step2 timeout triggered');
					Step2.data.timeout_triggered=false;
					clearTimeout(Step2.data.timeout_resource);
					return;
				}
				clearTimeout(Step2.data.timeout_resource);
				var valid=General.controller.validate_step_2(
					rcmLocationFees,rcmLocationInfo,rcmAvailableCars,
					Template.str_date_to_object(Step2.controller.get.pickup.date()),
					Template.str_date_to_object(Step2.controller.get.dropoff.date()),
					Data.controller.get('PickupLocationID'),
					Data.controller.get('DropoffLocationID')
				);
				if(valid!==true){
					Log.add('step2 not valid');
					Log.add(valid);
					Data.controller.set('_error',valid);
					window.location.href='index.php';
					return;
				}
				Step2.controller.view_vehicles();
				Log.add('step2 end');
			}
		},
		form_submit:function(){
			Log.add('form_submit start');
			$('#ifrm0').attr('src','');
			Step2.data.timeout_resource=setTimeout(Step2.controller.callback.api_timeout,45000);
			oAPI.OnReadyStep2(Step2.controller.callback.step2);
			oAPI.GetStep2(
				Data.controller.get('CategoryTypeInfoID'),
				Step2.controller.get.pickup.location_id(),
				Step2.controller.get.pickup.date(),
				Data.controller.get('PickupTime'),
				Step2.controller.get.dropoff.location_id(),
				Step2.controller.get.dropoff.date(),
				Data.controller.get('PickupTime'),
				Data.controller.get('Age'),
				Data.controller.get('PromoCode'),
				0,
				Data.controller.get('AgencyCode'),
				Data.controller.get('AgencyName')
			);
			Data.controller.set('PickupLocationID',	Step2.controller.get.pickup.location_id());
			Data.controller.set('DropoffLocationID',Step2.controller.get.dropoff.location_id());
			Data.controller.set('PickupLocationName',
				General.data.location_name_by_id(rcmLocationInfo,Step2.controller.get.pickup.location_id())
			);
			Data.controller.set('DropoffLocationName',
				General.data.location_name_by_id(rcmLocationInfo,Step2.controller.get.dropoff.location_id())
			);
			Data.controller.set('PickupDay',		$('select[name="PickupDay"]').val());
			Data.controller.set('PickupMonth',		$('select[name="PickupMonth"]').val());
			Data.controller.set('PickupYear',		$('select[name="PickupYear"]').val());
			Data.controller.set('DropoffDay',		$('select[name="DropoffDay"]').val());
			Data.controller.set('DropoffMonth',		$('select[name="DropoffMonth"]').val());
			Data.controller.set('DropoffYear',		$('select[name="DropoffYear"]').val());
			$('#available-cars').html(Step2.view.vehicles.loading());
			Log.add('form_submit end');
			return false;
		},
		view_vehicles:function(){
			Log.add('view_vehicles start');
			var html=Step2.view.vehicles.head();
			html+=Step2.view.vehicles.rows(rcmAvailableCars);
			$('#available-cars').html(html);
			Log.add('view_vehicles '+html);
			Log.add('view_vehicles end');
		},
		step3:function(carsizeid){
			Log.add('step3 start');
			Data.controller.set('CarSizeID',carsizeid);
			$('#ifrm0').attr('src','step3.php');
			Log.add('step3 end');
		},
		start:function(){
			Log.add('start start');
			Step2.controller.submit.disable();
			oAPI.OnAlerts(Step2.controller.callback.on_alert);
			General.controller.load.agency(
				Data.controller.get('AgencyCode'),	Data.controller.get('AgencyName'),	Data.controller.get('PromoCode'),
				'input[name="AgencyCode"]',			'input[name="AgencyName"]',			'input[name="promocode"]'
			);
			General.controller.load.date(
				Data.controller.get('PickupDay'),	Data.controller.get('PickupMonth'),	Data.controller.get('PickupYear'),
				'select[name="PickupDay"]',			'select[name="PickupMonth"]',		'select[name="PickupYear"]'
			);
			General.controller.load.date(
				Data.controller.get('DropoffDay'),	Data.controller.get('DropoffMonth'),	Data.controller.get('DropoffYear'),
				'select[name="DropoffDay"]',		'select[name="DropoffMonth"]',			'select[name="DropoffYear"]'
			);
			oAPI.OnReadyStep1(Step2.controller.callback.step1);
			Step2.data.timeout_resource=setTimeout(Step2.controller.callback.api_timeout,45000);
			oAPI.GetStep1();
			$('#available-cars').html(Step2.view.vehicles.loading());
			Log.add('start end');
		}
	},
	view:{
		vehicles:{
			loading:function(){
				return $('#html-available-cars-loading').html();
			},
			rows:function(availableCars){
				var html='';
				for(var i in availableCars){
					html+=Step2.view.vehicles.row(availableCars[i]);
				}
				return html;
			},
			row:function(availableCar){
				if(availableCar.available==2){
					return Template.run(
						$('#html-available-cars-row-request').html(),
						availableCar
					);
				}
				if(availableCar.available==0){
					availableCar.new_availablemsg=General.data.vehicle_availability_error(
						availableCar.availablemsg,false,false,false,
						'this vehicle category has a %days day minimum hire period'
					);
					if(availableCar.new_availablemsg!=availableCar.availablemsg){
						return Template.run(
							$('#html-available-cars-row-unavailable-because').html(),
							availableCar
						);
					}
					return Template.run(
						$('#html-available-cars-row-unavailable').html(),
						availableCar
					);
				}
				return Template.run(
					$('#html-available-cars-row').html(),
					availableCar
				);
			},
			head:function(){
				return $('#html-available-cars-head').html();
			}
		}
	}
};

$(document).ready(function(){
	if(Data.controller.get('AgencyCode')===null||Data.controller.get('AgencyCode')==''){
		window.location.href='index.php';
		return;
	}
	Step2.controller.start();
});