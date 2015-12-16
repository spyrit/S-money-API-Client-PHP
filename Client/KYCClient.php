<?php

class KYCClient extends SMoneyClient
{
    /**
     * @param array $files The files to upload. Array of array. Expects 'path', 'mimeType' and 'filename' for each file.
     * @param string $UserId
     * @throws Exception
     * @return KYCDemand
     */
    public function postKYCDemand($files, $UserId)
    {
        if ($UserId != null) {
            $Url = $this->baseUrl.'users/'.$UserId.'/kyc';
        } else {
            $Url = $this->baseUrl.'kyc';
        }

        $hash = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 16);
        define('MULTIPART_BOUNDARY', '--------------------------'.$hash);
        $header = "Accept: application/vnd.s-money.v1+json\r\n";
        $header .= 'Authorization: Bearer '.$this->token."\r\n";
        $header .= 'Content-Type: multipart/form-data; boundary='.MULTIPART_BOUNDARY."\r\n";
        $content = '';

        $i = 0;
        foreach ($files as $file) {
            $i++;
            $content = '--'.MULTIPART_BOUNDARY."\r\n".
                    'Content-Disposition: form-data; name="file'.$i.'"; filename="'.$file['filename']."\"\r\n".
                    'Content-Type: '.$file['mimeType']."\r\n\r\n".
                    file_get_contents($file['path'])."\r\n";
        }
        $content .= '--'.MULTIPART_BOUNDARY."--\r\n";

        $options = array(
            'http' => array(
                'header'  => $header,
                'method'  => 'POST',
                'content' => $content,
            ),
        );
        $context  = stream_context_create($options);
        $json = file_get_contents($Url, false, $context);
        $result = json_decode($json, true);

        $kyc = new KYCDemand();
        $kyc->initObject($result);

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
