<?php
/**
 * @class User
 * @author William Bruno
 * @date 27/08/2010
 */
class User extends AbstractModel
{
	private $db;

	public function __construct()
	{
		$this->vo = new UserVO();
    $this->dao = new DAO( 'user' );
		$this->db = Db::getInstance();
	}

	public function login( $user=null, $pass=null )
	{
		$_SESSION = array();

		$sql = "SELECT `id`,`user`,`name`,`level` FROM `user` WHERE `user` = '{$user}'";
		$query = $this->db->query( $sql );


		if( $query->num_rows ) {
			$dados = $query->fetch_object();
			$sql2 = "SELECT `user`
				FROM `user`
				WHERE `pass` = '{$pass}'
				AND `user` = '{$dados->user}' ";

			$q2 = $this->db->query( $sql2 );

			if( $q2->num_rows ) {
				$_SESSION['logged'] = 'ok';
				$_SESSION['level'] = $dados->level;
				$_SESSION['id'] = $dados->id;
				$_SESSION['name'] = $dados->name;

				return true;
			} else {
				$_SESSION['logged'] = 'Usuário não identificado.';
				return false;
			}
		} else {
			$_SESSION['logged'] = 'Usuário não identificado.';
			return false;
		}
	}

}//fecha class Usuário
