<?
namespace IsraelNogueira\Asaas;

//#####################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ ASSINATURAS ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//#####################################################################################

trait assinatura{

	/*
	|---------------------------------------------------------------------------
	|	NOVA ASSINATURA
	|---------------------------------------------------------------------------
	*/
		static public function novaAssinatura($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("PARAM is null em asaas::novaAssinatura", 1);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/subscriptions");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM) );
				curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	/*
	|---------------------------------------------------------------------------
	|	RETORNA UMA ASSINATURA
	|---------------------------------------------------------------------------
	*/
		static public function getAssinatura($_ID=null) {try{
			self::verifyEnv();
			if(is_null($_ID)) throw new Exception("ID is null em classe::methodo", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/subscriptions/$_ID");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}
	
	/*
	|---------------------------------------------------------------------------
	|	LISTA ASSINATURAS  // ?customer=&billingType=&offset=&limit=&includeDeleted=&externalReference=
	|---------------------------------------------------------------------------
	*/
		static public function listaAssinaturas($_PARAM=null) {try{
			self::verifyEnv();
			if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::listaAssinaturas", 1);
			$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/subscriptions".$_QUERY);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array("access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	/*
	|---------------------------------------------------------------------------
	|	LISTA COBRANÇAS DE UMA ASSINATURA
	|---------------------------------------------------------------------------
	*/
		static public function listaCobrancaAssinatura($_ID=null) {try{
			self::verifyEnv();
			if(is_null($_ID)) throw new Exception("_ID is null em asaas::listaCobrancaAssinatura", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/subscriptions/$_ID/payments");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	/*
	|---------------------------------------------------------------------------
	|	GERAR CARNÊ DE ASSINATURA ?month=&year=&sort=&order=
	|---------------------------------------------------------------------------
	*/
		static public function getCarneAssinatura($_ID=null,$_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_ID)) throw new Exception("Param is null em classe::methodo", 1);
			if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::listaAssinaturas", 1);
			$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/subscriptions/".$_ID."/paymentBook".$_QUERY);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array("access_token:".getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	/*
	|---------------------------------------------------------------------------
	|	ATUALIZA UMA ASSINATURA
	|---------------------------------------------------------------------------
	*/
		static public function updateAssinatura($_ID=null,$_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_ID))		throw new Exception("ID is null em asaas::updateAssinatura", 1);
			if(is_null($_PARAM))	throw new Exception("Param is null em asaas::updateAssinatura", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/subscriptions/".$_ID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_PARAM));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	/*
	|---------------------------------------------------------------------------
	|	DELETA UMA ASSINATURA
	|---------------------------------------------------------------------------
	*/
		static public function deleteAssinatura($_ID=null) {try{
			self::verifyEnv();
			if(is_null($_ID)) throw new Exception("ID is null em asaas::deleteAssinatura", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/subscriptions/$_ID");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);

		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}



}