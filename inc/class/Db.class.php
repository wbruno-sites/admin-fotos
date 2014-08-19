<?php
/**
 * @class Db
 * @author William Bruno
 * @date 06/09/2010
 */
class Db extends mysqli
{
	/**
	 * @static @var boolean
	 */
	private static $_connected = false;

	/**
	 * @static @var Conexao
	 */
	private static $_instance = null;

	/**
	 * @param void
	 * @return void
	 */
	public function  __destruct()
	{
		$this->close();
	}

    /**
     * @param void
     * @return Db
     */
	public static function getInstance()
	{
		if ( null === self::$_instance )
			self::$_instance = new self();
		return self::$_instance;
	}

    /**
     * @param void
     * @return void
     */
	public function connect(
		$host = '',
		$username = '',
		$passwd = '',
		$dbname = "",
		$port = '',
		$socket = ''
	)
	{
		if( !self::$_connected )
		{
			parent::__construct( HOST, USER, PASS, DB );

			if(mysqli_connect_errno())
				throw new Exception('A Conexao falhou: '.mysqli_connect_error());
			self::$_connected = true;
		}
	}

	/**
	 * @param void
	 * @return void
	 */
    public function close()
	{
        if(self::$_connected)
		{
            parent::close();
            self::$_connected = false;
        }
    }

	/**
	 * @param string $sql
	 * @return mysqli_result Object
	 */
    public function query( $sql )
	{
		try {
			$this->connect();
			$result = parent::query($sql);

			if( $result ) return $result;
			else throw new Exception("Query Exception: ".mysqli_error($this)." numero:".mysqli_errno($this)." \n sql: ".$sql);
		}
		catch( Exception $e ){
			echo '<strong class="system red">Falha grave com o banco de dados! Entre em contato com o administrador!</strong>';

			$log = new Logger( 'DB', "{$e->getMessage()} \n linha: {$e->getLine()} \n arquivo: {$e->getFile()}" );
			$log->createLog('log');
		}
    }

}
