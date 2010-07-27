<?php
# redirect the user to a different location
function redirect($location){ header('Location: '.$location); exit; }

# pass-through to htmlspecialchars
function h($_){ return htmlspecialchars($_); }

/* Generate a random string. Arguments:
	(integer) desired length of string
	(boolean) disallow two adjacent copies of the same character
	(string)  character set */
function rand_str($l, $u=false, $c='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'){
	if(!$u) for($z=strlen($c)-1, $s=''; $l > 0; $s.=$c{rand()&$z}, $l--);
	else for($z=strlen($c)-1, $s=$c{rand()&$z}, $i=1; $l>0; $s.=$c{rand()&$z}, list($s,$l,$i)=( $s{$i}==$s{$i-1} ? array(substr($s,0,-1),$l,$i) : array($s,$l-1,$i+1) ));
	return $s;
}

# pretty-prints any value
function pp($a){ return nl2br(str_replace(array("\t",'  '),'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',var_export($a,true))).';<br />'."\n"; }

/* Limit a string to a given length. Arguments:
	(string)  the string to limit
	(integer) the number of characters allowed
	(string)  a string to append to the truncated string */
function truncate($text,$maxlen,$etc="...") {
	if (strlen($text) <= $maxlen)  return $text;
	$text = substr($text, 0, max(0,$maxlen-strlen($etc)));
	//$text = substr($text,0,strrpos($text," ")); # uncomment to remove the last word of text
	$text = ($len=strspn(strrev($text),'.!?:;,-"\'([{ ')) ? substr($text, 0, -1*$len) : $text;
	return $text.$etc;
}

function json_wrap($json){ return '(function(){return ('.$json.');})()'; }
function json_err($msg){ return json_wrap(json_encode(array('error'=>true,'error_message'=>$msg))); }
?>
