<?php

session_start();

if(isset($_GET['newstory']))
{
  unset($_SESSION['story']);
  header("Location: /linkedin-learning/php-projects-udemy/madlib/index.php");
  exit;
}
elseif (isset($_GET['storyid']))
{
  $_SESSION['story'] = $_GET['storyid'];
}

$user = "root";
$pass = "secretpassword";
$pdo = new PDO('mysql:host=localhost;dbname=php-projects-stories', $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_SESSION['story'])) {
  $statement = $pdo->prepare("INSERT INTO story (timecreated) VALUES (?)");
  $statement->execute([time()]);
  $_SESSION['story'] = $pdo->lastInsertId();
}

$storyStatement = $pdo->prepare("SELECT * FROM story_words WHERE story_id = ?");
$storyStatement->execute([$_SESSION['story']]);

$words = [];
foreach ($storyStatement as $row) {
  $words[$row['label']] = $row['word'];
};

$name = $words['name'] ?? '';
$noun1 = $words['noun1'] ?? '';
$verb = $words['verb'] ?? '';
$adjective = $words['adjective'] ?? '';
$noun2 = $words['noun2'] ?? '';

$storyListStatement = $pdo->prepare("SELECT * FROM story");
$storyListStatement->execute([]);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>MadLibs</title>
</head>

<body>
  <h1>Choose your words</h1>
  <a href="?newstory=1">Create a new story</a>
  <form action="story.php" method="post">
    <div><label for="name">Name:</label>
      <input type="text" name="name" id="name" value="<?php echo $name; ?>">
    </div>
    <div><label for="noun1">Noun:</label>
      <input type="text" name="noun1" id="noun1" value="<?php echo $noun1; ?>">
    </div>
    <div><label for="verb">Verb:</label>
      <input type="text" name="verb" id="verb" value="<?php echo $verb; ?>">
    </div>
    <div><label for="adjective">Adjective:</label>
      <input type="text" name="adjective" id="adjective" value="<?php echo $adjective; ?>">
    </div>
    <div><label for="noun2">Noun:</label>
      <input type="text" name="noun2" id="noun2" value="<?php echo $noun2; ?>">
    </div>
    <div>
      <input type="submit" name="submit" value="Submit">
    </div>
  </form>

  <?php
  foreach($storyListStatement as $row)
  {
  ?>
  <div>
    <a href="?storyid=<?php echo htmlentities($row['id']) ?>">Story <?php echo htmlentities($row['id']) ?></a>
    <em>Created - <?php echo htmlentities(date('Y-m-d H:i:s', $row['timecreated'])); ?></em>
  </div>

  <?php
  }
  ?>

</body>

</html>