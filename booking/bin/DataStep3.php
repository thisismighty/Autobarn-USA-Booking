<?php

class DataStep3
{
	public static $country='AU';
	public static $pop_url='';

	public function pop_content(){
		$a=file_get_contents($this::$pop_url);
		var_dump($a,$this::$pop_url);die();
		if(!$a){
			return '[]';
		}
		return $a;
	}
	
	public function to_eval($path_to_wp_load)
	{
require_once($path_to_wp_load);
		return <<<EOT
\$preserve_variables=array_keys(get_defined_vars());
define('WP_USE_THEMES', true);

\$preserve_pops=get_field('pop_ups','option');
foreach(array_keys(get_defined_vars()) as \$variable){
	if(substr(\$variable,0,9)=='preserve_'){
		continue;
	}
	if(in_array(\$variable,\$preserve_variables)){
		continue;
	}
	unset(\$\$variable);
}
if(!\$preserve_pops){
	return array();
}
foreach(\$preserve_pops as \$key=>\$pop){
	\$preserve_pops[\$key]=array_values(\$pop);
}
unset(\$preserve_variables,\$variable,\$pop,\$key);
return json_encode(\$preserve_pops);
EOT;
	}

}
