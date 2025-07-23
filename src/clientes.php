<?
namespace IsraelNogueira\Asaas;
use Exception;
//######################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ CLIENTES ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//######################################################################################

trait clientes{
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
    //	NOVO CLIENTE
    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function novoCliente($_PARAM=null) {try{
			self::verifyEnv();
			if(empty($_PARAM['name']))										throw new Exception("'name' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['email']))										throw new Exception("'email' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['phone']))										throw new Exception("'phone' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['mobilePhone']))								throw new Exception("'mobilePhone' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['cpfCnpj']))									throw new Exception("'cpfCnpj' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['postalCode']))								throw new Exception("'postalCode' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['postalCode']) && empty($_PARAM['address']))	throw new Exception("'address' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['postalCode']) && empty($_PARAM['province']))	throw new Exception("'province' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['addressNumber']))								throw new Exception("'addressNumber' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['complement']))								throw new Exception("'complement' is null em asaas::novoCliente", 1);
			if(empty($_PARAM['externalReference']))							throw new Exception("'externalReference' is null em asaas::novoCliente", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/customers");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM));		
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RECUPERA CLIENTE
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getCliente($_UID) {try{
			self::verifyEnv();
			if(is_null($_UID)) throw new Exception("UID is null em asaas::getCliente", 1);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/customers/".$_UID);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response,true);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	LISTA CLIENTES ||  name=&email=&cpfCnpj=&groupName=&externalReference=&offset=&limit=
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function listaCliente($_PARAM=null) {try{
				self::verifyEnv();
				$ch = curl_init();
				if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::listaCliente", 1);
				$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
				curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/customers".$_QUERY);		
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array( "access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	UPDATE DO CLIENTE
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function updateCliente($_UID=null, $_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM))	throw new Exception("\$_PARAM is null em asaas::updateCliente", 1);
			if(is_null($_UID))		throw new Exception("\$_UID is null em asaas::updateCliente", 1);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/customers/".$_UID);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM) );
				curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	DELETA CLIENTE
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function deleteCliente($_UID) {try{
			self::verifyEnv();
			if(is_null($_UID)) throw new Exception("Param is null em classe::methodo", 1);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/customers/".$_UID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}


	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	TOKENIZAÇÃO DE CARTÃO DE CRÉDITO (REQUER AUTORIZAÇÃO PELO GERENTE DE CONTAS)
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function cartaoTokenizer($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em classe::methodo", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/creditCard/tokenize");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}




}