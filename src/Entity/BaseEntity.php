<?php

namespace App\Entity;

class BaseEntity implements \JsonSerializable {

    private $classPropertyGetters = array();

    public function jsonSerialize() {
        return $this->serializeInternal($this);
    }

    private function serializeInternal($object) {

        $result = $object;

        if (is_object($object)) $result = $this->serializeObject($object);
        if (is_array($object)) $result = $this->serializeArray($object);
        
        return $result;
    }

    private function serializeObject($object) {
        $properties = $this->getClassPropertyGetters($object);

        $data = array();
        foreach ($properties as $name => $property) {
            $data[$name] = $this->serializeInternal($object->$property());
        }
        
        return $data;
    }

    private function serializeArray($array) {

        $result = array();
        foreach ($array as $key => $value) {
            $result[$key] = $this->serializeInternal($value);
        }
        
        return $result;
    }  

    private function getClassPropertyGetters($object) {

        $className = get_class($object);
        if (!isset($this->classPropertyGetters[$className])) {
            $reflector = new \ReflectionClass($className);
            $properties = $reflector->getProperties();
            $getters = array();

            foreach ($properties as $property) {
                $name = $property->getName();
                $getter = "get" . ucfirst($name);

                try {
                    $reflector->getMethod($getter);
                    $getters[$name] = $getter;
                } catch (\Exception $e) {
                    // if no getter for a specific property - ignore it
                }
            }

            $this->classPropertyGetters[$className] = $getters;
        }

        return $this->classPropertyGetters[$className];
    }

}
