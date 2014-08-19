<?php
/**
 * @class View
 * @author William Bruno
 * @date 08/09/2010
 */
class View
{
	public function listar_registros( $query )
	{
		$ctrl = getGet('ctrl');
		$ac = getGet('ac');

		$order = getGet('order')!='DESC' ? 'DESC' : 'ASC';

		$html = '<table id="list">';
		$html .= '
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			</thead>
			<tbody>';

		if( $query && $query->num_rows )
		{
			$i=0;
			while( $dados = $query->fetch_object() )
			{
				$class = $i%2==0 ? ' class="dif"' : '';

				$html .= '<tr'.$class.'>
					<td>
						<a href="view/'.$dados->id.'">'.$dados->id.'</a></td>
					<td class="nome">
						<a href="view/'.$dados->id.'">'.$dados->label.'</a></td>
					<td><a href="view/'.$dados->id.'"><img src="/admin/images/action3.gif" alt="editar" title="editar" /></a></td>
					<td><a href="del/'.$dados->id.'"><img src="/admin/images/action4.gif" alt="excluir" title="excluir" /></a></td>
				</tr>';

				$i++;
			}
		}
		else
			$html .=  '<tr><td></td><td colspan="3" class="nome">Nenhum cadastro</td></tr>';

		$html .= '</tbody></table>';
		echo $html;
	}
	public function combobox( $query, $prev=null )
	{
		$option = '';
		while( $dados = $query->fetch_object() )
		{
			$selected = $prev==$dados->id ? ' selected="selectd"' : '';
			$option .= '<option value="'.$dados->id.'"'.$selected.'>'.$dados->label.'</option>';
		}
		return $option;
	}
	public function checkbox( $query, $query_aux, $prev, $identificador )
	{
		$arr = Array();
		if( is_object( $query_aux ) && $query_aux->num_rows )
		{
			//$identificador = "id_parametro";
			while($rel = $query_aux->fetch_object() )
			{
				$arr[] = $rel->$identificador;
			}
		}
		$check = $checked = '';
		while( $dados = $query->fetch_object() )
		{
			$checked = in_array( $dados->id, $arr ) ? ' checked="checked"' : '';
			$check .= "\t\t\t".'<label><input type="checkbox" name="'.$identificador.'[]" value="'.$dados->id.'" '.$checked.'/> '.$dados->label.'</label>'."\n";
		}

		return $check;
	}
	public function form_busca()
	{
		$form = '
			<form action="" method="get" id="f-busca">
				<fieldset class="lado">
					<label><input type="submit" name="ctrl" value="'.getGet('ctrl').'" /></label>
					<label><input type="hidden" name="ac" value="view" /></label>
					<label>Busca: <input type="text" name="q" value="'.getGet('q').'" /></label>
				</fieldset>
			</form>';

		return $form;
	}
	public function colunas( $query, $link, $colunas=3 )
	{
		$qnt = ceil( $query->num_rows/$colunas );
		$sub = new SubCategoria( 'subcategoria' );

		$li = '<ul class="cols">';
		if( $query->num_rows )
		{
			$coluna = 1;
			while( $dados = $query->fetch_object() )
			{
				$last = ( $coluna%$colunas==0 ) ? ' class="ultima"' : '';

				$li .= '<li'.$last.'><h2>'.getLink( $dados->id, $dados->label, $link ).'</h2>';
				$li .= '<p>'.$sub->byCat( $dados->id, 7 ).'</p>';

				$li .= '</li>'."\n";
				$coluna++;
			}
		}
		else
			$li .= '<li>Nenhum registro encontrado!</li></ul><!-- /coluna -->';
		return $li.'</ul><!-- /coluna -->';
	}
}
