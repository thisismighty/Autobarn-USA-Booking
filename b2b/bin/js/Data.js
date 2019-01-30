var Data={
	data:{},
	controller:{
		init:function(){
			var pick=new Date();
			pick.setDate(pick.getDate()+5);
			Data.data.PickupDay=pick.getDate();
			Data.data.PickupMonth=pick.getMonth()+1;
			Data.data.PickupYear=pick.getFullYear();
			var drop=new Date();
			drop.setDate(drop.getDate()+15);
			Data.data.DropoffDay=drop.getDate();
			Data.data.DropoffMonth=drop.getMonth()+1;
			Data.data.DropoffYear=drop.getFullYear();
			for(var i in Data.data){
				Data.controller.set_if_not_set(i,Data.data[i]);
			}
		},
		get:function(name){
			var nameEQ=name+"=";
			var ca=document.cookie.split(';');
			for(var i=0;i<ca.length;i++){
				var c=ca[i];
				while(c.charAt(0)==' '){
					c=c.substring(1,c.length);
				}
				if(c.indexOf(nameEQ)==0){
					return c.substring(nameEQ.length,c.length);
				}
			}
			return null;
		},
		get_to_name:function(name,name_attr,element_tag,form_selector){
			var val=Data.controller.get(name);
			if(val===null){
				val='';
			}
			var replace={
				form_selector	:typeof(form_selector)	=='undefined'?'form'	:form_selector
				,element_tag	:typeof(element_tag)	=='undefined'?'*'		:element_tag
				,name_attr		:typeof(name_attr)		=='undefined'?name		:name_attr
			};
			$(Template.run(
				'%form_selector %element_tag[name="%name_attr"]',
				replace
			)).val(val);
		},
		set_if_not_set:function(name,value,seconds){
			if(Data.controller.get(name)!==null){
				return;
			}
			Data.controller.set(name,value,seconds);
		},
		set_from_selector:function(name,css_selector){
			Data.controller.set(name,$(css_selector).val());
		},
		set_from_name:function(name,name_attr,element_tag,form_selector){
			var replace={
				form_selector	:typeof(form_selector)	=='undefined'?'form'	:form_selector
				,element_tag	:typeof(element_tag)	=='undefined'?'*'		:element_tag
				,name_attr		:typeof(name_attr)		=='undefined'?name		:name_attr
			};
			Data.controller.set(name,$(Template.run(
				'%form_selector %element_tag[name="%name_attr"]',
				replace
			)).val());
		},
		set:function(name,value,seconds){
			var expires='';
			if(seconds){
				var date=new Date();
				date.setTime(date.getTime()+(seconds*1000));
				expires="; expires="+date.toGMTString();
			}
			document.cookie=name+"="+value+expires+"; path=/";
		},
		unset:function(name){
			General.data.cookie.set(name,'',-1);
		}
	}
};