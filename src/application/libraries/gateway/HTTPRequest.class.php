<?php

class HTTPRequest
{

    public function curlConnection($method, $url, $timeout=30, $charset="UTF-8", $data = null, $override_header_array=false)
    {

        if (strtoupper($method) === 'POST') {
			if(is_array($data)){
				$postFields = ($data ? http_build_query($data, '', '&') : "");
			}elseif($data){
				$postFields = $data;
			}
            $contentLength = "Content-length: " . strlen($postFields);
            $methodOptions = array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postFields,
            );
        } else {
            $contentLength = null;
            $methodOptions = array(
                CURLOPT_HTTPGET => true
            );
        }


		$header_array = array(
			"Content-Type: application/x-www-form-urlencoded; charset=" . $charset,
			$contentLength
		);
		
		if($override_header_array){
		
			$header_array = $override_header_array;
			
		}
		
        $options = array(
            CURLOPT_HTTPHEADER => $header_array,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            //CURLOPT_TIMEOUT => $timeout
            );

     
        $options = ($options + $methodOptions);

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $resp = curl_exec($curl);
        $info = curl_getinfo($curl);
        $error = curl_errno($curl);
        $errorMessage = curl_error($curl);
        curl_close($curl);

        $this->setStatus = $info['http_code'];
        $this->setResponse = $resp;

        if ($error) {
            throw new Exception("CURL can't connect: $errorMessage");
        } else {
            return $this;
        }
    }

}
