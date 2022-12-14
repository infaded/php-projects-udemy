<?php

namespace UrlShortener;

/**
 * Responsible for co-ordinating interaction with URLs in the Shortener
 * @package UrlShortener
 */

class UrlController
{
  /**
   * Front Page
   */

  public function getIndex()
  {
    include CONFIG_VIEWS_DIR . '/index.php';
  }

  /**
   * Handles submission of the URL shortener form
   */
  public function postIndex()
  {
    session_start();

    $url = new UrlEntity($_POST['url']);
    $_SESSION['urls'][$url->getShortenedUrl()] = $url;

    $shortenedUrl = urlencode($url->getShortenedUrl());
    header("Location: /shortened.php?url={$shortenedUrl}");
  }

  public function getShortenedUrl()
  {
    session_start();

    $url = $_SESSION['urls'][$_GET['url']];
    include CONFIG_VIEWS_DIR . '/shortened.php';



  }
}
