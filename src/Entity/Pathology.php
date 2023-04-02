<?php

namespace App\Entity;

use App\Repository\PathologyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PathologyRepository::class)]
class Pathology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Diagnosis::class, mappedBy: 'pathologies')]
    private Collection $diagnoses;

    public function __construct()
    {
        $this->diagnoses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Diagnosis>
     */
    public function getDiagnoses(): Collection
    {
        return $this->diagnoses;
    }

    public function addDiagnosis(Diagnosis $diagnosis): self
    {
        if (!$this->diagnoses->contains($diagnosis)) {
            $this->diagnoses->add($diagnosis);
            $diagnosis->addPathology($this);
        }

        return $this;
    }

    public function removeDiagnosis(Diagnosis $diagnosis): self
    {
        if ($this->diagnoses->removeElement($diagnosis)) {
            $diagnosis->removePathology($this);
        }

        return $this;
    }
    function __toString(){
        return $this->name ;
    }
}
