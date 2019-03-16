Step2.view={
	available:function(available){
		if(available==0){
			return '';
		}
		return '';
	},
	totaldiscount:function(totaldiscount){
		return Template.run($('#totaldiscount_html').html(),{
			// totaldiscount:parseFloat(totaldiscount).toFixed(2)
			totaldiscount:totaldiscount
		});
	},
	freedays:function(freedays){
		return Template.run($('#freedays_html').html(),{
			freedays:parseFloat(freedays).toFixed(0)
		});
	},
	relocfee:function(relocfee){
		return Template.run($('#relocfee_html').html(),{
			relocfee:parseFloat(relocfee).toFixed(0)
		});
	},
	unattendedfee:function(location,unattendedfee){
		return Template.run($('#unattendedfee_html').html(),{
			location:location
			,unattendedfee:unattendedfee
		});
	},
	need_request:function(available,availablemessage){
		return Template.run($('#need_request_html').html(),{
			available:available,
			availablemessage:availablemessage
		});
	},
	unavailable:function(available,availablemessage){
		return Template.run($('#unavailable_html').html(),{
			available:available,
			availablemessage:availablemessage
		});
	},
	afterhourfee:function(location,afterhourfee){
		return Template.run($('#afterhourfee_html').html(),{
			location:location
			,afterhourfee:afterhourfee
		});
	},
	mandatoryfee_daily:function(name,altname,per_day,total){
		return Template.run($('#mandatoryfee_daily_html').html(),{
			name:name
			,altname:altname
			,per_day:parseFloat(per_day).toFixed(2)
			,total:parseFloat(total).toFixed(2)
		});
	},
	mandatoryfee_percentage:function(name,fees){
		return Template.run($('#mandatoryfee_percentage_html').html(),{
			name:name
			,fees:parseFloat(fees).toFixed(2)
		});
	},
	mandatoryfee_unknown:function(type,name,fees){
		return Template.run($('#mandatoryfee_unknown_html').html(),{
			name:name
			,type:type
			,fees:parseFloat(fees).toFixed(2)
		});
	},
	booked_out:function(){
		return $('#booked_out_html').html();
	},
	book_now:function(total,vehiclecategoryid,categorytype_name,categorytype_vehicledescriptionurl,categorytype_imageurl,available){
		return Template.run($('#book_now_html').html(),{
			total:total.toFixed(2)
			,categorytype_name:categorytype_name.replace(/'/g,'%27')
			,categorytype_vehicledescriptionurl:categorytype_vehicledescriptionurl.replace(/'/g,'%27')
			,categorytype_imageurl:categorytype_imageurl.replace(/'/g,'%27')
			,vehiclecategoryid:vehiclecategoryid
			,available:available
		});
	},
	request_now:function(total,vehiclecategoryid,categorytype_name,categorytype_vehicledescriptionurl,categorytype_imageurl,available,availablemessage){
		return Template.run($('#request_now_html').html(),{
			total:total.toFixed(2)
			,categorytype_name:categorytype_name.replace(/'/g,'%27')
			,categorytype_vehicledescriptionurl:categorytype_vehicledescriptionurl.replace(/'/g,'%27')
			,categorytype_imageurl:categorytype_imageurl.replace(/'/g,'%27')
			,vehiclecategoryid:vehiclecategoryid
			,availablemessage:availablemessage
			,available:available
		});
	},
	peoplegraphic:function(categoryfriendlydescription, numberofadults,numberofchildren,numberoflargecases,numberofsmallcases){
		// if(numberofchildren<2){
			// numberofchildren=2;
		// }
		// if(numberofadults<2){
			// numberofadults=2;
		// }
		// if(numberofadults==numberofchildren){
			// return Template.run(
				// $('#peoplegraphic_one_html').html(),
				// {
					// no:numberofadults
				// }
			// );
		// }
		switch(categoryfriendlydescription){
			case "Kuga Campervan":
			
				return Template.run(
					$('#peoplegraphic_kuga_html').html(),
					{
						numberofadults:numberofadults?( numberofadults>2 ? '2-' + numberofadults : numberofadults ):'2-5',
						numberofchildren:numberofchildren,
						numberoflargecases:numberoflargecases,
						numberofsmallcases:numberofsmallcases,
					}
				);
				
			break;
			case "Stationwagon":
			
				return Template.run(
					$('#peoplegraphic_stationwagon_html').html(),
					{
						numberofadults:numberofadults?( numberofadults>2 ? '2-' + numberofadults : numberofadults ):'2-5',
						numberofchildren:numberofchildren,
						numberoflargecases:numberoflargecases,
						numberofsmallcases:numberofsmallcases,
					}
				);
				
			break;
			default:
				
				return Template.run(
					$('#peoplegraphic_html').html(),
					{
						numberofadults:numberofadults?( numberofadults>2 ? '2-' + numberofadults : numberofadults ):'N/A',
						numberofchildren:numberofchildren,
						numberoflargecases:numberoflargecases,
						numberofsmallcases:numberofsmallcases,
					}
				);
			break;
				
		}
	},
	one_car:function(
		imageurl,categoryfriendlydescription,vehicledescriptionurl
		,numberofdays,avgrate,total
		,peoplegraphic_html
		,totaldiscount_html
		,freedays_html
		,relocfee_html
		,unattendedfee_html
		,afterhourfee_html
		,mandatoryfee_html
		,mandatoryfee_free_html
		,governmentfee_html
		,need_request_html
		,unavailable_html
		,book_html
		,mandatoryfee_value
		,price_total
		,usp
		,mostpopular
	){
		var new_name=categoryfriendlydescription.toUpperCase().split(' (');
		if(typeof(new_name[1])=='undefined'){
			new_name[0]=categoryfriendlydescription.toUpperCase();
			new_name[1]='';
		}else{
			new_name[1]='('+new_name[1];
		}
		
		if(new_name[0]==='VENTURA'){
			imageurl='image/campervans/ventura.png';
            vehicledescriptionurl='https://www.travellers-autobarnrv.com/campervan-hire-usa/ventura-camper/';
        }
        if(new_name[0]==='MAVERICK'){
            imageurl='image/campervans/maverick.png';
            vehicledescriptionurl = 'https://www.travellers-autobarnrv.com/campervan-hire-usa/maverick-camper/';
        }
		// if(new_name[0]==='HITOP CAMPERVAN'){
            // imageurl='image/campervans/hitop.png';
            // vehicledescriptionurl = 'https://www.staging.travellers-autobarnrv.com/campervan-hire-usa/hitop-campervan/';
        // }
		// if(new_name[0]==='KUGA CAMPERVAN'){
            // imageurl='image/campervans/kuga.png';
            // vehicledescriptionurl = 'https://www.staging.travellers-autobarnrv.com/campervan-hire-usa/kuga-campervan/';
        // }

		var mostpopular_html='';
		if(mostpopular){
			mostpopular_html='<img src="/booking/image/most-popular-step2.png" class="most-popular" />';
		}
		return Template.run(
			$('#car_html').html(),
			{
				imageurl:imageurl
				,categoryfriendlydescription0:Template.escape(new_name[0])
				,categoryfriendlydescription1:Template.escape(new_name[1])
				,categoryfriendlydescription:Template.escape(categoryfriendlydescription)
				,vehicledescriptionurl:vehicledescriptionurl
				,peoplegraphic:peoplegraphic_html
				,numberofdays:numberofdays
				,totaldiscount_html:totaldiscount_html
				,freedays_html:freedays_html
				,relocfee_html:relocfee_html
				,unattendedfee_html:unattendedfee_html
				,afterhourfee_html:afterhourfee_html
				,mandatoryfee_html:mandatoryfee_html
				,mandatoryfee_free_html:mandatoryfee_free_html
				,governmentfee_html:governmentfee_html
				,need_request_html:need_request_html
				,unavailable_html:unavailable_html
				,book_html:book_html
				,mandatoryfee_value:mandatoryfee_value
				,avgrate:parseFloat(avgrate).toFixed(2)
				,total:parseFloat(total).toFixed(2).split(".")[0]
				,total_small:parseFloat(total).toFixed(2).split(".")[0]
				,price_exclude_tax:parseFloat(price_total).toFixed(2).split(".")[0]
				,small:'.'+parseFloat(price_total).toFixed(2).split(".")[1]
				,price_total:parseFloat(price_total).toFixed(2)
				,usp:usp
				,mostpopular:mostpopular_html
			}
		);
	},
	no_car:function(){
		
		return Template.run(
			$('#nocar_html').html(),
			{}
		);
	}
};
