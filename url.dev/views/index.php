<!DOCTYPE html>
<html>

<head>
  <title>URL Shortener</title>
</head>

<body>
  <h1>PHP Projects - URL Shortener</h1>
  <form method="post" action="/index.php">

    <?php if ($errorMsg ?? false) : ?>
      <div class="errors"><?= htmlentities($errorMsg) ?></div>
    <?php endif; ?>

    <label for="url">URL</label>
    <input type="text" name="url" id="url" value="<?= isset($url) ? htmlentities($url->getTargetUrl()) : '' ?>">
    <input type="submit" name="shorten" id="shorten" value="Shorten">
  </form>
</body>

</html>