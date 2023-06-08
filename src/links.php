<?
namespace IsraelNogueira\Asaas;


//######################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ LINKS DE PAGAMENTO ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//######################################################################################

trait links{

   
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	LINK DE PAGAMENTOS
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function novoLink($_PARAM=null) {try{
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::novoLink", 1);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_PARAM));
				curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA UM LINK DE PAGAMENTO
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getLink($_UID=null) {try{
			if(is_null($_UID)) throw new Exception("UID is null em asaas::getLink", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/".$_UID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	UPDATE LINK
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function updateLink($_UID=null,$_PARAM=null) {try{
			if(is_null($_UID))		throw new Exception("UID is null em asaas::updateLink", 1);
			if(is_null($_PARAM))	throw new Exception("PARAM is null em asaas::updateLink", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/".$_UID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_PARAM));
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	LISTA LINKS  ?active=&includeDeleted=&name=&offset=&limit=
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function listaLinks($_PARAM=null) {try{
			if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::listaLinks", 1);
				$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks".$_QUERY);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("access_token:" . getEnv('APIKEY')));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	DELETA LINK DE PAGAMENTO
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function deleteLink($_UID) {try{
			if(is_null($_UID)) throw new Exception("UID is null em asaas::deleteLink", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/".$_UID);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RESTAURA UM LINK EXCLUIDO
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function restauraLink($_UID) {try{
			if(is_null($_UID)) throw new Exception("UID is null em asaas::restauraLink", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/$_UID/restore");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array( "Content-Type: application/json","access_token:".getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	INSERE IMAGEM NO LINK
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function insertImageLink($_UID=null,$_IMG=null) {try{
			if(is_null($_UID)) throw new Exception("UID is null em asaas::insertImageLink", 1);
			if(is_null($_IMG)) throw new Exception("IMG is null em asaas::insertImageLink", 1);
			$_CURLFile = curl_file_create($_IMG, mime_content_type($_IMG), basename($_IMG));
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/".$_UID."/images");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch,CURLOPT_ENCODING , '');
			curl_setopt($ch,CURLOPT_MAXREDIRS , 10);
			curl_setopt($ch,CURLOPT_TIMEOUT , 0);
			curl_setopt($ch,CURLOPT_FOLLOWLOCATION , true);
			curl_setopt($ch,CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
			curl_setopt($ch,CURLOPT_POSTFIELDS , array('main' => 'true', 'image' => $_CURLFile));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data","access_token:".getEnv('APIKEY')));	
			$response = curl_exec($ch);
			curl_close($ch);
			if (curl_errno($ch)) {
				$error_msg = curl_error($ch);
				throw new \Exception($error_msg);
			}
			return json_decode($response, true);

		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}	

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RECUPERA UMA IMAGEM DE UM LINK 
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getImageLink($paymentLinkId=null,$imageId=null) {try{
			if(is_null($paymentLinkId)) throw new Exception("LINK_ID is null em asaas::getImageLink", 1);
			if(is_null($imageId)) throw new Exception("IMG_ID is null em asaas::getImageLink", 1);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/$paymentLinkId/images/$imageId");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data","access_token:".getEnv('APIKEY')));	
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	LISTA IMAGENS DE UM LINK
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function listaImgLink($_ID=null) {try{
			if(is_null($_ID)) throw new Exception("Param is null em asaas::listaImgLink", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/".$_ID."/images");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}


	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//    EXCLUII UMA IMAGEM DE UM LINK
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function deleteImgLink($_ID=null) {try{
			if(is_null($_ID)) throw new Exception("Param is null em asaas::deleteImgLink", 1);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/".$_ID."/images");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data","access_token:".getEnv('APIKEY')));	
				$response = curl_exec($ch);
				curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	DEFINE COMO PRINCIPAL UMA IMAGEM DE UM LINK
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setPrincipalImgLink($ID_LINK=null,$_ID=null) {try{
			if(is_null($ID_LINK)) throw new Exception("ID_LINK is null em asaas::setPrincipalImgLink", 1);
			if(is_null($_ID)) throw new Exception("ID is null em asaas::setPrincipalImgLink", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/paymentLinks/$ID_LINK/images/$_ID/setAsMain");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data","access_token:".getEnv('APIKEY')));	
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}
}