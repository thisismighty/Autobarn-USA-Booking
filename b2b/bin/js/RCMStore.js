var RCMStore={
	populate:function(variable_name,step_data){
		$('input[name="copy_'+variable_name+'"]').val(step_data['copy_'+variable_name]);
		window[variable_name]=JSON.parse(step_data['copy_'+variable_name]);
	},
	clean:function(variable_name){
		$('input[name="copy_'+variable_name+'"]').val('[]');
	},
	set:function(variable_name,variable_value){
		$('input[name="copy_'+variable_name+'"]').val(JSON.stringify(variable_value));
	},
	get:function(variable_name){
		return JSON.parse($('input[name="copy_'+variable_name+'"]').val());
	}
};
