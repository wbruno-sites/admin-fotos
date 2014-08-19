<?php
/**
 * @class Field
 * @author William Bruno
 * @date 27/08/2010
 */
class Field
{

	const NORMAL = 1;
	const IDENTITY = 2;
	const LABEL = 3;
	const FOREIGN = 4;
	const DATE = 5;
	const HOUR = 6;
	const NUMBER = 7;
	private $name;
	public $type;
	public $value;


    public function __construct( $name , $type = self::NORMAL, $value = null, $alias=null )
	{
        $this->name 		= $name;
        $this->type 		= $type;
        $this->value 		= $value;
        $this->alias 		= $alias ? ' AS '.$alias : '';
    }


    public function __toString()
	{
        switch ( $this->type ){
            case 1: return sprintf( "'%s'" , $this->value ); break;
            case 2: return 'NULL'; break;
            case 3: return sprintf( "'%s'" , $this->value ); break;
            case 4: return sprintf( "'%s'" , intval($this->value) ); break;
            case 5: return empty( $this->value ) ? 'NOW()' : sprintf( "'%s'" , $this->value ); break;
            case 6: return empty( $this->value ) ? 'NOW()' : sprintf( "'%s'" , $this->value ); break;
            case 7: return sprintf( "%s" , $this->value ); break;



            default : return (string)$this->value;
        }
    }
	private function isNull()
	{
		return is_null( $this->value );
	}



}
