<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 * @ApiResource(formats={"json"},normalizationContext={"groups"={"etudiant_read"}})
 * @ApiFilter(SearchFilter::class, properties={"numEt": "exact", "nom": "partial"})
 */
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"etudiant_read","notes_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=9)
     * @Groups({"etudiant_read","notes_read"})
     */
    private $numEt;

    /**
     * @ORM\Column(type="string", length=100)
     *  @Groups({"etudiant_read","notes_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=3)
     *  @Groups({"etudiant_read","notes_read"})
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity=Notes::class, mappedBy="numEt")
     * @Groups({"etudiant_read"})
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEt(): ?string
    {
        return $this->numEt;
    }

    public function setNumEt(string $numEt): self
    {
        $this->numEt = $numEt;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection|Notes[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setNumEt($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getNumEt() === $this) {
                $note->setNumEt(null);
            }
        }

        return $this;
    }
}
