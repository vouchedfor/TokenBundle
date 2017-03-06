<?php

namespace VouchedFor\TokenBundle\Encoder;

class TokenEncoder
{
    private $url;

    public function __construct($url = null)
    {
        $this->url = $url;
    }

    public function decode($token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . "/" . $token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new \Exception("Could not get content from token. cURL Error #:" . $err);
        }

        return $response;
    }

    public function encode($tokenArray)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($tokenArray),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new \Exception("Could not get content from token. cURL Error #:" . $err);
        }

        return $response;
    }
}

// http://token-local.vouchedfor.co.uk/v2/token/eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NDksInJvbGVzIjpbIlJPTEVfTUVNQkVSX0NPQUNIIiwiUk9MRV9TVVBFUl9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6IkpvbmF0aGFuLlN0aWR3aWxsIn0.5BJ5NzaOsadba9rZJER_pQctzLTfS8PDZY8AJEwZyl15zcEnfcI0MZHiYjHsQKTKe3iLNXaQ3Sdg1dFkgzvaB0CGXZdOJ-OEZx_jjZQvVYtK0MToPLzhKYTRQZz7e8hFMIljcJ6Y_2xFWpfFGnH0Tt6MOV5z_iIq8My6mRa8_zXiWibQUQqejJuZgoyjxtPoJjmMvPuzrtFUe4I4Us_c4ry3-vTzs343DuzwuJvZ7f-Xp_gGg7dhPoJM9i2ewoEPWe0eZjA11n7uLrp9Qbu_F8a5URAennDIq4L25TPSF-1VRATy9qpGE2XzChaTBaMiA4mTubA1LwIw54TIJdRt1upRL25M1XWV-EbTwduQlCy5GnW2l3pDlBfWxSknrByKKqz-RUHusA3sHI6oUgZ-IgsVCCbmPbJ0DRY2pd1XgLF_rgSpGSVuw68mAyetRrUM3qQ9TFP32wXE1qvroQA9Vgbvvl6Ndaepvl-mVI-fC0Y2v1W0XOj38y8NN3MzfCkUnxNG407R32b1s3dDb6a-KRr2z8ut67P7XMHNrrKlgh-HBPMOC1_oS7qcFNcPspuw_x416miyAd6u6DUpzlTWR-fIjMHxJVOkc5Q-p9zlatQHwwD7d7slnAgiSgwDHHFh0jVwPF511q42Pqhc8oUBFkeu99FxkhJkNMHgPvG8KSk

// http://token-local.vouchedfor.co.uk/v2/token/eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NDksInJvbGVzIjpbIlJPTEVfTUVNQkVSX0NPQUNIIiwiUk9MRV9TVVBFUl9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6IkpvbmF0aGFuLlN0aWR3aWxsIn0.5BJ5NzaOsadba9rZJER_pQctzLTfS8PDZY8AJEwZyl15zcEnfcI0MZHiYjHsQKTKe3iLNXaQ3Sdg1dFkgzvaB0CGXZdOJ-OEZx_jjZQvVYtK0MToPLzhKYTRQZz7e8hFMIljcJ6Y_2xFWpfFGnH0Tt6MOV5z_iIq8My6mRa8_zXiWibQUQqejJuZgoyjxtPoJjmMvPuzrtFUe4I4Us_c4ry3-vTzs343DuzwuJvZ7f-Xp_gGg7dhPoJM9i2ewoEPWe0eZjA11n7uLrp9Qbu_F8a5URAennDIq4L25T