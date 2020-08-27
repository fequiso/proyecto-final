<?php
	date_default_timezone_set('America/Los_Angeles');

	function fechaC(){
		$mes = array("","01","02",
					  "03","04","05","06","07",
					  "08","09","10","11","12");
		return date('d')."/". $mes[date('n')] . "/" . date('Y');
	}
 ?>
