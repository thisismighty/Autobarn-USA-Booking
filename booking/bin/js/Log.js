var Log={
	_log:[],
	display:0,
	add:function(msg){
		if(msg===Object(msg)){
			try{
				msg='Object: '+JSON.stringify(msg);
			}catch(e){
				msg='error converting this object';
			}
		}
		var add=(new Date()).toString()+' '+msg;
		this._log.push(add);
		if(this.display==1){
			console.log(add);
		}
		if(this.display==2){
			console.log(msg);
		}
	},
	get:function(){
		return this._log.join('\n');
	}
};
