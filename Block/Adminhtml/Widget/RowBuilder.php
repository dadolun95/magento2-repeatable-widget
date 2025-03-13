<?php
/**
 * @package     Dadolun_RepeatableWidget
 * @copyright   Copyright (c) 2021 Dadolun (https://github.com/dadolun95)
 * @license     Open Source License
 */

declare(strict_types=1);

namespace Dadolun\RepeatableWidget\Block\Adminhtml\Widget;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Dadolun\RepeatableWidget\Helper\WidgetSerializer;

/**
 * Class RowBuilder
 * @package Dadolun\RepeatableWidget\Block\Adminhtml\Widget
 */
class RowBuilder extends AbstractFieldArray
{

    /**
     * @param Context $context
     * @param WidgetSerializer $serializer
     * @param array $data
     */
    public function __construct(
        protected Context $context,
        protected WidgetSerializer $serializer,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];

        $name = $row->getName();
        if ($name !== null) {
            $options['option_' . $this->getStatusRenderer()->calcOptionHash($name)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @param AbstractElement $element
     * @return AbstractElement
     * @throws LocalizedException
     */
    public function prepareElementHtml(AbstractElement $element): AbstractElement
    {
        $uniqId = $this->mathRandom->getUniqueHash($element->getId());

        if ($element->getData('value') && $element->getData('value') !== '') {
            $element->setData('value', $this->serializer->unserialize($element->getData('value')));
        }

        $repeater = $this->getLayout()->createBlock(
            \Dadolun\RepeatableWidget\Block\Adminhtml\Widget\Field\Item::class
        )->setElement(
            $element
        )->setUniqId(
            $uniqId
        );

        $element->setData('after_element_html', $repeater->toHtml());
        return $element;
    }
}
