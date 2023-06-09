<p align="center">
    <img src="https://github.com/israel-nogueira/api-asaas/blob/47408bfa966f5f070078a9f9ad790526ed708efc/src/top_readme.png"/>
</p>

<p align="center">
    <a href="#instalação" target="_Self">Instalação</a> |
    <a href="#admin" target="_Self">Admin</a> |
    <a href="#conversão-de-arquivos" target="_Self">Assinaturas</a> |
    <a href="#print-imagem-no-browser" target="_Self">Clientes</a> |
    <a href="#thumb-redondo" target="_Self">Cobranças</a><br>
    <a href="#paleta-de-cores" target="_Self">Links de cobrança</a> |
    <a href="#cor-predominante-de-uma-imagem" target="_Self">PIX</a> |
    <a href="#placeholder" target="_Self">Sub-Clientes</a> |
    <a href="#placeholder-blur-de-uma-imagem" target="_Self">Sub Contas</a> |
    <a href="#processa-uma-imagem" target="_Self"> WebHook</a>
</p>
<p align="center">
    <a href="https://packagist.org/packages/israel-nogueira/api-asaas">
        <img src="https://poser.pugx.org/israel-nogueira/api-asaas/v/stable.svg">
    </a>
    <a href="https://packagist.org/packages/israel-nogueira/api-asaas"><img src="https://poser.pugx.org/israel-nogueira/api-asaas/downloads"></a>
    <a href="https://packagist.org/packages/israel-nogueira/api-asaas"><img src="https://poser.pugx.org/israel-nogueira/api-asaas/license.svg"></a>
</p>

<p align="center">
    Esta é uma classe super simples dos serviços ASAAS.<br>
    Sem fru-fru, apenas o que realmente é útil em um sistema/website.<br/>
</p>



## Instalação

Instale via composer.

```plaintext
    composer require israel-nogueira/api-asaas
```

Crie um arquivo na raiz do projeto ``.env`` e coloque as seguintes informações:
```env

    #######################
    ###### API ASAAS ######
    #######################

    ASAAS_NOME_DO_SUPORTE=Maria José
    ASAAS_EMAIL_DO_SUPORTE=mariajose@gmail.com

    ASAAS_EMAIL_CONTA_PAI=exemplo@gmail.com
    ASAAS_SENHA_CONTA_PAI=*****

    ASAAS_SANDBOX="https://sandbox.asaas.com"
    ASAAS_PRODUCAO="https://www.asaas.com"

    ASAAS_APIKEY_SANDBOX="___APIKEY___"
    ASAAS_APIKEY_PRODUCAO="___APIKEY___"

    ASAAS_AMBIENTE=ASAAS_SANDBOX  # ASAAS_SANDBOX | ASAAS_PRODUCAO
    ASAAS_APIKEY=ASAAS_APIKEY_SANDBOX # ASAAS_APIKEY_SANDBOX | ASAAS_APIKEY_PRODUCAO
    
```

## GERANDO UMA COBRANÇA<br/>

Quando geramos uma nova cobrança, a função ``asaas::novaCobranca`` retorna todos os dados em formato ``JSON``<br>
para que você possa integrar tranquilamente com as suas funções;
```php

<?php
    include "vendor\autoload.php";
	use IsraelNogueira\SweetThumb\sweet;

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

?>
```

```php
 <?
 	
			api_asaas::novoCliente([
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
```
