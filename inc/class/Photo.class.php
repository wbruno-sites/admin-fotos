<?php
/**
 * @class Photo
 * @author William Bruno
 * @date 27/08/2010
 */
class Photo
{
  public $base;

  public function __construct(){
    $this->base = $_SERVER['DOCUMENT_ROOT'].'/';
  }
  public function image($id) {
    $files = $this->get($this->base . "uploads/image/{$id}/");
    return isset($files[0]) ? $files[0] : '';
  }
  public function carousel($id) {
    return $this->get($this->base . "uploads/carousel/{$id}/");
  }
  public function blueprint($id) {
    return $this->get($this->base . "uploads/blueprint/{$id}/");
  }

  private function get($path)
  {
    $files = glob( $path . '*.*' );
    return $files;
  }
  public function delTree($dir) {
   $files = $this->get($this->base.$dir);
    foreach ($files as $file) {
      @unlink($file);
    }
    if(is_dir($this->base.$dir)) {
      return rmdir($this->base.$dir);
    }
  }
}
