<?php

class Comment
{
	private $data = array();
	
	public function __construct($row)
	{
		
		$this->data = $row;
	}

// Если будет время тут допишется рандомная аватарка коммента
	public function markup()
	{
		
		$d = &$this->data;
		
		$link_open = '';
		$link_close = '';
		
		if($d['url']){
			
			$link_open = '<a href="'.$d['url'].'">';
			$link_close =  '</a>';
		}
		
		$d['dt'] = strtotime($d['dt']);

		$url = '';
		
		return '
							<div class="web_gallery">
								<div class="comment">				
									<span class="redtext">'.$link_open.$d['name'].$link_close.'</span> ('.date('d M Y',$d['dt']).')
									<p>'.$d['body'].'</p>
								</div>
							</div>
		';
	}
	
	public static function validate(&$arr)
	{
		
		$errors = array();
		$data	= array();
		
		if(!($data['captcha'] = filter_input(INPUT_POST,'captcha',FILTER_VALIDATE_INT)))
		{
			$errors['captcha'] = 'Пожалуйста, введите капчу.';
		}
		
		if(!($data['url'] = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL)))
		{
			
			$url = '';
		}
		
		if(!($data['body'] = filter_input(INPUT_POST,'body',FILTER_CALLBACK,array('options'=>'Comment::validate_text'))))
		{
			$errors['body'] = 'Пожалуйста, введите текст комментария.';
		}
		
		if(!($data['name'] = filter_input(INPUT_POST,'name',FILTER_CALLBACK,array('options'=>'Comment::validate_text'))))
		{
			$errors['name'] = 'Пожалуйста, введите имя.';
		}
		
		if(!empty($errors)){
			
			$arr = $errors;
			return false;
		}
		
		foreach($data as $k=>$v){
			$arr[$k] = mysql_real_escape_string($v);
		}
		
		$arr['captcha'] = strtolower($arr['captcha']);
		
		return true;
		
	}

	private static function validate_text($str)
	{
		
		if(mb_strlen($str,'cp1251')<1)
			return false;
		
		$str = nl2br(htmlspecialchars($str));

		$str = str_replace(array(chr(10),chr(13)),'',$str);
		
		return $str;
	}

}

?>