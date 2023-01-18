<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Сайт проверки случайной совместимости</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Сайт проверки случайной совместимости</h1>
        </header>
<?
include 'persons_array.php';
# попытался реализовать возможность авторизации, чтобы показать, как будет выглядеть интерфейс от лица  мужчин и женщин из массива person_array
# Если ид пользователя не найден - будет показана вновь формиа авторизации
if ((0 <= $_POST['id'] && $_POST['id'] <= (count($example_persons_array)-1) && $_POST['pass']==1234)){
    include 'perfect_partner.php';
    echo '<a href="?" class="back">←К авторизации</a>';
    echo '<section>
    <article>';
    echo '<div class="welcome">Привет, '.getShortName($example_persons_array[$_POST['id']]['fullname']);//показываем имя пользователя в сокращенном виде
    $gender= getGenderFromName($example_persons_array[$_POST['id']]['fullname']);//определяем пол
    #если пол мужской - заменим интерфейс
    switch($gender){
        case -1:
            $genderName='пол: женский';
        break;
        case 1:
            $genderName='пол: мужской';
            echo '<style>body{background-color: #0175a2;}.welcome, .PerfectPartner, .GenderDescription, .message, .form {background:#004C69}.button{background:#5FB1D1}</style>';
        break;
        default:
            $genderName='К сожалению, пол неопределен';
    }
    echo '<br><span class="job">'.$example_persons_array[$_POST['id']]['job'].'</span> ';//выведем профессию
    echo '<span class="gender">'.$genderName.'</span></div>';
    echo '</article></section><section>';
    $getFullname=getPartsFromFullname($example_persons_array[$_POST['id']]['fullname']);//разобъем ФИО на Ф И О
    echo '<article><div class="PerfectPartner">'.getPerfectPartner($getFullname['surname'],$getFullname['name'],$getFullname['patronomyc'], $example_persons_array).'</div></article>';// выводим идеального партнера
    echo '<article><a class="button" onclick="location.reload(); return false;">Обновить</a></article>';
    echo '<article><div class="GenderDescription">'.getGenderDescription ($example_persons_array).'</div></article>';//выводим гендерный состав пользователей
    echo '</section>';  
}else{
    echo '
    <section><article class="first"><div class="message">Пожалуйста, для входа на сайт введите корректные данные</div>
    <form class="form" action="index.php" method="post">
    <label>Логин пользователя:<br><input type="number" name="id"></label><br>
    <label>Пароль:<br><input type="text" name="pass"></label><br>
    <label><input type="submit"></label>
   </form></article></section>
    ';
}
?>
</body>
</html>