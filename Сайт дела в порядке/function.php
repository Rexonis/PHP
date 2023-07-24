<?php

function number_of_hour($tasks_list){

    if ($tasks_list !== null) {
        $date = Floor((strtotime($tasks_list)-time())/3600);
    }
    else {
        $date = floor(time()/3600);
    }
    return $date;
}

function validateFilled($name)
{
    if (empty($_POST[$name])) {
        return "Это поле должно быть заполнено";
    }
}

function getPostVal($name)
{
    return $_POST[$name] ?? "";
}

function validateDate($name)
{
    return strtotime($_POST[$name]) - time() <= - 86400;
}
?>
