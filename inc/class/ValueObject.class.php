<?php
/**
 * @class ValueObject
 * @author William Bruno
 * @date 27/08/2010
 */
abstract class ValueObject
{
    private $fields;


    final public function getNames( $alias=false, $table=false )
	{
        if ( !$this->fields )
		{
			return array_keys( $this->getFields( $alias, $table ) );
		}
        else return array_keys( $this->fields );
    }


    final public function &getFields( $alias=false, $table=false )
	{
        $this->fields = array();
        foreach ( $this as $name => $value )
			if ( $value instanceOf Field )
			{
				$tab = $table ? $table.'.' : '';
				$key = $alias ? $name.$value->alias : $name;
				$this->fields[ $tab.$key ] = $value->__toString();
			}

        return $this->fields;
    }
    final public function &getFieldsObject()
	{
        $this->fields = array();
        foreach ( $this as $name => $value ) if ( $value instanceOf Field ) $this->fields[ $name ] = $value;
        return $this->fields;
    }


}
