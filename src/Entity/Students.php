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


    #[ORM\OneToOne(inversedBy: 'students', targetEntity: Users::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $userId;

    #[ORM\ManyToOne(targetEntity: Classes::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $classId;

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


    public function getUserId(): ?Users
    {
        return $this->userId;
    }

    public function setUserId(Users $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getClassId(): ?Classes
    {
        return $this->classId;
    }

    public function setClassId(?Classes $classId): self
    {
        $this->classId = $classId;

        return $this;
    }
}
