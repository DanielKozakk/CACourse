<?php

namespace Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Repository\OrangeElepRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrangeElepRepository::class)
 */
class OrangeElep
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
     * @ORM\ManyToOne(targetEntity=OrangeElep::class, inversedBy="onetomany")
     */
    private $orangeElep;

    /**
     * @ORM\OneToMany(targetEntity=OrangeElep::class, mappedBy="orangeElep")
     */
    private $onetomany;

    public function __construct()
    {
        $this->onetomany = new ArrayCollection();
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

    public function getOrangeElep(): ?self
    {
        return $this->orangeElep;
    }

    public function setOrangeElep(?self $orangeElep): self
    {
        $this->orangeElep = $orangeElep;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getOnetomany(): Collection
    {
        return $this->onetomany;
    }

    public function addOnetomany(self $onetomany): self
    {
        if (!$this->onetomany->contains($onetomany)) {
            $this->onetomany[] = $onetomany;
            $onetomany->setOrangeElep($this);
        }

        return $this;
    }

    public function removeOnetomany(self $onetomany): self
    {
        if ($this->onetomany->removeElement($onetomany)) {
            // set the owning side to null (unless already changed)
            if ($onetomany->getOrangeElep() === $this) {
                $onetomany->setOrangeElep(null);
            }
        }

        return $this;
    }
}
