<?php

namespace Src;

class View
{
	public static function render($path, $items = [])
	{
		foreach($items as $key => $value){
			$$key = $value;
		}

		if(file_exists(__DIR__.'./views/'.$path.'.php')){
			include __DIR__.'./views/'.$path.'.php';
		}else{
			include __DIR__.'./views/p404.php';
			die();
		}
	}
}
