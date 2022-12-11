<?php
use \MadLib\Application;

require __DIR__ . '/Application.php';

$application = new Application();
$application->initializeApplication();

$name = $_POST['name'] ?? '';
$noun1 = $_POST['noun1'] ?? '';
$verb = $_POST['verb'] ?? '';
$adjective = $_POST['adjective'] ?? '';
$noun2 = $_POST['noun2'] ?? '';

$pdo = $application->getDatabase();

$storyId = $application->getCurrentStory();

$deleteStatement = $pdo->prepare("DELETE FROM story_words WHERE story_id = ?");
$deleteStatement->execute([$storyId]);

$insertStatement = $pdo->prepare("INSERT INTO story_words (story_id, label, word) VALUES (?, ?, ?)");
$insertStatement->execute([$storyId, 'name', $name]);
$insertStatement->execute([$storyId, 'noun1', $noun1]);
$insertStatement->execute([$storyId, 'verb', $verb]);
$insertStatement->execute([$storyId, 'adjective', $adjective]);
$insertStatement->execute([$storyId, 'noun2', $noun2]);

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