<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\NotesRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NotesRepository::class)
 * @ApiResource(formats={"json"},normalizationContext={"groups"={"notes_read"}})
 */
class Notes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"notes_read","etudiant_read","matiere_read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"notes_read","matiere_read"})
     */
    private $numEt;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"notes_read","etudiant_read"})
     */
    private $codeMat;

    /**
     * @ORM\Column(type="string", length=9)
     * @Groups({"notes_read","etudiant_read","matiere_read"})
     */
    private $numInscription;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"notes_read","etudiant_read","matiere_read"})
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEt(): ?Etudiant
    {
        return $this->numEt;
    }

    public function setNumEt(?Etudiant $numEt): self
    {
        $this->numEt = $numEt;

        return $this;
    }

    public function getCodeMat(): ?Matiere
    {
        return $this->codeMat;
    }

    public function setCodeMat(?Matiere $codeMat): self
    {
        $this->codeMat = $codeMat;

        return $this;
    }

    public function getNumInscription(): ?string
    {
        return $this->numInscription;
    }

    public function setNumInscription(string $numInscription): self
    {
        $this->numInscription = $numInscription;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }
}
