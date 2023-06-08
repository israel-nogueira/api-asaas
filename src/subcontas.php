<?
namespace IsraelNogueira\Asaas;
use Exception;
//######################################################################################
//⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮ SUBCONTAS ⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮⋮
//######################################################################################

trait subcontas{

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	NOVA SUBCONTA
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function novaSubConta($_PARAM=null) {try{
			self::verifyEnv();
			if(is_null($_PARAM)) throw new Exception("Param is null em asaas::novaSubConta", 1);
			//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/accounts");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_PARAM));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
				$response = curl_exec($ch);
				curl_close($ch);
				return json_decode($response, true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	LISTAR SUBCONTAS  ?cpfCnpj=&email=&name=&walletId=&offset=&limit=
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function listaSubContas($_PARAM=null) {try{
			self::verifyEnv();
			if(!is_null($_PARAM) && $_PARAM==[] ) 	throw new Exception("PARAMETROS DE PESQUISA INEXISTENTES OU INVÁLIDOS em asaas::listaSubContas", 1);
			$_QUERY = (!is_null($_PARAM)) ? "?".http_build_query($_PARAM):"";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/accounts".$_QUERY);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA UM SUBCONTA
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function getSubConta($_ID=null) {try{
			self::verifyEnv();
			if(is_null($_ID)) throw new Exception("Param is null em classe::methodo", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/accounts?id=$_ID");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY'))));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}


	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	RETORNA UM SUBCONTA
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function redefineApiKey($_ID=null) {try{
			self::verifyEnv();
			if(is_null($_ID)) throw new Exception("Param is null em classe::methodo", 1);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,getEnv(getEnv('ASAAS_AMBIENTE'))."/api/v3/accounts/redefineApiKey");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "access_token:" . getEnv(getEnv('ASAAS_APIKEY')) ));
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['id'=>$_ID,'email'=>getEnv('ASAAS_EMAIL_CONTA_PAI'),'password'=>getEnv('ASAAS_SENHA_CONTA_PAI')]));
			$response = curl_exec($ch);
			curl_close($ch);
			return json_decode($response, true);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}

	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
	//	SOLICITA REDEFINIÇÃO
	//ˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑˑ
		static public function solicitaAtualizaApiKey() {try{
			self::verifyEnv();
			return email::sendGrid([
				'ASSUNTO'=>'🔑 Atualização de APIKEY SUB CONTAS',
				'MENSAGEM'=>'Oi '.getEnv('ASAAS_NOME_DO_SUPORTE').' tudo bem?<br>
				Gostariamos de solicitar a liberação do endpoint de atualização da <b>APIKEY</b> de nossas <b>SUB_CONTAS</b>;<br><br>

				Email da conta pai é: <b>'.getEnv('ASAAS_EMAIL_CONTA_PAI').'</b><br>
				Ambiente atual é: <b>'.getEnv(getEnv('ASAAS_AMBIENTE')).'</b><br><br>

				Essa mensagem foi enviada pelo painel administrativo, sendo o email do sistema;<br>
				Então se possível, para confirmar a liberação da API responda nesse email: <b>'.getEnv('ASAAS_EMAIL_CONTA_PAI').'</b>,<br><br>
				<br><br>Muito obrigado!',
				'NOME'=>getEnv('ASAAS_NOME_DO_SUPORTE'),
				'DESTINO'=>getEnv('ASAAS_EMAIL_DO_SUPORTE'),
			]);
		} catch (\Throwable $ERROR) {throw new Exception($ERROR->getMessage());}}
}