<?php

class Application_Http_Response {

    const FORMAT_HTML = 1;
    const FORMAT_JSON = 2;
    const FORMAT_XML  = 3;
	const FORMAT_RAW  = 4;

	protected $_body;
	protected $_format;
    protected $_templateSystem;

	public function setBody($body)
    {
		$this->_body = $body;

		return $this;
	}

	public function setOutputFormat($format)
    {
		$this->_format = $format;

		return $this;
	}

    public function setFormat($format)
    {
        if($format == 'application/json' || $format == 'text/json') {
            $this->setOutputFormat(self::FORMAT_JSON);
        } elseif ($format == 'application/xml' || $format == 'text/xml') {
            $this->setOutputFormat(self::FORMAT_XML);
        } elseif ($format == self::FORMAT_RAW) {
            $this->setOutputFormat(self::FORMAT_RAW);
        } else {
            $this->setOutputFormat(self::FORMAT_HTML);
        }

        return $this;
    }

    public function setTemplateSystem($template)
    {
        $this->_templateSystem = $template;

        return $this;
    }

    public function getOutputFormat($acceptType) {
        if($this->_format) {
            return $this->_format;
        }

        return $acceptType;
    }

	public function out()
    {
        $content = null;

        switch($this->_format) {
            case self::FORMAT_XML:
                header('Content-type: text/xml; charset=utf-8');
                $content = $this->_toXml($this->_prepareBody());
                break;
            case self::FORMAT_JSON:
                header('Content-type: application/json; charset=utf-8');
                $content = json_encode($this->_prepareBody());
                break;
			case self::FORMAT_RAW:
				$content = $this->_prepareBody();
				break;
            default:
                $data = $this->_templateSystem->prepare($this->_prepareBody());
                $content = $this->_templateSystem->render($data);
                break;
        }

		echo $content;
	}

    public function setHeader($headers)
    {
        if(empty($headers)) {
            return $this;
        }

        if(is_array($headers)) {
            foreach($headers as $header) {
                header($header, true);
            }
        } else {
            if(is_string($headers)) {
                header($headers, true);
            }
        }

        return $this;
    }
	
	private function _prepareBody() {
		if($this->_format == self::FORMAT_RAW) {
			return $this->_body;
		}
		
		return is_array($this->_body) ?
            $this->_body :
            array();
	}

	public function _toXml($value)
    {
		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><root/>');

		$arrayToXml = function(\SimpleXMLElement $node, $array) use(&$arrayToXml) {
            if(!is_array($array))
            {
                if($array instanceof \stdClass)
                {
                    $array = (array) $array;
                }
                else
                {
                    throw new \Exception('Argument should be array or stdClass');
                }
            }

			foreach($array as $key => $value) {
				if(is_array($value) || ($value instanceOf \stdClass)) {
					if(is_numeric(key($value))) {
						foreach((array) $value as $item) {
                            (is_array($item) || ($item instanceOf \stdClass))
								? $arrayToXml($node->addChild($key), $item)
								: $node->addChild($key, $item);
						}
					} else {
						$arrayToXml($node->addChild($key), $value);
					}

				} else {
					$node->addChild($key, $value);
				}
			}
		};

        (is_array($value) || ($value instanceOf \stdClass)) ? $arrayToXml($xml, $value) : $xml->addChild('Response', $value);

		return $xml->asXML();
	}

}