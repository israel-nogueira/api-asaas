<p align="center">
    <img src="https://github.com/israel-nogueira/api-asaas/blob/47408bfa966f5f070078a9f9ad790526ed708efc/src/top_readme.png"/>
</p>

<p align="center">
    <a href="#instalação" target="_Self">Instalação</a> |
    <a href="#gerando-uma-nova-cobrança" target="_Self">Cobranças</a><br>
    <a href="#atualização-cadastral" target="_Self">Atualização Cadastral</a> |
    <a href="#sub-clientes" target="_Self">Sub clientes</a> |
    <a href="#sub-contas" target="_Self">Sub contas</a> |
    <a href="#assinatura" target="_Self">Assinatura</a> 
    <!-- |
    <a href="#paleta-de-cores" target="_Self">Links de cobrança</a> |
    <a href="#cor-predominante-de-uma-imagem" target="_Self">PIX</a> |
    <a href="#placeholder-blur-de-uma-imagem" target="_Self">Sub Contas</a> |
    <a href="#processa-uma-imagem" target="_Self"> WebHook</a> -->
</p>
<p align="center">
    <a href="https://packagist.org/packages/israel-nogueira/asaas">
        <img src="https://poser.pugx.org/israel-nogueira/asaas/v/stable.svg">
    </a>
    <a href="https://packagist.org/packages/israel-nogueira/asaas"><img src="https://poser.pugx.org/israel-nogueira/asaas/downloads"></a>
    <a href="https://packagist.org/packages/israel-nogueira/asaas"><img src="https://poser.pugx.org/israel-nogueira/asaas/license.svg"></a>
</p>

<p align="center">
    Esta é uma classe super simples dos serviços ASAAS.<br>
    Sem fru-fru, apenas o que realmente é útil em um sistema/website.<br/>
</p>



## Instalação

Instale via composer.

```plaintext
    composer require israel-nogueira/asaas
```

Crie um arquivo **NA RAIZ** do projeto ``var/www/html/.env`` e coloque as seguintes informações:
```env

    # E-mail da pessoa responsável pelo seu suporte ASAAS 
    ASAAS_NOME_DO_SUPORTE=Leticia Schmitt
    ASAAS_EMAIL_DO_SUPORTE=leticia.schmitt.rocha@asaas.intercom-mail.com

    # Aqui são os dados de acesso da sua conta principal do ASAAS
    ASAAS_EMAIL_CONTA_PAI=exemplo@gmail.com
    ASAAS_SENHA_CONTA_PAI=minha-senha-123

    ASAAS_SANDBOX="https://sandbox.asaas.com"
    ASAAS_PRODUCAO="https://www.asaas.com"

    ASAAS_APIKEY_SANDBOX="___APIKEY___"
    ASAAS_APIKEY_PRODUCAO="___APIKEY___"

    # É aqui que você vai habilitar o ambiente de produção ou teste
    ASAAS_AMBIENTE=ASAAS_SANDBOX  # ASAAS_SANDBOX | ASAAS_PRODUCAO
    ASAAS_APIKEY=ASAAS_APIKEY_SANDBOX # ASAAS_APIKEY_SANDBOX | ASAAS_APIKEY_PRODUCAO
    
```
>**! ATENÇÃO !**<br> 
>Todas as funções dessa classe retornam os dados em formato ``JSON``<br>
>sem tratamentos, da mesma forma que o end-point ASAAS nos retorna.<br> 
>Isso para que você possa integrar tranquilamente com as suas funções internas;


## GERANDO UMA NOVA COBRANÇA
```php

<?php
    include "vendor\autoload.php";
    use IsraelNogueira\Asaas\asaas;
    use lib\cors\meu_sistema;

    $nova_cobranca = asaas::novaCobranca([
        "customer"=> "cus_000005158308",    // Esse dado vem no cadastro do usuario
        "billingType"=> "BOLETO",           // BOLETO | CREDIT_CARD | PIX |  UNDEFINED
        "dueDate"=> "2023-03-01",           // Vencimento
        "value"=> 100,                      // Valor
        "description"=> "Pedido 056984",    // Descrição
        "externalReference"=> "056984",     // Referência externa do seu sistema
        "discount"=> [
            "dueDateLimitDays"=> 12,        //  Dias antes do vencimento para aplicar desconto.
            "type"=> "FIXED",               //  PERCENTAGE | FIXED
            "value"=> 10,                   //  Valor percentual ou fixo de desconto a ser aplicado sobre o valor da cobrança
        ],
        "fine"=> [
            "value"=> 1,                    // VALOR de multa sobre o valor da cobrança para pagamento após o vencimento
            "type"=> "FIXED"                // PERCENTAGE | FIXED
        ],
        "interest"=> [
            "value"=> 2                     //% de juros ao mês sobre o valor da cobrança para pagamento após o vencimento
        ],
        "postalService"=> false,

        /*
        |------------------------------------------------------------------
        |	se for por {CREDIT_CARD} e já houver um cartão toknizado 
        |------------------------------------------------------------------
        */
        "creditCardToken"=> "76496073-536f-4835-80db-c45d00f33695",
        "remoteIp"=> "116.213.42.532",

        /*
        |------------------------------------------------------------------
        |	se for por {CREDIT_CARD} e não tenha um cartão toknizado, 
        |   será necessário cadastrar os dados "creditCard" + "creditCardHolderInfo"
        |------------------------------------------------------------------
        */
        "creditCard"=> [
            "holderName"=> "marcelo h almeida",
            "number"=> "5162306219378829",
            "expiryMonth"=> "05",
            "expiryYear"=> "2021",
            "ccv"=> "318"
        ],

        "creditCardHolderInfo"=> [
            "name"=> "Marcelo Henrique Almeida",
            "email"=> "marcelo.almeida@gmail.com",
            "cpfCnpj"=> "24971563792",
            "postalCode"=> "89223-005",
            "addressNumber"=> "277",
            "addressComplement"=> null,
            "phone"=> "4738010919",
            "mobilePhone"=> "47998781877"
        ]
    ]);
    
    // Faça o que quiser agora com os retornos da API:
    meu_sistema::cadastra_nova_cobranca( $nova_cobranca );



	/*
	|-------------------------------------------------
	|	RECUPERANDO MINHA WALLET
	|-------------------------------------------------
	*/
		$MY_WALLET = asaas::getWallet()
		print_r($MY_WALLET);


?>
```
## CLIENTES
```php
 <?
    include "vendor\autoload.php";
    use IsraelNogueira\Asaas\asaas;
    use lib\cors\meu_sistema;


	/*
	|-------------------------------------------------
	|	LISTA DE CLIENTES
	|-------------------------------------------------
	*/
		$_LISTA = asaas::listaCliente()
		print_r($_LISTA);

	/*
	|-------------------------------------------------
	|	RETORNA DETALHES DO CLIENTE
	|-------------------------------------------------
	*/
		$_DETALHES_ = asaas::getCliente($UID_CLIENTE);
		print_r($_DETALHES_);


	/*
	|-------------------------------------------------
	|	CRIAR NOVO CLIENTE
	|-------------------------------------------------
	*/
    $novo_cliente   = asaas::novoCliente([
                        'name'=>'José de Abreu',
                        'email'=>'jose@feats.com.br',
                        'phone'=>'5541000000000',
                        'mobilePhone'=>'5541000000000',
                        'cpfCnpj'=>'43856881174',
                        'company'=>'Empresa do zé',
                        'postalCode'=>'81470275',
                        'addressNumber'=>'72',
                        'complement'=>'23',
                        'externalReference'=>'4567',
                        'additionalEmails'=>'',
                        'municipalInscription'=>'',
                        'stateInscription'=>'',
                        'observations'=>'',
                    ])

	/*
	|-------------------------------------------------
	|	DETELA UM CLIENTE
	|-------------------------------------------------
	*/
		asaas::deleteCliente($UID_CLIENTE);

	/*
	|-------------------------------------------------
	|	ALTERA DADOS DE UM CLIENTE
	|-------------------------------------------------
	|
	|	Ali eu altero apenas o email, porém todos os dados 
	|	que foram usados na criação do cliente poderão ser
	|	inseridos na array no 2º parametro para serem atualizados
	|
	*/
		asaas::updateCliente($UID_CLIENTE,['email'=>'user@exemplo.com']);


		


								

```

## ATUALIZAÇÃO CADASTRAL
```php
 <?
    include "vendor\autoload.php";
    use IsraelNogueira\Asaas\asaas;
    use lib\cors\meu_sistema;


    $novo_cliente   = asaas::setDadosComerciais([
                            "personType"=> "JURIDICA",
                            "cpfCnpj"=> "66625514000140",
                            "birthDate"=> null,
                            "companyType"=> "MEI",
                            "email"=> "emaildaempresa@gmail.com",
                            "phone"=> "11 32300606",
                            "mobilePhone"=> "11 988451155",
                            "postalCode"=> "89223005",
                            "address"=> "Av. Rolf Wiest",
                            "addressNumber"=> "659",
                            "complement"=> "Sala 201",
                            "province"=> "Bom Retiro",
                        ])

    // Faça o que quiser agora com os retornos da API:
    meu_sistema::atualiza_cadastro( $novo_cliente );


```

## SUB-CLIENTES
```php


```

## SUB-CONTAS
```php
 <?
    include "vendor\autoload.php";
    use IsraelNogueira\Asaas\asaas;
    use lib\cors\meu_sistema;

    /*
    |-------------------------------------------------
    | RETORNA JSON COM A LISTA DE SUB-CONTAS
    |-------------------------------------------------
    */
    $_LISTA = asaas::listaSubContas();

    /*
    |-------------------------------------------------
    | RETORNA JSON COM DETALHES DA CONTA REQUIRIDA
    |-------------------------------------------------
    */
    $_DADOS =   asaas::getSubConta($_UID);


    /*
    |-------------------------------------------------
    | CRIA UMA NOVA SUB-CONTA E RETORNA OS DADOS
    |-------------------------------------------------
    */
    $_RETORNO = asaas::novaSubConta([
                    "name"		=>"Nome Completo Do Cliente",
                    "email"		=>"myaccount@example.com",
                    "cpfCnpj"		=>"15571534000145",
                    "birthDate"		=>"2012-05-04",
                    "companyType"	=>"LIMITED",//MEI | LIMITED | INDIVIDUAL | ASSOCIATION
                    "phone"		=>"",
                    "mobilePhone"	=>"45 9 9354 4738",
                    "address"		=>"Rua das Laranjeiras",
                    "addressNumber"	=>"41",
                    "complement"	=>"Sala 502",
                    "province"		=>"Bairro do Limoeiro",
                    "postalCode"	=>"50050550"
                ])


```

## ASSINATURA
```php
 <?
    include "vendor\autoload.php";
    use IsraelNogueira\Asaas\asaas;
    use lib\cors\meu_sistema;

	/*
	|-------------------------------------------------
	| 	GERAR CARNÊ DE ASSINATURA
	|-------------------------------------------------
	|	Para gerar os carnês gerados a partir de uma assinatura em formato PDF, 
	|	é necessário que você tenha o ID da assinatura retornado pelo Asaas.
	|
	*/
	header("Content-Type: application/pdf");
	die(asaas::getCarneAssinatura($_ID,['month'=>3,'year'=>2023]));

	/*
	|-------------------------------------------------
	| LISTAR COBRANÇAS DE UMA ASSINATURA
	|-------------------------------------------------
	|	Para listar as cobranças geradas a partir de uma assinatura.
	*/
  
 	$_LISTA = asaas::listaCobrancaAssinatura($_ID);


	/*
	|-------------------------------------------------
	| RETORNA DADOS DE UMA ASSINATURA
	|-------------------------------------------------
	*/

	$_DADOS = asaas::getAssinatura($_ID);


	/*
	|-------------------------------------------------
	| LISTAR ASSINATURAS
	|-------------------------------------------------
	|	Diferente da recuperação de uma assinatura específica, 
	|	este método retorna uma lista paginada com todas 
	|	as assinaturas para os filtros informados
	*/
	$_LISTA = 	asaas::listaAssinaturas([
					'customer'=>null, 			//FILTRAR PELO IDENTIFICADOR ÚNICO DO CLIENTE
					'billingType'=>null,		//FILTRAR POR FORMA DE PAGAMENTO
					'offset'=>null,				//INDEX INICIAL DA LISTA
					'limit'=>null, 				//NÚMERO DE ELEMENTOS DA LISTA (MAX: 100)
					'includeDeleted'=>false, 	//TRUE PARA RECUPERAR TAMBÉM AS ASSINATURAS REMOVIDAS
					'externalReference'=>null,	//FILTRAR PELO IDENTIFICADOR DO SEU SISTEMA
				])

	/*
	|-------------------------------------------------
	|	CRIAR NOVA ASSINATURA
	|-------------------------------------------------
	|	Ao criar a assinatura a primeira mensalidade será 
	|	gerada vencendo na data enviada no parâmetro nextDueDate.
	|
	*/

	asaas::novaAssinatura([
		"customer"=> $UID_CLIENTE, // Uid do cliente 
		"externalReference"=> "2345", // Referencia externa do seu sistema
		"split"=>[
			[
				'walletId'=>'',// Wallet de quem receberá
				'fixedValue'=>'',// valor
				'percentualValue'=>'',// % sobre o valor líquido da cobrança
			],
			[
				'walletId'=>'',
				'fixedValue'=>'',
				'percentualValue'=>'',
			],
		]
		"maxPayments"=> 7, //Número máximo de mensalidades a serem geradas para esta assinatura
		"billingType"=> "PIX",//BOLETO | CREDIT_CARD | PIX |  UNDEFINED
		"nextDueDate"=> "2023-02-28", //Vencimento da 1ª mensalidade
		"value"=> 19.9, // VALOR
		"cycle"=> "WEEKLY", // WEEKLY (Semanal) | BIWEEKLY (Quinzenal) | MONTHLY (Mensal) | QUARTERLY (Trimestral) | SEMIANNUALLY (Semestral) | YEARLY (Anual)
		"description"=> "Assinatura Plano Pró",
		"discount"=> [
			"dueDateLimitDays"=> 12, //Dias antes do vencimento para aplicar desconto.
			"type"=> "FIXED", // PERCENTAGE | FIXED
			"value"=> 10, //Valor percentual ou fixo de desconto a ser aplicado sobre o valor da cobrança
		],
		"fine"=> [
			"value"=> 1, // VALOR de multa sobre o valor da cobrança para pagamento após o vencimento
			"type"=> "FIXED" // PERCENTAGE | FIXED
		],
		"interest"=> [
			"value"=> 2 //% de juros ao mês sobre o valor da cobrança para pagamento após o vencimento
		]
	])



	/*
	|-------------------------------------------------
	|	ATUALIZA UMA ASSINATURA
	|-------------------------------------------------
	*/
		asaas::updateAssinatura($ID_ASSINATURA, [
			"billingType" => "BOLETO", // BOLETO | CREDIT_CARD | PIX |  UNDEFINED
			"nextDueDate" => "2017-06-15", // Vencimento da próxima mensalidade a ser gerada
			"value" => 29.9, // VALOR
			"cycle" => "MONTHLY", // WEEKLY (Semanal) | BIWEEKLY (Quinzenal) | MONTHLY (Mensal) | QUARTERLY (Trimestral) | SEMIANNUALLY (Semestral) | YEARLY (Anual)
			"description" => "Assinatura Plano Pró",
			"updatePendingPayments" => true, //true para atualizar mensalidades já existentes com o novo valor ou forma de pagamento
			"discount" => [
				"value" => 10, //Valor percentual ou fixo de desconto
				"type" => "FIXED", // PERCENTAGE | FIXED
				"dueDateLimitDays" => 0, // Dias antes do vencimento para aplicar desconto
			],
			"fine" => [
				"value" => 1, // VALOR de multa sobre o valor da cobrança para pagamento após o vencimento
				"type" => "FIXED", // PERCENTAGE | FIXED
			],
			"interest" => [
				"value" => 2, //% de juros ao mês sobre o valor da cobrança para pagamento após o vencimento
			],
		]);



	/*
	|-------------------------------------------------
	|	ATUALIZA UMA ASSINATURA
	|-------------------------------------------------
	*/
		asaas::deleteAssinatura($ID_ASSINATURA);












```
