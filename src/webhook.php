<?
namespace IsraelNogueira\Asaas;
use Exception;
//######################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ WEBHOOKS ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//######################################################################################

trait webhook{

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVO WEBHOOK - Padrão de função
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setWebhook($_PATH=null, $_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PATH)) throw new Exception("PATH is null em asaas::setWebhook", 1);
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::setWebhook", 1);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/".$_PATH);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVO WEBHOOK PARA COBRANÇAS
	//	Cria ou atualiza a configuração de webhook para notificações de cobranças
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ

		static public function setWebhookCobranca($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::setWebhookCobranca", 1);
			return self::setWebhook('webhook', $_PARAM);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVO WEBHOOK NOTA FISCAIS
	//	Cria ou atualiza a configuração de webhook para notificações de notas fiscais
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setWebhookNotaFiscal($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::setWebhookNotaFiscal", 1);
			return self::setWebhook('webhook/invoice', $_PARAM);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVO WEBHOOK TRANSFERENCIAS
	//	Cria ou atualiza a configuração de webhook para transferências bancárias e entre contas Asaas
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setWebhookTransfer($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::setWebhookTransfer", 1);
			return self::setWebhook('webhook/transfer', $_PARAM);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVO WEBHOOK PARA PAGUE CONTAS
	//	Cria ou atualiza a configuração de webhook para notificações de pague contas.
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setWebhookContas($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::setWebhookContas", 1);
			return self::setWebhook('webhook/bill', $_PARAM);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVO WEBHOOK PARA ANTECIPAÇÕES
	//	Cria ou atualiza a configuração de webhook para notificações de antecipações.
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setWebhookAntecipacao($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::setWebhookAntecipacao", 1);
			return self::setWebhook('webhook/anticipation', $_PARAM);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVO WEBHOOK PARA RECARGAS DE CELULAR
	//	Cria ou atualiza a configuração de webhook para notificações de recarga de celular.
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setWebhookRecargaCelular($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::setWebhookRecargaCelular", 1);
			return self::setWebhook('webhook/mobilePhoneRecharge', $_PARAM);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA WEBHOOK - PADRÃO DE BUSCA
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getWebhook($PATH) {try{
			self::verifyEnv();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/".$PATH);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA WEBHOOK DE COBRANÇA
	//	Busca a configuração de webhook para notificações de cobranças
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getWebhookCobranca() {try{
			self::verifyEnv();
			return self::getWebhook('webhook');
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA WEBHOOK PARA NOTAS FISCAIS
	//	Busca a configuração de webhook para notificações de notas fiscais
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getWebhookNotaFiscal() {try{
			self::verifyEnv();
			return self::getWebhook('webhook/invoice');
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA WEBHOOK PARA TRANSFERÊNCIAS
	//	Busca a configuração de webhook para notificações de transferências bancárias e entre contas Asaas.
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getWebhookTransfer() {try{
			self::verifyEnv();
			return self::getWebhook('webhook/transfer');
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA WEBHOOK PARA PAGUE CONTAS
	//	Busca a configuração de webhook para notificações de pague contas
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getWebhookContas() {try{
			self::verifyEnv();
			return self::getWebhook('webhook/bill');
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA WEBHOOK DE ANTECIPAÇÕES
	//	Busca a configuração de webhook para notificações de antecipações
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getWebhookAntecipacao() {try{
			self::verifyEnv();
			return self::getWebhook('webhook/anticipation');
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA WEBHOOK PARA RECARGAS DE CELULAR
	//	Busca a configuração de webhook para notificações de recarga de celular
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getWebhookRecargaCelular() {try{
			self::verifyEnv();
			return self::getWebhook('webhook/mobilePhoneRecharge');
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}



}