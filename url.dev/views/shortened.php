<!DOCTYPE html>
<html>
<head>
  <title>URL Shortener</title>
</head>
<body>
  <h1>PHP Projects - <?=htmlentities($url->getShortenedUrl())?></h1>
  <p>This url redirects to <?=htmlentities($url->getTargetUrl())?></p>
  <h2>Create another URL</h2>
  <form method="post" action="/index.php">
    <label for="url">URL</label>
    <input type="text" name="url" id="url">
    <input type="submit" name="shorten" id="shorten" value="Shorten">
  </form>
</body>
</html>