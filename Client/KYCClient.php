<?php

class KYCClient extends SMoneyClient
{
    public function postKYCDemand($files, $UserId)
    {
        if ($UserId != null) {
            $Url = $this->baseUrl.'users/'.$UserId.'/kyc';
        } else {
            $Url = $this->baseUrl.'kyc';
        }

        $Client = new Motor($Url, $this->token);

        /*$SubAccount=$SubAccount->encodeJSON();
        $result = $Client->postData($SubAccount);*/

        $kyc = $result['content'];
        $kyc = new KYCDemand();
        $kyc->initObject($kyc);

        return $kyc;
    }

    public function getKYCDemand($Id, $UserId)
    {
        if ($UserId != null) {
            $Url = $this->baseUrl.'users/'.$UserId.'/kyc/'.$Id;
        } else {
            $Url = $this->baseUrl.'kyc/'.$Id;
        }

        $Client = new Motor($Url, $this->token);
        $result = $Client->getData();
        $array = $result['content'];
        $kyc = new KYCDemand();
        $kyc->initObject($array);

        return $kyc;
    }

    public function getKYCDemands($UserId)
    {
        if ($UserId != null) {
            $Url = $this->baseUrl.'users/'.$UserId.'/kyc/';
        } else {
            $Url = $this->baseUrl.'kyc/';
        }

        $Client = new Motor($Url, $this->token);

        $result = $Client->getData();

        if (array_key_exists('Code', $result['content']) && $result['content']['Code'] != null) {
            return $result;
        } else {
            $demands = array();
            $results = $result['content'];
            if (is_array($results)) {
                foreach ($results as $result) {
                    $kyc = new KYCDemand();
                    $kyc->initObject($result);
                    $demands[] = $kyc;
                }

                return $demands;
            } else {
                return 'Aucune valeur';
            }
        }
    }
}
