var oAPI=new rcmAPI();
var Index={
	data:{
		start_live_timeout:null,
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
			agencycode:function(){
				return $('input[name="AgencyCode"]').val();
			},
			agencyname:function(){
				return $('input[name="AgencyName"]').val();
			},
			promocode:function(){
				return $('input[name="promocode"]').val();
			},
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
				Index.data.timeout_triggered=true;
				Index.controller.submit.enable();
				alert("There was an error retrieving the data. Please reload the page and try again.");
			},
			on_alert:function(){
				Log.add('on_alert start');
				Index.controller.submit.enable();
				if(Index.data.timeout_triggered){
					Log.add('on_alert timeout triggered');
					Index.data.timeout_triggered=false;
					clearTimeout(Index.data.start_live_timeout);
					return;
				}
				clearTimeout(Index.data.start_live_timeout);
				if(rcmAlert!=''){
					$('#api_error div.msg').html(rcmAlert);
					$('#api_error').show();
					$('input[name="submit2"]').prop('disabled','');
					Log.add('on_alert rcmAlert end');
					return;
				}
				Log.add('on_alert end');
				return;
			},
			step1:function(){
				Log.add('step1 start');
				Index.controller.submit.enable();
				if(Index.data.timeout_triggered){
					Log.add('step1 timeout triggered');
					Index.data.timeout_triggered=false;
					clearTimeout(Index.data.start_live_timeout);
					return;
				}
				clearTimeout(Index.data.start_live_timeout);
				General.controller.load.location.pickup(
					rcmLocationInfo,Data.controller.get('PickupLocationID'),'select[name="PickupLocationID"]'
				);
				General.controller.load.location.dropoff(
					rcmLocationInfo,Data.controller.get('DropoffLocationID'),'select[name="DropoffLocationID"]'
				);
				if(Data.controller.get('_error')!==''&&Data.controller.get('_error')!==null){
					Log.add('showing error '+Data.controller.get('_error'));
					$('#api_error div.msg').html(Data.controller.get('_error'));
					$('#api_error').show();
					Data.controller.set('_error','');
				}
				Data.controller.set('CategoryTypeInfoID',rcmCategoryTypeInfo[0].id);
				Log.add('step1 end');
			},
			step2:function(){
				Log.add('step2 start');
				if(Index.data.timeout_triggered){
					Log.add('step2 timeout triggered');
					Index.data.timeout_triggered=false;
					clearTimeout(Index.data.start_live_timeout);
					Index.controller.submit.enable();
					return;
				}
				clearTimeout(Index.data.start_live_timeout);
				var valid=General.controller.validate_step_2(
					rcmLocationFees,rcmLocationInfo,rcmAvailableCars,
					Template.str_date_to_object(Index.controller.get.pickup.date()),
					Template.str_date_to_object(Index.controller.get.dropoff.date()),
					Index.controller.get.pickup.location_id(),
					Index.controller.get.dropoff.location_id()
				);
				if(valid!==true){
					$('#api_error div.msg').html(valid);
					$('#api_error').show();
					Index.controller.submit.enable();
					return;
				}
				Index.controller.save();
				Log.add('step2 end');
				window.location.href='step2.php';
				return;
			}
		},
		save:function(){
			Data.controller.set('PickupLocationID',	Index.controller.get.pickup.location_id());
			Data.controller.set('DropoffLocationID',Index.controller.get.dropoff.location_id());
			Data.controller.set('PickupLocationName',
				General.data.location_name_by_id(rcmLocationInfo,Index.controller.get.pickup.location_id())
			);
			Data.controller.set('DropoffLocationName',
				General.data.location_name_by_id(rcmLocationInfo,Index.controller.get.dropoff.location_id())
			);
			Data.controller.set('PickupDay',		$('select[name="PickupDay"]').val());
			Data.controller.set('PickupMonth',		$('select[name="PickupMonth"]').val());
			Data.controller.set('PickupYear',		$('select[name="PickupYear"]').val());
			Data.controller.set('DropoffDay',		$('select[name="DropoffDay"]').val());
			Data.controller.set('DropoffMonth',		$('select[name="DropoffMonth"]').val());
			Data.controller.set('DropoffYear',		$('select[name="DropoffYear"]').val());
			Data.controller.set('PromoCode',		Index.controller.get.promocode());
			Data.controller.set('AgencyCode',		Index.controller.get.agencycode());
			Data.controller.set('AgencyName',		Index.controller.get.agencyname());
		},
		validation:function(){
			Index.controller.submit.disable();
			oAPI.OnReadyStep2(Index.controller.callback.step2);
			Index.data.start_live_timeout=setTimeout(Index.controller.callback.api_timeout,45000);
			oAPI.GetStep2(
				rcmCategoryTypeInfo[0].id,
				Index.controller.get.pickup.location_id(),
				Index.controller.get.pickup.date(),
				Data.controller.get('PickupTime'),
				Index.controller.get.dropoff.location_id(),
				Index.controller.get.dropoff.date(),
				Data.controller.get('PickupTime'),
				Data.controller.get('Age'),
				Index.controller.get.promocode(),
				0,
				Index.controller.get.agencycode(),
				Index.controller.get.agencyname()
			);
			Log.add('validation calling step 2');
			return false;
		},
		start:function(){
			Log.add('start start');
			Index.controller.submit.disable();
			oAPI.OnAlerts(Index.controller.callback.on_alert);
			General.controller.load.agency(
				Data.controller.get('AgencyCode'),	Data.controller.get('AgencyName'),		Data.controller.get('PromoCode'),
				'input[name="AgencyCode"]',			'input[name="AgencyName"]',				'input[name="promocode"]'
			);
			General.controller.load.date(
				Data.controller.get('PickupDay'),	Data.controller.get('PickupMonth'),		Data.controller.get('PickupYear'),
				'select[name="PickupDay"]',			'select[name="PickupMonth"]',			'select[name="PickupYear"]'
			);
			General.controller.load.date(
				Data.controller.get('DropoffDay'),	Data.controller.get('DropoffMonth'),	Data.controller.get('DropoffYear'),
				'select[name="DropoffDay"]',		'select[name="DropoffMonth"]',			'select[name="DropoffYear"]'
			);
			oAPI.OnReadyStep1(Index.controller.callback.step1);
			Index.data.start_live_timeout=setTimeout(Index.controller.callback.api_timeout,45000);
			oAPI.GetStep1();
			Log.add('start end');
		}
	},
	view:{}
};
$(document).ready(function(){
	Data.controller.init();
	Index.controller.start();
});
