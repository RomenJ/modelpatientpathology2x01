<?php

namespace App\Entity;

use App\Repository\PacienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PacienteRepository::class)]
class Paciente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\OneToMany(mappedBy: 'paciente', targetEntity: Diagnosis::class)]
    private Collection $diagnosis;

    public function __construct()
    {
        $this->diagnosis = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection<int, Diagnosis>
     */
    public function getDiagnosis(): Collection
    {
        return $this->diagnosis;
    }

    public function addDiagnosi(Diagnosis $diagnosi): self
    {
        if (!$this->diagnosis->contains($diagnosi)) {
            $this->diagnosis->add($diagnosi);
            $diagnosi->setPaciente($this);
        }

        return $this;
    }

    public function removeDiagnosi(Diagnosis $diagnosi): self
    {
        if ($this->diagnosis->removeElement($diagnosi)) {
            // set the owning side to null (unless already changed)
            if ($diagnosi->getPaciente() === $this) {
                $diagnosi->setPaciente(null);
            }
        }

        return $this;
    }
    function __toString(){
        return $this->surname.', '.$this->name ;
    }
}
