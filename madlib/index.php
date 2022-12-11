<?php

session_start();

$name = $_SESSION['words']['name'] ?? '';
$noun1 = $_SESSION['words']['noun1'] ?? '';
$verb = $_SESSION['words']['verb'] ?? '';
$adjective = $_SESSION['words']['adjective'] ?? '';
$noun2 = $_SESSION['words']['noun2'] ?? '';

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>MadLibs</title>
</head>

<body>
  <h1>Choose your words</h1>
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
</body>

</html>