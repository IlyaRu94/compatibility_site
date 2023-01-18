<?php
include 'implode_and_explode_FIO.php';

//echo getGenderFromName($Fullname);

function getGenderFromName($Fullname){
    $name=getPartsFromFullname($Fullname);
    $aSignOfGender=0;

$nameEndsWith=["male"=>['surname'=>'в','name'=>['н','й'],'patronomyc'=>'ич'],"female"=>['surname'=>'ва','name'=>'а','patronomyc'=>'вна']];

foreach($nameEndsWith as $key=>$value){//разбираем многоуровневый мапссив
    foreach($value as $k=>$val){// разбираем массив окончаний для male и female на surname, name, patronomyc
        if (is_array($val)) {//проверяем, присутствует ли в surname, name или patronomyc дополнительный массив окончаний
            foreach($val as $v){//если да - обработаем его функцией aSignOfGender, передав каждое окончание в переменной $v
                $aSignOfGender+=aSignOfGender($name,$key,$k,$v);//суммируем возвращенные значения функции
            }
        }else {//если не массив - используем значения переменной $val
            $aSignOfGender+=aSignOfGender($name,$key,$k,$val);//суммируем возвращенные значения функции
        }
    }
}
return ($aSignOfGender <=> 0);
}



function aSignOfGender($name,$key,$k,$v){
//Если мужчина и есть окончание, то возвращаем 1, если женщина и есть окончание, то возвращаем -1
        if ((mb_substr($name[$k],'-'.mb_strlen($v),mb_strlen($v))===$v) && $key==='male'){
            return 1;
        }elseif((mb_substr($name[$k],'-'.mb_strlen($v),mb_strlen($v))===$v) && $key==='female'){
            return -1;
        }
}
