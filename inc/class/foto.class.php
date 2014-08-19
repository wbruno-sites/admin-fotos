<?php
/**
 * @class Foto
 * @author William Bruno
 * @date 27/08/2010
 */
abstract class Foto
{
	private static $grandes;
	public static $largura = '100px';
	public static function byAlbum( $id_album, $max_w=100, $dir='', $acao='', $capa=false )
	{
		try {
			return self::getFotos( $id_album, $max_w, $dir, $acao, $capa );
		}
		catch ( Exception $e ){
			echo '<span class="error">Erro. Contate o administrador.</span>';
			$log = new Logger( 'Mysql', $e->getMessage() );
			$log->createLog('log');
		}
	}
	public static function getFotos( $id_album, $maxLargura=200, $dir='', $acao=false, $capa=false )
	{
		self::$grandes = Array();

		$diretorio = $dir.$id_album.'/';
		$fotos = '';

		$legenda = self::get_legendas( $id_album );


		$files = glob( $diretorio.'*.*' );
		if( $files )
			foreach( $files as $filename )
			{
				$ext = strtolower( pathinfo($filename, 4) );

				if( !stripos( $filename, '_p.' ) && !stripos( $filename, 'db' ) )
				{
					$title = self::legenda( basename( $filename ), $legenda );
					$span = self::span( $filename, $title, $capa, $acao );
					$fotos .= self::get_li( $filename, $span, $title );
				}
			}
		return $fotos;
	}
	public static function get_grandes()
	{
		if( is_array( self::$grandes ) )
		{
			$li ='';
			foreach( self::$grandes AS $grande )
				$li .= '<li>'.$grande.'</li>';
		}
		return $li;
	}
	private static function get_legendas( $id_album )
	{
		$sql = "SELECT foto, legenda FROM foto WHERE id_album = {$id_album}";
		$db = Db::getInstance();

		$query = $db->query( $sql );
		$arr = Array();
		while( $dados = $query->fetch_object() )
			$arr[ $dados->foto ] = $dados->legenda;

		return $arr;
	}
	private static function legenda( $filename, $legenda )
	{
		return isset( $legenda[ $filename ] ) ? $legenda[ $filename ] : '';
	}
	private static function get_li( $filename, $span, $title='', $maxLargura=100 )
	{
		$style='';
		$miniatura = self::getThumb( $filename );
		$imagem = ( $miniatura ) ? $miniatura : basename( $filename );
		list( $largura, $altura ) = getimagesize( $imagem );

		self::$grandes[] = '<img src="'.$filename.'" title="'.$title.'" alt="" />';
		$style = ( $maxLargura<200 ) ? self::mini( $largura, $altura ) : $style;
		return '<li><a href="'.$filename.'" title="'.$title.'"><img src="'.$imagem.'" alt=""'.$style.' /></a>'.$span.'</li>'."\n";
	}
	private static function span( $filename, $title, $capa, $acao )
	{
		$del = '<span><a href="../inc/deletar.php?id='.$filename.'" class="no-light">Deletar</a></span>
			<p><input type="hidden" name="foto[]" value="'.basename($filename).'" /><input type="text" name="legenda[]" value="'.$title.'" /></p>';

		//$save = '<span><a href="inc/dwn_img.php?file='.$diretorio.$arq.'" class="no-light" />Clique aqui p/ salvar</a></span>';

		return ( $acao ) ? $del : '';
	}
	public static function getThumb( $file )
	{
		$ext = getExt( $file );
		$nome = str_replace( $ext, '', $file ).'_p'.$ext;

		return is_file( $nome ) ? $nome : false;
	}
	public static function mini( $largura, $altura )
	{
		$tal = ' style="height: 100px; width: '.(($largura/$altura)*100).'px; display: block;"';
		$height = ( $largura<150 ) ? $tal : '';//$largura<200 caso queria para 200px de largura

		return ( $height ) ? $height : ' width="'.self::$largura.'" ';
	}
	public static function delFotos( $foto )
	{
		$mini = self::getThumb( $foto );

		del_file( $mini );
		del_file( $foto );
	}
}
