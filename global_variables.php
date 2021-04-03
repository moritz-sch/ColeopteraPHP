<?php
/*
Global variables for create_pages.php and create_images.php.
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

  $TimeZone = "Europe/Berlin";
 
  $NumberOfImagesPerRow = 4;
  $BackgroundColor = "150918";
  $MarginLeft = 100;
  $MarginRight = 100;
  $MarginTop = 60;
  
  $ImageDirectory = "/media/veracrypt1/Bilder/Website/Coleoptera/"; //das ist das Verzeichnis, in dem die Verzeichnisse fuer die Familien liegen. Falls es das dasselbe Verzeichnis ist, in dem auch die php-Datei liegt, setze $ImageDirectory = ""; (entsprechende relative Pfade funktionieren ebenfalls) WICHTIG: am Ende muss ein "/" (Linux) oder "\\" (Windows) stehen stehen!
  $PreviewImageWidth = 200;
  $PreviewImageHeight = 150;
  $PreviewImageQuality = 84;
  
  //Datenbanksachen
  $DatabaseServer = "localhost";
  $DatabaseUserName = "root";
  $DatabasePassword = "";
  $DatabaseName = "coleoptera";
  
  //Tabellen in der Datenbank
  $MainTable = "table 1"; //Tabelle in der Datenbank mit bestimmten Arten fuer die Hauptseite
  $MainTableNoID = "table 2"; //Tabelle in der Datenbank mit unbestimmten Arten fuer die Hauptseite
  $LarvaTableNoID = "table 3"; //Tabelle in der Datenbank mit unbestimmten Arten fuer die Larvenseite
  
 ?>
