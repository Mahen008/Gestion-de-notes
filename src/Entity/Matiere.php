<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 * @ApiResource(formats={"json"},normalizationContext={"groups"={"matiere_read"}})
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"matiere_read","notes_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8)
     *  @Groups({"matiere_read","notes_read"})
     */
    private $codeMat;

    /**
     * @ORM\Column(type="string", length=60)
     *  @Groups({"matiere_read","notes_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     *  @Groups({"matiere_read","notes_read"})
     */
    private $coef;

    /**
     * @ORM\OneToMany(targetEntity=Notes::class, mappedBy="codeMat")
     * @Groups({"matiere_read"})
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

    public function getCodeMat(): ?string
    {
        return $this->codeMat;
    }

    public function setCodeMat(string $codeMat): self
    {
        $this->codeMat = $codeMat;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCoef(): ?int
    {
        return $this->coef;
    }

    public function setCoef(int $coef): self
    {
        $this->coef = $coef;

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
            $note->setCodeMat($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getCodeMat() === $this) {
                $note->setCodeMat(null);
            }
        }

        return $this;
    }

    public function getA()
    {
        return $this->notes->toArray();
    }

    // public function getNotePonderee() : float
    // {
    //     $noteP = array_reduce($this->notes->toArray(),function($notePonderee,$note)
    //         {
    //             return ($notePonderee + $note->getNote())*$this->$coef;
    //         },0);
    //     return $noteP;
    // }
}
