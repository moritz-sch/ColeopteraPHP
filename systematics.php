<?php
/*
Systematics of Central European Beetles as PHP functions

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

  //irgendwann werde ich das als json machen...

  $SuperfamiliesAndSuborders = ["Adephaga", "Myxophaga", "Hydrophiloidea", "Staphylinoidea", "Elateroidea", "Cleroidea", "Derodontoidea", "Lymexyloidea", "Buprestoidea", "Dascilloidea", "Scirtoidea", "Byrrhoidea", "Cucujoidea", "Bostrichoidea", "Tenebrionoidea", "Scarabaeoidea", "Chrysomeloidea", "Curculionoidea"];

  $Families = ["Carabidae", "Hygrobiidae", "Haliplidae", "Noteridae", "Dytiscidae", "Gyrinidae", "Rhysodidae", "Sphaeriusidae", "Hydrophilidae", "Histeridae", "Sphaeritidae", "Hydraenidae", "Silphidae", "Agyrtidae", "Leiodidae", "Ptiliidae", "Staphylinidae", "Lycidae", "Omalisidae", "Lampyridae", "Cantharidae", "Malachiidae", "Dasytidae", "Melyridae", "Phloiophilidae", "Cleridae", "Thanerocleridae", "Derodontidae", "Trogossitidae", "Lymexylidae", "Elateridae", "Cerophytidae", "Eucnemidae", "Throscidae", "Buprestidae", "Clambidae", "Dascillidae", "Scirtidae", "Ptilodactylidae", "Eucinetidae", "Dryopidae", "Elmidae", "Heteroceridae", "Psephenidae", "Limnichidae", "Dermestidae", "Nosodendridae", "Byrrhidae", "Byturidae", "Bothrideridae", "Cerylonidae", "Alexiidae", "Nitidulidae", "Kateretidae", "Cybocephalidae", "Monotomidae", "Cucujidae", "Silvanidae", "Phloeostichidae", "Erotylidae", "Biphyllidae", "Cryptophagidae", "Phalacridae", "Laemophloeidae", "Latridiidae", "Mycetophagidae", "Zopheridae", "Corylophidae", "Endomychidae", "Mycetaeidae", "Anamorphidae", "Coccinellidae", "Sphindidae", "Ciidae", "Bostrichidae", "Endecatomidae", "Ptinidae", "Oedemeridae", "Pythidae", "Salpingidae", "Mycteridae", "Prostomidae", "Pyrochroidae", "Scraptiidae", "Aderidae", "Anthicidae", "Meloidae", "Ripiphoridae", "Mordellidae", "Melandryidae", "Tetratomidae", "Tenebrionidae", "Boridae", "Trogidae", "Geotrupidae", "Ochodaeidae", "Bolboceratidae", "Scarabaeidae", "Lucanidae", "Cerambycidae", "Chrysomelidae", "Orsodacnidae", "Megalopodidae", "Anthribidae", "Nemonychidae", "Rhynchitidae", "Attelabidae", "Apionidae", "Nanophyidae", "Curculionidae", "Raymondionymidae", "Erirhinidae", "Dryophthoridae"];

  
  //eigentlich Ueberfamilie oder Unterordnung, aber der Name ist schon so lang genug
  function SuperfamilyToFamily($UeF)
  {
    switch($UeF)
	{
	  case ("Adephaga"):
	  return ["Carabidae","Hygrobiidae","Haliplidae","Noteridae","Dytiscidae","Gyrinidae","Rhysodidae"];
	  break;
	  
	  case ("Myxophaga"):
	  return ["Sphaeriusidae"];
	  break;
	  
	  case ("Hydrophiloidea"):
	  return ["Hydrophilidae","Histeridae","Sphaeritidae"];
	  break;
	  
	  case ("Staphylinoidea"):
	  return ["Hydraenidae","Silphidae","Agyrtidae","Leiodidae","Ptiliidae","Staphylinidae"];
	  break;
	  
	  case ("Elateroidea"):
	  return ["Omalisidae","Lycidae","Lampyridae","Cantharidae","Elateridae","Cerophytidae","Eucnemidae","Throscidae"];
	  break;
	  
	  case ("Cleroidea"):
	  return ["Malachiidae","Dasytidae","Melyridae","Phloiophilidae","Cleridae","Thanerocleridae","Trogossitidae","Byturidae","Biphyllidae"];
	  break;
	  
	  case ("Derodontoidea"):
	  return ["Derodontidae","Nosodendridae"];
	  
	  case ("Lymexyloidea"):
	  return ["Lymexylidae"];
	  break;
	  
	  case ("Buprestoidea"):
	  return ["Buprestidae"];
	  break;
	  
	  case ("Dascilloidea"):
	  return ["Dascillidae"];
	  break;
	  
	  case ("Scirtoidea"):
	  return ["Clambidae","Scirtidae","Eucinetidae"];
	  break;
	  
	  case ("Byrrhoidea"):
	  return ["Ptilodactylidae","Dryopidae","Elmidae","Heteroceridae","Psephenidae","Limnichidae","Byrrhidae"];
	  break;
	  
	  case ("Bostrichoidea"):
	  return ["Dermestidae","Bostrichidae","Endecatomidae","Ptinidae"];
	  
	  case ("Cucujoidea"):
	  return ["Bothrideridae","Cerylonidae","Alexiidae","Nitidulidae","Kateretidae","Cybocephalidae","Monotomidae","Cucujidae","Silvanidae","Phloeostichidae","Erotylidae","Cryptophagidae","Phalacridae","Laemophloeidae","Latridiidae","Corylophidae","Endomychidae","Mycetaeidae","Anamorphidae","Coccinellidae","Sphindidae"];
	  break;
	  
	  case ("Tenebrionoidea"):
	  return ["Ciidae","Mycetophagidae","Zopheridae","Oedemeridae","Pythidae","Salpingidae","Mycteridae","Prostomidae","Pyrochroidae","Scraptiidae","Aderidae","Anthicidae","Meloidae", "Ripiphoridae", "Mordellidae","Melandryidae","Tetratomidae","Tenebrionidae","Boridae"];
	  break;
	  
	  case ("Scarabaeoidea"):
	  return ["Trogidae","Geotrupidae","Ochodaeidae","Bolboceratidae","Scarabaeidae","Lucanidae"];
	  break;
	  
	  case ("Chrysomeloidea"):
	  return ["Cerambycidae","Chrysomelidae","Orsodacnidae","Megalopodidae"];
	  break;
	  
	  case ("Curculionoidea"):
	  return ["Anthribidae","Nemonychidae","Rhynchitidae","Attelabidae","Apionidae","Nanophyidae","Curculionidae","Raymondionymidae","Erirhinidae","Dryophthoridae"];
	  break;
	  
	  default:
	  return [];
	  break;
	  
	}
  }
  
  function FamilyToSubfamily($F)
  {
   switch($F)
   {
     case ("Carabidae"):
     return ["Cicindelinae","Brachininae","Omophroninae","Carabinae","Nebriinae","Elaphrinae","Scaritinae","Broscinae","Loricerinae","Trechinae","Harpalinae","Lebiinae"];
     break;
     
     case ("Noteridae"):
     return ["Noterinae"];
     break;
     
     case ("Dytiscidae"):
     return ["Hydroporinae","Laccophilinae","Copelatinae","Agabinae","Colymbetinae","Dytiscinae"];
     break;
     
     case ("Gyrinidae"):
     return ["Gyrininae"];
     break;
     
     case ("Hydrophilidae"):
     return ["Hydrochinae","Spercheinae","Georissinae","Helophorinae","Sphaeridiinae","Hydrophilinae"];
     break;
     
     case ("Histeridae"):
     return ["Abraeinae","Saprininae","Dendrophilinae","Onthophilinae","Tribalinae","Histerinae","Haeteriinae"];
     break;
     
     case ("Hydraenidae"):
     return ["Hydraeninae","Ochthebiinae"];
     break;
     
     case ("Silphidae"):
     return ["Nicrophorinae","Silphinae"];
     break;
     
     case ("Agyrtidae"):
     return ["Necrophilinae","Agyrtinae","Pterolomatinae"];
     break;
     
     case ("Leiodidae"):
     return ["Platypsyllinae","Cholevinae","Coloninae","Leiodinae"];
     break;
     
     case ("Ptiliidae"):
     return ["Ptiliinae","Acrotrichinae"];
     break;
     
     case ("Staphylinidae"):
	 return ["Scydmaeninae","Piestinae","Scaphidiinae","Osoriinae","Pseudopsinae","Phloeocharinae","Olisthaerinae","Dasycerinae","Proteininae","Micropeplinae","Omaliinae","Oxytelinae","Oxyporinae","Steninae","Euaesthetinae","Paederinae","Staphylininae","Habrocerinae","Trichophyinae","Tachyporinae","Aleocharinae","Pselaphinae"];
	 break;
	 
	 case ("Lycidae"):
	 return ["Erotinae","Calochrominae"];
	 break;
	 
	 case ("Lampyridae"):
	 return ["Lampyrinae"];
	 break;
	 
	 case ("Cantharidae"):
	 return ["Cantharinae","Malthininae"];
	 break;
	 
	 case ("Malachiidae"):
	 return ["Malachiinae"];
	 break;
	 
	 case ("Dasytidae"):
	 return ["Rhadalinae","Dasytinae","Danacaeinae"];
	 break;
	 
	 case ("Melyridae"):
	 return ["Melyrinae"];
	 break;
	 
	 case ("Cleridae"):
	 return ["Tillinae","Clerinae","Tarsosteninae","Korynetinae"];
	 break;
	 
	 case ("Derodontidae"):
	 return ["Derodontinae","Laricobiinae"];
	 break;
	 
	 case ("Trogossitidae"):
	 return ["Trogossitinae","Peltinae"];
	 break;
	 
	 case ("Lymexylidae"):
	 return ["Hylecoetinae","Lymexylinae"];
	 break;
	 
	 case ("Elateridae"):
	 return ["Elaterinae","Melanotinae","Agrypninae","Denticollinae","Hypnoidinae","Negastriinae","Cardiophorinae","Lissominae"]; 
	 break;
	 
	 case ("Eucnemidae"):
	 return ["Melasinae","Eucneminae","Macrulacinae"];
	 break;
	 
	 case ("Throscidae"):
	 return ["Throscinae"];
	 break;
	 
	 case ("Buprestidae"):
	 return ["Polycestinae","Chrysochroinae","Buprestinae","Agrilinae"];
	 break;
	 
	 case ("Clambidae"):
	 return ["Calyptomerinae","Clambinae"];
	 break;
	 
	 case ("Dascillidae"):
	 return ["Dascillinae"];
	 break;
	 
	 case ("Ptilodactylidae"):
	 return ["Ptilodactylinae"];
	 break;
	 
	 case ("Elmidae"):
	 return ["Larainae","Elminae"];
	 break;
	 
	 case ("Heteroceridae"):
	 return ["Heterocerinae"];
	 break;
	 
	 case ("Psephenidae"):
	 return ["Eubriinae"];
	 break;
	 
	 case ("Limnichidae"):
	 return ["Limnichinae"];
	 break;
	 
	 case ("Dermestidae"):
	 return ["Dermestinae","Attageninae","Megatominae","Orphilinae","Trinodinae","Thorictinae"];
	 break;
	 
	 case ("Byrrhidae"):
	 return ["Byrrhinae","Syncalyptinae"];
	 break;
	 
	 case ("Bothrideridae"):
	 return ["Bothriderinae","Teredinae","Anommatinae"];
	 break;
	 
	 case ("Cerylonidae"):
	 return ["Ceryloninae","Murmidiinae"];
	 break;
	 
	 case ("Nitidulidae"):
	 return ["Carpophilinae","Cillaeinae","Meligethinae","Epuraeinae","Nitidulinae","Cryptarchinae"];
	 break;
	 
	 case ("Monotomidae"):
	 return ["Monotominae","Rhizophaginae"];
	 break;
	 
	 case ("Silvanidae"):
	 return ["Silvaninae","Brontinae"];
	 break;
	 
	 case ("Erotylidae"):
	 return ["Cryptophilinae","Erotylinae","Xenoscelinae"];
	 break;
	 
	 case ("Cryptophagidae"):
	 return ["Cryptophaginae","Atomariinae"];
	 break;
	 
	 case ("Phalacridae"):
	 return ["Phalacrinae"];
	 break;
	 
	 case ("Latridiidae"):
	 return ["Latridiinae","Corticariinae"];
	 break;
	 
	 case ("Mycetophagidae"):
	 return ["Mycetophaginae","Bergininae"];
	 break;
	 
	 case ("Zopheridae"):
	 return ["Zopherinae","Colydiinae"];
	 break;
	 
	 case ("Corylophidae"):
	 return ["Corylophinae","Orthoperinae"];
	 break;
	 
	 case ("Endomychidae"):
	 return ["Merophysiinae","Leiestinae","Lycoperdininae","Endomychinae"];
	 break;
	 
	 case ("Coccinellidae"):
	 return ["Epilachninae","Coccidulinae","Ortaliinae","Scymninae","Chilocorinae","Coccinellinae","Sticholotidinae"];
	 break;
	 
	 case ("Sphindidae"):
	 return ["Sphindinae","Aspidiphorinae"];
	 break;
	 
	 case ("Bostrichidae"):
	 return ["Lyctinae","Dinoderinae","Bostrichinae"];
	 break;
	 
	 case ("Ptinidae"):
	 return ["Eucradinae","Dryophilinae","Ernobiinae","Anobiinae","Ptilininae","Xyletininae","Mesocoelopodinae","Dorcatominae","Gibbiinae","Ptininae"];
	 break;
	 
	 case ("Oedemeridae"):
	 return ["Calopinae","Oedemerinae"];
	 break;
	 
	 case ("Salpingidae"):
	 return ["Salpinginae","Agleninae"];
	 break;
	 
	 case ("Mycteridae"):
	 return ["Mycterinae"];
	 break;
	 
	 case ("Pyrochroidae"):
	 return ["Pyrochroinae","Agnathinae"];
	 break;
	 
	 case ("Scraptiidae"):
	 return ["Scraptiinae","Anaspidinae"];
	 break;
	 
	 case ("Anthicidae"):
	 return ["Notoxinae","Anthicinae"];
	 break;
	 
	 case ("Meloidae"):
	 return ["Meloinae","Nemognathinae"];
	 break;
	 
	 case ("Ripiphoridae"):
	 return ["Pelecotominae","Ripiphorinae","Ripidiinae"];
	 break;
	 
	 case ("Mordellidae"):
	 return ["Mordellinae"];
	 break;
	 
	 case ("Melandryidae"):
	 return ["Melandryinae","Osphyinae"];
	 break;
	 
	 case ("Tetratomidae"):
	 return ["Tetratominae","Eustrophinae","Hallomeninae"];
	 break;
	 
	 case ("Tenebrionidae"):
	 return ["Lagriinae","Alleculinae","Pimeliinae","Tenebrioninae","Stenochiinae","Diaperinae"];
	 break;
	 
	 case ("Boridae"):
	 return ["Borinae"];
	 break;
	 
	 case ("Geotrupidae"):
	 return ["Geotrupinae"];
	 break;
	 
	 case ("Ochodaeidae"):
	 return ["Ochodaeidae"];
	 break;
	 
	 case ("Scarabaeidae"):
	 return ["Scarabaeinae","Aegialiinae","Aphodiinae","Melolonthinae","Rutelinae","Dynastinae","Cetoniinae"];
	 break;
	 
	 case ("Lucanidae"):
	 return ["Lucaninae","Dorcinae","Syndesinae","Aesalinae"];
	 break;
	 
	 case ("Cerambycidae"):
	 return ["Parandrinae","Prioninae","Spondylidinae","Lepturinae","Necydalinae","Cerambycinae","Lamiinae"];
	 break;
	 
	 case ("Chrysomelidae"):
	 return ["Donaciinae","Criocerinae","Cryptocephalinae","Lamprosomatinae","Eumolpinae","Chrysomelinae","Galerucinae","Alticinae","Cassidinae","Bruchinae"]; //vollstaendig?
	 break;
	 
	 case ("Megalopodidae"):
	 return ["Zeugophorinae"];
	 break;
	 
	 case ("Anthribidae"):
	 return ["Urodontinae","Anthribinae","Choraginae"];
	 break;
	 
	 case ("Nemonychidae"):
	 return ["Nemonychinae","Cimberidinae"];
	 break;
	 
	 case ("Rhynchitidae"):
	 return ["Rhynchitinae"];
	 break;
	 
	 case ("Attelabidae"):
	 return ["Attelabinae","Apoderinae"];
	 break;
	 
	 case ("Apionidae"):
	 return ["Apioninae"];
	 break;
	 
	 case ("Nanophyidae"):
	 return ["Nanophyinae"];
	 break;
	 
	 case ("Curculionidae"):
	 return ["Scolytinae","Platypodinae","Entiminae","Lixinae","Cossoninae","Bagoinae","Mesoptilinae","Molytinae","Hyperinae","Cyclominae","Cryptorhynchinae","Baridinae","Conoderinae","Ceutorhynchinae","Orobitidinae","Curculioninae"]; //vollstaendig?
	 break;
	 
	 case ("Erirhinidae"):
	 return ["Erirhininae"];
	 break;
	 
	 case ("Dryophthoridae"):
	 return ["Rhynchophorinae","Dryophthorinae"];
	 break;
	 
	 default:
	 return [];
	 break;
   }
  }
  
  $AllSubfamilies=[];
  foreach($Families as $F)
  {
    $UFL = FamilyToSubfamily($F);
	$AllSubfamilies = array_merge($AllSubfamilies,$UFL);
  }
  
  function NumberOfSpeciesInTaxon($Taxon)
  {
    switch($Taxon)
    {
      case ("Carabidae"):
      return 607; // 647 - 16 - 9 - 0 - 2 - 6 - 2 - 0 - 0 - 1 - 1 - 2 - 0 - 1
      break;
      
      case ("Hygrobiidae"):
      return 1;
      break;
      
      case ("Haliplidae"):
      return 20;
      break;
      
      case ("Noteridae"):
      return 2;
      break;
      
      case ("Dytiscidae"):
      return 150; // 151 - 0 - 1 - 0 - 0
      break;
      
      case ("Gyrinidae"):
      return 13;
      break;
      
      case ("Rhysodidae"):
      return 2;
      break;
      
      case ("Sphaeriusidae"):
      return 1;
      break;
      
      case ("Hydrophilidae"):
      return 136;
      break;
      
      case ("Histeridae"):
      return 87;
      break;
      
      case ("Sphaeritidae"):
      return 1;
      break;
      
      case ("Hydraenidae"):
      return 57;
      break;
      
      case ("Silphidae"):
      return 22;
      break;
      
      case ("Agyrtidae"):
      return 4;
      break;
      
      case ("Leiodidae"):
      return 160; // 162 - 2
      break;
      
      case ("Ptiliidae"):
      return 96;
      break;
      
      case ("Staphylinidae"):
      return 1709; // 1724 - 1 - 1 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 1 - 0 - 0 - 0 - 0 - 0 - 0 - 4 - 1 - 2 - 0 - 0 - 3 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 2 - 0 - 0
      break;
      
      case ("Lycidae"):
      return 7;
      break;
      
      case ("Omalisidae"):
      return 1;
      break;
      
      case ("Lampyridae"):
      return 3;
      break;
      
      case ("Cantharidae"):
      return 91; // 93 - 0 - 2
      break;
      
      case ("Malachiidae"):
      return 39;
      break;
      
      case ("Dasytidae"):
      return 26; // 28 - 2
      break;
      
      case ("Melyridae"):
      return 1;
      break;
      
      case ("Phloiophilidae"):
      return 1;
      break;
      
      case ("Cleridae"):
      return 26;
      break;
      
      case ("Thanerocleridae"):
      return 1;
      break;
      
      case ("Derodontidae"):
      return 2;
      break;
      
      case ("Trogossitidae"):
      return 11;
      break;
      
      case ("Lymexylidae"):
      return 2;
      break;
      
      case ("Elateridae"):
      return 158;
      break;
      
      case ("Cerophytidae"):
      return 1;
      break;
      
      case ("Eucnemidae"):
      return 20;
      break;
      
      case ("Throscidae"):
      return 12;
      break;
      
      case ("Buprestidae"):
      return 107; // 109 - 1 - 0 - 1
      break;
      
      case ("Clambidae"):
      return 14;
      break;
      
      case ("Dascillidae"):
      return 1;
      break;
      
      case ("Scirtidae"):
      return 26;
      break;
      
      case ("Ptilodactylidae"):
      return 2;
      break;
      
      case ("Eucinetidae"):
      return 2;
      break;
      
      case ("Dryopidae"):
      return 14;
      break;
      
      case ("Elmidae"):
      return 25;
      break;
      
      case ("Heteroceridae"):
      return 15;
      break;
      
      case ("Psephenidae"):
      return 1;
      break;
      
      case ("Limnichidae"):
      return 3;
      break;
      
      case ("Dermestidae"):
      return 66;
      break;
      
      case ("Nosodendridae"):
      return 1;
      break;
      
      case ("Byrrhidae"):
      return 26;
      break;
      
      case ("Byturidae"):
      return 2;
      break;
      
      case ("Bothrideridae"):
      return 7;
      break;
      
      case ("Cerylonidae"):
      return 7;
      break;
      
      case ("Alexiidae"):
      return 3;
      break;
      
      case ("Nitidulidae"):
      return 143;
      break;
      
      case ("Kateretidae"):
      return 12;
      break;
      
      case ("Cybocephalidae"):
      return 3;
      break;
      
      case ("Monotomidae"):
      return 23;
      break;
      
      case ("Cucujidae"):
      return 4;
      break;
      
      case ("Silvanidae"):
      return 17;
      break;
      
      case ("Phloeostichidae"):
      return 1;
      break;
      
      case ("Erotylidae"):
      return 21;
      break;
      
      case ("Biphyllidae"):
      return 2;
      break;
      
      case ("Cryptophagidae"):
      return 136;
      break;
      
      case ("Phalacridae"):
      return 23;
      break;
      
      case ("Laemophloeidae"):
      return 22;
      break;
      
      case ("Latridiidae"):
      return 90;
      break;
      
      case ("Mycetophagidae"):
      return 17;
      break;
      
      case ("Zopheridae"):
      return 19;
      break;
      
      case ("Corylophidae"):
      return 22;
      break;
      
      case ("Endomychidae"):
      return 10; //ohne Anamorphidae und Mycetaeidae
      break;
      
      case ("Mycetaeidae"):
      return 1;
      break;
      
      case ("Anamorphidae"):
      return 3;
      break;
      
      case ("Coccinellidae"):
      return 87;
      break;
      
      case ("Sphindidae"):
      return 2;
      break;
      
      case ("Ciidae"):
      return 50;
      break;
      
      case ("Bostrichidae"):
      return 34;
      break;
      
      case ("Endecatomidae"):
      return 1;
      break;
      
      case ("Ptinidae"):
      return 116;
      break;
      
      case ("Oedemeridae"):
      return 28;
      break;
      
      case ("Pythidae"):
      return 2;
      break;
      
      case ("Salpingidae"):
      return 15;
      break;
      
      case ("Mycteridae"):
      return 1;
      break;
      
      case ("Prostomidae"):
      return 1;
      break;
      
      case ("Pyrochroidae"):
      return 4;
      break;
      
      case ("Scraptiidae"):
      return 31;
      break;
      
      case ("Aderidae"):
      return 9;
      break;
      
      case ("Anthicidae"):
      return 30;
      break;
      
      case ("Meloidae"):
      return 20;
      break;
      
      case ("Ripiphoridae"):
      return 4;
      break;
      
      case ("Mordellidae"):
      return 89;
      break;
      
      case ("Melandryidae"):
      return 31;
      break;
      
      case ("Tetratomidae"):
      return 7;
      break;
      
      case ("Tenebrionidae"):
      return 98;
      break;
      
      case ("Boridae"):
      return 1;
      break;
      
      case ("Trogidae"):
      return 8;
      break;
      
      case ("Geotrupidae"):
      return 9;
      break;
      
      case ("Ochodaeidae"):
      return 1;
      break;
      
      case ("Bolboceratidae"):
      return 2;
      break;
      
      case ("Scarabaeidae"):
      return 172; // 176 - 4
      break;
      
      case ("Lucanidae"):
      return 7;
      break;
      
      case ("Cerambycidae"):
      return 208; // 213 - 1 - 1 - 0 - 1 - 2
      break;
      
      case ("Chrysomelidae"):
      return 600; // 617 - 1 - 1 - 2 - 7 - 3 - 0 - 0 - 0 - 3 - 0 - 0 - 0 - 0
      break;
      
      case ("Orsodacnidae"):
      return 2;
      break;
      
      case ("Megalopodidae"):
      return 5;
      break;
      
      case ("Anthribidae"):
      return 25;
      break;
      
      case ("Nemonychidae"):
      return 3;
      break;
      
      case ("Rhynchitidae"):
      return 26;
      break;
      
      case ("Attelabidae"):
      return 3;
      break;
      
      case ("Apionidae"):
      return 129; // 131 - 2
      break;
      
      case ("Nanophyidae"):
      return 10;
      break;
      
      case ("Curculionidae"):
      return 942; // 947 - 0 - 0 - 0 - 0 - 0 - 1 - 1 - 1 - 0 - 0 - 0 - 0 - 1 - 0 - 0 - 0 - 0 - 0 - 1
      break;
      
      case ("Raymondionymidae"):
      return 1;
      break;
      
      case ("Erirhinidae"):
      return 18;
      break;
      
      case ("Dryophthoridae"):
      return 8;
      break;
      
      default:
      return null;
      break;
    }
  }
  
  //gibt den deutschen Namen einer Familie oder Unterfamilie aus
  function VernacularName($Taxon)
  {
  
    switch($Taxon)
	{
	  case ("Carabidae"):
	  return "Laufk??fer";
	  break;
	  
	  case ("Cicindelinae"):
	  return "Sandlaufk??fer";
	  break;
	  
	  case ("Brachininae"):
	  return "Bombardierk??fer";
	  break;
	  
	  case ("Hygrobiidae"):
	  return "Schlammschwimmer";
	  break;
	  
	  case ("Haliplidae"):
	  return "Wassertreter";
	  break;
	  
	  case ("Noteridae"):
	  return "Ruderschwimmer";
	  break;
	  
	  case ("Dytiscidae"):
	  return "Schwimmk??fer";
	  break;
	  
	  case ("Gyrinidae"):
	  return "Taumelk??fer";
	  break;
	  
	  case ("Rhysodidae"):
	  return "Runzelk??fer";
	  break;
	  
	  case ("Sphaeriusidae"):
	  return "Kugelk??fer";
	  break;
	  
	  case ("Hydrophilidae"):
	  return "Wasserfreunde";
	  break;
	  
	  case ("Hydrochinae"):
	  return "Rippenwasserk??fer";
	  break;
	  
	  case ("Spercheinae"):
	  return "Buckelwasserk??fer";
	  break;
	  
	  case ("Georissinae"):
	  return "Uferschlammk??fer";
	  break;
	  
	  case ("Histeridae"):
	  return "Stutzk??fer";
	  break;
	  
	  case ("Sphaeritidae"):
	  return "Scheinstutzk??fer";
	  break;
	  
	  case ("Hydraenidae"):
	  return "Langtasterwasserk??fer";
	  break;
	  
	  case ("Silphidae"):
	  return "Aask??fer";
	  break;
	  
	  case ("Agyrtidae"):
	  return "Scheinaask??fer";
	  break;
	  
	  //case ("Leiodidae"):
	  //return "Schwammkugel-, Nest-, Kolonisten- und Pelzflohk??fer";
	  //break;
	  
	  case ("Leiodinae"):
	  return "Schwammkugelk??fer";
	  break;
	  
	  case ("Cholevinae"):
	  return "Nestk??fer";
	  break;
	  
	  case ("Coloninae"):
	  return "Kolonistenk??fer";
	  break;
	  
	  case ("Leptininae"):
	  return "Pelzflohk??fer";
	  break;
	  
	  case ("Ptiliidae"):
	  return "Federfl??gler";
	  break;
	  
	  case ("Staphylinidae"):
	  return "Kurzfl??gler";
	  break;
	  
	  case ("Scydmaeninae"):
	  return "Ameisenk??fer";
	  break;
	  
	  case ("Scaphidiinae"):
	  return "Kahnk??fer";
	  break;
	  
	  case ("Dasycerinae"):
	  return "Moosschimmelk??fer";
	  break;
	  
	  case ("Micropeplinae"):
	  return "Rippenk??fer";
	  break;
	  
	  case ("Pselaphinae"):
	  return "Palpenk??fer";
	  break;
	  
	  case ("Omalisidae"):
	  return "Breithalsfliegenk??fer";
	  break;
	  
	  case ("Lycidae"):
	  return "Rotdeckenk??fer";
	  break;
	  
	  case ("Lampyridae"):
	  return "Leuchtk??fer";
	  break;
	  
	  case ("Cantharidae"):
	  return "Weichk??fer";
	  break;
	  
	  case ("Elateridae"):
	  return "Schnellk??fer";
	  break;
	  
	  case ("Cerophytidae"):
	  return "Mulmk??fer";
	  break;
	  
	  case ("Eucnemidae"):
	  return "Kammk??fer";
	  break;
	  
	  case ("Throscidae"):
	  return "H??pfk??fer";
	  break;
	  
	  case ("Malachiidae"):
	  return "Zipfelk??fer";
	  break;
	  
	  case ("Dasytidae"):
	  return "Wollhaark??fer";
	  break;
	  
	  case ("Phloiophilidae"):
	  return "Doppelzahnwollhaark??fer";
	  break;
	  
	  case ("Cleridae"):
	  return "Buntk??fer";
	  break;
	  
	  case ("Derodontidae"):
	  return "Knopfk??fer";
	  break;
	  
	  case ("Trogossitidae"):
	  return "Jagdk??fer";
	  break;
	  
	  case ("Lymexylidae"):
	  return "Werftk??fer";
	  break;
	  
	  case ("Buprestidae"):
	  return "Prachtk??fer";
	  break;
	  
	  case ("Dascillidae"):
	  return "Moorweichk??fer";
	  break;
	  
	  case ("Clambidae"):
	  return "Punktk??fer";
	  break;
	  
	  case ("Scirtidae"):
	  return "Sumpfk??fer";
	  break;
	  
	  case ("Eucinetidae"):
	  return "Purzelk??fer";
	  break;
	  
	  case ("Dryopidae"):
	  return "Hakenk??fer";
	  break;
	  
	  case ("Elmidae"):
	  return "Klauenk??fer";
	  break;
	  
	  case ("Heteroceridae"):
	  return "S??gek??fer";
	  break;
	  
	  case ("Psephenidae"):
	  return "Sumpfwiesenk??fer";
	  break;
	  
	  case ("Limnichidae"):
	  return "Uferpillenk??fer";
	  break;
	  
	  case ("Byrrhidae"):
	  return "Pillenk??fer";
	  break;
	  
	  case ("Byturidae"):
	  return "Bl??tenfresser";
	  break;
	  
	  case ("Nosodendridae"):
	  return "Saftk??fer";
	  break;
	  
	  case ("Bothrideridae"):
	  return "Schwielenk??fer";
	  break;
	  
	  case ("Cerylonidae"):
	  return "Glattrindenk??fer";
	  break;
	  
	  case ("Nitidulidae"):
	  return "Glanzk??fer";
	  break;
	  
	  case ("Kateretidae"):
	  return "Riedgrasglanzk??fer";
	  break;
	  
	  case ("Cybocephalidae"):
	  return "Schildlausk??fer";
	  break;
	  
	  case ("Monotomidae"):
	  return "Rindenglanzk??fer";
	  break;
	  
	  case ("Cucujidae"):
	  return "Plattk??fer";
	  break;
	  
	  case ("Silvanidae"):
	  return "Raubplattk??fer";
	  break;
	  
	  case ("Phloeostichidae"):
	  return "Rindenplattk??fer";
	  break;
	  
	  case ("Erotylidae"):
	  return "Pilzk??fer";
	  break;
	  
	  case ("Biphyllidae"):
	  return "Pilzplattk??fer";
	  break;
	  
	  case ("Cryptophagidae"):
	  return "Schimmelk??fer";
	  break;
	  
	  case ("Phalacridae"):
	  return "Glattk??fer";
	  break;
	  
	  case ("Laemophloeidae"):
	  return "Halsplattk??fer";
	  break;
	  
	  case ("Latridiidae"):
	  return "Moderk??fer";
	  break;
	  
	  case ("Endomychidae"):
	  return "St??ublingsk??fer";
	  break;
	  
	  case ("Coccinellidae"):
	  return "Marienk??fer";
	  break;
	  
	  case ("Sphindidae"):
	  return "Schleimpilzk??fer";
	  break;
	  
	  case ("Dermestidae"):
	  return "Speckk??fer";
	  break;
	  
	  case ("Bostrichidae"):
	  return "Bohrk??fer";
	  break;
	  
	  case ("Lyctinae"):
	  return "Splintholzk??fer";
	  break;
	  
	  case ("Ptinidae"):
	  return "Pochk??fer";
	  break;
	  
	  case ("Ptininae"):
	  return "Diebsk??fer";
	  break;
	  
	  case ("Ciidae"):
	  return "Baumschwammfresser";
	  break;
	  
	  case ("Mycetophagidae"):
	  return "Mycelfresser";
	  break;
	  
	  case ("Zopheridae"):
	  return "Rindenk??fer";
	  break;
	  
	  case ("Corylophidae"):
	  return "Faulholzk??fer";
	  break;
	  
	  case ("Oedemeridae"):
	  return "Scheinbockk??fer";
	  break;
	  
	  case ("Pythidae"):
	  return "Drachenk??fer";
	  break;
	  
	  case ("Salpingidae"):
	  return "Scheinr??ssler";
	  break;
	  
	  case ("Mycteridae"):
	  return "Haarscheinr??ssler";
	  break;
	  
	  case ("Prostomidae"):
	  return "Schaufelk??fer";
	  break;
	  
	  case ("Pyrochroidae"):
	  return "Feuerk??fer";
	  break;
	  
	  case ("Scraptiidae"):
	  return "Seidenk??fer";
	  break;
	  
	  case ("Aderidae"):
	  return "Baummulmk??fer";
	  break;
	  
	  case ("Anthicidae"):
	  return "Bl??tenmulmk??fer";
	  break;
	  
	  case ("Meloidae"):
	  return "??lk??fer";
	  break;
	  
	  case ("Ripiphoridae"):
	  return "F??cherk??fer";
	  break;
	  
	  case ("Mordellidae"):
	  return "Stachelk??fer";
	  break;
	  
	  case ("Melandryidae"):
	  return "D??sterk??fer";
	  break;
	  
	  case ("Tetratomidae"):
	  return "Keulend??sterk??fer";
	  break;
	  
	  case ("Tenebrionidae"):
	  return "Schwarzk??fer";
	  break;
	  
	  case ("Lagriinae"):
	  return "Wollk??fer";
	  break;
	  
	  case ("Alleculinae"):
	  return "Pflanzenk??fer";
	  break;
	  
	  case ("Trogidae"):
	  return "Knochenk??fer";
	  break;
	  
	  case ("Geotrupidae"):
	  return "Mistk??fer";
	  break;
	  
	  case ("Scarabaeidae"):
	  return "Blatthornk??fer";
	  break;
	  
	  case ("Cetoniinae"):
	  return "Rosenk??fer";
	  break;
	  
	  case ("Lucanidae"):
	  return "Schr??ter";
	  break;
	  
	  case ("Cerambycidae"):
	  return "Bockk??fer";
	  break;
	  
	  case ("Chrysomelidae"):
	  return "Blattk??fer";
	  break;
	  
	  case ("Alticinae"):
	  return "Flohk??fer";
	  break;
	  
	  case ("Cassidinae"):
	  return "Schildk??fer";
	  break;
	  
	  case ("Bruchinae"):
	  return "Samenk??fer";
	  break;
	  
	  case ("Anthribidae"):
	  return "Breitr??ssler";
	  break;
	  
	  case ("Nemonychidae"):
	  return "Schlankr??ssler";
	  break;
	  
	  case ("Rhynchitidae"):
	  return "Triebstecher";
	  break;
	  
	  case ("Attelabidae"):
	  return "Blattroller";
	  break;
	  
	  case ("Apionidae"):
	  return "Spitzmausr??ssler";
	  break;
	  
	  case ("Curculionidae"):
	  return "R??sselk??fer";
	  break;
	  
	  case ("Scolytinae"):
	  return "Borkenk??fer";
	  break;
	
	  default:
	  return NULL;
	  break;
	}
  }
  
  ?>
