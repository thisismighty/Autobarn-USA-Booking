Step3.view={
	peoplegraphic:function(numberofadults,numberofchildren){
		if(numberofchildren<2){
			numberofchildren=2;
		}
		if(numberofadults<2){
			numberofadults=2;
		}
		if(numberofadults==numberofchildren){
			return Template.run(
				$('#peoplegraphic_one_html').html(),
				{
					no:numberofadults
				}
			);
		}
		return Template.run(
			$('#peoplegraphic_html').html(),
			{
				numberofadults:numberofadults,
				numberofchildren:numberofchildren
			}
		);
	},
	option_quantity_daily:function(name,id,filename,extradesc,fees,total,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#option_quantity_daily_html').html(),{
			name:name
			,id:id
			,filename:filename
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
		});
	},
	option_quantity_percentage:function(name,id,filename,extradesc,fees,total,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#option_quantity_percentage_html').html(),{
			name:name
			,id:id
			,filename:filename
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
		});
	},
	option_quantity_unknown:function(name,id,filename,extradesc,fees,total,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#option_quantity_unknown_html').html(),{
			name:name
			,id:id
			,filename:filename
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
		});
	},
	option_daily:function(name,id,filename,extradesc,fees,total,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#option_daily_html').html(),{
			name:name
			,id:id
			,filename:filename
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
		});
	},
	option_percentage:function(name,id,filename,extradesc,fees,total,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#option_percentage_html').html(),{
			name:name
			,id:id
			,filename:filename
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
		});
	},
	option_unknown:function(name,id,filename,extradesc,fees,total,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#option_unknown_html').html(),{
			name:name
			,id:id
			,filename:filename
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
		});
	},
	insurance_option_daily:function(name,desc,id,extradesc,fees,total,checked,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#insurance_option_daily_html').html(),{
			name:name
			,desc:desc
			,id:id
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
			,checked:checked?'checked="checked"':''
		});
	},
	insurance_option_percentage:function(name,desc,id,extradesc,fees,total,checked,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#insurance_option_percentage_html').html(),{
			name:name
			,desc:desc
			,id:id
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
			,checked:checked?'checked="checked"':''
		});
	},
	insurance_option_unknown:function(name,desc,id,fees,extradesc,total,checked,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#insurance_option_unknown_html').html(),{
			name:name
			,desc:desc
			,id:id
			,extradesc:extradesc
			,pop:pop
			,fees:fees.toFixed(2)
			,total:total.toFixed(2)
			,checked:checked?'checked="checked"':''
		});
	},
	km_charges_daily:function(id,desc,extradesc,kmsfree,addkmsfee,dailyrate,total,checked,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#km_charges_html').html(),{
			id:id
			,desc:desc
			,extradesc:extradesc
			,pop:pop
			,kmsfree:kmsfree.toFixed(0)
			,addkmsfee:addkmsfee.toFixed(2)
			,dailyrate:dailyrate.toFixed(2)
			,total:total.toFixed(2)
			,checked:checked?'checked="checked"':''
		});
	},
	km_charges_unknown:function(id,desc,extradesc,kmsfree,addkmsfee,total,checked,display_pop){
		var pop='';
		if(display_pop!==false){
			pop=Template.run(
				' class="hover-underline" href="javascript:void(0)" onclick="Step3.controller.pop(\'%extradesc\');"',
				{
					extradesc:extradesc
				}
			);
		}
		return Template.run($('#km_charges_html').html(),{
			id:id
			,desc:desc
			,extradesc:extradesc
			,pop:pop
			,kmsfree:kmsfree.toFixed(0)
			,addkmsfee:addkmsfee.toFixed(2)
			,total:total
			,checked:checked?'checked="checked"':''
		});
	},
	car_title:function(categoryfriendlydescription){
		var new_name=categoryfriendlydescription.toUpperCase().split(' (');
		if(typeof(new_name[1])=='undefined'){
			new_name[0]=categoryfriendlydescription.toUpperCase();
			new_name[1]='';
		}else{
			new_name[1]='('+new_name[1];
		}
		return Template.run($('#car_title_html').html(),{
			categoryfriendlydescription0:Template.escape(new_name[0])
			,categoryfriendlydescription1:Template.escape(new_name[1])
		});
	},
	discount_item:function(name,discount){
		return Template.run($('#discounts_item_html').html(),{
			name:name
			,discount:discount.toFixed(2)
		});
	},
	numberofdays:function(numberofdays,avgrate,total){
		return Template.run($('#numberofdays_header_html').html(),{
			content:Template.run($('#numberofdays_html').html(),{
				numberofdays:numberofdays
				,avgrate:avgrate.toFixed(2)
				,total:total.toFixed(2)
			})
		});
	},
	relocfee:function(relocfee){
		return Template.run($('#extrafee_item_html').html(),{
			name:'Relocation Fee'
			,fee:relocfee.toFixed(2)
		});
	},
	unattendedfee:function(unattendedfee){
		return Template.run($('#extrafee_item_html').html(),{
			name:'Unattended Fee'
			,fee:unattendedfee.toFixed(2)
		});
	},
	afterhourfee:function(afterhourfee){
		return Template.run($('#extrafee_item_html').html(),{
			name:'After Hour Fee'
			,fee:afterhourfee.toFixed(2)
		});
	},
	mandatoryfee_daily:function(name,altname,per_day,total){
		return Template.run($('#extrafee_item_html').html(),{
			name:name+' @ $%per_day'
			,altname:altname
			,per_day:per_day.toFixed(2)
			,fee:total.toFixed(2)
		});
	},
	mandatoryfee_percentage:function(name,fees){
		return Template.run($('#extrafee_item_html').html(),{
			name:name
			,fee:fees.toFixed(2)
		});
	},
	mandatoryfee_unknown:function(type,name,fees){
		return Template.run($('#extrafee_item_html').html(),{
			name:name
			,type:type
			,fee:fees.toFixed(2)
		});
	}
};
