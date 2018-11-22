var View={
	css_type:function(){
		if(typeof(View.media_queries)=='undefined'){
			return false;
		}
		var tmp=false;
		for(var i in View.media_queries){
			tmp=window.matchMedia(View.media_queries[i]);
			if(tmp.matches==true){
				return i;
			}
		}
		return 'desktop';
	},
	errors:{
		_default_element:function(element_selector){
			if(typeof(element_selector)=='undefined'){
				return '#form-error';
			}
			return element_selector;
		},
		show:function(errors,element_selector){
			element_selector=View.errors._default_element(element_selector);
			$(element_selector).html('<p>'+errors.join('</p><p>')+'</p>');
			$(element_selector).show();
		},
		clean:function(element_selector){
			element_selector=View.errors._default_element(element_selector);
			$(element_selector).html('');
			$(element_selector).hide();
		}
	}
};
