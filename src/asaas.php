<?
namespace IsraelNogueira\Asaas;
use	Exception;
class asaas{
	/*
	|--------------------------------------------------------------------------- 
	|	TRAITS
	|--------------------------------------------------------------------------- 
	*/
		use	admin, assinatura, clientes, cobrancas,
			links, pix, subclientes, subcontas, webhook;

	/*
	|--------------------------------------------------------------------------- 
	|	INICIAMOS A CLASSE INSTANCIANDO AS VARIÁVEIS DE AMBIENTE
	|--------------------------------------------------------------------------- 
	*/
		public function __construct(){
			asaas::configEnv();
		}

	/*
	|--------------------------------------------------------------------------- 
	|	IMPORTAMOS O .ENV
	|--------------------------------------------------------------------------- 
	*/
		static public function configEnv(){
			if(	
				empty(getEnv('ASAAS_NOME_DO_SUPORTE'))	|| 
				empty(getEnv('ASAAS_EMAIL_DO_SUPORTE')) || 
				empty(getEnv('ASAAS_EMAIL_CONTA_PAI'))	|| 
				empty(getEnv('ASAAS_SANDBOX')) 			|| 
				empty(getEnv('ASAAS_APIKEY_SANDBOX'))	|| 
				empty(getEnv('ASAAS_PRODUCAO'))			|| 
				empty(getEnv('ASAAS_APIKEY_PRODUCAO'))	|| 
				empty(getEnv('ASAAS_SENHA_CONTA_PAI'))
			){
				throw new Exception("Está faltando alguma variavel de ambiente");
			}
			return;
		}
}