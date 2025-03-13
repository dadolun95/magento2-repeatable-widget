<?php
/**
 * @package     Dadolun_RepeatableWidget
 * @copyright   Copyright (c) 2021 Dadolun (https://github.com/dadolun95)
 * @license     Open Source License
 */

declare(strict_types=1);

namespace Dadolun\RepeatableWidget\Helper;

use Magento\Widget\Helper\Conditions;

/**
 * Class WidgetSerializer
 * @package Dadolun\RepeatableWidget\Helper
 */
class WidgetSerializer extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @param Conditions $conditions
     */
    public function __construct(
        protected Conditions $conditions
    )
    {
    }

    /**
     * @param array $value
     * @return string
     */
    public function serialize($value): string
    {
        return str_replace("\"", "|", $this->conditions->encode($value));
    }

    /**
     * @param string $value
     * @return array
     */
    public function unserialize($value): array
    {
        $serializedValue = str_replace("|", "\"", $value);
        $arrayValue = $this->conditions->decode($serializedValue);
        foreach ($arrayValue as $key => $value) {
            if ($key === '__empty') {
                unset($arrayValue[$key]);
            }
        }
        return $arrayValue;
    }
}
