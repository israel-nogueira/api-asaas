<?
namespace IsraelNogueira\Asaas;
//######################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ CONTAS E SUB CLIENTES ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//######################################################################################

trait subclientes{
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA A WALLET DA CONTA
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	static public function getWallet() {try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/wallets");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA O NUMERO DE CONTA
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getNumeroConta() {try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/myAccount/accountNumber/");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA DADOS COMERCIAIS
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getDadosComerciais() {try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/myAccount/commercialInfo");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	ALTERA DADOS COMERCIAIS
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function setDadosComerciais($_PARAM=null) {try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/myAccount/commercialInfo");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($_PARAM));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA O SALDO
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getSaldo() {try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, getEnv('ASAAS_AMBIENTE')."/api/v3/finance/balance");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	EXTRATO FINANCEIRO  ?startDate=&finishDate=&limit=&offset=
	//	https://asaasv3.docs.apiary.io/#reference/0/extrato/recuperar-extrato
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function extratoFinanceiro($_PARAM=null) {try{
			$ch = curl_init();
			if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::extratoFinanceiro", 1);
			$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
			curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/financialTransactions".$_QUERY);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA OS VALORES DE UM SPLIT
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getTotalSplits() {try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/finance/split/statistics");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	ESTATÍSTICAS DE COBRANÇA
	//	https://asaasv3.docs.apiary.io/#reference/0/informacoes-financeiras/estatisticas-de-cobrancas
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function estatisticasDeCobrancas($_PARAM=null) {try{
			$ch = curl_init();
			if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::extratoFinanceiro", 1);
			$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";
			curl_setopt($ch, CURLOPT_URL,getEnv('ASAAS_AMBIENTE')."/api/v3/finance/payment/statistics".$_QUERY);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv('APIKEY')));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response,true);
		} catch (\Throwable $ERROR) {die($ERROR->getMessage());}}



}