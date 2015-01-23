<?php
/**
 * @class ProjectController
 * @author William Bruno
 * @date 27/08/2010
 */
class ProjectController extends AbstractController
{
  public function set_post()
  {
    $this->vo->set_id( getPost('id') );
    $this->vo->set_name( getPost('name') );
    $this->vo->set_description( getPost('description') );
    $this->vo->set_order( getPost('order') );
  }
  public function do_set_dados( $dados )
  {
    $this->vo->set_id( $dados->id );
    $this->vo->set_name( $dados->label );
    $this->vo->set_description( $dados->description );
    $this->vo->set_order( $dados->order );
  }
}
