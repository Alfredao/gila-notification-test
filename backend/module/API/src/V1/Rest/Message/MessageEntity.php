<?php
declare(strict_types=1);

namespace API\V1\Rest\Message;

use Gila\Entity\Broadcast;
use Gila\Entity\Message\Status;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\ArraySerializableInterface;

class MessageEntity implements ArraySerializableInterface
{
    private ?int $id = null;
    private ?string $text = null;
    private ?\DateTimeImmutable $deliveredAt = null;
    private ?Status $status = null;
    private ?Broadcast $broadcast = null;

    /**
     * Get array copy
     *
     * @return array
     */
    public function getArrayCopy()
    : array
    {
        return [
            'id'           => $this->getId(),
            'text'         => $this->getText(),
            'delivered_at' => $this->getDeliveredAt(),
            'status'       => $this->getStatus()->name,
            'broadcast'    => [
                'category' => $this->getBroadcast()?->getCategory()?->getName(),
                'channel'  => $this->getBroadcast()?->getChannel()?->getName(),
            ],

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
     * @return MessageEntity
     */
    public function setId(?int $id)
    : MessageEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Text
     *
     * @return string|null
     */
    public function getText()
    : ?string
    {
        return $this->text;
    }

    /**
     * Set Text
     *
     * @param string|null $text
     * @return MessageEntity
     */
    public function setText(?string $text)
    : MessageEntity
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get DeliveredAt
     *
     * @return \DateTimeImmutable|null
     */
    public function getDeliveredAt()
    : ?\DateTimeImmutable
    {
        return $this->deliveredAt;
    }

    /**
     * Set DeliveredAt
     *
     * @param \DateTimeImmutable|null $deliveredAt
     * @return MessageEntity
     */
    public function setDeliveredAt(?\DateTimeImmutable $deliveredAt)
    : MessageEntity
    {
        $this->deliveredAt = $deliveredAt;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \Gila\Entity\Message\Status|null
     */
    public function getStatus()
    : ?Status
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param \Gila\Entity\Message\Status|null $status
     * @return MessageEntity
     */
    public function setStatus(?Status $status)
    : MessageEntity
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get Broadcast
     *
     * @return \Gila\Entity\Broadcast|null
     */
    public function getBroadcast()
    : ?Broadcast
    {
        return $this->broadcast;
    }

    /**
     * Set Broadcast
     *
     * @param \Gila\Entity\Broadcast|null $broadcast
     * @return MessageEntity
     */
    public function setBroadcast(?Broadcast $broadcast)
    : MessageEntity
    {
        $this->broadcast = $broadcast;

        return $this;
    }
}
