<?php

namespace MadLib;

/**
 * Provides Application level data and functionality
 * 
 * @package MadLib
 */
class Application
{
  /**
   * Contains the pdo connection
   * @var \PDO
   */
  private $pdo;

  /**
   * Performs Application Initialization
   */
  public function initializeApplication()
  {
    session_start();
  }

  /**
   * Returns a database connection
   * 
   * @return \PDO
   */
  public function getDatabase()
  {
    if (empty($this->pdo)) {
      $user = "root";
      $pass = "secretpassword";
      $this->pdo = new \PDO('mysql:host=localhost;dbname=php-projects-stories', $user, $pass);
      $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    return $this->pdo;
  }

  /**
   * Sets the id of the current story
   * 
   * @param int $storyId
   */
  public function setCurrentStory($storyId = null)
  {
    $_SESSION['story'] = $storyId;
  }

  public function getCurrentStory()
  {
    if (!isset($_SESSION['story'])) {
      $pdo = $this->getDatabase();
      $statement = $pdo->prepare("INSERT INTO story (timecreated) VALUES (?)");
      $statement->execute([time()]);
      $this->setCurrentStory($pdo->lastInsertId());
    }
    return $_SESSION['story'];
  }
}
