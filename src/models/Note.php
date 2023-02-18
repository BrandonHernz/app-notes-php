<?php

namespace Kneel\Notes\models;

use Kneel\Notes\lib\Database;
use PDO;

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

  // Functions

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

  /**
   * Summary of update
   * @return void
   */
  public function update(){
    $query = $this->connect()->prepare("UPDATE notes SET title = :title, content = :content, updated = NOW() WHERE uuid = :uuid");
    $query->execute([
      'title' => $this->title,
      'uuid' => $this->uuid,
      'content' => $this->content
    ]);
  }

  /**
   * Summary of get
   * @param mixed $uuid
   * @return Note
   */
  public static function get($uuid){
    $db = new Database();
    $query = $db->connect()->prepare("SELECT * FROM notes WHERE uuid = :uuid");
    $query->execute([
      'uuid' => $uuid
    ]);

    $note = Note::createFromArray($query->fetch(PDO::FETCH_ASSOC));
    return $note;
  }

  /**
   * Summary of createFromArray
   * @param mixed $arr
   * @return Note
   */
  public static function createFromArray($arr):Note{
    $note = new Note($arr['title'], $arr['content']);
    $note->setUUID($arr['uuid']);

    return $note;
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