<?php

namespace Kneel\Notes\models;

use Kneel\Notes\lib\Database;

class Note extends Database{
  private string $uuid;

  /**
   * Summary of __construct
   * @param string $title
   * @param string $content
   */
  public function __construct(private string $title, private string $content) {
    parent::__construct();
    $this->uuid = uniqid();
  }

  /**
   * Summary of save
   * @return void
   */
  public function save(){
    $query = $this->connect()->prepare("INSERT INTO notes (uuid, title, content, updated) VALUES (:uuid,:title, :content, NOW())");
    $query->execute([
      'title' => $this->title,
      'uuid' => $this->uuid,
      'content' => $this->content
    ]);
  }

  // Getters and Setters

  /**
   * Summary of getUUID
   * @return string
   */
  public function getUUID(){
    return $this->uuid;
  }

  /**
   * Summary of setUUID
   * @param mixed $value
   * @return void
   */
  public function setUUID($value){
    $this->uuid = $value;
  }

  /**
   * Summary of getTitle
   * @return string
   */
  public function getTitle():String{
    return $this->title;
  }

  /**
   * Summary of setTitle
   * @param mixed $value
   * @return void
   */
  public function setTitle($value){
    $this->title = $value;
  }

  /**
   * Summary of getContent
   * @return string
   */
  public function getContent():String{
    return $this->content;
  }

  /**
   * Summary of setContent
   * @param mixed $value
   * @return void
   */
  public function setContent($value){
    $this->content = $value;
  }
}