<?php

namespace App\Backend\Statistics\Infrastructe\Serializer;

use App\Backend\Statistics\Domain\Interfaces\SerializerDeserializeInterface;
use JMS\Serializer\SerializerInterface;

final class JsonSerializerDeserialize implements SerializerDeserializeInterface {

    private $serializer;

    public function __construct(SerializerInterface $serializer) {


        $this->serializer = $serializer;
    }

    public function deserialize($data, $objetClassType) {


        return $this->serializer->deserialize($data, $objetClassType, "json");
    }

    public function serialize($data) {

        return $this->serializer->serialize($data, "json");
    }

}
