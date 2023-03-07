<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;

abstract class AbstractForm extends Form implements InputFilterProviderInterface
{
}
