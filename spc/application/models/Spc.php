<?php

class Default_Model_Spc
{
    protected $_pid;
    protected $_password;
    protected $_hitcount;
    protected $_mapper;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set'.$name;
        if ($name == 'mapper' || !method_exists($this, $method)) {
            throw new Exception('Invalid spc property');
        }
        $this->$method();
    }

    public function __get($name)
    {
        $method = 'get'.$name;
        if ($name == 'mapper' || !method_exists($this, $method)) {
            throw new Exception('Invalid spc property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setPid($pid)
    {
        $this->_pid = (int) $pid;
        return $this;
    }

    public function getPid()
    {
        return $this->_pid;
    }

    public function setPassword($password)
    {
        $this->_password = (string) $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setHitcount($hitcount)
    {
        $this->_hitcount = (int) $hitcount;
        return $this;
    }

    public function getHitcount()
    {
        return $this->_hitcount;
    }

    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Default_Model_SpcMapper());
        }
        return $this->_mapper;
    }

    public function save()
    {
        $this->getMapper()->save($this);
    }

    public function find($pid)
    {
        $this->getMapper()->find($pid, $this);
        return $this;
    }

    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }

}

?>
