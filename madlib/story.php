<?php

session_start();

$name = $_POST['name'] ?? '';
$noun1 = $_POST['noun1'] ?? '';
$verb = $_POST['verb'] ?? '';
$adjective = $_POST['adjective'] ?? '';
$noun2 = $_POST['noun2'] ?? '';

$_SESSION['words'] = [
  'name' => $name,
  'noun1' => $noun1,
  'verb' => $verb,
  'adjective' => $adjective,
  'noun2' => $noun2,
];

$user = "root";
$pass = "secretpassword";
$pdo = new PDO('mysql:host=localhost;dbname=php-projects-stories', $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_SESSION['story']))
{
  $statement = $pdo->prepare("INSERT INTO story (timecreated) VALUES (?)");
  $statement->execute([time()]);
  $_SESSION['story'] = $pdo->lastInsertId();
}

$deleteStatement = $pdo->prepare("DELETE FROM story_words WHERE story_id = ?");
$deleteStatement->execute([$_SESSION['story']]);

$insertStatement = $pdo->prepare("INSERT INTO story_words (story_id, label, word) VALUES (?, ?, ?)");
$insertStatement->execute([$_SESSION['story'], 'name', $name]);
$insertStatement->execute([$_SESSION['story'], 'noun1', $noun1]);
$insertStatement->execute([$_SESSION['story'], 'verb', $verb]);
$insertStatement->execute([$_SESSION['story'], 'adjective', $adjective]);
$insertStatement->execute([$_SESSION['story'], 'noun2', $noun2]);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>MadLibs</title>
</head>

<body>
  <h1>Here's your story</h1>
  <p>Yesterday, <?php echo htmlentities($name); ?> decided to buy a <?php echo htmlentities($adjective); ?> <?php echo htmlentities($noun1);?>. After using it to <?php echo htmlentities($verb); ?> with the <?php echo htmlentities($noun2); ?> they decided to give the <?php echo htmlentities($noun1); ?> to their friend.
  </p>
  <p><a href="index.php">Edit the story</a></p>
</body>

</html>