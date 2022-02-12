<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PokemonRepository::class)
 */
class Pokemon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Type::class, inversedBy="evolvedFrom")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class, inversedBy="evolvedTo")
     */
    private $evolvedFrom;

    /**
     * @ORM\OneToMany(targetEntity=Pokemon::class, mappedBy="evolvedFrom")
     */
    private $evolvedTo;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->evolvedTo = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function __toString(){
        return $this->name;
    }
    
    /**
     * @return Collection|Type[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Type $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->type->removeElement($type);

        return $this;
    }

    public function getEvolvedFrom(): ?self
    {
        return $this->evolvedFrom;
    }

    public function setEvolvedFrom(?self $evolvedFrom): self
    {
        $this->evolvedFrom = $evolvedFrom;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEvolvedTo(): Collection
    {
        return $this->evolvedTo;
    }

    public function addEvolvedTo(self $evolvedTo): self
    {
        if (!$this->evolvedTo->contains($evolvedTo)) {
            $this->evolvedTo[] = $evolvedTo;
            $evolvedTo->setEvolvedFrom($this);
        }

        return $this;
    }

    public function removeEvolvedTo(self $evolvedTo): self
    {
        if ($this->evolvedTo->removeElement($evolvedTo)) {
            // set the owning side to null (unless already changed)
            if ($evolvedTo->getEvolvedFrom() === $this) {
                $evolvedTo->setEvolvedFrom(null);
            }
        }

        return $this;
    }
}
