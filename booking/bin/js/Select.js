var Select={
	option_object:function(text,value,disabled){
		return {
			text:text
			,value:value
			,disabled:disabled
		};
	},
	html:function(array_of_option_objects,selected_value){
		var ret='';
		for(var i in array_of_option_objects){
			ret+=this.option_html(array_of_option_objects[i],selected_value==array_of_option_objects[i].value);
		}
		return ret;
	},
	option_html:function(option_object,selected){
		return Template.run(
			'<option value="%value"%disabled%selected>%text</option>',
			{
				value:option_object.value
				,text:option_object.text
				,disabled:(option_object.disabled?' disabled':'')
				,selected:(selected?' selected="selected"':'')
			}
		);
	}
};
