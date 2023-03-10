<?php
declare(strict_types=1);

namespace API\V1\Rest\Message;

use Gila\Entity\Category;
use Gila\Entity\Message\Status;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\ArraySerializableInterface;

class MessageEntity implements ArraySerializableInterface
{
    private ?int $id = null;
    private ?string $text = null;
    private ?\DateTimeImmutable $createdAt = null;
    private ?\DateTime $updatedAt = null;
    private ?\DateTimeImmutable $deliveredAt = null;
    private ?Status $status = null;
    private ?Category $category = null;

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
            'created_at'   => $this->getCreatedAt(),
            'updated_at'   => $this->getDeliveredAt(),
            'text'         => $this->getText(),
            'delivered_at' => $this->getDeliveredAt(),
            'status'       => $this->getStatus()?->name,
            'category'     => $this->getCategory()?->getArrayCopy(),
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
     * Get CreatedAt
     *
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt()
    : ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Set CreatedAt
     *
     * @param \DateTimeImmutable|null $createdAt
     * @return MessageEntity
     */
    public function setCreatedAt(?\DateTimeImmutable $createdAt)
    : MessageEntity
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get UpdatedAt
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    : ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Set UpdatedAt
     *
     * @param \DateTime|null $updatedAt
     * @return MessageEntity
     */
    public function setUpdatedAt(?\DateTime $updatedAt)
    : MessageEntity
    {
        $this->updatedAt = $updatedAt;

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
     * @return \Gila\Entity\Category|null
     */
    public function getCategory()
    : ?Category
    {
        return $this->category;
    }

    /**
     * Set Broadcast
     *
     * @param \Gila\Entity\Category|null $category
     * @return MessageEntity
     */
    public function setCategory(?Category $category)
    : MessageEntity
    {
        $this->category = $category;

        return $this;
    }
}
