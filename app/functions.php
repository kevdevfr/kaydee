 <?php

function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}

function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
    $toDom = dom_import_simplexml($to);
    $fromDom = dom_import_simplexml($from);
    $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
}

function formatBytes( $size , $precision = 2 )
{
    $base = log( $size, 1024 );
    $suffixes = array( '', 'K', 'M', 'G', 'T' );

    return round( pow( 1024, $base - floor( $base ) ), $precision ) . '' . $suffixes[floor( $base )];
}

function file_upload_max_size()
{
  static $max_size = -1;

  if ( $max_size < 0 ) {
    // Start with post_max_size.
    $max_size = parse_size( ini_get( 'post_max_size' ) );

    // If upload_max_size is less, then reduce. Except if upload_max_size is
    // zero, which indicates no limit.
    $upload_max = parse_size( ini_get( 'upload_max_filesize' ) );
    if ( $upload_max > 0 && $upload_max < $max_size ) {
      $max_size = $upload_max;
    }
  }
  return $max_size;
}

function parse_size( $size )
{
  $unit = preg_replace( '/[^bkmgtpezy]/i', '', $size ); // Remove the non-unit characters from the size.
  $size = preg_replace( '/[^0-9\.]/', '', $size ); // Remove the non-numeric characters from the size.
  if ( $unit ) {
    // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
    return round( $size * pow( 1024, stripos( 'bkmgtpezy', $unit[0] ) ) );
  }
  else {
    return round( $size );
  }
}

function removeAccents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caract�res

    return $str;
}

function resizeImage($newHeight, $targetFile, $originalFile) {

    $info = getimagesize($originalFile);

    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            case 'image/svg':
                    exit();
                    break;
            default:
                    throw Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    if($mime=='image/png')
    {
      imageAlphaBlending($img, true);
      imageSaveAlpha($img, true);
    }
    list($width, $height) = getimagesize($originalFile);

    if($height<=$newHeight) return false;

    $newWidth = ($width / $height) * $newHeight;

    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile");

    return true;
}

function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' )
    {
      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
  }
  // close the directory
  closedir( $dir );
}

function array_group_by(array $arr,  $key_selector) {
  $result = array();
  foreach ($arr as $i) {
    $key = call_user_func($key_selector, $i);
    $result[$key][] = $i;
  }
  return $result;
}

function classify($str) {
    $str = removeAccents($str);
    $str = str_replace('\'','',$str);
	$str = preg_replace( '/\s+/', '', $str );
	$str = str_replace( ',', '', $str );
	$str = strtolower($str);

    return $str;
}

function first_letter($str, $repl) {
  // using a regular expression beats a foreach
  $search = '/(\b\w)|(?<=\p{Ll})\p{Lu}/u';
  // simple var + backreference concatenation
  $repl = $repl . '$2';
  // use preg_replace to replace based on our regex
  $new_str = preg_replace($search, $repl, $str);

  return $new_str;
}

function spanup($str, $repl) {
  // using a regular expression beats a foreach
  $search = '/([A-ZÉ])/u';
  // simple var + backreference concatenation
  $repl = $repl . '$2';
  // use preg_replace to replace based on our regex
  $new_str = preg_replace($search, $repl, $str);

  return $new_str;
}

function lang($arr){
  $lang = 'fr';
  if(isset($_SESSION['lang']))
    $lang = $_SESSION['lang'];

  return $arr[$lang];

}

function idfy($str) {
		$str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
		$str = preg_replace('#&[^;]+;#', '', $str);
		$str = str_replace('\'','-',$str);
		$str = str_replace('/','-',$str);
		$str = str_replace(',','',$str);
		$str = preg_replace( '/\s+/', '-', $str );
		$str = str_replace(' ','_',$str );
		$str = strtolower($str);
		return $str;
}
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


	$html = "<p>".$html;
	$html = $html."</p>";
	$html = str_replace("<p></p>", "", $html);
	$html = str_replace("<p><p", "<p", $html);
	return $html;
}

function encodeHTMLDiv($html, $chars=0) {
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
		$replacements[] = "</p><blockquote>\\1</blockquote><p>";
		$patterns[] = "/^\*\s(.*?)$/m";
		$replacements[] = "<li>\\1</li>";
		$patterns[] = "/^center\-\s(.*?)$/m";
		$replacements[] = "<p class='center'>\\1</p><p>";
		$patterns[] = "/^left\-\s(.*?)$/m";
		$replacements[] = "<p class='left'>\\1</p><p>";
		$patterns[] = "/^right\-\s(.*?)$/m";
		$replacements[] = "<p class='right'>\\1</p><p>";
		$patterns[] = "/^centre\-\s(.*?)$/m";
		$replacements[] = "<p class='center'>\\1</p><p>";
		$patterns[] = "/^gauche\-\s(.*?)$/m";
		$replacements[] = "<p class='left'>\\1</p><p>";
		$patterns[] = "/^droite\-\s(.*?)$/m";
		$replacements[] = "<p class='right'>\\1</p><p>";
  		$patterns[] = "/^h1\-\s(.*?)$/m";
  		$replacements[] = "<h1>\\1</h1>";
    		$patterns[] = "/^h2\-\s(.*?)$/m";
    		$replacements[] = "<h2>\\1</h2>";
		$patterns[] = "/^h3\-\s(.*?)$/m";
		$replacements[] = "<h3>\\1</h3>";
		$patterns[] = "/^h4\-\s(.*?)$/m";
		$replacements[] = "<h4>\\1</h4>";
		$patterns[] = "/\[(.*?)\]\((.*?)\)/";
		$replacements[] = "<a href='\\2'>\\1</a>";

  	$patterns[] = "/\[img src=\"(.*?)\" title=\"(.*?)\"\]/";
    $replacements[] = "<a class=\"gal\" href=\"".$url."\\1\" title=\"\\2\"><img src='".$url."\\1' title='\\2' /></a>";
    /*
	$patterns[] = "/\[img src=\"(.*?)\"\]/";
		$replacements[] = "<a class=\"gal\" href=\"".$url."\\1\"><span style=\"background-image: url('".$url."\\1')\" /></span></a>";*/
		$patterns[] = "/\[(.*?)\](.*?)\[\/(.*?)\]/";
		$replacements[] = "<\\1>\\2</\\1>";



		$html = preg_replace($patterns, $replacements, $html);
		$html = str_replace(array("\r\n\r\n", "\r\r", "\n\n"), "</p><p>", $html);
		$html = str_replace(array("\r\n", "\r", "\n"), "<br />", $html);
		$html = str_replace("</li><br /><li>", "</li><li>", $html);
		$html = str_replace("</li><br />", "</li><p>", $html);
		$html = str_replace("<br /><li>", "</p><li>", $html);
		$html = str_replace("<br /></li>", "</li>", $html);
		$html = str_replace("<p><br /><br />", "<p>", $html);

		$html = str_replace("<br /></blockquote>", "</blockquote>", $html);

		$html = "<p>".$html;
		$html = $html."</p>";
		//$html = str_replace("<p></p>", "", $html);
		$html = str_replace("<p><p", "<p", $html);
		echo $html;
	}
function resize($newWidth, $targetFile) {
    $info = getimagesize($targetFile);
    $mime = $info['mime'];
	$width = $info[0] ;
	$height = $info[1] ;

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default:
				exit();
    }

    $img = $image_create_func($targetFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, $targetFile);


}

//ruudrp at live dot nl
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

	$ub="";
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

?>
