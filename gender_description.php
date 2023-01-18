<?php
include 'gender_by_name.php';


//echo getGenderDescription ($example_persons_array);

function getGenderDescription ($example_persons_array){
$countPersonAll = count($example_persons_array);// кол-во всего людей    
    foreach($example_persons_array as $value){
        $gender[]=getGenderFromName($value['fullname']);
    }
# в функцию filtergender отправляем массив для фитльтрации $gender и фильтруем по 1 - для мужчин, -1 - для женщин и 0 - для неопределенных
# в функции filtergender организован подсчет значений, эти значения мы умножаем на 100 и делим на количество всех элементов в массиве
$countPersonMale=round(filtergender($gender, 1) * 100 / $countPersonAll, 2);// подсчет Мужчин
$countPersonFemale=round(filtergender($gender, -1) * 100 / $countPersonAll, 2);// подсчет Женщин
$countPersonUnknown=round(filtergender($gender, 0) * 100 / $countPersonAll, 2);// подсчет неопределенных

return <<<HEREDOCLETTER
Гендерный состав аудитории:<br>
---------------------------<br>
Мужчины - $countPersonMale %<br>
Женщины - {$countPersonFemale} %<br>
Не удалось определить - $countPersonUnknown %<br>
HEREDOCLETTER;

}

function filtergender($gender, $numberGender){
   
$countPerson = array_filter($gender, function($count) use ($numberGender) {// используем функцию use для того, чтобы можно было использовать переменную $numberGender
    return $count == $numberGender;
});
return count($countPerson);
}