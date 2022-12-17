<?php

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$todo = $_POST['todo'] ?? '';

if (!$todo) {
    $error = ERROR_REQUIRED;
} else if (mb_strlen($todo) < 5) {
    $error = ERROR_TOO_SHORT;
} else if (mb_strlen($todo) > 200) {
    $error = ERROR_TOO_LONG;
}

if (!$error) {
    $todos = [...$todos, [
        'name' => $todo,
        'done' => false,
        'id' => time()
    ]];
    file_put_contents($filename, json_encode($todos));
    $todo = '';
    header('Location: /');
}
