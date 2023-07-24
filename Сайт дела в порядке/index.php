<?php
require_once ("init.php");

$projects_id = $_GET['projects_id'] ?? '';

$content = include_template('main.php', ['projects' => get_projects($con, 1004),  'tasks' => get_tasks($con, 1004, $projects_id), 'show_complete_tasks' => $show_complete_tasks, 'projects_id' => $projects_id]);
$layout = include_template('layout.php', ['content' => $content, 'title'=> $title, 'projects_id' => $projects_id]);
print($layout);

?>




