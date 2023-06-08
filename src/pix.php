<?
namespace IsraelNogueira\Asaas;
//######################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ PIX ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//######################################################################################

trait pix{
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA UMA TRANSAÇÃO PIX
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getTransactionPIX($_UID=null) {try{
			if(is_null($_UID)) throw new Exception("Param is null em asaas::getTransactionPIX", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/pix/transactions?id=".$_UID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA LISTA DE TRANSAÇÕES PIX  || offset=&limit=&status=&type
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getListTransactionPIX($_PARAM=null) {try{
			if(!is_null($_PARAM) && $_PARAM==[] ) throw new Exception("Param is null em asaas::getListTransactionPIX", 1);
			$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/pix/transactions".$_QUERY);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
    //	NOVAS CHAVES ESTATICAS
    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function novaChavePix($_FILTER=['type'=>'EVP']) {try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/pix/addressKeys");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_FILTER));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

   //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
   //	RETORNA UMA CHAVE PIX
   //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getChavePix($_ID=null) {try{
			if(is_null($_ID)) throw new Exception("ID is null em asaas::getChavePix", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/pix/addressKeys/".$_ID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	LISTA CHAVES PIX ?status=&statusList=&offset=&limit=
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function listaChavesPix($_PARAM=null) {try{
			$ch = curl_init();
			if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::listaChavesPix", 1);
			$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/pix/addressKeys");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	DELETA UMA CHAVE PIX
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function deleteChavePix($_ID=null) {try{
			if(is_null($_ID)) throw new Exception("ID is null em asaas::deleteChavePix", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/pix/addressKeys/".$_ID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
    //	CRIA UM QR CODE ESTATICO
    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function qrStatic($_PARAM=[]) {try{
			if(empty($_PARAM['addressKey']))    throw new Exception("'addressKey' is null em asaas::qrStatic", 1);
			if(empty($_PARAM['description']))   throw new Exception("'description' is null em asaas::qrStatic", 1);
			if(empty($_PARAM['value']))         throw new Exception("'value' is null em asaas::qrStatic", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/pix/qrCodes/static");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	PLAYLOAD DECODE - TRAZ OS DADOS DE UM PLAYLOAD
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function playloadDecode($_PLAYLOAD=null) {try{
			if(is_null($_PLAYLOAD)) throw new Exception("Param is null em asaas::QRDecode", 1);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/pix/qrCodes/decode");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['payload'=>$_PLAYLOAD]));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	EXECUTA PAGAMENTO DE UM QRCODE
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function qrPay($_PARAM=null) {try{
			if(is_null($_PARAM)) throw new Exception("Param is null em classe::methodo", 1);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/pix/qrCodes/pay");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM) );		
				curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response, true);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}




}