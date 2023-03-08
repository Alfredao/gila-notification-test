<?php
declare(strict_types=1);

namespace API\V1\Rest\UserMessage;

use Gila\Entity\Category;
use Gila\Entity\Message;
use Gila\Entity\Message\Status;
use Gila\Entity\Subscription;
use Gila\Entity\User;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\ArraySerializableInterface;

class UserMessageEntity implements ArraySerializableInterface
{
    private ?int $id = null;
    private ?\DateTimeImmutable $createdAt = null;
    private ?\DateTime $updatedAt = null;
    private ?User $user = null;
    private ?Message $message = null;
    private ?Subscription $subscription = null;

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
            'updated_at'   => $this->getUpdatedAt(),
            'user'         => $this->getUser()?->getArrayCopy(),
            'message'      => $this->getMessage()?->getArrayCopy(),
            'subscription' => $this->getSubscription()?->getArrayCopy(),
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
     * @return UserMessageEntity
     */
    public function setId(?int $id)
    : UserMessageEntity
    {
        $this->id = $id;

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
     * @return UserMessageEntity
     */
    public function setCreatedAt(?\DateTimeImmutable $createdAt)
    : UserMessageEntity
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
     * @return UserMessageEntity
     */
    public function setUpdatedAt(?\DateTime $updatedAt)
    : UserMessageEntity
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get User
     *
     * @return \Gila\Entity\User|null
     */
    public function getUser()
    : ?User
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param \Gila\Entity\User|null $user
     * @return UserMessageEntity
     */
    public function setUser(?User $user)
    : UserMessageEntity
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get Message
     *
     * @return \Gila\Entity\Message|null
     */
    public function getMessage()
    : ?Message
    {
        return $this->message;
    }

    /**
     * Set Message
     *
     * @param \Gila\Entity\Message|null $message
     * @return UserMessageEntity
     */
    public function setMessage(?Message $message)
    : UserMessageEntity
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get Subscription
     *
     * @return \Gila\Entity\Subscription|null
     */
    public function getSubscription()
    : ?Subscription
    {
        return $this->subscription;
    }

    /**
     * Set Subscription
     *
     * @param \Gila\Entity\Subscription|null $subscription
     * @return UserMessageEntity
     */
    public function setSubscription(?Subscription $subscription)
    : UserMessageEntity
    {
        $this->subscription = $subscription;

        return $this;
    }
}
