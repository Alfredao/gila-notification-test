<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Entity\User\Status;
use Gila\Repository\UserRepo;

#[ORM\Table(name: 'user')]
#[ORM\Entity(repositoryClass: UserRepo::class)]
#[ORM\HasLifecycleCallbacks]
class User
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: Types::STRING, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(name: 'email', type: Types::STRING, nullable: false)]
    private ?string $email = null;

    #[ORM\Column(name: 'phone_number', type: Types::STRING, nullable: false)]
    private ?string $phoneNumber = null;

    #[ORM\Column(name: 'status', type: Types::INTEGER, nullable: false, enumType: Status::class)]
    private ?Status $status = null;

    #[ORM\ManyToMany(targetEntity: Broadcast::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'subscription')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'broadcast_id', referencedColumnName: 'id')]
    private Collection $subscriptions;

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
     * @return User
     */
    public function setName(string $name)
    : User
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string|null
     */
    public function getEmail()
    : ?string
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param string $email
     * @return User
     */
    public function setEmail(string $email)
    : User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get PhoneNumber
     *
     * @return string|null
     */
    public function getPhoneNumber()
    : ?string
    {
        return $this->phoneNumber;
    }

    /**
     * Set PhoneNumber
     *
     * @param string $phoneNumber
     * @return User
     */
    public function setPhoneNumber(string $phoneNumber)
    : User
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \Gila\Entity\User\Status|null
     */
    public function getStatus()
    : ?Status
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param \Gila\Entity\User\Status $status
     * @return User
     */
    public function setStatus(Status $status)
    : User
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get Subscriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptions()
    : Collection
    {
        return $this->subscriptions;
    }
}
