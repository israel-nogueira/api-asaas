<?
namespace IsraelNogueira\Asaas;

use Exception;
//#####################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ CONTA ESCROW ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//#####################################################################################
trait escrow
{
    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
    //	ESTATÍSTICAS DE COBRANÇA
    //	https://docs.asaas.com/reference/salvar-ou-atualizar-configuracao-da-conta-escrow-para-a-subconta
    //ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
    /*
		asaas::ativarEscrow("sub_acc_xxx", [
			"enabled" => true,
			"releaseType" => "MANUAL|AUTOMATIC",
			"releaseDay" => 10, // dia do mês para liberação automática (se releaseType = AUTOMATIC)
			"maxDaysForRelease" => 30 // máximo dias para liberação automática
		]);
	*/
    public static function ativarEscrow($subAccountId, $config = [])
    {
        try {
            self::verifyEnv();
            $url = getEnv(getEnv('ASAAS_AMBIENTE')) . "/v3/accounts/" . $subAccountId . "/escrow";
            $ch  = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST  => "PUT",
                CURLOPT_POSTFIELDS     => json_encode($config),
                CURLOPT_HTTPHEADER     => [
                    "Content-Type: application/json",
                    "access_token: " . getEnv(getEnv('ASAAS_APIKEY')),
                ],
            ]);
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response, true);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

	static public function encerrarEscrow($paymentId){
		try{
			self::verifyEnv();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE'))."/v3/payment/".$paymentId."/close-escrow");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, null);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type: application/json",
				"access_token: " . getEnv(getEnv('ASAAS_APIKEY'))
			));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		}catch(\Throwable $ERROR){
			throw new Exception($ERROR->getMessage());
		}
	}



    public static function novaCobrancaEscrow($_PARAM = [])
    {
        try {
            $_PARAM['escrow'] = true;
            return self::novaCobranca($_PARAM);
        } catch (\Throwable $ERROR) {
            throw new Exception($ERROR->getMessage());
        }
    }

    public static function getEscrowSubConta($subAccountId){
        try {
            self::verifyEnv();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, getEnv(getEnv('ASAAS_AMBIENTE')) . "/v3/accounts/" . $subAccountId . "/escrow");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "access_token: " . getEnv(getEnv('ASAAS_APIKEY')),
            ]);
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response, true);
        } catch (\Throwable $ERROR) {
            throw new Exception($ERROR->getMessage());
        }
    }

}
