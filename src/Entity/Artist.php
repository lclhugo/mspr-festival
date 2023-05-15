<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'artistId', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\ManyToMany(targetEntity: MusicGenre::class, inversedBy: 'artists')]
    private Collection $musicgenres;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->musicgenres = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setArtistId($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getArtistId() === $this) {
                $event->setArtistId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MusicGenre>
     */
    public function getMusicgenres(): Collection
    {
        return $this->musicgenres;
    }

    public function addMusicgenre(MusicGenre $musicgenre): self
    {
        if (!$this->musicgenres->contains($musicgenre)) {
            $this->musicgenres->add($musicgenre);
        }

        return $this;
    }

    public function removeMusicgenre(MusicGenre $musicgenre): self
    {
        $this->musicgenres->removeElement($musicgenre);

        return $this;
    }
}
