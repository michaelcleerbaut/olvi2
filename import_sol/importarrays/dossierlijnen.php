<?

/**
* key           = schoolonline
* value         = onze db
* import stijl  = STANDAARD
* 
* [ADAPT]       = moet nog bewerkt worden, bv is serialize van iets anders ofzo
* 
* verplichte velden
* ==================
* 
* leerling (naam + voornaam)
* dossier schooljaar
* geboortedatum
* categorie
* datum
* omschrijving
* 
* 
*/

$import_kols = array(
  "leerling" => "naam_volledig",
  "dossier schooljaar" => "schooljaar",  
  "categorie" => "categorie",
  "datum" => "datum",
  "dossier periode" => "[SKIP]",
  "omschrijving" => "omschrijving",
  "detailomschrijving" => "[SKIP]",
  "beeldvorming" => "[SKIP]",
  "strategie" => "[SKIP]",
  "evaluatie" => "[SKIP]",
  "rapportperiode" => "[SKIP]",
  "beoordelingsrapport" => "[SKIP]",
  "belangrijk?" => "[SKIP]",
  "publiek?" => "[SKIP]",
  "is detailomschrijving publiek?" => "[SKIP]",
  "bijlage publiek?" => "[SKIP]",
  "bijkomende leerlingen" => "[SKIP]",
  "aanwezigen" => "[SKIP]",
  "groeps werk plan" => "[SKIP]",
  "klas" => "[SKIP]",
  "geboortedatum" => "geboortedatum",
  "schooljaar" => "[SKIP]"  
);



?>