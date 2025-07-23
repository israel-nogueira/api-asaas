<?
namespace IsraelNogueira\Asaas;
use Exception;
//#####################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ COBRANÇAS ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//#####################################################################################


trait cartao{

		//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		//	NOVA COBRANÇA
		//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function tokenizeCreditCard(array $_PARAM = []) {
			try {
				self::verifyEnv();
				$url = getEnv(getEnv('ASAAS_AMBIENTE')) . "/v3/creditCard/tokenizeCreditCard";
				$headers = [ "Content-Type: application/json", "access_token: " . getEnv(getEnv('ASAAS_APIKEY')) ];
				$ch = curl_init($url);
				curl_setopt_array($ch, [
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => json_encode($_PARAM),
					CURLOPT_HTTPHEADER => $headers
				]);

				$response = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				$data = json_decode($response, true);
				if ($httpCode >= 400) { throw new Exception("Erro Asaas: " . ($data['errors'][0]['description'] ?? 'Erro desconhecido')); }
				return $data;
	} catch (\Throwable $e) {
		throw new Exception($e->getMessage());
	}
}


		//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		//	TRANSFERENCIA
		//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function transferEntreContas($_wallet=null,$_valor=0) {try{
			self::verifyEnv();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/transfers");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["value"=> $_valor,"walletId"=> $_wallet]));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

		//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		//	TRANSFERENCIA
		//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function transferParaFora($_DATA=[]) {try{
			self::verifyEnv();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/transfers");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
						"value"=> $_DATA['valor'],
						"bankAccount"=> [
							"bank"=> [
								"code"=> $_DATA['codeBank']
							],
							"accountName"=> $_DATA['nomeDaConta'],
							"ownerName"=> $_DATA['nomeTitular'],
							"ownerBirthDate"=> $_DATA['dataNascimento'],
							"cpfCnpj"=> $_DATA['cpf'],
							"agency"=> $_DATA['agencia'],
							"account"=> $_DATA['conta'],
							"accountDigit"=> $_DATA['digito'],
							"bankAccountType"=>$_DATA['tipoConta'],// CONTA_CORRENTE | CONTA_POUPANCA
						],
						"operationType"=>$_DATA['tipo_operacao'], // PIX | TED | INTERNAL
						"scheduleDate"=> $_DATA['agendado'], // Para transferências via Pix agendadas, caso não informado o pagamento é instantâneo
						"description"=> $_DATA['descricao']//Transferências via Pix permitem descrição
				]));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}




}