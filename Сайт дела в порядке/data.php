<?php
$show_complete_tasks = rand(0, 1);
$title = "Дела в порядке";

function get_projects($con, $user) {
    $sql = "SELECT projects_id, name_projects, COUNT(name_tasks) AS value_tasks FROM Projects LEFT JOIN Tasks ON Projects.id=Tasks.projects_id WHERE Projects.users_id = ? GROUP BY name_projects, projects_id";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
} 

function get_tasks($con, $user, $projects_id) {
    if($projects_id){
    $sql = "SELECT name_tasks, date_format(end_time, '%d.%m.%Y') AS end_time, name_projects, status_tasks, random_file FROM Projects 
    LEFT JOIN Tasks ON Projects.id=Tasks.projects_id WHERE Users_id = ? AND projects_id = ? ORDER BY end_time DESC"; 
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $user, $projects_id);
    }
    else{
        $sql = "SELECT name_tasks, date_format(end_time, '%d.%m.%Y') AS end_time, name_projects, status_tasks, random_file FROM Projects 
        LEFT JOIN Tasks ON Projects.id=Tasks.projects_id WHERE Users_id = ? ORDER BY end_time DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $user);
    }
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if (!mysqli_num_rows($res)) {
        http_response_code(404);
    }
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function write_task ($con, $name, $projects, $end_time, $file_name) {
    if ($end_time) {
        $sql = "INSERT INTO Task (name_tasks, end_time, projects_id, random_file) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssis', $name, $end_time, $projects, $file_name);
    }
    else {
        $sql = "INSERT INTO Task (name_tasks, projects_id, random_file) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sis', $name, $projects, $file_name);
    }
    mysqli_stmt_execute($stmt);
}

/*$projects = ["Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];*/
/*$tasks =[ 
[
    'task' => 'Собеседование в IT компании',
    'date_of_completion' => '01.12.2019',
    'category' => 'Работа',
    'completed' => false
],
[
    'task' => 'Выполнить тестовое задание',
    'date_of_completion' => '25.12.2019',
    'category' => 'Работа',
    'completed' => false
],
[
    'task' => 'Сделать задание первого раздела',
    'date_of_completion' => '21.12.2019',
    'category' => 'Учеба',
    'completed' => true
],
[
    'task' => 'Встреча с другом',
    'date_of_completion' => '22.12.2019',
    'category' => 'Входящие',
    'completed' => false
],
[
    'task' => 'Купить корм для кота',
    'date_of_completion' => null,
    'category' => 'Домашние дела',
    'completed' => false
],
[
    'task' => 'Заказать пиццу',
    'date_of_completion' => null,
    'category' => 'Домашние дела',
    'completed' => false
],
];*/
?>