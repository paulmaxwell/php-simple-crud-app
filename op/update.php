<?php

$sth = $pdo->prepare('SELECT * FROM repositories WHERE id = :id');
$sth->execute(array(':id' => $_GET['id']));

if ($repo = $sth->fetch(PDO::FETCH_ASSOC)) {

  if (!empty($_POST['save'])) {
    $sth = $pdo->prepare('UPDATE repositories SET name = :name, active = :active WHERE id = :id');
    $sth->execute(array(
      ':name' => $_POST['name'],
      ':active' => (!empty($_POST['active']) ? 1 : 0),
      ':id' => $_GET['id'],
    ));

    header('Location: index.php');
    exit;
  }

  ob_start();

  require __DIR__ . '/../view/form.php';

  $content = ob_get_clean();

  require __DIR__ . '/../view/main.php';
}
