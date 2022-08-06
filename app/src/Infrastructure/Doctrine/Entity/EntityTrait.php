<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

trait EntityTrait
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue()
     */
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
