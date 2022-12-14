<?php

require __DIR__ . '/../src/bootstrap.php';

$controller = new \UrlShortener\UrlController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $controller->postIndex();
} else {
  $controller->getIndex();
}