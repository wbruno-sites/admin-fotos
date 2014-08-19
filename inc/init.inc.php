<?php
define('BASE_PATH', realpath(dirname(__FILE__)).'/');

error_reporting( E_ALL | E_STRICT );
ini_set('display_errors', TRUE);


setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

set_include_path(implode(PATH_SEPARATOR, array(
  BASE_PATH.'class',
  get_include_path()
)));

/**
 * Faz require do arquivo de configurações
 * edite ele para mudar conexão com o banco de dados
 */
if( !file_exists(BASE_PATH.'config.inc.php') ){
        exit('Erro config.php nao encontrado');
} else {
        require BASE_PATH.'config.inc.php';
}


/**
 * Faz include do arquivo da classe no momento em que esta for instanciada
 * @param $class string = classe que foi instanciada
 */
function __autoload( $class ){
	if( is_file( BASE_PATH.'class/'.$class.'.class.php' ) )
		include $class.'.class.php';
}
/**
 * Verifica se foi enviada uma requisição POST ao servidor
 */
function isPost(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		return TRUE;
	}
}
/**
 * Verfica o se existe valor
 * @param $campo var, valor na URL
 */
function getGet( $campo ){
	return isset($_GET[$campo]) ? filter( $_GET[$campo] ) : '';
}
/**
 * Verfica o se existe valor
 * @param $campo var, name do input a ser verificado
 */
function getPost( $campo ){
	return isset($_POST[$campo]) ? filter( $_POST[$campo] ) : '';
}
/**
 * Evita SQL Injection
 * @param $var var, variável a ser 'limpa'
 * @return $str string
 */
function filter( $var ){
	if( !get_magic_quotes_gpc() )
		//$str = mysql_real_escape_string( $var );
		$str = addslashes( $var );
	else
		$str = $var;
	$str = str_replace( '#', '\#', $str );
	return $str;
}
/**
 * @param $string, valor que será limpo para URL
 */
function slug( $string ){

	$string = trim($string);

	$string = preg_replace("/[áàâãª]/i","a",$string);
	$string = preg_replace("/[éèê]/i","e",$string);
	$string = preg_replace("/[íìî]/i","i",$string);
	$string = preg_replace("/[óòôõº]/i","o",$string);
	$string = preg_replace("/[úù]/i","u",$string);
	$string = preg_replace("/[ç]/i","c",$string);
	$string = preg_replace("/[\/,()]/i","",$string);
	$string = str_replace("|","",$string);
	$string = str_replace("  "," ",$string);

	$string = strtolower($string);

	$string = preg_replace('/[^a-z0-9\.]/i', '-', $string);

	return $string;
}

/**
 * @return boolean, true caso a URI seja a home do site
 */
function is_home(){
	return stripos( $_SERVER['REQUEST_URI'], 'index.html' )
		|| ( $_SERVER['REQUEST_URI'] === '/' );
}
/**
 * @return string, class=""(html) de acordo com o URI atual
 */
function get_body_class(){
	if( is_home() ) return 'class="home"';

	$pieces = explode( '/', $_SERVER['REQUEST_URI'] );
	$class = Array();
	foreach( $pieces AS $part ){
		$class[] = str_replace( '.html', '', $part );
	}

	return 'class="'.trim(implode( ' ', $class )).'"';
}
/**
 * @see get_body_class()
 */
function body_class(){ echo get_body_class(); }
