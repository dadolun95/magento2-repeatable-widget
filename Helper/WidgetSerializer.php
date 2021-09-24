<?php
/**
 * @package     Dadolun_RepeatableWidget
 * @copyright   Copyright (c) 2021 Dadolun (https://github.com/dadolun95)
 * @license     Open Source License
 */
namespace Dadolun\RepeatableWidget\Helper;

use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class WidgetSerializer
 * @package Dadolun\RepeatableWidget\Helper
 */
class WidgetSerializer extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var Json
     */
    protected $serializer;

    /**
     * WidgetSerializer constructor.
     * @param Json $serializer
     */
    public function __construct(
        Json $serializer
    )
    {
        $this->serializer = $serializer;
    }

    /**
     * @param array $value
     * @return string
     */
    public function serialize($value) {
        return str_replace("\"", "|", $this->serializer->serialize($value));
    }

    /**
     * @param string $value
     * @return array
     */
    public function unserialize($value) {
        $serializedValue = str_replace("|", "\"", $value);
        $arrayValue = $this->serializer->unserialize($serializedValue);
        foreach ($arrayValue as $key => $value) {
            if ($key === '__empty') {
                unset($arrayValue[$key]);
            }
        }
        return $arrayValue;
    }
}
