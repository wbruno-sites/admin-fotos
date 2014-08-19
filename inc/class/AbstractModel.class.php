<?php/** * @class AbstractModel * @author William Bruno * @date 08/09/2010 */abstract class AbstractModel{	protected $dao, $vo;  public function save( ValueObject $vo )  {    $sql = $vo->get_id() != null ? $this->dao->update( $vo ) : $this->dao->insert( $vo );    $query = $this->dao->query( $sql );    $vo->set_id( $this->dao->lastInsert( $vo ) );    return $query;  }  public function one( $id ) {    $sql = $this->dao->select( $this->vo )->byId( $id );    $query = $this->dao->query($sql);    return $query->fetch_object();  }  public function all() {    $sql = $this->dao->select( $this->vo )->order();    return $this->dao->query( $sql );  }}