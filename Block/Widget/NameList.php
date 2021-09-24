<?php
/**
 * @package     Dadolun_RepeatableWidget
 * @copyright   Copyright (c) 2021 Dadolun (https://github.com/dadolun95)
 * @license     Open Source License
 */
namespace Dadolun\RepeatableWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Dadolun\RepeatableWidget\Helper\WidgetSerializer;

/**
 * Class Accordion
 * @package Dadolun\RepeatableWidget\Block\Widget
 */
class NameList extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "widget/name-list.phtml";

    /**
     * @var WidgetSerializer
     */
    protected $serializer;

    /**
     * @var array
     */
    protected $data;

    /**
     * NameList constructor.
     * @param WidgetSerializer $serializer
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        WidgetSerializer $serializer,
        Template\Context $context,
        array $data = []
    )
    {
        $this->data = $data;
        $this->serializer = $serializer;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getItems() {
        $items = [];
        if (!empty($this->data["repeatable_items"])) {
            $items = $this->serializer->unserialize($this->data["repeatable_items"]);
        }
        return $items;
    }
}
