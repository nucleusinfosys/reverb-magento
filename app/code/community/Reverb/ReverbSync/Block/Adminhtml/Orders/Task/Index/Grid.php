<?php
/**
 * Author: Sean Dunagan
 * Created: 9/16/15
 */

class Reverb_ReverbSync_Block_Adminhtml_Orders_Task_Index_Grid
    extends Reverb_ProcessQueue_Block_Adminhtml_Task_Index_Grid
{
    public function setCollection($collection)
    {
        $collection->addCodeFilter($this->_getCodeToFilterBy());
        parent::setCollection($collection);
    }

    protected function _getCodeToFilterBy()
    {
        return 'order_update';
    }
}