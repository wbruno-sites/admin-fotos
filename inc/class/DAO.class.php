<?php
/**
 * @class DAO
 * @author William Bruno
 * @package wbruno 1.0beta 09/09/2010
 */
class DAO
{
	private $table, $fields, $statement;
	private $type, $sql;

	public $num_rows = 0, $limite = 30;


	public function __construct( $table )
	{
		$this->table = $table;
		$this->db = Db::getInstance();
	}
	final public function prepare()
	{
		$this->type = null;
		$this->statement = Array();
	}

	final public function save( ValueObject $vo )
	{
		$sql = $vo->get_id() != null ? $this->update( $vo ) : $this->insert( $vo );
		$query = $this->query( $sql );

		$vo->set_id( $this->lastInsert( $vo ) );
		return $query;
	}
	final public function del( ValueObject $vo )
	{
		$sql = $this->delete( $vo );
		return $this->query( $sql );
	}
	final public function execute( $debug=false )
	{
		$ret = true;
		$values = array();
		$where  = null;
		switch ( $this->type )
		{
			case 'SELECT':
				$fields = sprintf( '%s' , implode( ', ' , $this->fields ) );

				$ret =  sprintf( 'SELECT %s FROM `%s`' , $fields , $this->table );
				if ( isset( $this->statement[ 'left' ] ) ) $ret .= sprintf( ' LEFT JOIN %s' , $this->statement[ 'left' ] );
				if ( isset( $this->statement[ 'where' ] ) ) $ret .= sprintf( ' %s' , $this->statement[ 'where' ] );
				if ( isset( $this->statement[ 'order' ] ) ) $ret .= sprintf( ' ORDER BY %s' , $this->statement[ 'order' ] );
				if ( isset( $this->statement[ 'limit' ] ) ) $ret .= sprintf( ' LIMIT %s' , $this->statement[ 'limit' ] );
				break;

			case 'UPDATE':
				$fields = $this->statement->getFieldsObject();


				foreach ( $fields AS $field => $value ){
					if ( $value->type == Field::IDENTITY ){ $where = sprintf( '`%s`=%s' , $field , $fields['id']->value ); }
					else $values[] = sprintf( '`%s`=%s' , $field , $value->__toString() );
				}
				if ( $where ) $ret = sprintf( 'UPDATE `%s` SET %s WHERE %s' , $this->table , implode( ',' , $values ) , $where );
				break;

			case 'INSERT':
				foreach ( $this->statement AS $vo )
					$values[] = sprintf( '%s' , implode( ',' , $vo->getFields() ) );

				$ret = sprintf( 'INSERT INTO `%s`(`%s`) VALUES(%s);' , $this->table , implode( '`,`' , $this->fields ) , implode( '),(' , $values ) );
				break;

			case 'DELETE':
				$fields = $this->statement->getFieldsObject();

				foreach ( $fields as $field => $value ) if ( $value->type == Field::IDENTITY ){
					$where = sprintf( '`%s`=%s' , $field , getPost('id') );
					break;
				}
				if ( $where ) $ret = sprintf( 'DELETE FROM `%s` WHERE %s' , $this->table , $where );
				break;
		}
		if( $debug ) echo $ret;

		$this->sql = $ret;
		return $this;
	}


	final public function select( ValueObject $vo )
	{
		if ( ( $this->type == null ) || ( $this->type == 'SELECT' ) )
		{
			if ( !$this->fields ) $this->fields = $vo->getNames( true, $this->table );
			$this->statement[] = $vo;
			$this->type = 'SELECT';
		}
		return $this;
	}
	final public function update( ValueObject $vo )
	{
		if ( ( $this->type == null ) || ( $this->type == 'UPDATE' ) )
		{
			if ( !$this->fields ) $this->fields = $vo->getNames();
			$this->statement = $vo;
			$this->type = 'UPDATE';
		}
		return $this;
	}
	final public function insert( ValueObject $vo )
	{
		if ( ( $this->type == null ) || ( $this->type == 'INSERT' ) )
		{
			if ( !$this->fields ) $this->fields = $vo->getNames();
			$this->statement[] = $vo;
			$this->type = 'INSERT';
		}
		return $this;
	}
	final public function delete( ValueObject $vo )
	{
		if ( ( $this->type == null ) || ( $this->type == 'DELETE' ) )
		{
			if ( !$this->fields ) $this->fields = $vo->getNames();
			$this->statement = $vo;
			$this->type = 'DELETE';
		}
		return $this;
	}
	public function fields( Array $fields )
	{
		$this->fields = array_merge( (array)$this->fields, (array)$fields );
		return $this;
	}
	public function left( $tab )
	{
		$this->statement['left'] = $tab;
		return $this;
	}
	public function order( $field='' )
	{
		$this->statement['order'] = !empty( $field ) ? $field : 'label';
		return $this;
	}
	public function where( $str )
	{
		$this->statement['where'] = $str;
		return $this;
	}
	public function limit( $start, $end=false )
	{
		if( is_int($start) )
		{
			$limit = $end ? ', '.$end : '';
			$this->statement['limit'] = $start.$limit;
		}
		return $this;
	}
	public function byId( $id )
	{
		$this->statement['where'] = " WHERE `{$this->table}`.`id` = {$id} ";
		return $this;
	}
	final public function query( $sql )
	{
		/*
		$this->execute();
		$sql = $this->sql;
		*/
		try{
			$query = $this->db->query( $sql );
			return $query;
		}
		catch( Exception $e ){
			echo '<span class="error">Erro. Contate o administrador.</span>';
			$log = new Logger( 'DB', "{$e->getMessage()} \n" );
			$log->createLog('log');
		}
	}
	final public function __toString()
	{
		$this->execute();
		return $this->sql;
	}
	final private function lastInsert( $vo )
	{
		return $this->db->insert_id ? $this->db->insert_id : $vo->get_id();
	}




	public function links_paginacao()
	{
		$total_paginas = $this->num_rows/$this->limite;

		$by = getGet('by') ? '&amp;by='.getGet('by') : '';
		$order = getGet('order') ? '&amp;order='.getGet('order') : '';
		$q = getGet('q') ? '&amp;q='.getGet('q') : '';

		if( $total_paginas>1 )
		{
			$links = '<p class="paginacao">';
			$i = 0;
			while( $i < $total_paginas )
			{
				$links .= '<a href="?ctrl='.getGet('ctrl').'&amp;ac='.getGet('ac').'&amp;in='.$i.$by.$order.$q.'">'.($i+1).'</a> ';
				$i++;
			}
			return $links.'</p>';
		}
	}
	public function paginar( ValueObject $vo, $where='' )
	{
		$by = getGet('by') ? getGet('by').' '.getGet('order') : '';


		$sql = $this->select( $vo )->where( $where );
		$query = $this->query( $sql );
		if( is_object( $query ) )
			$this->num_rows = $query->num_rows;


		$inicio = getGet('in')*$this->limite;
		$sql = $this->select( $vo )->order( $by )->limit( $inicio, $this->limite );

		return $this->query( $sql );
	}
}
