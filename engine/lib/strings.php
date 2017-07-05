<?php
/**
*
* функции для работы со строками
*
*/

/**
* Проверяет является ли строка адресом e-mail
*/
function strings_isemail($string)
{
	return preg_match('%[-\.\w]+@[-\w]+(?:\.[-\w]+)+%', $string);
}

/**
* Добавление ссылок на http и e-mail
*/
function strings_addlinks($string)
{
	return preg_replace(
		'%((?:http|ftp)://[-\w]+(?:\.[-\w]+)+\b[-\w:@&?=+,!/~*$\.\'\%]*)(?<![\.,?!)])%i',
		'<a href="\\1">\\1</a>',
		$string
	);
}

/**
* Чистка строки
*/
function strings_clear($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	return htmlspecialchars($string, ENT_QUOTES);
}

/**
* Обрезание строки
*/
function strings_stripstring($text, $wrap, $length)
{
	$text = preg_replace('%(\S{'.$wrap.'})%', '\\1 ', $text);
	return substr($text, 0, $length);
}

?>