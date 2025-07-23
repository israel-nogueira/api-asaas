<?
namespace IsraelNogueira\Asaas;
use	Exception;
class asaas{
	/*
	|--------------------------------------------------------------------------- 
	|	TRAITS
	
	|--------------------------------------------------------------------------- 
	*/
		use	admin, assinatura, clientes, cobrancas ,cartao,escrow,
			links, pix, subclientes, subcontas, webhook;

	/*
	|--------------------------------------------------------------------------- 
	|	IMPORTAMOS O .ENV
	|--------------------------------------------------------------------------- 
	*/
	
		static public function verifyEnv(){
			if(empty(getEnv('ASAAS_NOME_DO_SUPORTE')))	{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_NOME_DO_SUPORTE\"",1); }
			if(empty(getEnv('ASAAS_EMAIL_DO_SUPORTE')))	{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_EMAIL_DO_SUPORTE\"",1); }
			if(empty(getEnv('ASAAS_EMAIL_CONTA_PAI')))	{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_EMAIL_CONTA_PAI\"",1); }
			if(empty(getEnv('ASAAS_SANDBOX')))			{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_SANDBOX\"",1); }
			if(empty(getEnv('ASAAS_APIKEY_SANDBOX')))	{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_APIKEY_SANDBOX\"",1); }
			if(empty(getEnv('ASAAS_PRODUCAO')))			{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_PRODUCAO\"",1); }
			if(empty(getEnv('ASAAS_APIKEY_PRODUCAO')))	{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_APIKEY_PRODUCAO\"",1); }
			if(empty(getEnv('ASAAS_SENHA_CONTA_PAI')))	{throw new Exception("Está faltando a variavel de ambiente \"ASAAS_SENHA_CONTA_PAI\"",1); }		
		}
}