<?php
declare(strict_types=1);

namespace API\V1\Rest\Channel;

use Gila\Entity\Channel\Status;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\ArraySerializableInterface;

class ChannelEntity implements ArraySerializableInterface
{
    private ?int $id = null;
    private ?string $name = null;
    private ?Status $status = null;

    /**
     * Get array copy
     *
     * @return array
     */
    public function getArrayCopy()
    : array
    {
        return [
            'id'     => $this->getId(),
            'name'   => $this->getName(),
            'status' => $this->getStatus()->name,
        ];
    }

    /**
     * Exchange array
     *
     * @param array $array
     * @return void
     */
    public function exchangeArray(array $array)
    : void
    {
        $hydrator = new ClassMethodsHydrator();
        $hydrator->hydrate($array, $this);
    }

    /**
     * Get Id
     *
     * @return int|null
     */
    public function getId()
    : ?int
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param int|null $id
     * @return ChannelEntity
     */
    public function setId(?int $id)
    : ChannelEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName()
    : ?string
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string|null $name
     * @return ChannelEntity
     */
    public function setName(?string $name)
    : ChannelEntity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \Gila\Entity\Channel\Status|null
     */
    public function getStatus()
    : ?Status
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param \Gila\Entity\Channel\Status|null $status
     * @return ChannelEntity
     */
    public function setStatus(?Status $status)
    : ChannelEntity
    {
        $this->status = $status;

        return $this;
    }
}
