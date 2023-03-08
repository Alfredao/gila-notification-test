<?php
declare(strict_types=1);

namespace Gila\Entity;

use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Repository\UserMessageRepo;

#[ORM\Table(name: 'user_message')]
#[ORM\Entity(repositoryClass: UserMessageRepo::class)]
#[ORM\HasLifecycleCallbacks]
class UserMessage
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Message::class)]
    #[ORM\JoinColumn(name: 'message_id', referencedColumnName: 'id')]
    private ?Message $message = null;

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
     * @param \Gila\Entity\User $user
     * @return UserMessage
     */
    public function setUser(User $user)
    : UserMessage
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
     * @param \Gila\Entity\Message $message
     * @return UserMessage
     */
    public function setMessage(Message $message)
    : UserMessage
    {
        $this->message = $message;

        return $this;
    }
}
