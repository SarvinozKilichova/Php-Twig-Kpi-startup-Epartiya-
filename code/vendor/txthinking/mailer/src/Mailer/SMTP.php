<?php

namespace Tx\Mailer;

// use Psr\Log\LoggerInterface;
// use Tx\Mailer\Exceptions\CodeException;
// use Tx\Mailer\Exceptions\CryptoException;
// use Tx\Mailer\Exceptions\SMTPException;

class SMTP
{


    public function __construct()
    {
        print_r('dddd');
        $this->logger = $logger;
    }

    public function setServer($host, $port, $secure=null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->secure = $secure;
        if(!$this->ehlo) $this->ehlo = $host;
        $this->logger && $this->logger->debug("Set: the server");
        return $this;
    }

}

