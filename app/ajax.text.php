<?php
function encodeHTML($html, $chars=0) {

  if(empty($html)) $html = "";
    if($chars!=0)
    $html = substr($html, 0, $chars);


	if(basename(dirname(dirname(__FILE__)))!=basename($_SERVER['DOCUMENT_ROOT']))
		$url = "/".basename(dirname(dirname(__FILE__)))."/";
	else
		$url = "/";
	$url .= "ups/www/";
	$patterns = array();
	$replacements = array();

	$patterns[] = "/\|(.*?)\|/";
	$replacements[] = "<div>\\1</div>";
	$patterns[] = "/--(.*?)--/";
	$replacements[] = "<strike>\\1</strike>";
	$patterns[] = "/\*\*(.*?)\*\*/";
	$replacements[] = "<strong>\\1</strong>";
	$patterns[] = "/\*(.*?)\*/";
	$replacements[] = "<em>\\1</em>";
	$patterns[] = "/\^(\w*)/";
	$replacements[] = "<sup>\\1</sup>";
	$patterns[] = "/^\>\s(.*)$/m";
	$replacements[] = "<blockquote>\\1</blockquote>";
	$patterns[] = "/^\*\s(.*?)$/m";
	$replacements[] = "<li>\\1</li>";
	$patterns[] = "/^center\-\s(.*?)$/m";
	$replacements[] = "<p class='center'>\\1";
	$patterns[] = "/^left\-\s(.*?)$/m";
	$replacements[] = "<p class='left'>\\1";
	$patterns[] = "/^right\-\s(.*?)$/m";
	$replacements[] = "<p class='right'>\\1";
	$patterns[] = "/^centre\-\s(.*?)$/m";
	$replacements[] = "<p class='center'>\\1";
	$patterns[] = "/^gauche\-\s(.*?)$/m";
	$replacements[] = "<p class='left'>\\1";
	$patterns[] = "/^droite\-\s(.*?)$/m";
	$replacements[] = "<p class='right'>\\1";
	$patterns[] = "/^\#\s(.*?)$/m";
	$replacements[] = "<h1>\\1</h1>";
	$patterns[] = "/^\#\#\s(.*?)$/m";
	$replacements[] = "<h2>\\1</h2>";
	$patterns[] = "/^\#\#\#\s(.*?)$/m";
	$replacements[] = "<h3>\\1</h3>";
	$patterns[] = "/^\#\#\#\#\s(.*?)$/m";
	$replacements[] = "<h4>\\1</h4>";
	$patterns[] = "/^\#\#\#\#\#\s(.*?)$/m";
	$replacements[] = "<h5>\\1</h5>";
	$patterns[] = "/^\#\#\#\#\#\#\s(.*?)$/m";
	$replacements[] = "<h6>\\1</h6>";
	$patterns[] = "/^\#\#\#\#\#\#\#\s(.*?)$/m";
	$replacements[] = "<h7>\\1</h7>";
	$patterns[] = "/^\#\#\#\#\#\#\#\#\s(.*?)$/m";
	$replacements[] = "<h8>\\1</h8>";
	$patterns[] = "/^\#\#\#\#\#\#\#\#\#\s(.*?)$/m";
	$replacements[] = "<h9>\\1</h9>";
	$patterns[] = "/\[(.*?)\]\((.*?)\)/";
	$replacements[] = "<a href='\\2'>\\1</a>";
	$patterns[] = "/\[img src=\"(.*?)\" title=\"(.*?)\"\]/";
  $replacements[] = "<a class=\"gal\" href=\"".$url."\\1\" title=\"\\2\"><img src='".$url."\\1' title='\\2' /></a>";


	$html = preg_replace($patterns, $replacements, $html);
	$html = str_replace(array("</li>\r\n\r\n", "</li>\r\r", "</li>\n\n"), "</li><p id='rn'>", $html);
	$html = str_replace(array("</li>\r\n", "</li>\r", "</li>\n"), "</li>", $html);
	$html = str_replace(array("</blockquote>\r\n\r\n", "</blockquote>\r\r", "</blockquote>\n\n"), "</blockquote><p id='rn'>", $html);
	$html = str_replace(array("</blockquote>\r\n", "</blockquote>\r", "</blockquote>\n"), "</blockquote>", $html);
	$html = str_replace(array("</p>\r\n\r\n", "</p>\r\r", "</p>\n\n"), "</p><p id='rn'>", $html);
	$html = str_replace(array("</p>\r\n", "</p>\r", "</p>\n"), "</p>", $html);
	$html = str_replace(array("\r\n\r\n", "\r\r", "\n\n"), "</p><p id='r'>", $html);
	$html = str_replace(array("\r\n", "\r", "\n"), "<br />", $html);

  /*
	$html = str_replace("</li><br /><li>", "</li><li>", $html);
	$html = str_replace("</li><br />", "</li><p>", $html);
	$html = str_replace("<br /><li>", "</p><li>", $html);
	$html = str_replace("<br /></li>", "</li>", $html);
	$html = str_replace("<p><br /><br />", "<p>", $html);
	$html = str_replace("<p><br /><br />", "<p>", $html);

	$html = str_replace("<br /></blockquote>", "</blockquote>", $html);
  */

	return $html;

}

if(isset($_POST['text']))
	echo encodeHTML($_POST['text']);
