<?php
/**
 * @package     Dadolun_RepeatableWidget
 * @copyright   Copyright (c) 2021 Dadolun (https://github.com/dadolun95)
 * @license     Open Source License
 */
namespace Dadolun\RepeatableWidget\Plugin;

use Dadolun\RepeatableWidget\Helper\WidgetSerializer;

/**
 * Class SaveRepeatableItems
 * @package Dadolun\RepeatableWidget\Plugin
 */
class SaveRepeatableItems
{
    /**
     * @var WidgetSerializer
     */
    protected $serializer;

    /**
     * SaveRepeatableItems constructor.
     * @param WidgetSerializer $serializer
     */
    public function __construct(
        WidgetSerializer $serializer
    )
    {
        $this->serializer = $serializer;
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
    ) {
        foreach ($params as $name => $value) {
            if (strpos($name, 'repeatable_') !== false) {
                $params[$name] = $this->serializer->serialize($value);
            }
        }
        return [$type, $params, $asIs];
    }
}
