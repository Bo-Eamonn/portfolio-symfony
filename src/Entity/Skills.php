<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 */
class Skills
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
    private $Skill_Name;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $percentage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $learning;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkillName(): ?string
    {
        return $this->Skill_Name;
    }

    public function setSkillName(string $Skill_Name): self
    {
        $this->Skill_Name = $Skill_Name;

        return $this;
    }

    public function getPercentage(): ?string
    {
        return $this->percentage;
    }

    public function setPercentage(string $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getLearning(): ?bool
    {
        return $this->learning;
    }

    public function setLearning(bool $learning): self
    {
        $this->learning = $learning;

        return $this;
    }
}
