<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $ClassName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassName(): ?string
    {
        return $this->ClassName;
    }

    public function setClassName(string $ClassName): self
    {
        $this->ClassName = $ClassName;

        return $this;
    }
}
