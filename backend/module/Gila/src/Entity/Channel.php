<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Entity\Channel\EmailChannel;
use Gila\Entity\Channel\PushChannel;
use Gila\Entity\Channel\SmsChannel;
use Gila\Entity\Channel\Status;
use Gila\Repository\ChannelRepo;

#[ORM\Table(name: 'channel')]
#[ORM\Entity(repositoryClass: ChannelRepo::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: Types::STRING)]
#[ORM\DiscriminatorMap([
    'email' => EmailChannel::class,
    'sms'   => SmsChannel::class,
    'push'  => PushChannel::class,
])]
abstract class Channel
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: Types::STRING, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(name: 'status', type: Types::INTEGER, nullable: false, enumType: Status::class)]
    private ?Status $status = null;

    public function __construct()
    {
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
     * @param string $name
     * @return Channel
     */
    public function setName(string $name)
    : Channel
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
     * @param \Gila\Entity\Channel\Status $status
     * @return Channel
     */
    public function setStatus(Status $status)
    : Channel
    {
        $this->status = $status;

        return $this;
    }

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
}
