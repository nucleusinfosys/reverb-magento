<?php
/**
 * Author: Sean Dunagan
 * Created: 8/22/15
 */

abstract class Reverb_ReverbSync_Model_Mysql4_Task extends Mage_Core_Model_Mysql4_Abstract
{
    abstract public function getTaskCode();

    public function _construct()
    {
        $this->_init('reverb_process_queue/task','task_id');
    }

    public function deleteAllTasks()
    {
        $task_code = $this->getTaskCode();
        if (empty($task_code))
        {
            // Should never happen
            return 0;
        }
        $where_condition_array = array('code=?' => $task_code);
        $rows_deleted = $this->_getWriteAdapter()->delete($this->getMainTable(), $where_condition_array);
        return $rows_deleted;
    }

    protected function _getInsertColumnsArray()
    {
        return array('code', 'status', 'object', 'method', 'serialized_arguments_object');
    }

    protected function _getInsertDataArrayTemplate($object, $method)
    {
        $task_code = $this->getTaskCode();
        return array(
            'code' => $task_code,
            'status' => Reverb_ProcessQueue_Model_Task::STATUS_PENDING,
            'object' => $object,
            'method' => $method
        );
    }
}
