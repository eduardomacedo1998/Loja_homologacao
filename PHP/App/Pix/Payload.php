<?php 

namespace App\Pix;


class Payload{
    /**
   * IDs do Payload do Pix
   * @var string
   */
  const ID_PAYLOAD_FORMAT_INDICATOR = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
  const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
  const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
  const ID_MERCHANT_CATEGORY_CODE = '52';
  const ID_TRANSACTION_CURRENCY = '53';
  const ID_TRANSACTION_AMOUNT = '54';
  const ID_COUNTRY_CODE = '58';
  const ID_MERCHANT_NAME = '59';
  const ID_MERCHANT_CITY = '60';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
  const ID_CRC16 = '63';

// Chave PIX pode ser qualquer chave, tipo: String 

  private $pixkey;

// descrição do pagamento 

  private $description;
 
// Nome do titular da conta 

  private $merchantName;

// cidade do titular da conta 

  private $MerchantCity;

// id da transação pix

 private $txid;

// Valor da transação 

 private  $Amount;


//         Metodo responsavel por definir o valor de pixkey


 public function setPixKey($pixkey){

    $this -> pixkey =  $pixkey;

    return $this;

 }


 public function setDescription($description){

    $this -> description =  $description;

    return $this;

 }


 public function setMerchantName($merchantName){

    $this -> merchantName =  $merchantName;

    return $this;

 }

 public function setMerchantCity($MerchantCity){

    $this -> MerchantCity  =  $MerchantCity;

    return $this;

 }

 public function setTxid($txid){

    $this -> txid =  $txid;

    return $this;

 }

// responsavel por retornar o valor completo do objeto do payload

 public function getValue($id,$value){

    $size = str_pad(strlen($value),2,'0',STR_PAD_LEFT) ;

   return $id.$size.$value;

 }


// metodo responsavel por retornar os valores informações completos da conta

private function getMerchantAccountInformation(){
    // domínio do banco
    $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, 'br.gov.bcb.pix');

    // Chave pix
    $key = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->pixkey);

    // Descrição do pagamento
    $description = !empty($this->description) ? $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION, $this->description) : '';

    return $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION, $gui . $key . $description);
}


// responsavel por retornar os valores completos do campo adicional do pix 

private function getAdditionalDataFieldTemplate(){

    $txid = $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID, $this->txid);

    return $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE,$txid);

}



// metodo responsavel por gerar o codigo completo do payload

 public function getPayload(){
    $payload = $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR,'01').
                $this->getMerchantAccountInformation().
                $this->getValue(self::ID_MERCHANT_CATEGORY_CODE,'0000').
                $this->getValue(self::ID_TRANSACTION_CURRENCY,'986').
                $this->getValue(self::ID_TRANSACTION_AMOUNT,$this->Amount).
                $this->getValue(self::ID_COUNTRY_CODE,'BR').
                $this->getValue(self::ID_MERCHANT_NAME,$this->merchantName).
                $this->getValue(self::ID_MERCHANT_CITY,$this->MerchantCity).
                $this->getAdditionalDataFieldTemplate();
    
    
    
    return $payload.$this->getCRC16($payload);
 }


 /**
   * Método responsável por calcular o valor da hash de validação do código pix
   * @return string
   */
  private function getCRC16($payload) {
    //ADICIONA DADOS GERAIS NO PAYLOAD
    $payload .= self::ID_CRC16.'04';

    //DADOS DEFINIDOS PELO BACEN
    $polinomio = 0x1021;
    $resultado = 0xFFFF;

    //CHECKSUM
    if (($length = strlen($payload)) > 0) {
        for ($offset = 0; $offset < $length; $offset++) {
            $resultado ^= (ord($payload[$offset]) << 8);
            for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                if (($resultado <<= 1) & 0x10000) $resultado ^= $polinomio;
                $resultado &= 0xFFFF;
            }
        }
    }

    //RETORNA CÓDIGO CRC16 DE 4 CARACTERES
    return self::ID_CRC16.'04'.strtoupper(dechex($resultado));
}


 public function setAmount($Amount){

    $this -> Amount = (string) number_format($Amount,2, '.' , '') ;

    return $this;

 }




  

 

 



}