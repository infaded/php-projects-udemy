<?php

namespace UrlShortener;

/**
 * Handle the business logic and data behind URLs for our Shortener
 * 
 * @package UrlShortener
 */

class UrlEntity
{

  /**
   * @var string
   */
  private $targetUrl;

  /**
   * @var string
   */
  private $shortenedUrl;

  /** 
   * Create a new url entity for the target URL
   * 
   * @param string $targetUrl
   */
  public function __construct($targetUrl)
  {
    $this->targetUrl = $targetUrl;
    $this->shortenedUrl = $this->generateRandomToken();
  }

  /**
   * Generates a random 8 character string for a shortened URL
   * 
   * @return string
   */
  private function generateRandomToken()
  {
    $characters = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
    $token = '';
    for ($i = 0; $i < 8; $i++) {
      $token .= $characters[array_rand($characters)];
    }
    return $token;
  }

  /**
   * Returns the target URL
   * 
   * @return string
   */
  public function getTargetUrl()
  {
    return $this->targetUrl;
  }

  /**
   * Returns a short URL that will redirect to the target URL
   * 
   * @return string
   */
  public function getShortenedUrl()
  {
    return $this->shortenedUrl;
  }
}
