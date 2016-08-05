<?php


/***
 * Represents the party on the transaction that is sending the money
 */
class Sender
{

    /*** Sender name */
    private $name;

    /*** Sender email */
    private $email;

    /*** Sender phone */
    private $phone;

    /*** Sender documents */
    private $documents;

    /*** Sender IP */
    private $ip;

    /***
     * Initializes a new instance of the Sender class
     *
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            if (isset($data['name'])) {
                $this->name = $data['name'];
            }
            if (isset($data['email'])) {
                $this->email = $data['email'];
            }
            if (isset($data['phone']) && $data['phone'] instanceof Phone) {
                $this->phone = $data['phone'];
            } else {
                if (isset($data['areaCode']) && isset($data['number'])) {
                    $phone = new Phone($data['areaCode'], $data['number']);
                    $this->phone = $phone;
                }
            }
            if (isset($data['documents']) && is_array($data['documents'])) {
                $this->setDocuments($data['documents']);
            }
            if (isset($data['ip'])) {
                $this->getIP();
            }
        }
    }

    /***
     * Sets the sender name
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = Helper::formatString($name, 50, '');
    }

    /***
     * @return String the sender name
     */
    public function getName()
    {
        return $this->name;
    }

    /***
     * Sets the Sender e-mail
     * @param email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /***
     * @return String the sender e-mail
     */
    public function getEmail()
    {
        return $this->email;
    }

    /***
     * Sets the sender phone
     * @param String $areaCode
     * @param String $number
     */
    public function setPhone($areaCode, $number = null)
    {
        $param = $areaCode;
        if ($param instanceof Phone) {
            $this->phone = $param;
        } elseif ($number) {
            $phone = new Phone();
            $phone->setAreaCode($areaCode);
            $phone->setNumber($number);
            $this->phone = $phone;
        }
    }

    /***
     * @return Phone the sender phone
     * @see Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /***
     * Get Sender documents
     * @return array Document List of Document
     * @see Document
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /***
     * Set documents
     * @param array $documents
     * @see Document
     */
    public function setDocuments(array $documents)
    {
        if (count($documents) > 0) {
            foreach ($documents as $document) {
                if ($document instanceof SenderDocument) {
                    $this->documents[] = $document;
                } else {
                    if (is_array($document)) {
                        $this->addDocument($document['type'], $document['value']);
                    }
                }
            }
        }
    }

    /***
     * Add a document for Sender object
     * @param String $type
     * @param String $value
     */
    public function addDocument($type, $value)
    {
        if ($type && $value) {
            if (count($this->documents) == 0) {
                $document = new SenderDocument($type, $value);
                $this->documents[] = $document;
            }
        }
    }

    /***
     * Add an ip for Sender object
     */
    public function getIP()
    {
        if ( function_exists( 'apache_request_headers' ) ) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }
 
        if ( array_key_exists( 'X-Forwarded-For', $headers ) 
            && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
            $ip = $headers['X-Forwarded-For'];
 
        } elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) 
            && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )) {
 
            $ip = $headers['HTTP_X_FORWARDED_FOR'];
 
        } else {  
            $ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP );
        }

        $this->ip = $ip;
    }
}
