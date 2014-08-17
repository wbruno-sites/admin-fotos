<?php

class Seo {

  private static $title = 'Studio AG Arquitetura';
  private static $desc_default = 'Fundado em São Paulo pelas arquitetas Amanda Castro e Giovana Giosa, o Studio AG Arquitetura desenvolve projetos em diferentes escalas e usos.';
  private static $url = 'www.studioag.arq.br';

  public static function metas() {
    $self = $_SERVER['PHP_SELF'];
    $p = explode('/', $self);

    return self::pg( end( $p ) );
  }

  public static function getUrl() {
    return 'http://' . self::$url;
  }

  public static function getDomain() {
    return self::$url;
  }

  private static function pg( $pg ) {
    switch( $pg )
    {
      case '404.html':
        $arr['desc'] = 'Essa página não existe, mas você pode visitar outras.';
        $arr['title'] = 'Esse projeto não foi criado ainda. | ' . self::$title;
        $arr['canonical'] = self::getUrl() . '/404';
        break;

      case 'home.html':
        $arr['desc'] = self::$desc_default;
        $arr['title'] = self::$title;
        $arr['canonical'] = self::getUrl();
        break;

      case 'projetos.html':
        $arr['desc'] = 'Projetos de Arquitetura do Studio AG. ' . self::$desc_default;
        $arr['title'] = 'Projetos de Arquitetura  | '.self::$title;
        $arr['canonical'] = self::getUrl(). '/projetos';
        break;

      case 'studio.html':
        $arr['desc'] = 'Criado com a proposta de produzir uma arquitetura contemporânea. ' . self::$desc_default;
        $arr['title'] = 'Amanda Castro e Giovana Giosa  | '.self::$title;
        $arr['canonical'] = self::getUrl(). '/studio';
        break;

      case 'feed.html':
        $arr['desc'] = 'Confira nosso perfil no Pinterest. Usamos essa plataforma para arquivar referências e tendências da arquitetura para nossos projetos.';
        $arr['title'] = 'Nosso Pinterest e Instagram | '.self::$title;
        $arr['canonical'] = self::getUrl() . '/feed';
        break;

      case 'contato.html':
        $arr['desc'] = 'Saiba como contratar nossos serviços. ' . self::$desc_default;
        $arr['title'] = 'Entre em contato | '.self::$title;
        $arr['canonical'] = self::getUrl() . '/contato';
        break;

      default:
        $arr['desc'] = self::$desc_default;
        $arr['title'] = self::$title;
        $arr['canonical'] = self::getUrl();
        break;
    }

    return $arr;
  }
}//Seo
