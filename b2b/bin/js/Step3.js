var oAPI=new rcmAPI();
var Step3={
	data:{
		timeout_resource:null,
		timeout_triggered:false
	},
	controller:{
		callback:{
			on_alert:function(){
				Log.add('on_alert start');
				if(Step2.data.timeout_triggered){
					Log.add('on_alert timeout triggered');
					Step2.data.timeout_triggered=false;
					clearTimeout(Step3.data.timeout_resource);
					return;
				}
				clearTimeout(Step3.data.timeout_resource);
				if(rcmAlert!=''){
					alert(rcmAlert);
					Log.add('on_alert rcmAlert end');
					return;
				}
				Log.add('on_alert end');
				return;
			},
			api_timeout:function(){
				Step3.data.timeout_triggered=true;
				alert("There was an error retrieving the data. Please reload the page and try again.");
			},
			step3:function(){
				Log.add('step3 start');
				if(Step3.data.timeout_triggered){
					Log.add('step3 timeout triggered');
					Step3.data.timeout_triggered=false;
					clearTimeout(Step3.data.timeout_resource);
					return;
				}
				clearTimeout(Step3.data.timeout_resource);
				Step3.controller.view_insurance();
				Log.add('step3 end');
			}
		},
		view_insurance:function(){
			Log.add('view_insurance start');
			var html=Step3.view.insurance.head();
			html+=Step3.view.insurance.rows(rcmInsuranceOptions,['93']);
			html+=Step3.view.insurance.footer();
			$('#insurance-options').html(html);
			Log.add('view_insurance '+html);
			Log.add('view_insurance end');
		},
		form_submit:function(){
			Log.add('form_submit start');
			if(!$('input[name="InsuranceID"]:checked').val()){
				alert('Please select an insurance option');
				Log.add('form_submit end');
				return false;
			}
			Data.controller.set('InsuranceID',$('input[name="InsuranceID"]:checked').val());
			oAPI.SetInsurance($('input[name="InsuranceID"]:checked').val());
			window.location.href='step4.php';
			Log.add('form_submit end');
			return false;
		},
		start:function(){
			Log.add('start start');
			oAPI.OnAlerts(Step3.controller.callback.on_alert);
			oAPI.OnReadyStep3(Step3.controller.callback.step3);
			Step3.data.timeout_resource=setTimeout(Step3.controller.callback.api_timeout,45000);
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
			Log.add('start end');
		}
	},
	view:{
		insurance:{
			head:function(){
				return $('#html-insurance-options-head').html();
			},
			rows:function(insuranceOptions,blacklist_array){
				insuranceOptions.reverse();
				var html='';
				for(var i in insuranceOptions){
					if(blacklist_array.indexOf(insuranceOptions[i].id)!=-1){
						continue;
					}
					html+=Step3.view.insurance.row(insuranceOptions[i]);
				}
				return html;
			},
			row:function(insuranceOption){
				insuranceOption.excessfee=Template.number_to_money(parseFloat(insuranceOption.excessfee));
				insuranceOption.fees=Template.number_to_money(parseFloat(insuranceOption.fees));
				insuranceOption.checked='';
				if(insuranceOption.fees=='0.00'){
					insuranceOption.checked='checked="checked"';
				}
				insuranceOption.name=insuranceOption.name.replace(' (AGENT)','');
				insuranceOption.encoded_extradesc=btoa(insuranceOption.extradesc);
				return Template.run(
					$('#html-insurance-options-row').html(),
					insuranceOption
				);
			},
			footer:function(){
				return $('#html-insurance-options-footer').html();
			}
		}
	}
};
$(document).ready(function(){
	if(Data.controller.get('AgencyCode')===null||Data.controller.get('AgencyCode')==''){
		window.top.location.href='index.php';
		return;
	}
	Step3.controller.start();
});