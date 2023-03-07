<?php
declare(strict_types=1);

namespace API\V1\Rest\Broadcast;

use Gila\Entity\Category;
use Gila\Entity\Channel;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\ArraySerializableInterface;

class BroadcastEntity implements ArraySerializableInterface
{
    private ?int $id = null;
    private ?Channel $channel = null;
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
            'id'       => $this->getId(),
            'channel'  => $this->getChannel()?->getArrayCopy(),
            'category' => $this->getCategory()?->getArrayCopy(),
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
     * @return BroadcastEntity
     */
    public function setId(?int $id)
    : BroadcastEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Channel
     *
     * @return \Gila\Entity\Channel|null
     */
    public function getChannel()
    : ?Channel
    {
        return $this->channel;
    }

    /**
     * Set Channel
     *
     * @param \Gila\Entity\Channel|null $channel
     * @return BroadcastEntity
     */
    public function setChannel(?Channel $channel)
    : BroadcastEntity
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get Category
     *
     * @return \Gila\Entity\Category|null
     */
    public function getCategory()
    : ?Category
    {
        return $this->category;
    }

    /**
     * Set Category
     *
     * @param \Gila\Entity\Category|null $category
     * @return BroadcastEntity
     */
    public function setCategory(?Category $category)
    : BroadcastEntity
    {
        $this->category = $category;

        return $this;
    }
}
