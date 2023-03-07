<?php
declare(strict_types=1);

namespace Gila\Entity;

use AclAuth\Entity\User;
use AclAuth\Repository\UserRepo;
use Application\Entity\Traits\Timestamping\TimestampableTrait;
use Core\Entity\Currency;
use Core\Entity\Wallet;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gila\Entity\Payment\Status;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Table(name: 'payment')]
#[ORM\Entity(repositoryClass: UserRepo::class)]
#[ORM\HasLifecycleCallbacks]
class Payment
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid', unique: true, nullable: false)]
    protected ?UuidInterface $uuid = null;

    #[ORM\Column(name: 'price_amount', type: Types::DECIMAL, precision: 12, scale: 4, nullable: false)]
    private ?string $priceAmount = null;

    #[ORM\Column(name: 'pay_amount', type: Types::DECIMAL, precision: 12, scale: 8, nullable: false)]
    private ?string $payAmount = null;

    #[ORM\Column(name: 'expires', type: Types::DATETIME_MUTABLE, nullable: false)]
    private ?DateTime $expires = null;

    #[ORM\Column(name: 'status', type: Types::INTEGER, enumType: Status::class)]
    private ?Status $status = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Wallet::class)]
    #[ORM\JoinColumn(name: 'wallet_id', referencedColumnName: 'id')]
    private ?Wallet $wallet = null;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(name: 'price_currency_id', referencedColumnName: 'id')]
    private ?Currency $priceCurrency = null;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(name: 'pay_currency_id', referencedColumnName: 'id')]
    private ?Currency $payCurrency = null;

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
     * Get Uuid
     *
     * @return \Ramsey\Uuid\UuidInterface|null
     */
    public function getUuid()
    : ?UuidInterface
    {
        return $this->uuid;
    }

    /**
     * Set Uuid
     *
     * @param \Ramsey\Uuid\UuidInterface $uuid
     * @return Payment
     */
    public function setUuid(UuidInterface $uuid)
    : Payment
    {
        $this->uuid = $uuid;

        return $this;
    }

    #[ORM\PrePersist]
    public function createUuid()
    : self
    {
        $this->uuid = Uuid::uuid4();

        return $this;
    }

    /**
     * Get Expires
     *
     * @return \DateTime|null
     */
    public function getExpires()
    : ?DateTime
    {
        return $this->expires;
    }

    /**
     * Set Expires
     *
     * @param \DateTime $expires
     * @return Payment
     */
    public function setExpires(DateTime $expires)
    : Payment
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \Gila\Entity\Payment\Status|null
     */
    public function getStatus()
    : ?Status
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param \Gila\Entity\Payment\Status $status
     * @return Payment
     */
    public function setStatus(Status $status)
    : Payment
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get User
     *
     * @return \AclAuth\Entity\User|null
     */
    public function getUser()
    : ?User
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param \AclAuth\Entity\User $user
     * @return Payment
     */
    public function setUser(User $user)
    : Payment
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get PriceAmount
     *
     * @return string|null
     */
    public function getPriceAmount()
    : ?string
    {
        return $this->priceAmount;
    }

    /**
     * Set PriceAmount
     *
     * @param string $priceAmount
     * @return Payment
     */
    public function setPriceAmount(string $priceAmount)
    : Payment
    {
        $this->priceAmount = $priceAmount;

        return $this;
    }

    /**
     * Get PayAmount
     *
     * @return string|null
     */
    public function getPayAmount()
    : ?string
    {
        return $this->payAmount;
    }

    /**
     * Set PayAmount
     *
     * @param string $payAmount
     * @return Payment
     */
    public function setPayAmount(string $payAmount)
    : Payment
    {
        $this->payAmount = $payAmount;

        return $this;
    }

    /**
     * Get PriceCurrency
     *
     * @return \AclAuth\Entity\User|null
     */
    public function getPriceCurrency()
    : ?Currency
    {
        return $this->priceCurrency;
    }

    /**
     * Set PriceCurrency
     *
     * @param \Core\Entity\Currency $priceCurrency
     * @return Payment
     */
    public function setPriceCurrency(Currency $priceCurrency)
    : Payment
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    /**
     * Get PayCurrency
     *
     * @return \Core\Entity\Currency|null
     */
    public function getPayCurrency()
    : ?Currency
    {
        return $this->payCurrency;
    }

    /**
     * Set PayCurrency
     *
     * @param \Core\Entity\Currency $payCurrency
     * @return Payment
     */
    public function setPayCurrency(Currency $payCurrency)
    : Payment
    {
        $this->payCurrency = $payCurrency;

        return $this;
    }

    /**
     * Get Wallet
     *
     * @return \Core\Entity\Wallet|null
     */
    public function getWallet()
    : ?Wallet
    {
        return $this->wallet;
    }

    /**
     * Set Wallet
     *
     * @param \Core\Entity\Wallet $wallet
     * @return Payment
     */
    public function setWallet(Wallet $wallet)
    : Payment
    {
        $this->wallet = $wallet;

        return $this;
    }
}
