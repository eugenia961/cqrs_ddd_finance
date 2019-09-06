<?php

namespace App\Backend\Statistics\Domain\Interfaces;

interface SerializerDeserializeInterface {

    public function deserialize($data, $objetClassType);

    public function serialize($data);
}
