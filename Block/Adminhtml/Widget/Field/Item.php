<?php
/**
 * @package     Dadolun_RepeatableWidget
 * @copyright   Copyright (c) 2021 Dadolun (https://github.com/dadolun95)
 * @license     Open Source License
 */
namespace Dadolun\RepeatableWidget\Block\Adminhtml\Widget\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Item
 * @package Dadolun\RepeatableWidget\Block\Adminhtml\Widget\Field
 */
class Item extends AbstractFieldArray
{

    /**
     * Prepare to render block
     */
    protected function _prepareToRender()
    {
        $this->addColumn(
            'name',
            [
                'label' => __('Name'),
                'id' => 'name',
                'class' => 'name',
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row)
    {
        $options = [];

        $name = $row->getName();
        if ($name !== null) {
            $options['option_' . $this->calcOptionHash($name)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @param $optionValue
     * @return string
     */
    private function calcOptionHash($optionValue)
    {
        return sprintf('%u', crc32($optionValue));
    }

}
