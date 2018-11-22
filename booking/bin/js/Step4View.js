Step4.view={
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
	price_details_header:function(){
		return $('#price_details_table_header_html').html();
	},
	daily_rate:function(numberofdays,avgrate,total){
		return Template.run(
			$('#price_details_table_row_html').html(),{
				class:''
				,cell1:'Daily Rate'
				,cell2:numberofdays.toFixed(0)
				,cell3:'$'+avgrate.toFixed(2)
				,cell4:'$'+total.toFixed(2)
			}
		);
	},
	insurance:function(name,fees,total,type){
		if(type=='Daily'){
			return Template.run(
				$('#price_details_table_row_html').html(),{
					class:''
					,cell1:name
					,cell2:''
					,cell3:'$'+fees.toFixed(2)
					,cell4:'$'+total.toFixed(2)
				}
			);
		}
		if(type=='Percentage'){
			return Template.run(
				$('#price_details_table_row_html').html(),{
					class:''
					,cell1:name
					,cell2:''
					,cell3:''
					,cell4:'$'+total.toFixed(2)
				}
			);
		}
		if(type==''){
			return Template.run(
				$('#price_details_table_row_html').html(),{
					class:''
					,cell1:name
					,cell2:''
					,cell3:'$'+fees.toFixed(2)
					,cell4:'$'+total.toFixed(2)
				}
			);
		}
		return '';
	},
	mandatoryfee:function(mandatoryfee){
		var html='';
		for(var i=0;i<mandatoryfee.length;i++){
			if(mandatoryfee[i].discount){
				continue;
			}
			html+=Template.run(
				$('#price_details_table_row_html').html(),{
					class:''
					,cell1:mandatoryfee[i].name
					,cell2:''
					,cell3:''
					,cell4:'$'+mandatoryfee[i].total.toFixed(2)
				}
			);
		}
		return html;
	},
	discount:function(discount){
		var html='';
		for(var i=0;i<discount.length;i++){
			var sig='';
			if(discount[i].discount.toFixed(2)>0){
				sig='-';
			}
			html+=Template.run(
				$('#price_details_table_row_html').html(),{
					class:''
					,cell1:discount[i].name
					,cell2:''
					,cell3:''
					,cell4:'-$'+ ( Math.abs(discount[i].discount.toFixed(2)) )
				}
			);
		}
		return html;
	},
	optional_extras:function(optional_extras){
		var html='';
		for(var i=0;i<optional_extras.length;i++){
			html+=Template.run(
				$('#price_details_table_row_html').html(),{
					class:''
					,cell1:optional_extras[i].name
					,cell2:''
					,cell3:optional_extras[i].value.replace(/\sper\sday/g,'')
					,cell4:'$'+parseFloat(optional_extras[i].total).toFixed(2)
				}
			);
		}
		return html;
	},
	total:function(gst,price){
		return Template.run(
			$('#price_details_table_row_html').html(),{
				class:'total-details'
				,cell1:'Total Price'
				,cell2:''
				,cell3:''
				,cell4:'$'+parseFloat(price).toFixed(2)
			}
		);
	}
};
