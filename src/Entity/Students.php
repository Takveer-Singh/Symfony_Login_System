<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Admission_Number;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;


    #[ORM\ManyToOne(targetEntity: Classes::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $ClassId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdmissionNumber(): ?int
    {
        return $this->Admission_Number;
    }

    public function setAdmissionNumber(int $Admission_Number): self
    {
        $this->Admission_Number = $Admission_Number;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getClassId(): ?Classes
    {
        return $this->ClassId;
    }

    public function setClassId(?Classes $ClassId): self
    {
        $this->ClassId = $ClassId;

        return $this;
    }
}
