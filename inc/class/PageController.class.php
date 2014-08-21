<?php
/**
 * @class PageController
 * @author William Bruno
 * @date 2014-08-21
 */
class PageController extends AbstractController
{
  public function set_post()
  {
    $this->vo->set_id( getPost('id') );
    $this->vo->set_title( getPost('title') );
    $this->vo->set_text( getPost('text') );
  }
  public function do_set_dados( $dados )
  {
    $this->vo->set_id( $dados->id );
    $this->vo->set_title( $dados->label );
    $this->vo->set_text( $dados->text );
  }
}
