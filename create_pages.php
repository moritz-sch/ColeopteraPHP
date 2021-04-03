<!DOCTYPE HTML>
<html>
<head>
  <title>Erstellen der HTML-Seiten</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <meta name="robots" content="noindex">
</head>

<body>

<?php
  /*
  PHP scripts to create HTML pages. This is just the menu for choosing
  which pages to creates and whether there should be constraints.

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

  //Systematik auf Unterordnungs-/Überfamilien-, Familien- und Unterfamilienebene aus separater Datei einlesen
  include("systematics.php");
  
  //globale Variablen aus separater Datei einlesen
  include("global_variables.php");
  
  date_default_timezone_set($TimeZone);
  $CurrentDate = date("d.m.Y");
  
  //Datenbank
  $Database = mysqli_connect($DatabaseServer,$DatabaseUserName,$DatabasePassword,$DatabaseName);
  if(!$Database)
  {
    exit("Verbindungsfehler: ".mysqli_connect_error());
  }
  
  
  //Berechne die Anzahl der Arten in der deutschen Fauna
  $NumberOfSpeciesInGermanFauna = 0;
  foreach($Families as $F)
  {
    $NumberOfSpeciesInGermanFauna += NumberOfSpeciesInTaxon($F);
  }
  
  
  //Funktionen aus separater Datei einlesen
  include("functions.php");
  
  
  
  //Seite beginnt hier
  //Einschränkungen in der Datei qualifiers.php, dort editieren!
  
  if(isset($_POST["write_main_page"]) or isset($_POST["write_larvae_page"]) or isset($_POST["write_stats_page"]))
  {
    if(isset($_POST["use_qualifiers"]))
    {
      echo "<p>Alle Seiten werden mit Einschränkungen erstellt.</p>\n\n";
      include("qualifiers.php");
    }
    else
    {
      echo "<p>Alle Seiten werden ohne Einschränkungen erstellt.</p>\n\n";
      $Qualifiers = [];
    }
  
    if(isset($_POST["write_main_page"]))
    {
      WritePage(false,$Qualifiers); //schreibe Hauptseite
	  echo "<p>Hauptseite wurde erstellt.</p>\n\n";
    }
    else
    {
      echo "<p>Hauptseite wurde NICHT erstellt.</p>\n\n";
    }
	
	if(isset($_POST["write_larvae_page"]))
    {
      WritePage(true,$Qualifiers); //schreibe Larvenseite
	  echo "<p>Larvenseite wurde erstellt.</p>\n\n";
    }
    else
    {
      echo "<p>Larvenseite wurde NICHT erstellt.</p>\n\n";
    }
	
	if(isset($_POST["write_stats_page"]))
    {
      WriteStatisticsPage($Qualifiers); //schreibe Statistikseite
	  echo "<p>Statistikseite wurde erstellt.</p>\n\n";
    }
    else
    {
      echo "<p>Statistikseite wurde NICHT erstellt.</p>\n\n";
    }
	
	echo "<hr>\n\n";
	
  }
  
?>

<form method="post">
  <h3>Erstelle die HTML-Seiten</h3>
  <fieldset>
    <input type="checkbox" id="main_page" name="write_main_page" value="main_page_yes">
    <label for="main_page">Erstelle Hauptseite</label>
    <input type="checkbox" id="larvae_page" name="write_larvae_page" value="larvae_page_yes">
    <label for="main_page">Erstelle Larvenseite</label>
    <input type="checkbox" id="stats_page" name="write_stats_page" value="stats_page_yes">
    <label for="main_page">Erstelle Statistikseite</label>
    <input type="checkbox" id="qualifiers" name="use_qualifiers" value="qualifiers_yes">
    <label for="main_page">Einschränkung</label>
    <input type="submit">
  </fieldset>
</form>

</body>

</html>
