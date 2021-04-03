<!DOCTYPE HTML>
<html>
<head>
  <title>Erstellen von Vorschaubildern</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <meta name="robots" content="noindex">
</head>

<body>

<?php
/*
PHP scripts to create preview images for the images used in the
pages created by create_pages.php, Windows version
See Documentation.txt for more information

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

  //Systematik aus separater Datei einlesen
  include("systematics.php");
  
  //globale Variablen aus separater Datei einlesen
  include("global_variables.php");
  
  //bei vielen Bildern kann es ziemlich lange dauern. Eine Stunde sollte aber reichen...
  ini_set("max_execution_time",3600);

  //Skaliert das Bild $ImgSrc auf $Width x $Height und speichert es als $ImgDest als jpg-Datei mit Qualitaet $Quality
  function ScaleImage($ImgSrc,$ImgDest,$Width,$Height,$Quality)
  {
    $SourceImage = imagecreatefromjpeg($ImgSrc);
    $SourceImageX = imagesx($SourceImage);
    $SourceImageY = imagesy($SourceImage);
    $NewImage = imagecreatetruecolor($Width,$Height);
    imagecopyresampled($NewImage,$SourceImage,0,0,0,0,$Width,$Height,$SourceImageX,$SourceImageY);
    imagejpeg($NewImage,$ImgDest,$Quality);
    imagedestroy($SourceImage);
  }

  //Funktion, die alle Vorschaubilder erstellt, falls $overwrite==true, werden bestehende ueberschrieben. Die vorhandenen Bilder sollten die Endung "jpg" haben.
   function CreateSmallImages($overwrite)
   {
    global $Families;
	global $ImageDirectory;
	global $PreviewImageWidth;
	global $PreviewImageHeight;
	global $PreviewImageQuality;
	
	$FL = $Families;
	array_push($FL,"Unknown");
	array_push($FL,"Larven");
	  
	$c = 0;
  
    foreach($FL as $F)
    {
	  $FPath = $ImageDirectory.$F; //hier auch andere Verzeichnisse zulassen?
	  
	  if(is_dir($FPath))
	  {
        if($Handle = opendir($FPath))
		{
          while(false !== ($Entry = readdir($Handle)))
		  {
			$FileExtension = pathinfo($Entry, PATHINFO_EXTENSION);
			$FileBaseName = basename($Entry,".".$FileExtension);
			
			if($FileExtension=="jpg" and preg_match("/_s\./",$Entry)==false)
		    {
		      $FileHandleOriginalSize = $FPath."\\".$Entry;
		      $FileHandleSmall = $FPath."\\".$FileBaseName."_s.jpg";
		      if(!file_exists($FileHandleSmall) or ($overwrite == true))
		      {
		        ScaleImage($FileHandleOriginalSize,$FileHandleSmall,$PreviewImageWidth,$PreviewImageHeight,$PreviewImageQuality);
				$c++;
		      }
		    }
          }
	    }
      }
    }
	 
	echo "<p>Es wurden $c Bilder erstellt.</p>\n";
   
 }
  
  if(isset($_POST["overwrite"]))
  {	
    $ow = ($_POST["overwrite"] == "overwrite_yes");
	CreateSmallImages($ow);
	echo "<hr>\n\n";
  }

?>

<form method="post">
  <h3>Vorhandene Bilder überschreiben?</h3>
  <fieldset>
    <input type="radio" id="yes" name="overwrite" value="overwrite_yes">
    <label for="yes">Ja</label>
    <input type="radio" id="no" name="overwrite" value="overwrite_no">
    <label for="no">Nein</label>
    <input type="submit">
  </fieldset>
</form>

</body>

</html>
