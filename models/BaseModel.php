<?php

abstract class BaseModel extends CModel {

    private $_attributes = array();

    public function __sleep() {
        return array_keys((array) $this);
    }

    public function __get($name) {
        $attrs = $this->attributeNames();
        if (isset($this->_attributes[$name]))
            return $this->_attributes[$name];
        else if (in_array($name, $attrs))
            return null;
        else
            return parent::__get($name);
    }

    public function __set($name, $value) {
        if ($this->setAttribute($name, $value) === false) {
            parent::__set($name, $value);
        }
    }

    public function __isset($name) {
        $attrs = $this->attributeNames();
        if (isset($this->_attributes[$name]))
            return true;
        else if (in_array($name, $attrs))
            return true;
        else
            return parent::__isset($name);
    }

    public function __unset($name) {
        $attrs = $this->attributeNames();
        if (in_array($name, $attrs))
            unset($this->_attributes[$name]);
        else
            parent::__unset($name);
    }

    public function setAttribute($name, $value) {
        $attrs = $this->attributeNames();
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } elseif (in_array($name, $attrs)) {
            $this->_attributes[$name] = $value;
        } else
            return false;
        return true;
    }

}
