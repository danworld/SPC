<?php

class Default_Model_SpcMapper
{
    protected $_db_table;

    public function setDbTable($db_table)
    {
        if (is_string($db_table)) {
            $db_table = new $db_table();
        }
        if (!$db_table instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_db_table = $db_table;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_db_table) {
            $this->setDbTable('Default_Model_DbTable_Spc');
        }
        return $this->_db_table;
    }

    public function save(Default_Model_Spc $spc)
    {
        $data = array(
            'password' => $spc->getPassword(),
            'hitcount' => $spc->getHitcount()
        );

        if (null === ($pid = $spc->getPid())) {
            unset($data['pid']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('pid = ?' => $pid));
        }
    }

    public function find($id, Default_Model_Spc $spc)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $spc->setPid($row->pid)
            ->setPassword($row->password)
            ->setHitcount($row->hitcount);
    }

    public function fetchAll()
    {
        $result_set = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($result_set as $row) {
            $entry = new Default_Model_Spc();
            $entry->setPid($row->pid)
                  ->setPassword($row->password)
                  ->setHitcount($row->hitcount)
                  ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
}

?>
