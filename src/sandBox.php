<?
namespace IsraelNogueira\Asaas;
use Exception;
//#####################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ CARTÃO DE CREDITO ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//#####################################################################################
trait sandBox{

	static public function confirmPayment($_ID){
		try{
			self::verifyEnv();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE')) . "/v3/sandbox/payment/" . $_ID . "/confirm");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, null); // corpo vazio
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type: application/json",
				"access_token: " . getEnv(getEnv('ASAAS_APIKEY'))
			));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {
			throw new Exception($ERROR->getMessage());
		}
	}

	static public function forcaVencimento($_ID, $_DUE_DATE){
		try{
			self::verifyEnv();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE')) . "/v3/payment/" . $_ID . "/forceDueDate");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
				"dueDate" => $_DUE_DATE
			]));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type: application/json",
				"access_token: " . getEnv(getEnv('ASAAS_APIKEY'))
			));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {
			throw new Exception($ERROR->getMessage());
		}
	}

	static public function pagaPIX($qrCodeId=null){
		try {
			self::verifyEnv();
			if(is_null($qrCodeId)) throw new Exception("qrCodeId não informado");

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE')) . "/v3/sandbox/pix/qrCodes/{$qrCodeId}/pay");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([]));
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				"Content-Type: application/json",
				"access_token: " . getEnv(getEnv('ASAAS_APIKEY'))
			]);
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {
			throw new Exception($ERROR->getMessage());
		}
	}




}