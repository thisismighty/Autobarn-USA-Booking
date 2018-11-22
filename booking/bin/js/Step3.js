var oAPI=new rcmAPI();
var signScript='bin/signedRequest.php';
// console.log(oAPI);
var Step3={
	data:{},
	controller:{
		start_live_timeout:null,
		timeout_triggered:false,
		api_timeout:function(){
			View.errors.clean();
			View.errors.show(['There was an error retrieving the data. Please <a href="">reload</a> the page and try again.']);
			Step3.controller.timeout_triggered=true;
		},
		start_fake:function(){
			rcmDriverAgesInfo = [{"id":"1","driverage":"18","defaultage":"False"},{"id":"2","driverage":"19","defaultage":"False"},{"id":"3","driverage":"20","defaultage":"False"},{"id":"4","driverage":"21","defaultage":"False"},{"id":"5","driverage":"22","defaultage":"False"},{"id":"6","driverage":"23","defaultage":"False"},{"id":"7","driverage":"24","defaultage":"False"},{"id":"8","driverage":"25","defaultage":"False"},{"id":"9","driverage":"26+","defaultage":"False"}];
			rcmLocationFees = [{"loctypeid":"1","loctype":"pickup","locationid":"7","currencyname":"AUD","currencysymbol":"$","locdate":"23 Feb 2016","loctime":"10:00","dwname":"Tuesday","days4minimumbookingdaycheck":"30","location":"Brisbane","locdateloctime":"23-Nov-2015","tstavailable":"1","ierrorcode":"0","availablemessage":"","iafterhourpickup":"0","iafterhourdropoff":"0","tstminimumbookingday":"0","flightnoreqd":"0"},{"loctypeid":"2","loctype":"dropoff","locationid":"7","currencyname":"AUD","currencysymbol":"$","locdate":"23 Mar 2016","loctime":"10:00","dwname":"Wednesday","days4minimumbookingdaycheck":"30","location":"Brisbane","locdateloctime":"23-Nov-2015","tstavailable":"1","ierrorcode":"0","availablemessage":"","iafterhourpickup":"0","iafterhourdropoff":"0","tstminimumbookingday":"0","flightnoreqd":"0"}];
			rcmAvailableCarDetails = [];
			rcmAvailableCars = [{"column1":"rcmAvailableCars","statusid":"1","available":"1","availablemessage":"Available for booking","vehiclecategoryid":"19","vehiclecategory":"Stationwagon","categoryfriendlydescription":"Stationwagon (1-5 persons)","numberofhours":"0","hourlyrate":"0.0000","numberofdays":"30","avgrate":"45","totalratebeforediscount":"1350.0000","discounteddailyrate":"45","totalrateafterdiscount":"1350","totaldiscount":"0","discountrate":"0","discounttype":" ","total":"1350","freedays":"2","freedaysamount":"0.0000","imageurl":"http://secure20.rentalcarmanager.com.au/DB/AuAutoBarn191/station_wagon.png","mobileimage":"","numberofadults":"5","numberofchildren":"0","numberoflargecases":"0","numberofsmallcases":"0","sippcodes":"","vehicledescription1":"","vehicledescription2":"","vehicledescription3":"","vehicledescriptionurl":""}];rcmMandatoryFees = [{"id":"70","locationid":"0","vehiclecategoryid":"15","numberofdays":"30","qty":"1","fees":"45.0000","name":"Living Equipment Hitop","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"72","locationid":"0","vehiclecategoryid":"16","numberofdays":"30","qty":"1","fees":"45.0000","name":"Living Equipment Budgie","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"71","locationid":"0","vehiclecategoryid":"17","numberofdays":"30","qty":"1","fees":"45.0000","name":"Living Equipment Budget","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"73","locationid":"0","vehiclecategoryid":"19","numberofdays":"30","qty":"1","fees":"45.0000","name":"Living Equipment Stationwagon","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"True","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"58","locationid":"0","vehiclecategoryid":"22","numberofdays":"30","qty":"1","fees":"45.0000","name":"Living Equipment Kuga","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"97","locationid":"0","vehiclecategoryid":"26","numberofdays":"30","qty":"1","fees":"75.0000","name":"Living Equipment Hi5","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"114","locationid":"0","vehiclecategoryid":"28","numberofdays":"30","qty":"1","fees":"45.0000","name":"Living Equipment Chubby","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""}];rcmOptionalFees = [{"id":"56","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"3.0000","name":"Extra Driver","type":"Daily","maxprice":"75.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"True","extradesc":"extras/extradriver.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"89","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"7.0000","name":"GPS Navigation System","type":"Daily","maxprice":"140.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/gps.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"60","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"3.0000","name":"Tyre Waiver","type":"Daily","maxprice":"75.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/tyrewaver.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"68","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"3.0000","name":"Windscreen Waiver","type":"Daily","maxprice":"75.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/windscreenwaver.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"69","locationid":"0","vehiclecategoryid":"19","numberofdays":"30","fees":"45.0000","name":"Baby Seat","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"True","extradesc":"extras/baybseat.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"106","locationid":"0","vehiclecategoryid":"26","numberofdays":"30","fees":"45.0000","name":"Baby Seat","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"True","extradesc":"extras/baybseat.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"103","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"45.0000","name":"Booster Seat","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"True","extradesc":"extras/booster.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"104","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"15.0000","name":"Camping Chair","type":"Fixed","maxprice":"15.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"True","extradesc":"extras/chairs.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"112","locationid":"0","vehiclecategoryid":"28","numberofdays":"30","fees":"25.0000","name":"External Awning/Rear-Mounted Tent","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/externaltent.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"113","locationid":"0","vehiclecategoryid":"16","numberofdays":"30","fees":"25.0000","name":"External Awning/Rear-Mounted Tent","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/externaltent.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"116","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"25.0000","name":"Fan (240V power required)","type":"Fixed","maxprice":"25.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/fan.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"117","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"25.0000","name":"Heater (240V power required)","type":"Fixed","maxprice":"25.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/heater.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"98","locationid":"0","vehiclecategoryid":"26","numberofdays":"30","fees":"25.0000","name":"Living Equipment Hi5 5th person","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"81","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"35.0000","name":"Prepaid Gas Bottle Refill","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/gas.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"111","locationid":"0","vehiclecategoryid":"28","numberofdays":"30","fees":"30.0000","name":"Roofracks","type":"Fixed","maxprice":"30.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"False","extradesc":"extras/roofracks.html","extradesc1":"","extradesc2":"","extradesc3":""},{"id":"128","locationid":"0","vehiclecategoryid":"19","numberofdays":"30","fees":"9.0000","name":"Sleeping Bag","type":"Fixed","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","merchantfee":"False","fromage":"0","toage":"0","qtyapply":"True","extradesc":"","extradesc1":"","extradesc2":"","extradesc3":""}];rcmInsuranceOptions = [{"id":"93","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"16.0000","name":"Midway Protection $1200 Excess","type":"Daily","maxprice":"800.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"1200.0000","default":"False","merchantfee":"False","fromage":"18","toage":"75","qtyapply":"False","extradesc":"extras/CDW1.html","extradesc1":"Midway Protection $1200 Excess","extradesc2":"","extradesc3":"2"},{"id":"125","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"25.0000","name":"Protection Plus $0 Excess","type":"Daily","maxprice":"1250.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"0.0000","default":"False","merchantfee":"False","fromage":"18","toage":"75","qtyapply":"False","extradesc":"extras/CDW1.html","extradesc1":"Protection Plus $0 Excess","extradesc2":"","extradesc3":""},{"id":"95","locationid":"0","vehiclecategoryid":"0","numberofdays":"30","fees":"0.0000","name":"Standard Protection $2500 Excess","type":"Daily","maxprice":"0.0000","stampduty":"False","gst":"True","percentagetotalcost":"False","excessfee":"2500.0000","default":"False","merchantfee":"False","fromage":"18","toage":"75","qtyapply":"False","extradesc":"extras/CDW1.html","extradesc1":"Standard Protection $2500 Excess","extradesc2":"","extradesc3":"1"}];rcmKmCharges = [];
			rcmRentalSource = [{"id":"2","rentalsource":"Online Booking","locationid":"0","default":"False"}];
			rcmCountries = [{"id":"3","country":"Algeria","default":"False"},{"id":"4","country":"Angola","default":"False"},{"id":"5","country":"Antarctica","default":"False"},{"id":"6","country":"Argentina","default":"False"},{"id":"7","country":"Australia","default":"True"},{"id":"8","country":"Austria","default":"False"},{"id":"9","country":"Azerbaijan","default":"False"},{"id":"10","country":"Bangladesh","default":"False"},{"id":"11","country":"Belarus","default":"False"},{"id":"12","country":"Belgium","default":"False"},{"id":"13","country":"Belize","default":"False"},{"id":"14","country":"Bermuda","default":"False"},{"id":"15","country":"Bhutan","default":"False"},{"id":"16","country":"Botswana","default":"False"},{"id":"17","country":"Brazil","default":"False"},{"id":"18","country":"Brunei","default":"False"},{"id":"19","country":"Bulgaria","default":"False"},{"id":"20","country":"Burma","default":"False"},{"id":"21","country":"Burundi","default":"False"},{"id":"22","country":"Cambodia","default":"False"},{"id":"23","country":"Cameroon","default":"False"},{"id":"24","country":"Canada","default":"False"},{"id":"25","country":"Cayman Islands","default":"False"},{"id":"26","country":"Chad","default":"False"},{"id":"27","country":"Chile","default":"False"},{"id":"28","country":"China","default":"False"},{"id":"29","country":"Christmas Island","default":"False"},{"id":"30","country":"Colombia","default":"False"},{"id":"31","country":"Comoros","default":"False"},{"id":"32","country":"Cook Islands","default":"False"},{"id":"33","country":"Costa Rica","default":"False"},{"id":"34","country":"Cote d'Ivoire","default":"False"},{"id":"35","country":"Croatia","default":"False"},{"id":"36","country":"Cuba","default":"False"},{"id":"37","country":"Cyprus","default":"False"},{"id":"38","country":"Czech Republic","default":"False"},{"id":"39","country":"Denmark","default":"False"},{"id":"40","country":"Djibouti","default":"False"},{"id":"41","country":"Dominica","default":"False"},{"id":"42","country":"Dominican Republic","default":"False"},{"id":"43","country":"Ecuador","default":"False"},{"id":"44","country":"Egypt","default":"False"},{"id":"45","country":"Eritrea","default":"False"},{"id":"46","country":"Estonia","default":"False"},{"id":"47","country":"Ethiopia","default":"False"},{"id":"48","country":"Fiji","default":"False"},{"id":"49","country":"Finland","default":"False"},{"id":"50","country":"France","default":"False"},{"id":"51","country":"Gabon","default":"False"},{"id":"52","country":"Georgia","default":"False"},{"id":"53","country":"Germany","default":"False"},{"id":"54","country":"Ghana","default":"False"},{"id":"55","country":"Gibraltar","default":"False"},{"id":"56","country":"Greece","default":"False"},{"id":"57","country":"Greenland","default":"False"},{"id":"58","country":"Grenada","default":"False"},{"id":"59","country":"Guadeloupe","default":"False"},{"id":"60","country":"Guam","default":"False"},{"id":"61","country":"Guatemala","default":"False"},{"id":"62","country":"Guernsey","default":"False"},{"id":"63","country":"Guinea","default":"False"},{"id":"64","country":"Guyana","default":"False"},{"id":"65","country":"Haiti","default":"False"},{"id":"66","country":"Honduras","default":"False"},{"id":"67","country":"Hong Kong","default":"False"},{"id":"68","country":"Howland Island","default":"False"},{"id":"69","country":"Hungary","default":"False"},{"id":"70","country":"Iceland","default":"False"},{"id":"71","country":"India","default":"False"},{"id":"72","country":"Indian Ocean","default":"False"},{"id":"73","country":"Indonesia","default":"False"},{"id":"74","country":"Iran","default":"False"},{"id":"75","country":"Iraq","default":"False"},{"id":"76","country":"Ireland","default":"False"},{"id":"77","country":"Israel","default":"False"},{"id":"78","country":"Italy","default":"False"},{"id":"79","country":"Jamaica","default":"False"},{"id":"80","country":"Jan Mayen","default":"False"},{"id":"81","country":"Japan","default":"False"},{"id":"82","country":"Jarvis Island","default":"False"},{"id":"83","country":"Jersey","default":"False"},{"id":"84","country":"Johnston Atoll","default":"False"},{"id":"85","country":"Jordan","default":"False"},{"id":"86","country":"Kazakhstan","default":"False"},{"id":"87","country":"Kenya","default":"False"},{"id":"88","country":"Kingman Reef","default":"False"},{"id":"89","country":"Kiribati","default":"False"},{"id":"90","country":"Korea, North","default":"False"},{"id":"91","country":"Korea, South","default":"False"},{"id":"92","country":"Kuwait","default":"False"},{"id":"93","country":"Kyrgyzstan","default":"False"},{"id":"94","country":"Laos","default":"False"},{"id":"95","country":"Latvia","default":"False"},{"id":"96","country":"Lebanon","default":"False"},{"id":"97","country":"Lesotho","default":"False"},{"id":"98","country":"Liberia","default":"False"},{"id":"99","country":"Libya","default":"False"},{"id":"100","country":"Liechtenstein","default":"False"},{"id":"101","country":"Lithuania","default":"False"},{"id":"102","country":"Luxembourg","default":"False"},{"id":"103","country":"Macau","default":"False"},{"id":"104","country":"Madagascar","default":"False"},{"id":"105","country":"Malawi","default":"False"},{"id":"106","country":"Malaysia","default":"False"},{"id":"107","country":"Maldives","default":"False"},{"id":"108","country":"Mali","default":"False"},{"id":"109","country":"Malta","default":"False"},{"id":"110","country":"Martinique","default":"False"},{"id":"111","country":"Mauritania","default":"False"},{"id":"112","country":"Mauritius","default":"False"},{"id":"113","country":"Mayotte","default":"False"},{"id":"114","country":"Mexico","default":"False"},{"id":"115","country":"Moldova","default":"False"},{"id":"116","country":"Monaco","default":"False"},{"id":"117","country":"Mongolia","default":"False"},{"id":"118","country":"Montserrat","default":"False"},{"id":"119","country":"Morocco","default":"False"},{"id":"120","country":"Mozambique","default":"False"},{"id":"121","country":"Namibia","default":"False"},{"id":"122","country":"Nauru","default":"False"},{"id":"123","country":"Nepal","default":"False"},{"id":"124","country":"Netherlands","default":"False"},{"id":"125","country":"Netherlands Antilles","default":"False"},{"id":"126","country":"New Caledonia","default":"False"},{"id":"2","country":"New Zealand","default":"False"},{"id":"127","country":"Nicaragua","default":"False"},{"id":"128","country":"Niger","default":"False"},{"id":"129","country":"Nigeria","default":"False"},{"id":"130","country":"Niue","default":"False"},{"id":"131","country":"Norway","default":"False"},{"id":"132","country":"Oman","default":"False"},{"id":"133","country":"Pakistan","default":"False"},{"id":"134","country":"Palau","default":"False"},{"id":"135","country":"Panama","default":"False"},{"id":"136","country":"Papua New Guinea","default":"False"},{"id":"137","country":"Paraguay","default":"False"},{"id":"138","country":"Peru","default":"False"},{"id":"139","country":"Philippines","default":"False"},{"id":"140","country":"Poland","default":"False"},{"id":"141","country":"Portugal","default":"False"},{"id":"142","country":"Puerto Rico","default":"False"},{"id":"143","country":"Reunion","default":"False"},{"id":"144","country":"Romania","default":"False"},{"id":"145","country":"Russia","default":"False"},{"id":"146","country":"Rwanda","default":"False"},{"id":"147","country":"Samoa","default":"False"},{"id":"148","country":"San Marino","default":"False"},{"id":"149","country":"Saudi Arabia","default":"False"},{"id":"150","country":"Senegal","default":"False"},{"id":"151","country":"Serbia and Montenegro","default":"False"},{"id":"152","country":"Seychelles","default":"False"},{"id":"153","country":"Sierra Leone","default":"False"},{"id":"154","country":"Singapore","default":"False"},{"id":"155","country":"Slovakia","default":"False"},{"id":"156","country":"Slovenia","default":"False"},{"id":"157","country":"Solomon Islands","default":"False"},{"id":"158","country":"Somalia","default":"False"},{"id":"159","country":"South Africa","default":"False"},{"id":"160","country":"Spain","default":"False"},{"id":"161","country":"Sri Lanka","default":"False"},{"id":"162","country":"Sudan","default":"False"},{"id":"163","country":"Suriname","default":"False"},{"id":"164","country":"Svalbard","default":"False"},{"id":"165","country":"Swaziland","default":"False"},{"id":"166","country":"Sweden","default":"False"},{"id":"167","country":"Switzerland","default":"False"},{"id":"168","country":"Syria","default":"False"},{"id":"193","country":"Taiwan","default":"False"},{"id":"169","country":"Tajikistan","default":"False"},{"id":"170","country":"Tanzania","default":"False"},{"id":"171","country":"Thailand","default":"False"},{"id":"172","country":"Togo","default":"False"},{"id":"173","country":"Tokelau","default":"False"},{"id":"174","country":"Tonga","default":"False"},{"id":"175","country":"Tunisia","default":"False"},{"id":"176","country":"Turkey","default":"False"},{"id":"177","country":"Turkmenistan","default":"False"},{"id":"178","country":"Tuvalu","default":"False"},{"id":"179","country":"Uganda","default":"False"},{"id":"180","country":"Ukraine","default":"False"},{"id":"181","country":"United Arab Emirates","default":"False"},{"id":"182","country":"United Kingdom","default":"False"},{"id":"183","country":"United States","default":"False"},{"id":"184","country":"Uruguay","default":"False"},{"id":"185","country":"Uzbekistan","default":"False"},{"id":"186","country":"Vanuatu","default":"False"},{"id":"187","country":"Venezuela","default":"False"},{"id":"188","country":"Vietnam","default":"False"},{"id":"189","country":"Virgin Islands","default":"False"},{"id":"190","country":"Yemen","default":"False"},{"id":"191","country":"Zambia","default":"False"},{"id":"192","country":"Zimbabwe","default":"False"}];
			rcmAreaOfUse = [];
			rcmTaxInclusive=true;rcmTaxRate=0.100;rcmStateTax=0.000;
			rcmStep3Ready("","","");
			Step3.controller.ready_callback();
		},
		start_live:function(){
			Log.add('start live');
			oAPI.OnReadyStep3(Step3.controller.ready_callback);
			Step3.controller.start_live_timeout=setTimeout(Step3.controller.api_timeout,30000);
			oAPI.GetStep3(
				Step3.data.CategoryTypeID
				,Step3.data.PickupLocationID
				,Step3.data.PickupDate
				,Step3.data.PickupTime
				,Step3.data.DropOffLocationID
				,Step3.data.ReturnDate
				,Step3.data.ReturnTime
				,Step3.data.Age
				,Step3.data.Vehiclecategoryid
				,Step3.data.PromoCode
				,0
				// ,'Stade24'
			);
			Log.add('end live');
		},
		validate:function(){
			if(Step3.controller.timeout_triggered){
				Log.add('timeout triggered');
				Step3.controller.timeout_triggered=false;
				clearTimeout(Step3.controller.start_live_timeout);
				return false;
			}
			$('#update-search').removeAttr('disabled');
			clearTimeout(Step3.controller.start_live_timeout);
			View.errors.clean();
			var pickup=Step3.controller.location_by_type(rcmLocationFees,'pickup');
			var ret=Step3.controller.location_by_type(rcmLocationFees,'dropoff');
			if(pickup===false||ret===false){
				View.errors.show(['Invalid pickup or return dates. Please <a href="step1.php">try again</a>.']);
				return false;
			}
			var age=Step3.controller.selected_age(rcmDriverAgesInfo,Step3.data.Age);
			if(age===false){
				View.errors.show(['Invalid driver age. Please contact us.']);
				return false;
			}
			var available=Controller.check_location_available(rcmLocationFees);
			if(available.length>0){
				View.errors.show(available);
				return false;
			}
			return true;
		},
		ready_callback:function(){
			Log.add('callback');
			if(Step3.controller.validate()==false){
				Log.add('validate error');
				return;
			}
			Log.add('validate');
			$('#car .peoplegraphic').html(Step3.view.peoplegraphic(rcmAvailableCars[0].numberofadults,rcmAvailableCars[0].numberofchildren));
			$('#car .cartitle').html(Step3.view.car_title(Step3.data.CategoryType_name));
			Log.add('car');
			Step3.controller.prepare_optional_fees();
			Step3.controller.optional_extras();
			Log.add('optional_extras');
			Step3.controller.optional_extras_check();
			Log.add('optional_extras_check');
			Step3.controller.insurance_options();
			Log.add('insurance_options');
			Step3.controller.insurance_options_check();
			Log.add('insurance_options_check');
			Step3.controller.km_charges_options();
			Log.add('km_charges_options');
			Step3.controller.km_charges_options_check();
			Log.add('km_charges_options');
			
			if(Controller.check_most_popular(rcmAvailableCars[0].vehicledescriptionurl,Step3.data.most_popular)){
				Log.add('most-popular');
				$('#car .image .most-popular').show();
			}
			
			var total=parseFloat(rcmAvailableCars[0].totalratebeforediscount);
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
			var discount=Step3.controller.discount(
				parseInt(rcmAvailableCars[0].freedays)
				,parseFloat(rcmAvailableCars[0].avgrate)
				,parseFloat(rcmAvailableCars[0].totaldiscountamount)
				,extra_fees.mandatoryfee
				,total
			);
			// var StateTax = Controller.StateTax();
			// console.log('StateTax: ' +StateTax);
			Step3.data.base={
				subtotal:total
				,discount:discount.totaldiscounts
				,total:discount.total
				,gst:Step3.controller.tax(discount.total-discount.totaldiscounts,rcmTaxRate)
				// ,gst:Step3.controller.tax(discount.total-discount.totaldiscounts,StateTax)
			};
			
			Step3.controller.calculate_totals();
			
			if(rcmLocationFees[0].flightnoreqd=="True"){
				$('label[for="txtFlightNo"],input[name="txtFlightNo"]');
			}
			
			Step3.controller.price_details.main();
			Log.add('end callback');
		},
		tax:function(value,taxRate){
			// console.log('value: ' + value);
			// console.log('taxRate: ' + taxRate);
			// taxRate=0.1;
			return parseFloat(value)-parseFloat(value)/(1+taxRate);
		},
		discount:function(freedays,avgrate,totaldiscount,mandatoryfee,total){
			var ret={
				total:total
				,totaldiscounts:0.0
				,freedays:{
					avgrate:0.0
					,freedays:0
				}
				,html:''
				,individual:[]
			};
			if(totaldiscount>0){
				ret.html+=Step3.view.discount_item('Vehicle discount',-totaldiscount);
				ret.totaldiscounts+=-totaldiscount;
				ret.total+=-totaldiscount;
				ret.individual.push({
					name:'Vehicle discount'
					,discount:-totaldiscount
				});
			}
			if(freedays>0){
				ret.freedays.numberofdays=freedays;
				ret.freedays.avgrate.toFixed(2);
				var name=Template.run('%numberofdays days @ $%avgrate',{
					numberofdays:freedays
					,avgrate:avgrate.toFixed(2)
				});
				ret.html+=Step3.view.discount_item(
					name
					,freedays*avgrate
				);
				ret.totaldiscounts+=-freedays*avgrate;
				ret.total+=-freedays*avgrate;
				ret.individual.push({
					name:name
					,discount:-freedays*avgrate
				});
			}
			for(var i=0;i<mandatoryfee.length;i++){
				if(mandatoryfee[i].discount===false){
					continue;
				}
				ret.totaldiscounts+=-mandatoryfee[i].total;
				ret.total+=-mandatoryfee[i].total;
				ret.html+=Step3.view.discount_item(mandatoryfee[i].name,-mandatoryfee[i].total);
				ret.individual.push({
					name:mandatoryfee[i].name
					,discount:-mandatoryfee[i].total
				});
			}
			return ret;
		},
		extra_fees:function(numberofdays,relocfee,relocdaysnocharge,locationFees,mandatoryFees
			,locId,vehiclecategoryid,total
		){
			var ret={
				total:0.0
				,totalCalcGst:0.0
				,totalCalcStampDuty:0.0
				,relocfee:0.0
				,unattendedfee:0.0
				,afterhourfee:0.0
				,mandatoryfee:[]
				,html:''
			};
			
			if(relocfee!==false){
				var relocfee_total=Step3.controller.relocfee(numberofdays,relocfee,relocdaysnocharge);
				ret.relocfee=relocfee_total.total;
				ret.total+=relocfee_total.total;
				ret.html+=relocfee_total.html;
			}
			
			var unattendedfee_total=Controller.unattendedfee(locationFees,Step3.controller.unattendedfee);
			ret.unattendedfee=unattendedfee_total.total;
			ret.total+=unattendedfee_total.total;
			ret.html+=unattendedfee_total.html;
			
			var afterhourfee_total=Controller.afterhourfee(locationFees,Step3.controller.afterhourfee);
			ret.afterhourfee=afterhourfee_total.total;
			ret.total+=afterhourfee_total.total;
			ret.html+=afterhourfee_total.html;
			
			var mandatoryfee_total=Controller.mandatoryfee(mandatoryFees,locId,vehiclecategoryid,numberofdays,total
				,Step3.view.mandatoryfee_daily
				,Step3.view.mandatoryfee_percentage
				,Step3.view.mandatoryfee_unknown
			);
			// console.log(mandatoryfee_total);
			ret.mandatoryfee=mandatoryfee_total.individual;
			ret.total=mandatoryfee_total.total;
			ret.totalCalcGst=mandatoryfee_total.totalCalcGst;
			ret.totalCalcStampDuty=mandatoryfee_total.totalCalcStampDuty;
			ret.html+=mandatoryfee_total.html;
			return ret;
		},
		relocfee:function(numberofdays,relocfee,relocdaysnocharge){
			var ret={
				total:0.0,
				html:''
			};
			if(relocfee==0){
				return ret;
			}
			if(relocdaysnocharge>numberofdays){
				return ret;
			}
			ret.total=relocfee;
			ret.html=Step3.view.relocfee(relocfee);
			return ret;
		},
		numberofdays:function(numberofdays,avgrate){
			var ret={
				numberofdays:numberofdays
				,avgrate:avgrate
				,total:0.0
				,html:''
			};
			if(numberofdays==0){
				return ret;
			}
			ret.total=avgrate*numberofdays;
			ret.html=Step3.view.numberofdays(numberofdays,avgrate,ret.total);
			return ret;
		},
		selected_age:function(driverAgesInfo,selected_age_id){
			for(var i in driverAgesInfo){
				if(typeof(driverAgesInfo[i])=='undefined'||typeof(driverAgesInfo[i].id)=='undefined'){
					continue;
				}
				if(driverAgesInfo[i].id==selected_age_id){
					return driverAgesInfo[i];
				}
			}
			return false;
		},
		location_by_type:function(locationFees,type){
			for(var i in locationFees){
				if(typeof(locationFees[i])=='undefined'||typeof(locationFees[i].loctype)=='undefined'){
					continue;
				}
				if(locationFees[i].loctype==type){
					return locationFees[i];
				}
			}
			return false;
		},
		make_a_booking:function(){
			Step3.controller._step4_optional_extras();
			// Step3.controller._step4_km_charges();
			Step3.controller._step4_insurance();
			Step3.controller._step4_rates();
			$('#make_a_booking').hide();
			$('form input[name=bookmode]').val(2);
			$('#frmStep3').submit();
		},
		email_a_quote:function(){
			Step3.controller._step4_optional_extras();
			// Step3.controller._step4_km_charges();
			Step3.controller._step4_insurance();
			Step3.controller._step4_rates();
			$('#email_a_quote').hide();
			$('form input[name=bookmode]').val(1);
			$('#frmStep3').submit();
		},
		_set_optional_extras:function(){
			var ret=[];
			var numqty=0;
			var qty=null;
			var total=0;
			var value='';
			for(var i in rcmOptionalFees){
				if(!rcmOptionalFees[i]._display){
					continue;
				}
				if($('#OptionalExtras'+rcmOptionalFees[i].id+':checked').length==0){
					Log.add('_set_optional_extras error optional extras not found or not checked: #OptionalExtras'+rcmOptionalFees[i].id);
					continue;
				}
				numqty=1;
				value='';
				if(rcmOptionalFees[i].qtyapply==false){
					Log.add('_set_optional_extras optional extras qty does not apply: #OptionalExtras'+rcmOptionalFees[i].id);
					if(rcmOptionalFees[i].type=='Daily'){
						value=Template.run(
							'$%fee per day',{
							fee:rcmOptionalFees[i]._fees.toFixed(2)
						});
					}
				}else{
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
					if(rcmOptionalFees[i].type=='Daily'){
						value=Template.run(
							'%qty @ $%fee per day',{
							fee:rcmOptionalFees[i]._fees.toFixed(2)
							,qty:numqty
						});
					}else if(rcmOptionalFees[i].type=='Percentage'){
						value=Template.run(
							'%qty @ $%fee',{
							fee:rcmOptionalFees[i]._fees.toFixed(2)
							,qty:numqty
						});
					}
				}
				ret.push({
					name:rcmOptionalFees[i].name
					,value:value
					// ,total:rcmOptionalFees[i]._unitfee.toFixed(2)*numqty
					,total:rcmOptionalFees[i].totalfeeamount.toFixed(2)*numqty
					,id:rcmOptionalFees[i].id
					,qty:numqty
				});
			}
			return JSON.stringify(ret);
		},
		_set_insurance_options:function(){
			oAPI.SetInsurance(0);
			Log.add('_set_insurance_options clearing optional extras');
			
			var checked=null;
			if($('input[name="Insurance"]:checked').length!=0){
				checked=$('input[name="Insurance"]:checked').val();
			}
			if(checked===null){
				for (var i in rcmInsuranceOptions) {
					if(rcmInsuranceOptions[i].default==true){
						checked=rcmInsuranceOptions[i].id;
						break;
					}
				}
			}
			if(checked===null){
				var fees=0;
				var lowest_fee=999999;
				for (var i in rcmInsuranceOptions) {
					fees=parseFloat(rcmInsuranceOptions[i].fees);
					if(fees<lowest_fee){
						lowest_fee=fees;
						checked=rcmInsuranceOptions[i].id;
						continue;
					}
				}
			}
			if(checked!==null){
				oAPI.SetInsurance(checked);
			}
			for(var i in rcmInsuranceOptions){
				if(oAPI.GetInsurance()!=rcmInsuranceOptions[i].id){
					continue;
				}
				var maxprice=parseFloat(rcmInsuranceOptions[i].maxprice);
				var save={
					name:rcmInsuranceOptions[i].extradesc1
					,fees:parseFloat(rcmInsuranceOptions[i].fees)
					,id:rcmInsuranceOptions[i].id
				};
				if(rcmInsuranceOptions[i].type=='Daily'){
					save.total=parseFloat(rcmInsuranceOptions[i].fees)*parseFloat(rcmInsuranceOptions[i].numberofdays);
					if(maxprice!=0&&save.total>maxprice){
						save.total=maxprice;
					}
					save.type='Daily';
					return JSON.stringify(save);
				}
				if(rcmInsuranceOptions[i].type=='Percentage'){
					save.total=parseFloat(rcmInsuranceOptions[i].fees)*Step3.data.base.total/100;
					if(maxprice!=0&&save.total>maxprice){
						save.total=maxprice;
					}
					save.type='Percentage';
					return JSON.stringify(save);
				}
				save.total=parseFloat(rcmInsuranceOptions[i].fees);
				save.type='';
				
				// console.log(save);
				return JSON.stringify(save);
			}
			return '';
		},
		_set_km_charges:function(){
			
			Log.add('_set_km_charges clearing optional extras');			
			return '';
		},
		_step4_optional_extras:function(){
			$('input[name="optional_extras_json"]').val(Step3.controller._set_optional_extras());
		},
		_step4_insurance:function(){
			$('input[name="insurance_json"]').val(Step3.controller._set_insurance_options());
		},
		_step4_km_charges:function(){
			$('input[name="km_charges_json"]').val(Step3.controller._set_km_charges());
		},
		_step4_rates:function(){
			var daily_rate=Step3.controller.numberofdays(
				parseInt(rcmAvailableCars[0].numberofdays)
				,parseFloat(rcmAvailableCars[0].avgrate)
			);
			delete daily_rate.html;
			$('input[name="daily_rate_json"]').val(JSON.stringify(daily_rate));
			
			var extra_fees=Step3.controller.extra_fees(
				parseInt(rcmAvailableCars[0].numberofdays)
				,typeof(rcmAvailableCars[0].relocfee)=='undefined'?false:parseFloat(rcmAvailableCars[0].relocfee)
				,parseInt(rcmAvailableCars[0].relocdaysnocharge)
				,rcmLocationFees
				,rcmMandatoryFees
				,Step3.data.PickupLocationID
				,rcmAvailableCars[0].vehiclecategoryid
				,parseFloat(rcmAvailableCars[0].totalratebeforediscount)
			);
			delete extra_fees.html;
			$('input[name="extra_fees_json"]').val(JSON.stringify(extra_fees));

			var discount=Step3.controller.discount(
				parseInt(rcmAvailableCars[0].freedays)
				,parseFloat(rcmAvailableCars[0].avgrate)
				,parseFloat(rcmAvailableCars[0].totaldiscountamount)
				,extra_fees.mandatoryfee
				,0
			);
			$('input[name="discount_json"]').val(JSON.stringify(discount.individual));
		}
	}
};

$(document).ready(function(){
	if(typeof(Step3.data.PromoCode)=='undefined'){
		window.top.location.href='step1.php';
	}
	Step3.controller.start_live();
});
