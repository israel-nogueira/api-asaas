<?

namespace IsraelNogueira\Asaas;

trait admin{

    //######################################################################################
    //⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ ADMIN ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
    //######################################################################################

	/*
    |------------------------------------------------------------
	|	PERSONALIZAÇÃO DO LINK
	|------------------------------------------------------------
    */
		static public function setThemeLink($_PARAM=null) {try{
			self::verifyEnv();
			$ch = curl_init();
			if(isset($_PARAM['logoFile']) && $_PARAM['logoFile']!="" && file_exists($_PARAM['logoFile'])){
				$_CURLFile = curl_file_create($_PARAM['logoFile'], mime_content_type($_PARAM['logoFile']), basename($_PARAM['logoFile']));
				$_PARAM['logoFile'] = $_CURLFile;
			}
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/myAccount/paymentCheckoutConfig/");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	/*
    |------------------------------------------------------------
	|	RETORNA A PERSONALIZAÇÃO DO LINK
	|------------------------------------------------------------
    */
		static public function getThemeLink() {try{
			self::verifyEnv();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/myAccount/paymentCheckoutConfig/");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	/*
    |------------------------------------------------------------
	|	AMBIENTE & API KEY
	|------------------------------------------------------------
    */
		static public function setApiKey($API) {try{
            putenv('APIKEY='.$API);
			return new static();
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

		static public function dev() {try{
            putenv('ASAAS_AMBIENTE='.getEnv('ASAAS_SANDBOX'));
			return new static();
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}
		
		static public function prod() {try{
            putenv('ASAAS_AMBIENTE='.getEnv('ASAAS_PRODUCAO'));
			return new static();
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}




}