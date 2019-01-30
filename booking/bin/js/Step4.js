var oAPI=new rcmAPI();
var signScript='bin/signedRequest.php';

var Step4={
	data:{},
	controller:{
		start_live_timeout:null,
		timeout_triggered:false,
		api_timeout:function(){
			View.errors.clean();
			View.errors.show(['There was an error retrieving the data. Please <a href="">reload</a> the page and try again.']);
			Step4.controller.timeout_triggered=true;
		},
		start_live:function(){
			Log.add('start live');
			oAPI.OnReadyStep3(Step4.controller.ready_callback);
			Step4.controller.start_live_timeout=setTimeout(Step4.controller.api_timeout,30000);
			oAPI.GetStep3(
				Step4.data.CategoryTypeID
				,Step4.data.PickupLocationID
				,Step4.data.PickupDate
				,Step4.data.PickupTime
				,Step4.data.DropOffLocationID
				,Step4.data.ReturnDate
				,Step4.data.ReturnTime
				,Step4.data.Age
				,Step4.data.Vehiclecategoryid
				,Step4.data.PromoCode
				,0
			);
			Log.add('end live');
		},
		book_now:function(){
			$('#book_now_button').hide();
			oAPI.OnBookingDone(Step4.controller.book_now_finish);
			var error_messages=[];
			var is_error=0;
			var firstname=Step4.controller.validate_text($('#firstname').val());
			var lastname=Step4.controller.validate_text($('#lastname').val());
			var country_code=Step4.controller.validate_phone($('#country_code').val());
			var phone=Step4.controller.validate_phone($('#phone').val());
			var email=Step4.controller.validate_email($('#email').val());
			var notraveling=Step4.controller.validate_notraveling($('#notraveling').val());
			var noadults=$('#notraveling').val();
			if(firstname===false || lastname===false ){
				error_messages.push('You must enter a first and last name');
				$('#book_now_button').show();
				is_error++;
			}
			if(email===false){
				error_messages.push('You must enter an email address');
				$('#book_now_button').show();
				is_error++;
			}
			if(country_code===false){
				error_messages.push('You must enter a valid country code');
				$('#book_now_button').show();
				is_error++;
			}
			if(phone===false){
				error_messages.push('You must enter a valid phone number');
				$('#book_now_button').show();
				is_error++;
			}
			if(notraveling===false){
				error_messages.push('You must select number of people travelling');
				$('#book_now_button').show();
				is_error++;
			}
			if($('#tc:checked').length===0){				
				error_messages.push('You must agree to the terms and conditions');
				$('#book_now_button').show();
				is_error++;
			}
			
			if(is_error){
				View.errors.show(error_messages,'#form-error-book-now');
				return;
			}
			
			Step4.controller._set_customer();
			View.errors.clean('#form-error-book-now');
			if(oAPI.CheckCustomerDataOK()==false){
				if(rcmAlert==''){
					View.errors.show(['All fields are required'],'#form-error-book-now');
				}else{
					View.errors.show([rcmAlert.replace(/API.*?\:\s/g,'')],'#form-error-book-now');
				}
				$('#book_now_button').show();
				return;
			}else if(Step4.data.bookmode == 2){
				Controller.hubspot_submit(
					email,Step4.data.PickupLocation_name,
					Step4.data.PickupDate,
					Step4.data.DropOffLocation_name,
					Step4.data.ReturnDate,
					Step4.data.CategoryType_name,
					country_code + phone,
					noadults,
					'lead',
					firstname,
					lastname,
					parseFloat(Step4.data.total_price) + parseFloat(Step4.data.total_gst)
				);
			}
			
			Step4.controller._set_optional_extras();
			Step4.controller._set_km_charges();
			Step4.controller._set_insurance_options();
			Step4.controller._set_make_booking();
			$('#CustomerData').val(oAPI.GetCustomerData());
		},
		book_now_finish:function(){
			$('#ReservationRef').val(oAPI.ReservationRef());
			$('#ReservationNo').val(oAPI.ReservationNo());
			$('#frmStep4').addClass('can-submit');
			$('#frmStep4').submit();
		},
		_set_optional_extras:function(){
			var data=JSON.parse(Step4.data.optional_extras_json);
			oAPI.ClearOptionalItems();
			for(var i=0;i<data.length;i++){
				oAPI.AddToOptionalItems(data[i].id,data[i].qty);
			}
		},
		_set_km_charges:function(){
			if(!Step4.data.km_charges_json){
            	return;
            }
			var data=JSON.parse(Step4.data.km_charges_json);
			oAPI.SetExtraKms(data.id);
		},
		_set_insurance_options:function(){
            if(!Step4.data.insurance_json){
            	return;
            }
			var data=JSON.parse(Step4.data.insurance_json);
			oAPI.SetInsurance(data.id);
		},
		_set_customer:function(){
			oAPI.SetCustomerData({
				firstname:$('#firstname').val(),
				lastname:$('#lastname').val(),
				email:$('#email').val(),
				// phone:$('#phone').val(),
				phone:$('#country_code').val() + $('#phone').val(),
			});

			oAPI.SetNoTraveling(Step4.controller.validate_notraveling($('#notraveling').val()));
			oAPI.SetFoundus($('#foundus').val());
			oAPI.SetNewsletter($('#opt-in:checked').length==0?0:1);
		},
		_set_make_booking:function(){
			oAPI.MakeBooking({
                vehiclecategorytypeid:Step4.data.CategoryTypeID,
                pickuplocationid:Step4.data.PickupLocationID,
                pickupdate:Step4.data.PickupDate,
                pickuptime:Step4.data.PickupTime,
                dropofflocationid:Step4.data.DropOffLocationID,
                dropoffdate:Step4.data.ReturnDate,
                dropofftime:Step4.data.ReturnTime,
                ageid: Step4.data.Age,
                vehiclecategoryid:Step4.data.Vehiclecategoryid,
                // bookingtype:1, //quote
				// bookingtype:2, //book
				bookingtype:Step4.data.bookmode,
            });
		},
		validate:function(){
			if(Step4.controller.timeout_triggered){
				Log.add('timeout triggered');
				Step4.controller.timeout_triggered=false;
				clearTimeout(Step4.controller.start_live_timeout);
				return false;
			}
			$('#update-search').removeAttr('disabled');
			clearTimeout(Step4.controller.start_live_timeout);
			View.errors.clean();
		},
		load_rental_source:function(){
			var opts=[];
			var selected=Step4.data.foundus;
			for(var i in rcmRentalSource){
				if(rcmRentalSource[i].locationid!='0'&&Step4.data.PickupLocationID!=rcmRentalSource[i].locationid){
					continue;
				}
				if(selected==''&&rcmRentalSource[i].default==true){
					selected=rcmRentalSource[i].id;
				}
				opts.push(Select.option_object(rcmRentalSource[i].rentalsource,rcmRentalSource[i].id));
			}
			return Select.html(opts,selected);
		},
		price_details:{
			show:function(el){
				$(el).parent().find('.show').hide();
				$(el).parent().find('.hide').show();
				$(el).parents('.car').find('.details').show();
				$(el).parents('.car').find('.location').show();
			},
			hide:function(el){
				$(el).parent().find('.show').show();
				$(el).parent().find('.hide').hide();
				$(el).parents('.car').find('.details').hide();
				$(el).parents('.car').find('.location').hide();
			}
		},
		ready_callback:function(){
			Log.add('callback');
			if(Step4.controller.validate()==false){
				Log.add('validate error');
				return;
			}
			if(Controller.check_most_popular(rcmAvailableCars[0].vehicledescriptionurl,Step4.data.most_popular)){
				Log.add('most-popular');
				$('#car .image .most-popular').show();
			}
			$('#total-top').html('$'+parseFloat(Controller.price_rounding(Step4.data.total_price,Step4.data.country)).toFixed(2));
			$('#foundus').html(Step4.controller.load_rental_source());
			$('#deposit').html(Step4.controller.deposit().toFixed(2));
			$('#deposit_currency').html(Step4.controller.deposit_currency());
			// $('form input[name="total_deposit"]').val(Step4.controller.deposit().toFixed(2));
			$('#car .peoplegraphic').html(Step4.view.peoplegraphic(rcmAvailableCars[0].numberofadults,rcmAvailableCars[0].numberofchildren));
			$('#car .cartitle').html(Step4.view.car_title(Step4.data.CategoryType_name));

			var insuranceHTML = '';

			if(Step4.data.insurance_json){
				insuranceHTML = Step4.controller._build_insurance(JSON.parse(Step4.data.insurance_json));
            }

			$('#price_details .details').html(
				Step4.view.price_details_header()
				+Step4.controller._build_daily_rate(JSON.parse(Step4.data.daily_rate_json))
				+Step4.controller._build_extra_fees(JSON.parse(Step4.data.extra_fees_json))
				+insuranceHTML
				+Step4.controller._build_optional_extras(JSON.parse(Step4.data.optional_extras_json))
				+Step4.controller._build_discount(JSON.parse(Step4.data.discount_json))
				+Step4.view.total(Step4.data.total_gst,Controller.price_rounding(Step4.data.total_price,Step4.data.country))
			);
			if(rcmAvailableCars[0].available==2){
				// $('#book_now_button').val('SEND BOOKING REQUEST');
			}
		}
	}
};

$(document).ready(function(){
	if(typeof(Step4.data.CategoryType_imageurl)=='undefined'||Step4.data.CategoryType_imageurl==''){
		window.top.location.href='step1.php';
	}
	Step4.controller.start_live();
});
