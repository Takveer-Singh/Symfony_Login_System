<?php
namespace App\Entity;
use App\Repository\AttendanceRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: AttendanceRepository::class)]
class Attendance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    #[ORM\Column(type: 'string', length: 255)]
    private $Status;
    #[ORM\Column(type: 'date')]
    private $Date;
    #[ORM\ManyToOne(targetEntity: Classes::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Class;
    #[ORM\ManyToOne(targetEntity: Students::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Student;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getStatus(): ?string
    {
        return $this->Status;
    }
    public function setStatus(string $Status): self
    {
        $this->Status = $Status;
        return $this;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }
    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;
        return $this;
    }
    public function getClass(): ?Classes
    {
        return $this->Class;
    }
    public function setClass(?Classes $Class): self
    {
        $this->Class = $Class;
        return $this;
    }
    public function getStudent(): ?Students
    {
        return $this->Student;
    }
    public function setStudent(?Students $Student): self
    {
        $this->Student = $Student;
        return $this;
    }
}