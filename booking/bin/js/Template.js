var Template={
	escape:function(text){
		return text
			.replace(/&/g, "&amp;")
			.replace(/</g, "&lt;")
			.replace(/>/g, "&gt;")
			.replace(/"/g, "&quot;")
			.replace(/'/g, "&#039;");
	},
	run:function(html,replacements){
		if(!html||typeof(html)=='undefined'||typeof(html.replace)=='undefined'){
			Log.add('undefined variable in Template.run');
			Log.add(html);
			Log.add(replacements);
		}
		for(var k in replacements){
			if(typeof(replacements[k])!='string'){
				replacements[k]+='';
			}
			if(html !== undefined && html !== null)
				html=html.split('%'+k).join(replacements[k]);
		}
		return html;
	},
	date_object_to_str:function(date_object){
		var date=date_object.getDate()
			,month=date_object.getMonth();
		date=''+date;
		month=''+month;
		if(date.length<2){
			date='0'+date;
		}
		if(month.length<2){
			month='0'+month;
		}
		return date+'/'+month+'/'+date_object.getFullYear();
	},
	str_date_to_object:function(d_m_y_date){
		var tmp=d_m_y_date.split('/');
		if(typeof(tmp[2])=='undefined'){
			return false;
		}
		
		return new Date(tmp[2],tmp[1]-1,tmp[0]);
	}
};
