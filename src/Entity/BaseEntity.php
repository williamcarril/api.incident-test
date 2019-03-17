<?php

namespace App\Entity;

class BaseEntity implements \JsonSerializable {

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
