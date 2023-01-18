<?php
include 'gender_description.php';

//echo getPerfectPartner($FIO['surname'],$FIO['name'],$FIO['patronomyc'], $example_persons_array);
function getPerfectPartner($surname,$name,$patronomyc, $example_persons_array){
    $surname=mb_convert_case($surname, MB_CASE_TITLE, "UTF-8");//Приводим все к регистру с заглавной буквы
    $name=mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
    $patronomyc=mb_convert_case($patronomyc, MB_CASE_TITLE, "UTF-8");
    $FIO=getFullnameFromParts($surname,$name,$patronomyc);//объединяем ФИО в одну строку
    $gender=getGenderFromName($FIO);//определяем пол
    if ($gender==0){return "К сожалению, мы на смогли подобрать Вам пару. Пожалуйста, уточните Ваш пол";}//выводим надпись, если пол неопределенный
$perfectPartner='';
    do {
        $randGender=rand(0, (count($example_persons_array)-1));//генерируем рандомное число
        $gender2=getGenderFromName($example_persons_array[$randGender]['fullname']);//смотрим пол рандомного пользователя
        $perfectPartner= $example_persons_array[$randGender]['fullname'];//Записываем пользователя в переменную
    } while ($gender == $gender2 || $gender2==0);//цикл, который будет выполняться в случае, если пол получили одинаковый или пол - неопределенный
    $compatibilityPercentage = number_format(rand(500, 1000)/10,2,'.','');//генерируем процент
    $abbrPerfectPartner = getShortName ($perfectPartner);//сокращаем ФИО партнера
    $abbrFIO= getShortName ($FIO);//сокращаем фио пользователя
    return "$abbrFIO + $abbrPerfectPartner =<br>♡ Идеально на $compatibilityPercentage% ♡";//выводим надпись
    //дописать
}