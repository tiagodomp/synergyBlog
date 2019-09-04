<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	/**
	 * Verifica se o caminho Json existe na tabela.
	 * @param string $Tb
	 * @param string $where
	 * @param string $collumn
	 * @param string $pathJson
	 * @return bool
	 */
	protected function validarPathJson(string $Tb, array $where, string $collumn, string $pathjson)
	{
		$conditions	= $this->geradorWhereString($where)[0];
		$pathValido = $this->query("SELECT JSON_CONTAINS_PATH(".$collumn.",'one','".$pathjson."') AS retorno FROM ".$Tb." WHERE ".$conditions." limit 1")[0][0];
		//Se existir
		return (!empty($pathValido) && $pathValido['retorno'] == 1)? true : false;
	}

	/**
	 * Método que busca dados dentro de uma coluna JSON
	 *
     * @param string $Tb            | Tabela de consulta
     * @param string $column        | Coluna json consulta e extração
     * @param string $pathResponse  | Caminho json da resposta
     * @param string $pathSearch    | Caminho json da validação
     * @param string $oneOrAll      | one OR all
     * @param mixed  $query         | valor de busca
     * @return object $query
     */
    public static function searchJson(string $Tb, string $column, string $whereRaw, string $pathResponse, string $pathSearch, string $oneOrAll = 'one', $query)
    {
        $response = DB::table($Tb)
                    ->whereRaw($whereRaw)//$column."->'".$pathResponse."'"." is not null")
                    ->selectRaw(
                        "JSON_EXTRACT(
                            ".$column."->'".$pathResponse."',
                            JSON_UNQUOTE(
                                JSON_SEARCH(
                                    ".$column."->'".$pathSearch."',
                                    '".$oneOrAll."',
                                    '".$query."'
                                )
                            )
                        ) AS data"
                    )
                    ->get();
        return $response;
    }

	/**
	 * Atualiza parcialmente ou insere caso não exista dados em uma coluna json
	 * @param string $Tb
	 * @param string $collumn
	 * @param array $where
	 * @param string $path
	 * @param array $data
	 * @return bool true || false
	 */
	protected function atualizarJson(string $Tb, string $collumn, array $where, string $path, $data)
	{
		$whereString = $this->geradorWhereString($where)[0];
		if($this->salvarRotaJson($Tb, $collumn, $where, $path)){
			exit;
			$data 		= (is_string($data) || is_int($data))? $this->utf8_ansi($data): "CAST('".$this->utf8_ansi(json_encode($data))."' AS JSON)";
			$sql     	= (string) "JSON_UNQUOTE(JSON_SET(".$collumn.", '".$path."', $data))";
			$up		 	= $this->query('update '.$Tb.' set '.$collumn.' = '.$sql.', modified = "'.gmdate('Y-m-d H:i:s').'" where '.$whereString);

			return $up == 1;
		}
		return false;
	}
	/**
	 * De forma recursiva insere ou atualiza no banco um caminho json
	 * @param string $Tb 		| Tabela
	 * @param string $collumn 	| Coluna que deseja afetar
	 * @param array  $where		| Condições de busca [campo => value]
	 * @param string $path 		| Caminho em forma de $.dot.json
	 * @param string $pathJson 	| Não deve ser passado nenhum valor para este parametro, pois ele é dependente da recursividade
	 * @return bool
	 */
	private function salvarRotaJson(string $Tb, string $collumn, array $where, string $path, string $pathJson = '')
	{
		$whereString = $this->geradorWhereString($where)[0];

		//obtém um vetor a partir do caminho cedido
		$vetorOrigem = (array) $this->str_explode($path, ['.', '$', '\'' ]);
		$countOrigem = (int) count($vetorOrigem);

		//obtem um vetor a partir do caminho que esta sendo salvo no banco
		$vetorLocal = (array) $this->str_explode($pathJson, ['.', '$', '\'' ]);
		$countLocal = (int) count($vetorLocal);

		//facilitar na validação abaixo
		$pathLocal = (string) ($pathJson != '')?$pathJson:'$';
		$pathQuery = (string) ($countLocal == 0)?$path:$pathLocal;

		//Verifico se este caminho json existe no BD
		$pathValido = $this->validarPathJson($Tb, $where, $collumn, $path);

	//Se existir
		if($pathValido){
			if($countLocal == 0 || $countLocal == $countOrigem){
				return true;
			}else{
				$pathLocal .= '.'.$vetorOrigem[$countLocal];
				//dd(2,$Tb, $lojaId, $apiId, $collumn, $path, $pathLocal);
				return $this->salvarRotaJson($Tb,  $collumn, $where, $path, $pathLocal);
			}
		//Se for o primeiro campo e ele não existir no banco
		}elseif($countLocal == 1){
			//dd(2,$Tb, $lojaId, $apiId, $collumn, $path, $pathLocal);
			$sql = (string) "JSON_UNQUOTE(JSON_SET(".$collumn.", '".$pathLocal."', CAST('{}' AS JSON)))";
			$this->query('update '.$Tb.' set '.$collumn.' = '.$sql.' where  '.$whereString);
			return $this->salvarRotaJson($Tb, $collumn, $where, $path, $pathLocal);
		//Em quanto o $path tiver campos.
		}else{
			if($countLocal == 0){
				$pathLocal .= '.'.$vetorOrigem[$countLocal];
				//dd(1,$Tb, $lojaId, $apiId, $collumn, $path, $pathLocal);
				return $this->salvarRotaJson($Tb, $collumn, $where, $path, $pathLocal);
			}
			$sql = (string) "JSON_UNQUOTE(JSON_SET(".$collumn.", '".$pathLocal."', CAST('{}' AS JSON)))";
			$this->query('update '.$Tb.' set '.$collumn.' = '.$sql.' where '.$whereString);
			if($countLocal < $countOrigem){
				$pathLocal .= '.'. $vetorOrigem[$countLocal];
			}
			//dd(4,$Tb, $lojaId, $apiId, $collumn, $path, $pathLocal);
			return $this->salvarRotaJson($Tb,  $collumn, $where, $path, $pathLocal);
		}
	}

	/**
	 * Retorna um array simples contendo cada palavra separada pelos caracteres especificados no array
	 * @param string $data      | string para explode
	 * @param array $retirar    | Vetor com todos os caracteres que serão retirados
	 * @return array $retorno   | Vetor contendo o resultado
	 */
	public function str_explode(string $data, array $retirar = [])
	{
		$retirar = (array) ($retirar)?:array('"',',',' ', '[',']','\\', '/');
		$substituir = str_replace($retirar, $retirar[0], $data);
		$explode = explode($retirar[0], $substituir);
		return $this->array_divide(array_filter($explode))[1];
	}

	/**
	* retorna a versão em string para executar um where
	* @param array $where - [campo => value]
	* @param bool $valueInArray
	* @return array [whereStringComValue, value] || [whereStringCom?, value]
	*/
	public function geradorWhereString(array $where, bool $valueInArray = true)
	{
		$where = $this->array_divide($where);
		$whereString = '';
		foreach($where[0] as $key=>$value){
			$whereString = ($valueInArray)?$value." = '".$where[1][$key]. "'": $value. ' = ?';
		}
		return [$whereString, $where[1]];
	}

	/**
	* Retorna um array onde no campo 0 esta todas as chaves e no campo 1 todos os valores
	* @param array $where - [campo => value]
	* @return array [0 => keys, 1 => values]
	*/
	public function array_divide(array $array){
		return[
			array_keys($array),
			array_values($array),
		];
	}

	 /**
     * Gero um path-dot Json respectivo ao conteúdo do array
     * @param array $data
     * @param string $iterador
     * @return string $.chave1.valor1.iterador
     */
    protected function pathDotJson(array $data, string $iterador = null)
    {
        //primeira chave
        $chave  = array_key_first($data);
        //primeiro valor
        $valor   = array_values($data)[0];

        $r = (string) (!is_null($iterador))?'"'.$chave.'"."'.$valor.'"."'.$iterador.'"' : '"'. $chave.'"."'.$valor.'"';

        return $r;
    }

	 /**
     * Converte os caracteres de latim/ansi para utf-8
     * @param string $valor
     * @return string
     */
    public function utf8_ansi(string $valor='') {

        $model = array(
        "\u00c0" =>"À",
        "\u00c1" =>"Á",
        "\u00c2" =>"Â",
        "\u00c3" =>"Ã",
        "\u00c4" =>"Ä",
        "\u00c5" =>"Å",
        "\u00c6" =>"Æ",
        "\u00c7" =>"Ç",
        "\u00c8" =>"È",
        "\u00c9" =>"É",
        "\u00ca" =>"Ê",
        "\u00cb" =>"Ë",
        "\u00cc" =>"Ì",
        "\u00cd" =>"Í",
        "\u00ce" =>"Î",
        "\u00cf" =>"Ï",
        "\u00d1" =>"Ñ",
        "\u00d2" =>"Ò",
        "\u00d3" =>"Ó",
        "\u00d4" =>"Ô",
        "\u00d5" =>"Õ",
        "\u00d6" =>"Ö",
        "\u00d8" =>"Ø",
        "\u00d9" =>"Ù",
        "\u00da" =>"Ú",
        "\u00db" =>"Û",
        "\u00dc" =>"Ü",
        "\u00dd" =>"Ý",
        "\u00df" =>"ß",
        "\u00e0" =>"à",
        "\u00e1" =>"á",
        "\u00e2" =>"â",
        "\u00e3" =>"ã",
        "\u00e4" =>"ä",
        "\u00e5" =>"å",
        "\u00e6" =>"æ",
        "\u00e7" =>"ç",
        "\u00e8" =>"è",
        "\u00e9" =>"é",
        "\u00ea" =>"ê",
        "\u00eb" =>"ë",
        "\u00ec" =>"ì",
        "\u00ed" =>"í",
        "\u00ee" =>"î",
        "\u00ef" =>"ï",
        "\u00f0" =>"ð",
        "\u00f1" =>"ñ",
        "\u00f2" =>"ò",
        "\u00f3" =>"ó",
        "\u00f4" =>"ô",
        "\u00f5" =>"õ",
        "\u00f6" =>"ö",
        "\u00f8" =>"ø",
        "\u00f9" =>"ù",
        "\u00fa" =>"ú",
        "\u00fb" =>"û",
        "\u00fc" =>"ü",
        "\u00fd" =>"ý",
        "\u00ff" =>"ÿ");

        return strtr($valor, $model);
    }
}
