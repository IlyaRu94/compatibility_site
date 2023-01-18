<?php
include 'persons_array.php';

//$FIO=getPartsFromFullname($example_persons_array[0]['fullname']);
//print_r($FIO);

//$Fullname=getFullnameFromParts($FIO['surname'],$FIO['name'],$FIO['patronomyc']);
//print_r($Fullname);

//$nameS=getShortName($example_persons_array[0]['fullname']);
//print_r($nameS);


function getPartsFromFullname ($Fullname){//Функция для разделения полного имени на Фамилию, Имя, Очество
    list($name['surname'],$name['name'],$name['patronomyc'])=explode(' ', $Fullname);//функция list помогает присвоить сразу несколько значений
    return $name;
}


function getFullnameFromParts ($surname,$name,$patronomyc){// Функция, сиединяющая и возвращающая полное ФИО
    return $surname.' '.$name.' '.$patronomyc;
}

function getShortName ($Fullname){// функция, делающая из полного ФИО сокращенное
    $name = getPartsFromFullname ($Fullname);
    return $name['name'].' '.mb_substr($name['surname'],0,1).'.';
}