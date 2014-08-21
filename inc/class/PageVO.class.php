<?php
/**
 * @class PageVO
 * @author William Bruno
 * @date 2014-08-21
 */
class PageVO extends ValueObject
{
  protected $id, $title, $text;


  public function __construct( $id = null )
  {
    $this->id           = new Field( 'id', Field::IDENTITY, $id );
    $this->title         = new Field( 'title', Field::LABEL, '', 'label' );
    $this->text  = new Field( 'text' );
  }

  public function get_id(){ return $this->id->value; }
  public function get_title(){ return $this->title->value; }
  public function get_text(){ return $this->text->value; }

  public function get_label(){ return $this->title->value; }


  public function set_id( $id ){ $this->id->value = (int)$id; }
  public function set_title( $title ){ $this->title->value = $title; }
  public function set_text( $text ){ $this->text->value = $text; }
}
