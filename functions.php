<?php
  /*
  Lots of functions for creating the HTML pages.

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

  
  function AddQualifiers($query,$StringList)
  {
    $i = 0;
	
    foreach($StringList as $S)
	{
	  if($i==0 and preg_match("/WHERE/",$query)==false)
	  {
	    $query .= " WHERE ";
	  }
	  else
	  {
	    $query .= " AND ";
	  }
	  $query .= $S;
	  $i++;
	}
	
	return $query;
  }
  
  //eigentlich Ueberfamilie oder Unterordnung, aber Name ist schon lang genug
  function CountSpeciesInDatabaseSuperfamily($SupF,$larva,$Qualifiers)
  {
    global $Database;
    global $MainTable;
	
    $FList = SuperfamilyToFamily($SupF);
	$c = 0;
	
	foreach($FList as $F)
	{
	  if($larva==false)
	  {
        $query = "SELECT species FROM  `$MainTable` WHERE family LIKE '$F'";
      }
	  else
	  {
	    $query = "SELECT species FROM  `$MainTable` WHERE family LIKE '$F' AND larva LIKE 'y'";
	  }
	  $query = AddQualifiers($query,$Qualifiers);
      $L = mysqli_query($Database,$query);
   
      while($row = mysqli_fetch_object($L))
      {
        $c++;
      }
	  
	}
	
	return $c;
	
  }
  
  //zaehlt die Anzahl der Arten der Familie $F, die in $MainTable gespeichert sind
  function CountSpeciesInDatabaseFamily($F,$larva,$Qualifiers)
  {
    global $Database;
    global $MainTable;
	
	if($larva==false)
	{
      $query = "SELECT species FROM  `$MainTable` WHERE family LIKE '$F'";
	}
	else
	{
	  $query = "SELECT species FROM  `$MainTable` WHERE family LIKE '$F' AND larva LIKE 'y'";
	}
	$query = AddQualifiers($query,$Qualifiers);
    $L = mysqli_query($Database,$query);
    $a = 0;
   
    while($row = mysqli_fetch_object($L))
    {
      $a++;
    }
    return $a;
  }
 
  //wie CountSpeciesInDatabaseFamily nur mit Unterfamilie $SubF der Familie $F
  function CountSpeciesInDatabaseSubfamily($F,$SubF,$larva,$Qualifiers) //$F mit anzugeben ist wichtig (im Fall, dass die Unterfamilie unbekannt ist!)
  {
    global $Database;
    global $MainTable;
	
	if($larva == false)
	{
      $query = "SELECT species FROM  `$MainTable` WHERE family LIKE '$F' AND subfamily LIKE '".$SubF."'";
	}
	else
	{
	  $query = "SELECT species FROM  `$MainTable` WHERE family LIKE '$F' AND subfamily LIKE '".$SubF."' AND larva LIKE 'y'";
	}
	$query = AddQualifiers($query,$Qualifiers);
    $L = mysqli_query($Database,$query);
    $a = 0;
   
    while($row = mysqli_fetch_object($L))
    {
      $a++;
    }
    return $a;
  }
  
  //zaehlt die Anzahl der Eintraege in $MainTableNoID und $LarvaTableNoID zur Ueberfamilie $SupF
  function CountSpeciesInDatabaseSuperfamilyNoID($SupF,$larva,$Qualifiers)
  {
    global $Database;
	global $MainTableNoID;
    global $LarvaTableNoID;
	
    $FList = SuperfamilyToFamily($SupF);
	$c = 0;
	
	foreach($FList as $F)
	{
	  if($larva==false)
	  {
        $Table = $MainTableNoID;
      }
	  else
	  {
	    $Table = $LarvaTableNoID;
	  }
	  $query = "SELECT species FROM  `$Table` WHERE family LIKE '$F'";
	  $query = AddQualifiers($query,$Qualifiers);
      $L = mysqli_query($Database,$query);
   
      while($row = mysqli_fetch_object($L))
      {
        $c++;
      }
	  
	}
	
	return $c;
	
  }
  
  //wie CountSpeciesInDatabaseSuperfamilyNoID nur mit Familie $F
  function CountSpeciesInDatabaseFamilyNoID($F,$larva,$Qualifiers) 
  {
    global $Database;
    global $MainTableNoID;
	global $LarvaTableNoID;
	
	if($larva==false)
	{
	  $Table = $MainTableNoID;
	}
	else
	{
	  $Table = $LarvaTableNoID;
	}
	
    $query = "SELECT species FROM  `$Table` WHERE family LIKE '$F'";
	$query = AddQualifiers($query,$Qualifiers);

    $L = mysqli_query($Database,$query);
    $a = 0;
   
    while($row = mysqli_fetch_object($L))
    {
      $a++;
    }
    return $a;
  }
  
  //wie CountSpeciesInDatabaseSuperfamilyNoID nur mit Unterfamilie $SubF der Familie $F
  function CountSpeciesInDatabaseSubfamilyNoID($F,$SubF,$larva,$Qualifiers) //$F mit anzugeben ist wichtig (im Fall, dass die Unterfamilie unbekannt ist!)
  {
    global $Database;
    global $MainTableNoID;
	global $LarvaTableNoID;
	
	if($larva==false)
	{
	  $Table = $MainTableNoID;
	}
	else
	{
	  $Table = $LarvaTableNoID;
	}
	
    $query = "SELECT species FROM  `$Table` WHERE family LIKE '$F' AND subfamily LIKE '$SubF'";
	$query = AddQualifiers($query,$Qualifiers);
    $L = mysqli_query($Database,$query);
    $a = 0;
   
    while($row = mysqli_fetch_object($L))
    {
      $a++;
    }
    return $a;
  }
  
  //prueft, ob in einer gegebenen Familie ein Eintrag mit unbekannter Unterfamilie in der Datenbank existiert
  function DoesEntryWithUnknownSubfamilyExist($F,$larva,$Qualifiers)
  {
    global $Database;
	global $MainTableNoID;
	global $LarvaTableNoID;
	
	$SubfamList = FamilyToSubfamily($F);
	if($SubfamList==[])
	{
	  return false;
	}
	
	if($larva==false)
	{
	  $query = "SELECT species FROM  `$MainTableNoID` WHERE family LIKE '$F' AND subfamily LIKE ''";
	}
	else
	{
	  $query = "SELECT species FROM  `$LarvaTableNoID` WHERE family LIKE '$F' AND subfamily LIKE ''";
	}
	$query = AddQualifiers($query,$Qualifiers);
	$L = mysqli_query($Database,$query);
	
	while($row = mysqli_fetch_object($L))
	{
	  return true;
	}
	
	return false;
	
  }
  
  
  //prueft, ob in einer gegebenen Ueberfamilie ein Eintrag mit unbekannter Familie in der Datenbank existiert.
  function DoesEntryWithUnknownFamilyExist($larva,$Qualifiers)
  {
    global $Database;
	global $MainTableNoID;
	global $LarvaTableNoID;
	
	if($larva==false)
	{
	  $query = "SELECT species FROM  `$MainTableNoID` WHERE family LIKE ''";
	}
	else
	{
	  $query = "SELECT species FROM  `$LarvaTableNoID` WHERE family LIKE ''";
	}
	$query = AddQualifiers($query,$Qualifiers);
	$L = mysqli_query($Database,$query);
	
	while($row = mysqli_fetch_object($L))
	{
	  return true;
	}
	
	return false;
	
  }
  
  
  //ueberprueft, ob die Eingabe eine Gattung ist... bzw. eigentlich wird ueberprueft, ob es KEINE Unterordnung, Ueberfamilie, Familie, Unterfamilie oder Tribus ist! Solange keine anderen Taxa vorkommen, reicht das aus
  function IsGenus($PotentialGenus)
  {
    global $SuperfamiliesAndSuborders;
	global $Families;
	global $AllSubfamilies;
	
	$IsGenus = true;
	
	foreach([$SuperfamiliesAndSuborders,$Families,$AllSubfamilies] as $T)
	{
	  if(in_array($PotentialGenus,$T))
	  {
		$IsGenus = false; // $PotentialGenus ist eine Unterordnung, Ueberfamilie, Familie oder Unterfamilie
	  }
	}
	
	$PotGen = $PotentialGenus."xxx";
	  
	if(preg_match("/inixxx/",$PotGen)==true)
	{
	  $IsGenus = false; // $PotentialGenus ist eine Tribus (oder eine Gattung, die auf -ini endet... sollte es aber in Mitteleuropa nicht geben)
	}
	  
	return $IsGenus;
	
  }
  
  
  //z.B. "Allecula morio" -> ["Allecula"], "cf. Dinaraea aequata" -> ["Dinaraea"], "Oligota/Holobus sp." -> ["Oligota","Holobus"]
  //ACHTUNG: Ich gehe davon aus, dass neben Gattungen (und Untergattungen) nur Unterordnungen, Ueberfamilien, Familien, Unterfamilien und Triben vorkommen! Siehe auch Kommentar zur Funktion IsGenus
  function GetGenera($spec)
  {
    global $SuperfamiliesAndSuborders;
	global $Families;
	global $AllSubfamilies;
  
    if($spec=="Unknown")
	{
	  return [];
	}
	
	if(explode("cf. ",$spec)[0]=="") //falls ein cf. am Anfang steht, gibt es keine sicher bestimmte Gattung
	{
	  return [];
	}
	
    $SpecNoSubgenus = explode(" (",$spec)[0]; //z.B. "Quedius (Raphirus) sp." -> "Quedius"
	$SpecNoSStr = explode(" s. str.",$SpecNoSubgenus)[0]; //z.B. "Haliplus s. str. sp." -> "Haliplus"
    $SpecNocf = str_replace("cf. ","",$SpecNoSStr);
    $PotentialGenera = explode(" ",$SpecNocf)[0];
	$PotentialGeneraList = explode("/",$PotentialGenera);
	
	$GeneraList = [];
	
	foreach($PotentialGeneraList as $PotentialGenus)
	{
	  if(IsGenus($PotentialGenus) == true)
	  {
        array_push($GeneraList,$PotentialGenus);
	  }
	}
	
	return $GeneraList;

  }
  
  
  //zaehlt die Anzahl der Arten in $MainTable (falls $larva==true, nur Arten, die als Larven gefunden worden sind)
  function CountSpecies($larva,$Qualifiers)
  {
    global $Database;
    global $MainTable;
	
    $a=0;
  
    if($larva==false)
	{
      $query = "SELECT * FROM  `$MainTable`";
	}
	else
	{
	  $query = "SELECT * FROM  `$MainTable` WHERE larva LIKE 'y'";
	}
	$query = AddQualifiers($query,$Qualifiers);
    $L = mysqli_query($Database,$query);
    
    while($row = mysqli_fetch_object($L))
    {
      $a++;
    }
    
    return $a;
  }
  
  //zaehlt die Anzahl der Gattungen in $MainTable (falls $larva==true nur Arten, die als Larven gefunden worden sind)
  function CountGenera($larva,$Qualifiers)
  {
    global $Database;
    global $MainTable;
	global $MainTableNoID;
	global $LarvaTableNoID;
	
    $GenusSet = [];
	if($larva==false)
	{
	  $Tables = [$MainTable,$MainTableNoID];
	}
	else
	{
	  $Tables = [$MainTable,$LarvaTableNoID];
	}
    
    foreach($Tables as $T)
    {
	  if($T==$MainTable and $larva==true)
	  {
	    $query = "SELECT * FROM `$T` WHERE larva LIKE 'y'";
	  }
	  else
	  {
	    $query = "SELECT * FROM `$T`";
	  }
	  $query = AddQualifiers($query,$Qualifiers);
      $L = mysqli_query($Database,$query);
    
      while($row = mysqli_fetch_object($L))
      {
	    $spec = $row->species;
        $genera = GetGenera($spec);
		if(count($genera)==1 and $spec[0]<>"c" and $spec[1]<>"f")
		{
          $GenusSet += [$genera[0] => 1];
		}
      }
    }

	return count($GenusSet);
	
  }
  
  //zaehlt die Anzahl der Familien in $MainTable (falls $larva==true nur Arten, die als Larven gefunden worden sind)
  function CountFamilies($larva,$Qualifiers) //Implementation ohne Sets
  {
    global $Database;
    global $MainTable;
	global $MainTableNoID;
	global $LarvaTableNoID;
	
    $FamilySet = [];
	if($larva==false)
	{
	  $Tables = [$MainTable,$MainTableNoID];
	}
	else
	{
	  $Tables = [$MainTable,$LarvaTableNoID];
	}
	
	foreach($Tables as $T)
	{
      if($T==$MainTable and $larva==true)
	  {
	    $query = "SELECT * FROM `$T` WHERE larva LIKE 'y'";
	  }
	  else
	  {
	    $query = "SELECT * FROM `$T`";
	  }
	  $query = AddQualifiers($query,$Qualifiers);
      $L = mysqli_query($Database,$query);
	
	  while($row = mysqli_fetch_object($L))
	  {
	    if($row->family<>"") //koennte man vielleicht schon bei $query ausschliessen
		{
	      $FamilySet += [$row->family => 1];
		}
	  }
	}
	
	return count($FamilySet);
	
  }
  
  // fügt, sofern vorhanden, noch den deutschen Namen in Klammern an, z.B. "Staphylinidae" -> "Staphylinidae (Kurzflügler)"
  //$lvl gibt an, um welches Taxon es sich handelt, Moeglichkeiten: "family", "subfamily"
  function FullName($T,$lvl)
  {
    if($T == "")
	{
	  if($lvl=="family")
	  {
	    return "Unbekannte Familie";
	  }
	  elseif($lvl=="subfamily")
	  {
	    return "Unbekannte Unterfamile";
	  }
	  else
	  {
	    return "ERROR, UNKNOWN TAXON";
	  }
	}
    $Vname = VernacularName($T);
	if($Vname)
	{
	  return $T." (".$Vname.")";
	}
	else
	{
	  return $T;
	}
  }
  
  // gibt zu einem Datenbankeintrag den passenden Dateinamen der Bilder aus
  // z.B. "Agyrtes bicolor" -> "Agyrtes_bicolor", "cf. Atheta sp." -> "cf_Atheta_sp"
  function SpeciesNameInFile($spec)
  {
    $SpecNoPeriod = str_replace(".","",$spec);
	$SpecSlashToUnderscore = str_replace("/","_",$SpecNoPeriod);
	$SpecInFile = str_replace(" ","_",$SpecSlashToUnderscore);
	
	return $SpecInFile;
	
  }
  
  //Tabellen mit Familien sortiert nach Anzahl Arten und Anteil der gefundenen Arten
  function TablesFamiliesBySpeciesAndRatio($Qualifiers)
  {
    global $Database;
    global $Families;
	global $NumberOfSpeciesInGermanFauna;
	
	$Tables = "";
  
    $FamSpec = [];
    $FamRat = [];
	$TotalNumberSpecies = 0;
	
    $c = 0;
    
    foreach($Families as $F)
    {
      $NumberOfMySpecies = CountSpeciesInDatabaseFamily($F,false,$Qualifiers);
      $NumberOfTotalSpecies = NumberOfSpeciesInTaxon($F);
	  
	  $TotalNumberSpecies += $NumberOfMySpecies;
      
      if($NumberOfMySpecies > 0)
      {      
        $c++;
        $Ratio = 100*round($NumberOfMySpecies/$NumberOfTotalSpecies,3);
      
        $Fname = FullName($F,"family");
      
        array_push($FamSpec,[$NumberOfMySpecies,$Ratio,$NumberOfTotalSpecies,$Fname]); // $Ratio an Stelle 2 wegen Sortierung
        array_push($FamRat,[$Ratio,$NumberOfMySpecies,$NumberOfTotalSpecies,$Fname]);
      }
    }
	
	$TotalRatio = 100*round($TotalNumberSpecies/$NumberOfSpeciesInGermanFauna,3);
    
    sort($FamSpec);
    sort($FamRat);
	
	$Tables .= "<h2>Familien nach Artenzahl und nach Anteil erfasster Arten</h2>\n\n";
    
    $Tables .= "<table  cellpadding=\"30\">\n";
    $Tables .= "  <tr>\n";
    $Tables .= "    <td>\n";
    $Tables .= "      <table  cellpadding=\"5\">\n";
	
	$Tables .= "        <tr>\n";
	$Tables .= "          <td></td>\n";
	$Tables .= "          <td><b>Familie</b></td>\n";
	$Tables .= "          <td><b>Anzahl/gesamt</b></td>\n";
	$Tables .= "          <td><b>Anteil</b></td>\n";
	$Tables .= "        </tr>\n";
	
	$Tables .= "        <tr>\n";
	$Tables .= "          <td></td>\n";
	$Tables .= "          <td><b class=\"totalrow\">gesamt</b></td>\n";
	$Tables .= "          <td><b class=\"totalrow\">$TotalNumberSpecies/$NumberOfSpeciesInGermanFauna</b></td>\n";
	$Tables .= "          <td><b class=\"totalrow\">$TotalRatio%</b></td>\n";
	$Tables .= "        </tr>\n";
	  
    $t = null;
    
    for($i = 1; $i <= $c; $i++)
    {
      $Tables .= "        <tr>\n";
      $Tables .= "          <td>";
      if($FamSpec[$c-$i][0] <> $t)
      {
        $Tables .= $i;
      }
      $t = $FamSpec[$c-$i][0];
      $Tables .= "</td>\n";
      $Tables .= "          <td>";
      $Tables .= $FamSpec[$c-$i][3]; //Name der Familie
      $Tables .= "</td>\n";
      $Tables .= "          <td>";
      $Tables .= $FamSpec[$c-$i][0]; //Anzahl
      $Tables .= "/".$FamSpec[$c-$i][2]; //Gesamtanzahl
      $Tables .= "</td>\n";
      $Tables .= "          <td>";
      $Tables .= $FamSpec[$c-$i][1]."%"; //Anteil
      $Tables .= "</td>\n";
      $Tables .= "        </tr>\n";
      
    }
    
    $Tables .= "      </table>\n";
    $Tables .= "    </td>\n";
    $Tables .= "    <td>\n";
    $Tables .= "      <table  cellpadding=\"5\">\n";
	
	$Tables .= "        <tr>\n";
	$Tables .= "          <td></td>\n";
	$Tables .= "          <td><b>Familie</b></td>\n";
	$Tables .= "          <td><b>Anteil</b></td>\n";
	$Tables .= "          <td><b>Anzahl/gesamt</b></td>\n";
	$Tables .= "        </tr>\n";
	
	$Tables .= "        <tr>\n";
	$Tables .= "          <td></td>\n";
	$Tables .= "          <td><b class=\"totalrow\">gesamt</b></td>\n";
	$Tables .= "          <td><b class=\"totalrow\">$TotalRatio%</b></td>\n";
	$Tables .= "          <td><b class=\"totalrow\">$TotalNumberSpecies/$NumberOfSpeciesInGermanFauna</b></td>\n";
	$Tables .= "        </tr>\n";
    
    $t = null;
    
    for($i = 1; $i <= $c; $i++)
    {
      $Tables .= "        <tr>\n";
      $Tables .= "          <td>";
      if($FamRat[$c-$i][0] <> $t)
      {
        $Tables .= $i;
      }
      $t = $FamRat[$c-$i][0];
      $Tables .= "</td>\n";
      $Tables .= "          <td>";
      $Tables .= $FamRat[$c-$i][3]; //Name der Familie
	  $Tables .= "</td>\n";
      $Tables .= "          <td>";
      $Tables .= $FamRat[$c-$i][0]."%"; //Anteil
      $Tables .= "</td>\n";
      $Tables .= "          <td>";
      $Tables .= $FamRat[$c-$i][1]; //Anzahl
      $Tables .= "/".$FamRat[$c-$i][2]; //Gesamtanzahl
      $Tables .= "</td>\n";
      $Tables .= "        </tr>\n";
      
    }
    
    $Tables .= "      </table>\n";
    $Tables .= "    </td>\n";
    $Tables .= "  </tr>\n";
    $Tables .= "</table>\n";
	
	return $Tables;
    
  }
 
  //ueberprueft, ob die Ueberfamilie $SupF in der Tabelle $Table der Datenbank vorhanden ist
  //wird derzeit nicht verwendet
  function IsSuperfamilyInTable($SupF,$Table,$Qualifiers)
  {
    global $Database;
	
    $SuperfamilyIsInDatabase = false;
	
	$FList = SuperfamilyToFamily($SupF);
	
	foreach($FList as $F)
	{
	  $query = "SELECT * FROM  `$Table` WHERE family LIKE '$F'";
	  $query = AddQualifiers($query,$Qualifiers);
	  $L = mysqli_query($Database,$query);
	
	  while($row = mysqli_fetch_object($L))
      {
        $SuperfamilyIsInDatabase = true;
		break;
      }
	  
	  if($SuperfamilyIsInDatabase==true)
	  {
	    break;
	  }
	  
	}
	
	return $SuperfamilyIsInDatabase;
	
  }
 
  //ueberprueft, ob die Familie $F in der Tabelle $Table der Datenbank vorhanden ist
  function IsFamilyInTable($F,$Table,$Qualifiers)
  {
    global $Database;
	
    $FamilyIsInDatabase = false;
	
	$query = "SELECT * FROM  `$Table` WHERE family LIKE '$F'";
	$query = AddQualifiers($query,$Qualifiers);
	$L = mysqli_query($Database,$query);
	
	while($row = mysqli_fetch_object($L))
    {
      $FamilyIsInDatabase = true;
	  break;
    }
	
	return $FamilyIsInDatabase;
	
  }
  
  //ueberprueft, ob die Unterfamilie $SubF in der Tabelle $Table der Datenbank vorhanden ist
  //wird derzeit nicht verwendet
  function IsSubfamilyInTable($SubF,$Table,$Qualifiers)
  {
    global $Database;
	
    $SubfamilyIsInDatabase = false;
	
	$query = "SELECT * FROM  `$Table` WHERE subfamily LIKE '$SubF'";
	$query = AddQualifiers($query,$Qualifiers);
	$L = mysqli_query($Database,$query);
	
	while($row = mysqli_fetch_object($L))
    {
      $SubfamilyIsInDatabase = true;
	  break;
    }
	
	return $SubfamilyIsInDatabase;
	
  }
  
  //Hier beginnen die Funktionen, die die HTML-Seiten schreiben
  
  //gibt den Header fuer die HTML-Seiten aus
  //$Title ist der Titel der Seite, falls $i==1 wird die normale Version des Headers erzeugt, ansonsten fuer dei Version mit erhoehtem Kontrast
  function HTMLHeader($Title,$i)
  {
    global $BackgroundColor;
	global $MarginLeft;
	global $MarginRight;
	global $MarginTop;
	
	if($i == 1)
	{
	  $css = "coleoptera.css";
	}
	else
	{
	  $css = "coleoptera2.css";
	}
	
    return "<!DOCTYPE HTML>\n<html>\n<head>\n  <title>".$Title."</title>\n  <meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\">\n  <link rel=\"stylesheet\" type=\"text/css\" href=\"".$css."\">\n  <meta name=\"robots\" content=\"noindex\">\n</head>\n\n<body bgcolor=\"#".$BackgroundColor."\" style=\"margin-left:".$MarginLeft."px; margin-right:".$MarginRight."px; margin-top:".$MarginTop."px;\">\n\n";
  }
  
  //gibt eine Tabelle der noch fehlenden Familien aus
  function TableMissingFamilies($Qualifiers)
  {
    global $Database;
	global $MainTable;
	global $MainTableNoID;
    global $Families;
	
	$Table = "";
	$NumberOfFamiliesInGermanFauna = count($Families);
	
    $FL = [];
    $c = 0;
    
    foreach($Families as $F)
    {
      if(IsFamilyInTable($F,$MainTable,$Qualifiers)==false and IsFamilyInTable($F,$MainTableNoID,$Qualifiers)==false)
      {
        $c++;
        array_push($FL,[NumberOfSpeciesInTaxon($F),FullName($F,"family")]);
      }
    }
    
    sort($FL);
	
	$NumberOfMyFamilies = $NumberOfFamiliesInGermanFauna-$c;
	$Ratio = 100*round($NumberOfMyFamilies/$NumberOfFamiliesInGermanFauna,3);
	
	$Table .= "<h2>Fehlende Familien</h2>\n\n";
	
	$Table .= "<p>Derzeit sind $NumberOfMyFamilies von $NumberOfFamiliesInGermanFauna Familien, die aus Deutschland nachgewiesen sind, erfasst ($Ratio%). Die folgenden $c Familien fehlen noch.</p>";
    
    $Table .= "<table  cellpadding=\"5\">\n";
	$Table .= "  <tr>\n";
	$Table .= "    <td><b>Familie</b></td>\n";
	$Table .= "    <td><b>Anzahl nachgewiesener Arten</b></td>\n";
	$Table .= "  </tr>\n";
    
    for($i = 1; $i <= $c; $i++)
    {
      $Table .= "  <tr>\n";
      $Table .= "    <td>";
      $Table .= $FL[$c-$i][1];
      $Table .= "</td>\n";
      $Table .= "    <td>";
      $Table .= $FL[$c-$i][0];
      $Table .= "</td>\n";
      $Table .= "  </tr>\n";
    }
    
    $Table .= "</table>\n";
	
	return $Table;
    
  }
  
  //gibt Tabelle mit Anzahl Arten nach Rote-Liste-Status aus
  //"RL 0" muss in der Datenbank als "Ex" angegeben werden, weil Abfragen wie "STRING"==0 immer zu true evaluieren... tja
  function TableRL($Qualifiers)
  {
    global $Database;
	global $MainTable;
	
	$query = "SELECT * FROM  `$MainTable`";
	$query = AddQualifiers($query,$Qualifiers);
	$L = mysqli_query($Database,$query);
	
	$NumberNotOnRL = 0;
	$RLList = ["N","V",3,2,1,"Ex","D","R"];
	$RLCountList = ["N" => 0, "V" => 0, 3 => 0, 2 => 0, 1 => 0, "Ex" => 0, "D" => 0, "R" => 0];
	
	$NumberOfMySpecies = 0;
	
	while($row = mysqli_fetch_object($L))
    {
	  $NumberOfMySpecies++;
	  
	  $rl = $row->rl;
      if($rl)
	  {
	    $RLCountList[$rl] = $RLCountList[$rl]+1;
	  }
	  else
	  {
	    $RLCountList["N"] = $RLCountList["N"]+1;
	  }
    }
	
	$Table = "";
	
	$Table .= "<h2>Anzahl erfasster Arten nach Status in der Roten Liste</h2>\n\n";
	
	$Table .= "<table  cellpadding=\"5\">\n";
	$Table .= "  <tr>\n";
	$Table .= "    <td><b>Status</b></td>\n";
	$Table .= "    <td><b>Anzahl Arten</b></td>\n";
	$Table .= "    <td><b>Anteil an allen erfassten Arten</b></td>\n";
	$Table .= "  </tr>\n";
	
	foreach($RLList as $rl)
	{
	  $Table .= "  <tr>\n";
	  
	  switch($rl)
	  {
	    case "N":
		$Table .= "    <td class>Nicht gefährdet</td>\n";
		break;
		
		case "V":
		$Table .= "    <td>Vorwarnliste (<span class=\"rl\">RL V</span>)</td>\n";
		break;
		
		case "D":
		$Table .= "    <td>Unzureichende Datenlage (<span class=\"rl\">RL D</span>)</td>\n";
		break;
		
		case "R":
		$Table .= "    <td>Extrem selten (<span class=\"rl\">RL R</span>)</td>\n";
		break;
		
		case 3:
		$Table .= "    <td>Gefährdet (<span class=\"rl\">RL 3</span>)</td>\n";
		break;
		
		case 2:
		$Table .= "    <td>Stark gefährdet (<span class=\"rl\">RL 2</span>)</td>\n";
		break;
		
		case 1:
		$Table .= "    <td>Vom Aussterben bedroht (<span class=\"rl\">RL 1</span>)</td>\n";
		break;
		
		case "Ex":
		$Table .= "    <td>Ausgestorben/verschollen (<span class=\"rl\">RL 0</span>)</td>\n";
		break;
		
		default:
		$Table .= "    <td><b>ERROR</b></td>\n";
		break;	
		
	  }
 
	  $Table .= "    <td>".$RLCountList[$rl]."</td>\n";
	  
	  $Ratio = 100*round($RLCountList[$rl]/$NumberOfMySpecies,3);
	  $Table .= "    <td>$Ratio%</td>\n";
	  $Table .= "  </tr>\n";
	}
	
	$Table .= "</table>\n";
	
	return $Table;
	
  }
  
  //schreibt die Statistikseite
  function WriteStatisticsPage($Qualifiers)
  {
    global $Database;
	
	if($Qualifiers==[])
	{    
      $StatsPage1 = fopen("stats.html","w+"); //normale, uneingeschränkte Seite
      $StatsPage2 = fopen("stats2.html","w+"); //leichter lesbare, uneingeschränkte Seite
    }
    else
    {
      $StatsPage1 = fopen("statsc.html","w+"); //normale, eingeschränkte Seite
      $StatsPage2 = fopen("stats2c.html","w+"); //leichter lesbare, eingeschränkte Variante
    }
    
    foreach([1,2] as $i)
    {
      if($Qualifiers==[])
	  {
	    $infix = ""; //uneingeschränkte Seite
      }
      else
      {
        $infix = "c"; //eingeschränkte Seite
      }
    
      if($i==1)
      {
        $StatsPage = $StatsPage1;
      }
      else
      {
        $StatsPage = $StatsPage2;
      }
      
	  fwrite($StatsPage,HTMLHeader("Zahlen",$i));
	
	  fwrite($StatsPage,"<h1>Zahlen</h1>");
	
	  fwrite($StatsPage,"<p>Derzeit sind ".CountSpecies(false,$Qualifiers)." Arten, ".CountGenera(false,$Qualifiers)." Gattungen und ".CountFamilies(false,$Qualifiers)." Familien erfasst.</p>\n");
	  fwrite($StatsPage,"<p>Als Larven sind ".CountSpecies(true,$Qualifiers)." Arten, ".CountGenera(true,$Qualifiers)." Gattungen und ".CountFamilies(true,$Qualifiers)." Familien erfasst.</p>\n");
	  
	  if($i==1)
	  {
	    fwrite($StatsPage,"<p><a href=\"stats2".$infix.".html\">Eine kontrastreichere Version dieser Seite für verbesserte Lesbarkeit.</a></p>\n\n");
	    fwrite($StatsPage,"<p><a href=\"index".$infix.".html\">Zurück zur Hauptseite.</a></p>\n");
	  }
	  else
	  {
	    fwrite($StatsPage,"<p>Diese Seite hat erhöhten Kontrast für verbesserte Lesbarkeit.<a href=\"stats".$infix.".html\">Zur Standard-Version.</a></p>\n\n");
	    fwrite($StatsPage,"<p><a href=\"index2".$infix.".html\">Zurück zur Hauptseite.</a></p>\n");
	  }
	  
	  fwrite($StatsPage,"<hr>\n\n");
	
	  fwrite($StatsPage,TableRL($Qualifiers));
	
	  fwrite($StatsPage,"\n\n<hr>\n");
	
	  fwrite($StatsPage,TablesFamiliesBySpeciesAndRatio($Qualifiers));
	
	  fwrite($StatsPage,"<br><br>\n\n<hr>\n");
	
	  fwrite($StatsPage,TableMissingFamilies($Qualifiers));
	
	  fwrite($StatsPage,"\n\n<hr>\n");
	
	  fwrite($StatsPage,"</body>\n\n</html>");
	
	}
	
  }
  
  //schreibt die Haupt- bzw. Larvenseite
  function WritePage($larva,$Qualifiers)
  {
    global $Database;
	global $SuperfamiliesAndSuborders;
	
	global $CurrentDate;
	
	if($larva==false)
	{
	  if($Qualifiers==[])
	  {
	    $Page1 = fopen("index.html","w+"); //normale, uneingeschränkte Seite
	    $Page2 = fopen("index2.html","w+"); //leichter lesbare, uneingeschränkte Seite
      }
      else
      {
        $Page1 = fopen("indexc.html","w+"); //normale, eingeschränkte Seite
	    $Page2 = fopen("indexc2.html","w+"); //leichter lesbare, eingeschränkte Variante
      }
	}
	else
	{
	  if($Qualifiers==[])
	  {
	    $Page1 = fopen("larven.html","w+"); //normale, uneingeschränkte Seite
	    $Page2 = fopen("larven2.html","w+"); //leichter lesbare, uneingeschränkte Seite
      }
      else
      {
        $Page1 = fopen("larvenc.html","w+"); //normale, eingeschränkte Seite
	    $Page2 = fopen("larvenc2.html","w+"); //leichter lesbare, eingeschränkte Variante
      }
	}

	
	foreach([1,2] as $i)
	{
	
      if($Qualifiers==[])
	  {
	    $infix = ""; //uneingeschränkte Seite
      }
      else
      {
        $infix = "c"; //eingeschränkte Seite
      }
	
	  if($i==1)
	  {
        $Page = $Page1;
	  }
	  else
	  {
	    $Page = $Page2;
	  }
	
	  if($larva==false)
	  {
	    fwrite($Page,HTMLHeader("Coleoptera",$i));
	
	    fwrite($Page,"<h1>Käfer</h1>");
	  }
	  else
	  {
	    fwrite($Page,HTMLHeader("Käferlarven",$i));
	
	    fwrite($Page,"<h1>Käferlarven</h1>");
	  }
	
	  fwrite($Page,"\n\n");
	
	  if($larva==false) //Einleitungstext fuer Hauptseite
	  {
	    fwrite($Page,"<p>Alle Bestimmungen sind anhand von Fotos vorgenommen worden und können fehlerhaft sein. Eine graue Beschriftung bedeutet, dass das entsprechende Tier nicht bis zur Art bestimmt werden konnte.</p>\n\n");
  
        fwrite($Page,"<p>Die Systematik auf Familien- und Unterfamilienebene folgt größtenteils der Entomofauna Germanica mit folgenden Unterschieden:</p>\n\n");
  
        fwrite($Page,"<ul>\n");
        fwrite($Page,"  <li>Hydrochinae, Spercheinae, Georissinae und Helophorinae werden als Unterfamilien der Hydrophilidae geführt statt als Familien.\n");
        fwrite($Page,"  <li>Drilini werden zur Unterfamile Agrypninae der Familie Elateridae gestellt statt als Familie geführt.\n");
        fwrite($Page,"  <li>Cybocephalidae werden als Familie geführt statt als Unterfamilie der Nitidulidae.\n");
        fwrite($Page,"  <li>Mycetaeidae und Anamorphidae werden als Familien geführt statt als Unterfamilien der Endomychidae.\n");
        fwrite($Page,"</ul>\n\n");
  
  
        fwrite($Page,"<p>Steht eine Art auf der Roten Liste Deutschlands*, wird der Status, wie folgt, angegeben.</p>\n");
  
        fwrite($Page,"<table>\n");
  
        fwrite($Page,"  <tr>\n");
        fwrite($Page,"    <td width=\"100\"><span class=\"rl\">RL V</span></td><td>Vorwarnliste</td>\n");
        fwrite($Page,"  </tr>\n");
  
        fwrite($Page,"  <tr>\n");
        fwrite($Page,"    <td width=\"100\"><span class=\"rl\">RL 3</span></td><td>Gefährdet</td>\n");
        fwrite($Page,"  </tr>\n");
  
        fwrite($Page,"  <tr>\n");
        fwrite($Page,"    <td width=\"100\"><span class=\"rl\">RL 2</span></td><td>Stark gefährdet</td>\n");
        fwrite($Page,"  </tr>\n");
  
        fwrite($Page,"  <tr>\n");
        fwrite($Page,"    <td width=\"100\"><span class=\"rl\">RL 1</span></td><td>Vom Aussterben bedroht</td>\n");
        fwrite($Page,"  </tr>\n");
  
        fwrite($Page,"  <tr>\n");
        fwrite($Page,"    <td width=\"100\"><span class=\"rl\">RL 0</span></td><td>Ausgestorben/verschollen</td>\n");
        fwrite($Page,"  </tr>\n");
  
        fwrite($Page,"  <tr>\n");
        fwrite($Page,"    <td width=\"100\"><span class=\"rl\">RL D</span></td><td>Datenlage unzureichend</td>\n");
        fwrite($Page,"  </tr>\n");
  
        fwrite($Page,"  <tr>\n");
        fwrite($Page,"    <td width=\"100\"><span class=\"rl\">RL R</span></td><td>Extrem selten</td>\n");
        fwrite($Page,"  </tr>\n");
  
        fwrite($Page,"</table>\n\n");
	  
	    fwrite($Page,"<p>*Als Grundlage dient die Rote Liste von 1998, die leider veraltet ist. In vielen Fällen spiegeln die Einstufungen nicht den aktuellen Status der Art wider.</p>\n");
  
        
        if($i==1)
        {
          fwrite($Page,"<p><a href=\"larven".$infix.".html\">Hier</a> gibt es eine Auswahl an Käferlarven.</p>\n\n");
          
          fwrite($Page,"<p><a href=\"stats".$infix.".html\">Ein paar Zahlen.</a></p>\n\n");
          
          fwrite($Page,"<p><a href=\"index".$infix."2.html\">Eine kontrastreichere Version dieser Seite für verbesserte Lesbarkeit.</a></p>\n\n");
        }
        else
        {
          fwrite($Page,"<p><a href=\"larven".$infix."2.html\">Hier</a> gibt es eine Auswahl an Käferlarven.</p>\n\n");
          
          fwrite($Page,"<p><a href=\"stats".$infix."2.html\">Ein paar Zahlen.</a></p>\n\n");
          
          fwrite($Page,"<p>Diese Seite hat erhöhten Kontrast für verbesserte Lesbarkeit.<a href=\"index".$infix.".html\">Zur Standard-Version</a></p>\n\n");
        }
  
	    fwrite($Page,"<p>Diese Seite wurde am $CurrentDate erstellt. Die PHP-Skripte, die diese Seite generiert haben, sind freie Software und <a href=\"ColeopteraPHP.7z\">hier</a> verfügbar.</p>\n\n");
	    
	  }
	  else //Einleitungstext fuer Larvenseite
	  {
	    fwrite($Page,"<p>Die Seite gibt eine Übersicht über von mir fotografierte Käferlarven. Die Bestimmung von Larven ist im Allgemeinen äußerst schwierig und nur in den seltensten Fällen bis zur Art möglich.</p>\n\n");
	    
        if($i==1)
        {
          fwrite($Page,"<p><a href=\"larven".$infix."2.html\">Eine kontrastreichere Version dieser Seite für verbesserte Lesbarkeit.</a></p>\n\n");
        }
        else
        {
          fwrite($Page,"<p>Diese Seite hat erhöhten Kontrast für verbesserte Lesbarkeit.<a href=\"larven".$infix.".html\">Zur Standard-Version</a></p>\n\n");
        }
        
	    fwrite($Page,"<p>Diese Seite wurde am $CurrentDate erstellt. Die PHP-Skripte, die diese Seite generiert haben, sind freie Software und <a href=\"ColeopteraPHP.7z\">hier</a> verfügbar.</p>\n\n");
	    
	    if($i==1)
	    {
	      fwrite($Page,"<p><a href=\"index".$infix.".html\">Zurück zur Hauptseite</a></p>\n");
        }
        else
        {
          fwrite($Page,"<p><a href=\"index".$infix."2.html\">Zurück zur Hauptseite</a></p>\n");
        }
	  }
	
	  fwrite($Page,"\n<hr>\n\n");
	
	  fwrite($Page,"<h1>Inhaltsverzeichnis</h1>\n\n");
	
	  foreach($SuperfamiliesAndSuborders as $SupF)
	  {
	    fwrite($Page,ToCSuperfamily($SupF,$larva,$Qualifiers));
	  }
	
	  if(DoesEntryWithUnknownFamilyExist($larva,$Qualifiers)==true)
      {
        fwrite($Page,ToCSuperFamily("",$larva,$Qualifiers));
      }
	
	  fwrite($Page,"<hr>\n\n");
	
	  foreach($SuperfamiliesAndSuborders as $SupF)
	  {
	    $FList = SuperfamilyToFamily($SupF);
	    foreach($FList as $F)
	    {
	      fwrite($Page,FamilyTable($F,$larva,$Qualifiers));
	    }
	  }
	
	  fwrite($Page,FamilyTable("",$larva,$Qualifiers)); //unbekannte Familie
		
	  fwrite($Page,"<hr>\n\n\n");
	
	  fwrite($Page,"</body>\n\n</html>");
	
    }
  }
  
  //Funktion fuer den Tabelleninhalt
  //$F Familie, $query klar, $ID bool-Variable: bestimmte (oder unbestimmte?) Arten, $larva gibt an, ob eine Larventabelle geschrieben wird
  function TableRows($F,$query,$ID,$larva)
  {
    global $Database;
    global $NumberOfImagesPerRow;
	global $PreviewImageWidth;
	global $PreviewImageHeight;
	
	$Rows = "";
  
    $SpeciesList = mysqli_query($Database,$query);
	$NumberItems = 0;
	
	while($row = mysqli_fetch_object($SpeciesList))
	{
	  $NumberItems++;
	}
	
	$SpeciesList = mysqli_query($Database,$query);
	
	$d = 0;
	$e = 0;
  
    while($row = mysqli_fetch_object($SpeciesList))
    {
	  $d++;
	  $e++;
		  
	  if($e == 1)
      {
        $Rows .= "        <tr valign=\"top\">\n";
	  }
		  
	  $Rows .= "          <td width=\"$PreviewImageWidth\">\n";
		  
	  $spec = $row->species;
	  $SpecInFile = SpeciesNameInFile($row->species);
		
      if($larva==false)
      {
	    if($ID==true)
		{
	      if($row->imago == "n")
		  {
		    $Rows .= "            <a href=\"Larven/$SpecInFile.jpg\"><img src=\"Larven/".$SpecInFile."_s.jpg\" width=\"$PreviewImageWidth\" height=\"$PreviewImageHeight\"></a>\n";
		  }
		  else
		  {
	        $Rows .= "            <a href=\"$F/$SpecInFile.jpg\"><img src=\"$F/".$SpecInFile."_s.jpg\" width=\"$PreviewImageWidth\" height=\"$PreviewImageHeight\"></a>\n";
		  }
		}
		else
		{
		  if($row->larva == "y")
		  {
		    $Rows .= "            <a href=\"Larven/$SpecInFile.jpg\"><img src=\"Larven/".$SpecInFile."_s.jpg\" width=\"$PreviewImageWidth\" height=\"$PreviewImageHeight\"></a>\n";
		  }
		  else
		  {
		    $Rows .= "            <a href=\"$F/$SpecInFile.jpg\"><img src=\"$F/".$SpecInFile."_s.jpg\" width=\"$PreviewImageWidth\" height=\"$PreviewImageHeight\"></a>\n";
		  }
		}
	  }
	  else
	  {
	    $Rows .= "            <a href=\"Larven/$SpecInFile.jpg\"><img src=\"Larven/".$SpecInFile."_s.jpg\" width=\"$PreviewImageWidth\" height=\"$PreviewImageHeight\"></a>\n";
	  }
	  
      if($ID==true)
      {	  
	    $Rows .= "            <h4>$spec</h4>";
	  }
	  else
	  {
	    $Rows .= "            <h4 class=\"nodet\">$spec</h4>";
	  }
	  
	  
	  //Rote Liste
	  $rl = $row->rl;
	  if($rl <> NULL)
	  {
	    if($rl == "Ex")
	    {
	      $Rows .= " <span class=\"rl\">RL 0</span>";
        }
        else
        {
          $Rows .= " <span class=\"rl\">RL $rl</span>";
        }
	  }
	  
	  
	  //falls es eine Larve ist und keine Larventabelle, wird das angemerkt
	  if($larva==false)
	  {
	    if($ID==true)
		{
	      if($row->imago == "n")
	      {
		    if($rl <> NULL)
			{
			  $Rows .= " &nbsp; &nbsp;";
			}
	        $Rows .= " <span class=\"larva\">Larve</span>";
	      }
		}
		else
		{
		  if($row->larva == "y")
		  {
		     $Rows .= " <span class=\"larva\">Larve</span>";
		  }
		}
	  }
	  
	  $Rows .= "\n";
	  
	  $Rows .= "          </td>\n";

	  if((($e % $NumberOfImagesPerRow)==0) or ($d == $NumberItems))
	  {
	    $e = 0;
	    $Rows .= "        </tr>\n";
	  }
    }
	
	return $Rows;
			
  }
  
  
  // Gibt die Tabelle fuer eine Familie $F aus. $larva gibt an, ob die Larventabelle gedruckt werden soll oder nicht
  function FamilyTable($F,$larva,$Qualifiers)
  {
    global $Database;
    global $MainTable;
	global $MainTableNoID;
	global $LarvaTableNoID;
	
	$NumberID = CountSpeciesInDatabaseFamily($F,$larva,$Qualifiers);
	$NumberNoID = CountSpeciesInDatabaseFamilyNoID($F,$larva,$Qualifiers);
	
	$NumberFam = $NumberID + $NumberNoID;
	
	$Table = "";
	
	if($NumberFam > 0)
	{
	  $Fname = FullName($F,"family");
	
	  if($F=="")
	  {
		$Table .= "<h1 id=\"Unknown\">$Fname</h1>\n";
	  }
	  else
	  {
		$Table .= "<h1 id=\"$F\">$Fname ($NumberID) </h1>\n";
	  }
	
	  $SubFL = FamilyToSubfamily($F);
	  array_push($SubFL,"");
	  
      $Table .= "\n<ul>\n";
	  
	  
	  if($larva==false)
	  {
		$TableNoID = $MainTableNoID;
	  }
	  else
	  {
		$TableNoID = $LarvaTableNoID;
	  }
	
	    foreach($SubFL as $SubF)
	    {
		  if($larva==false)
		  {
	        $queryID = "SELECT * FROM  `$MainTable` WHERE family LIKE '$F' AND subfamily LIKE '$SubF'";
		  }
		  else
		  {
		    $queryID = "SELECT * FROM  `$MainTable` WHERE family LIKE '$F' AND subfamily LIKE '$SubF' and larva LIKE 'y'";
		  }
		  
		  $queryID = AddQualifiers($queryID,$Qualifiers);
		  
		  $queryNoID = "SELECT * FROM  `$TableNoID` WHERE family LIKE '$F' AND subfamily LIKE '$SubF'";
		  $queryNoID = AddQualifiers($queryNoID,$Qualifiers);
		
		  $numberID = CountSpeciesInDatabaseSubfamily($F,$SubF,$larva,$Qualifiers);
		  $numberNoID = CountSpeciesInDatabaseSubfamilyNoID($F,$SubF,$larva,$Qualifiers);
		
		  $numbersubfam = $numberID + $numberNoID;
		  
		  $FnameUF = FullName($SubF,"subfamily");
		  
		  
		  if($numbersubfam > 0)
		  {
		  
		    $Table .= "  <li>\n";
		
		    if($F=="")
			{
			  $Table .= "    <h2>-</h2>\n";
			}
		    elseif($SubF <> "")
			{
		      $Table .= "    <h2 id=\"$SubF\">$FnameUF ($numberID) </h2>\n";
		    }
			elseif(count($SubFL)==1)
			{
			  $Table .= "    <h2>Ohne Unterfamilie</h2>\n";
			}
			else
			{
			  $Table .= "    <h2 id=\"Unknown_$F\">Unbekannte Unterfamilie</h2>\n";
			}
		
		    $Table .= "      <table cellpadding=\"10\">\n";
			
			$Table .= TableRows($F,$queryID,true,$larva);
			
			$Table .= TableRows($F,$queryNoID,false,$larva);
			
			$Table .= "      </table>";
		  
		  }
		
	    }
		
		$Table .= "\n</ul>\n\n";
	  
	}
	
	return $Table;
	
  }
  
  // $SupF ist Ueberfamilie bzw. Unterordnung als String. Die Funktion schreibt das Inhaltsverzeichnis fuer diese Ueberfamilie, nur Familien und Unterfamilien, die auch in der Datenbank vorkommen
  function ToCSuperfamily($SupF,$larva,$Qualifiers)
  {
    global $Database;
	
	$NumberID = CountSpeciesInDatabaseSuperfamily($SupF,$larva,$Qualifiers);
	$NumberNoID = CountSpeciesInDatabaseSuperfamilyNoID($SupF,$larva,$Qualifiers);
	
	$Numbersuperfam = $NumberID + $NumberNoID;
	
	$ToC = "";
	
	if($SupF == "")
	{
	  $ToC .= "<h3>Alle Überfamilien</h3>\n\n<ul>\n";
	  $ToC .= "  <li> <a href=\"#Unknown\">Unbekannte Familie</a>\n";
	  $ToC .= "</ul>\n\n";
      return $ToC;
	}
	
	if($Numbersuperfam==0)
	{
	  return "";
	}
  
    $FList = SuperfamilyToFamily($SupF);
	array_push($FList,"");
	
	if (!$FList)
	{
	  $ToC .= "Fehler, ungültige Überfamilie";
	}
	else
	{
      if($NumberID==1)
	  {
		$ToC .= "<h3>$SupF (1 Art)</h3>\n\n<ul>\n";
	  }
	  else
	  {
	    $ToC .= "<h3>$SupF ($NumberID Arten)</h3>\n\n<ul>\n";
	  }
	  
	  $FList = SuperfamilyToFamily($SupF);
	
	  foreach($FList as $F)
	  {
	    $Fname = FullName($F,"family");
		
		$NumberFamID = CountSpeciesInDatabaseFamily($F,$larva,$Qualifiers);
		$NumberFamNoID = CountSpeciesInDatabaseFamilyNoID($F,$larva,$Qualifiers);
		
		$NumberFam = $NumberFamID + $NumberFamNoID;
		
		if ($NumberFam > 0)
		{
	      $ToC .= "  <li> <a href=\"#$F\">$Fname ($NumberFamID)</a>\n";
		
		  $SubFL = FamilyToSubfamily($F);
		
		  if($SubFL<>[])
		  {
		    $ToC .= "    <ul>\n";
		  
		    //Unterfamilien existieren
		    foreach($SubFL as $SubF)
		    {
		      $FnameUF = FullName($SubF,"subfamily");
			  $NumberSubfamID = CountSpeciesInDatabaseSubfamily($F,$SubF,$larva,$Qualifiers);
			  $NumberSubfamNoID = CountSpeciesInDatabaseSubfamilyNoID($F,$SubF,$larva,$Qualifiers);
			  $NumberSubfam = $NumberSubfamID + $NumberSubfamNoID;
			  
			  if($NumberSubfam > 0)
			  {
			    $ToC .= "        <li> <a href=\"#$SubF\">$FnameUF ($NumberSubfamID) </a>\n";
			  }
			
		    }
			
			if(DoesEntryWithUnknownSubfamilyExist($F,$larva,$Qualifiers))
			{
			  $ToC .= "        <li> <a href=\"#Unknown_$F\">Unbekannte Unterfamilie</a>\n";
			}
		  
		    $ToC .= "    </ul>\n";
		  }
		  
	    }
		
	  }
	
	  $ToC .= "</ul>\n\n";
	}
	
	return $ToC;
	
  }

  
?>
