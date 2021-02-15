<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
 */
class School
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $School_name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $education;

    /**
     * @ORM\Column(type="text")
     */
    private $about;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchoolName(): ?string
    {
        return $this->School_name;
    }

    public function setSchoolName(string $School_name): self
    {
        $this->School_name = $School_name;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(?string $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(string $about): self
    {
        $this->about = $about;

        return $this;
    }
}
