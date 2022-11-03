<?php
$paymentRequest = new PagSeguroPaymentRequest();
$paymentRequest->addItem('0001', 'Notebook', 1, 2430.00);
$paymentRequest->addItem('0002', 'Mochila',  1, 150.99);
$sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');  
$paymentRequest->setShippingType($sedexCode);  
$paymentRequest->setShippingAddress(  
  '01452002',  
  'Av. Brig. Faria Lima',  
  '1384',  
  'apto. 114',  
  'Jardim Paulistano',  
  'São Paulo',  
  'SP',  
  'BRA'  
);  

$paymentRequest->setSender(  
    'João Comprador',  
    'email@comprador.com.br',  
    '11',  
    '56273440',  
    'CPF',  
    '156.009.442-76'  
  );  

  $paymentRequest->setCurrency("BRL");  

  // Referenciando a transação do PagSeguro em seu sistema  
$paymentRequest->setReference("REF123");  
  
// URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento  
$paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");  
  
// URL para onde serão enviadas notificações (POST) indicando alterações no status da transação  
$paymentRequest->addParameter('notificationURL', 'http://www.lojamodelo.com.br/nas');  

    $paymentRequest->addPaymentMethodConfig('CREDIT_CARD', 1.00, 'DISCOUNT_PERCENT');  
$paymentRequest->addPaymentMethodConfig('EFT', 2.90, 'DISCOUNT_PERCENT');  
$paymentRequest->addPaymentMethodConfig('BOLETO', 10.00, 'DISCOUNT_PERCENT');  
$paymentRequest->addPaymentMethodConfig('DEPOSIT', 3.45, 'DISCOUNT_PERCENT');  
$paymentRequest->addPaymentMethodConfig('BALANCE', 0.01, 'DISCOUNT_PERCENT');  

$paymentRequest->addParameter('senderBornDate', '07/05/1981');  

$paymentRequest->addParameter('senderBornDate', '07/05/1981');  

try {  
  
    $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
    $sessionId = PagSeguroSessionService::getSession($credentials);  
    
  } catch (PagSeguroServiceException $e) {  
    die($e->getMessage());  
  }  
?>

  <script type="text/javascript"
  src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
</script>

<script type="text/javascript">
  PagSeguroDirectPayment.setSessionId('sessionId');
</script>

<script type="text/javascript">
  PagSeguroDirectPayment.getSenderHash();
</script>

<script type="text/javascript">
  PagSeguroDirectPayment.getPaymentMethods({
    success: {função de callback para chamadas bem sucedidas},
    error: {função de callback para chamadas que falharam},
    complete: {função de callback para todas chamadas}
  });
</script>

<script type="text/javascript">
  PagSeguroDirectPayment.getBrand({
    cardBin: $("input#cartao").val(),
    success: {função de callback para chamadas bem sucedidas},
    error: {função de callback para chamadas que falharam},
    complete: {função de callback para todas chamadas}
  });
</script>

<script type="text/javascript">
  var param = {
    cardNumber: $("input#cartao").val(),
    brand: $("input#bandeira").val();
    cvv: $("input#cvv").val(),
    expirationMonth: $("input#validadeMes").val(),
    expirationYear: $("input#validadeAno").val(),
    success: {função de callback para chamadas bem sucedidas},
    error: {função de callback para chamadas que falharam},
    complete: {função de callback para todas chamadas}
  }

  PagSeguroDirectPayment.createCardToken(param);
</script>

<script type="text/javascript">
  PagSeguroDirectPayment.getInstallments({
    amount: $("input#valorPgto").val(),
    brand: $("input#bandeira").val(),
    maxInstallmentNoInterest: 2,
    success: {função de callback para chamadas bem sucedidas},
    error: {função de callback para chamadas que falharam},
    complete: {função de callback para todas chamadas}
  });
</script>

<?php
#Definindo o modo e método de pagamento.

$directPaymentRequest = new PagSeguroDirectPaymentRequest();  
$directPaymentRequest->setPaymentMode('DEFAULT'); // GATEWAY  
$directPaymentRequest->setPaymentMethod('CREDIT_CARD');  
#Definindo a moeda a ser utilizada no pagamento.

$directPaymentRequest->setCurrency("BRL");  
#Adicionando produtos/serviços na solicitação.

$directPaymentRequest->addItem('0001', 'Notebook', 1, 2430.00);  
$directPaymentRequest->addItem('0002', 'Mochila',  1, 150.99);  
#Informando os dados do comprador.

$directPaymentRequest->setSender(  
  'João Comprador',  
  'email@comprador.com.br',  
  '11',  
  '56273440',  
  'CPF',  
  '156.009.442-76'  
);  
  
$directPaymentRequest->setSenderHash(  
  'd94d002b6998ca9cd69092746518e50aded5a54aef64c4877ccea02573694987'  
);  
#Informando o endereço de entrega, assim como tipo do frete.

$sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');  
$directPaymentRequest->setShippingType($sedexCode);  
$directPaymentRequest->setShippingAddress(  
  '01452002',  
  'Av. Brig. Faria Lima',  
  '1384',  
  'apto. 114',  
  'Jardim Paulistano',  
  'São Paulo',  
  'SP',  
  'BRA'  
);  
#Informando os dados do cartão.

$creditCardToken = "1a45e0f9029344898d1b1fe00d90a66b";  
  
$installments = new PagSeguroInstallment(  
  array(  
    'quantity' => '1',  
    'value' => '2580.99'  
  )  
);  
  
$billingAddress = new PagSeguroBilling(  
    array(  
      'postalCode' => '01452002',  
      'street' => 'Av. Brig. Faria Lima',  
      'number' => '1384',  
      'complement' => 'apto. 114',  
      'district' => 'Jardim Paulistano',  
      'city' => 'São Paulo',  
      'state' => 'SP',  
      'country' => 'BRA'  
    )  
);  
  
$creditCardData = new PagSeguroCreditCardCheckout(  
  array(  
    'token' => $creditCardToken,  
    'installment' => $installments,  
    'billing' => $billingAddress,  
    'holder' => new PagSeguroCreditCardHolder(  
      array(  
        'name' => 'João Comprador',  
        'birthDate' => date('01/10/1979'),  
        'areaCode' => '11',  
        'number' => '56273440',  
        'documents' => array(  
          'type' => 'CPF',  
          'value' => '156.009.442-76'  
        )  
      )  
    )  
  )  
);  
  
$directPaymentRequest->setCreditCard($creditCardData);  


#Por fim você deve fazer a requisição no sistema do PagSeguro. O retorno do método register, por padrão, será um objeto com a resposta da requisição.

try {  
  
  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
  $response = $directPaymentRequest->register($credentials);  
  
} catch (PagSeguroServiceException $e) {  
    die($e->getMessage());  
}  

#Consultas
#Por código de notificação
#O PagSeguro pode enviar notificações ao seu sistema (POST) indicando a ocorrência de algum evento que requer sua atenção. Para mais informações sobre o recebimento de notificações clique aqui.

try {  
  
  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
  $response = PagSeguroNotificationService::checkTransaction(  
    $credentials,  
    $notificationCode  
  );  
  
} catch (PagSeguroServiceException $e) {  
  die($e->getMessage());  
}  
#Por código da transação
#Sempre que precisar, você pode consultar dados de uma transação específica utilizando seu código identificador.

try {  
  
  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
  $response = PagSeguroTransactionSearchService::searchByCode(  
    $credentials,  
    $transactionCode  
  );  
  
} catch (PagSeguroServiceException $e) {  
  die($e->getMessage());  
}  
#Por código de referência

#Você pode buscar transações com base em um código de referência.

try {  
  
  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
  $response = PagSeguroTransactionSearchService::searchByReference(  
    $credentials,  
    $reference,  
    $initialDate,  
    $finalDate,  
    $pageNumber,  
    $maxPageResults  
  );  
  
} catch (PagSeguroServiceException $e) {  
  die($e->getMessage());  
}  
#Transações concluídas - por intervalo de datas
#Para facilitar seu controle financeiro e seu estoque, você pode solicitar uma lista com histórico das transações da sua loja.

try {  
  
  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
  $response = PagSeguroTransactionSearchService::searchByDate(  
    $credentials,  
    $pageNumber,  
    $maxPageResults,  
    $initialDate,  
    $finalDate  
  );  
  
} catch (PagSeguroServiceException $e) {  
  die($e->getMessage());  
}  
#Transações abandonadas - por intervalo de datas
#A consulta destas transações é útil para que você identifique quais transações não foram concluídas devido ao abandono do fluxo de pagamento e tente fazer algum processo de recuperação junto ao comprador.

try {  
  
  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials();  
  $response = PagSeguroTransactionSearchService::searchAbandoned(  
    $credentials,  
    $pageNumber,  
    $maxPageResults,  
    $initialDate,  
    $finalDate  
  );  
  
} catch (PagSeguroServiceException $e) {  
  die($e->getMessage());  
}  
#Estorno
#Sempre que precisar você pode solicitar o estorno parcial ou total de uma transação previamente paga. A chamada ao serviço pode ser feita da seguinte forma:

$transactionCode = "6337FB5F-6B4C-432A-BDF4-FCE950CCCA64";  
  
$refundAmount = "1000.00"; // opcional  
  
try {  
  
    $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
  
    $response = PagSeguroRefundService::createRefundRequest(  
      $credentials,  
      $transactionCode,  
      $refundAmount  
    );  
  
} catch (PagSeguroServiceException $e) {  
    die($e->getMessage());  
}  
#Cancelamento
#Sempre que precisar você pode solicitar o cancelamento de uma transação que ainda esteja sendo processada. A chamada ao serviço pode ser feita da seguinte forma:

$transactionCode = "7737FC3F-6B4C-435B-BDF4-FEB950CCAA88";  
  
try {  
  
    $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
  
    $response = PagSeguroCancelService::createRequest($credentials, $transactionCode);  
  
} catch (PagSeguroServiceException $e) {  
    die($e->getMessage());  
}  