<?php
/**
 * @package     Dadolun_RepeatableWidget
 * @copyright   Copyright (c) 2021 Dadolun (https://github.com/dadolun95)
 * @license     Open Source License
 */

declare(strict_types=1);

namespace Dadolun\RepeatableWidget\Plugin;

use Dadolun\RepeatableWidget\Helper\WidgetSerializer;

/**
 * Class SaveRepeatableItems
 * @package Dadolun\RepeatableWidget\Plugin
 */
class SaveRepeatableItems
{

    /**
     * @param WidgetSerializer $serializer
     */
    public function __construct(
        protected WidgetSerializer $serializer,
    )
    {
    }

    /**
     * @param \Magento\Widget\Model\Widget $subject
     * @param $type
     * @param $params
     * @param $asIs
     * @return array
     */
    public function beforeGetWidgetDeclaration(
        \Magento\Widget\Model\Widget $subject,
        $type,
        $params,
        $asIs
    ): array
    {
        foreach ($params as $name => $value) {
            if (strpos($name, 'repeatable_') !== false) {
                $params[$name] = $this->serializer->serialize($value);
            }
        }
        return [$type, $params, $asIs];
    }
}
