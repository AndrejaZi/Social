<?php


$people[] = "Andreja";
$people[] = "Marko";
$people[] = "Svetozar";
$people[] = "Milenko";
$people[] = "Branko";
$people[] = "Vanja";
$people[] = "Gordana";
$people[] = "Dragana";
$people[] = "Djordje";
$people[] = "Elizabeta";
$people[] = "Zivojin";
$people[] = "Ilija";
$people[] = "Jelena";
$people[] = "Lenka";
$people[] = "Kostarika";
$people[] = "Smiljka";
$people[] = "Anastasija";
$people[] = "Irena";
$people[] = "Goca";
$people[] = "Valerija";

$query = $_REQUEST['q'];

// Izlazna informacija 
$suggestion = "";

if($query !== ""){
    $query = strtolower($query);
    //  len se koristi za proveru 
    $len = strlen($query); 
    foreach($people as $person){
        if(stristr($query, substr($person, 0, $len))){
           
           if($suggestion === ""){
                $suggestion = $person;
           }else{
                $suggestion .= ", " . $person;
           }
            
        }
    }

}

echo $suggestion === "" ? 'Nema predloga' : $suggestion;