<?php
/**
 * @class ProjectVO
 * @author William Bruno
 * @date 2014-08-19
 */
class ProjectVO extends ValueObject
{
  protected $id, $name, $description, $order;


  public function __construct( $id = null )
  {
    $this->id           = new Field( 'id', Field::IDENTITY, $id );
    $this->name         = new Field( 'name', Field::LABEL, '', 'label' );
    $this->description  = new Field( 'description' );
    $this->order        = new Field( 'order', Field::NUMBER );
  }

  public function get_id(){ return $this->id->value; }
  public function get_name(){ return $this->name->value; }
  public function get_description(){ return $this->description->value; }
  public function get_order(){ return $this->order->value; }

  public function get_label(){ return $this->name->value; }


  public function set_id( $id ){ $this->id->value = (int)$id; }
  public function set_name( $name ){ $this->name->value = $name; }
  public function set_description( $description ){ $this->description->value = $description; }
  public function set_order( $order ){ $this->order->value = $order; }
}
