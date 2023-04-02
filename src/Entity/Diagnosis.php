<?php

namespace App\Entity;

use App\Repository\DiagnosisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiagnosisRepository::class)]
class Diagnosis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedia = null;

    #[ORM\ManyToMany(targetEntity: Pathology::class, inversedBy: 'diagnoses')]
    private Collection $pathologies;

    #[ORM\ManyToOne(inversedBy: 'diagnosis')]
    private ?Paciente $paciente = null;

    public function __construct()
    {
        $this->pathologies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedia(): ?\DateTimeInterface
    {
        return $this->datedia;
    }

    public function setDatedia(\DateTimeInterface $datedia): self
    {
        $this->datedia = $datedia;

        return $this;
    }

    /**
     * @return Collection<int, Pathology>
     */
    public function getPathologies(): Collection
    {
        return $this->pathologies;
    }

    public function addPathology(Pathology $pathology): self
    {
        if (!$this->pathologies->contains($pathology)) {
            $this->pathologies->add($pathology);
        }

        return $this;
    }

    public function removePathology(Pathology $pathology): self
    {
        $this->pathologies->removeElement($pathology);

        return $this;
    }

    public function getPaciente(): ?Paciente
    {
        return $this->paciente;
    }

    public function setPaciente(?Paciente $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }
}
