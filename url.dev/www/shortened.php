<?php
require __DIR__ . '/../src/bootstrap.php';

$controller = new \UrlShortener\UrlController();

$controller->getShortenedUrl();