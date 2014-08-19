<?php
/**
 * @class UserVO
 * @author William Bruno
 * @date 27/08/2010
 */
class UserVO extends ValueObject
{

	protected $id, $name, $user, $pass, $ativo, $level;


	public function __construct( $id = null )
	{
		$this->id 			= new Field( 'id', Field::IDENTITY, $id );
		$this->name			= new Field( 'name', Field::LABEL, '', 'label' );
		$this->user			= new Field( 'user' );
		$this->pass			= new Field( 'pass' );
		$this->level		= new Field( 'level', Field::NUMBER );
	}


	public function get_id(){ return $this->id->value; }
	public function get_name(){ return $this->name->value; }
	public function get_user(){ return $this->user->value; }
	public function get_pass(){ return $this->pass->value; }
	public function get_level(){ return $this->level->value; }

	public function get_label(){ return $this->name->value; }


	public function set_id( $id ){ $this->id->value = (int)$id; }
	public function set_name( $name ){ $this->name->value = $name; }
	public function set_user( $user ){ $this->user->value = $user; }
	public function set_pass( $pass ){ $this->pass->value = $pass; }
	public function set_level( $level ){ $this->level->value = (int)$level; }
}
