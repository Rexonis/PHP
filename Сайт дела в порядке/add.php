<?php

require_once('init.php');
$required_fields = ['name', 'projects'];
$errors = [];

if (isset($_POST['button_add'])) {
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if ($_POST['end_time'])
    {
        if (validateDate('end_time')) {
            $errors['end_time'] = 'Выберите правильную дату';
        }
    }
    $errors = array_filter($errors);
    if (!count($errors)) {
        $name = $_POST['name'];
        $projects = $_POST['projects'];
        $end_time = $_POST['end_time'];
        if (isset($_FILES['file'])) {
            $file_name = $_FILES['file']['name'];
            $file_path = __DIR__ . '/uploads/';
            $file_url = '/uploads/' . $file_name;
            move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
        }
        write_task ($con, $name, $projects, $end_time, $file_name);
        header("Location: /index.php?projects_id=$projects");
    }
}

$projects_id = $_GET['projects_id'] ?? '';

$content = include_template('add_form.php', ['projects' => get_projects($con, 1004),  'tasks' => get_tasks($con, 1004, $projects_id), 'show_complete_tasks' => $show_complete_tasks, 'projects_id' => $projects_id, 'errors' => $errors]);
$layout = include_template('layout.php', ['content' => $content, 'title'=> $title, 'projects_id' => $projects_id]);
print($layout);

?>