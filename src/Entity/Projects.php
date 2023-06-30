<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectsRepository::class)]
class Projects
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'projects')]
    private Collection $project_user;

    #[ORM\OneToMany(mappedBy: 'projects', targetEntity: Tasks::class)]
    private Collection $task;

    public function __construct()
    {
        $this->project_user = new ArrayCollection();
        $this->task = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    
    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getProjectUser(): Collection
    {
        return $this->project_user;
    }

    public function addProjectUser(User $projectUser): self
    {
        if (!$this->project_user->contains($projectUser)) {
            $this->project_user->add($projectUser);
        }

        return $this;
    }

    public function removeProjectUser(User $projectUser): self
    {
        $this->project_user->removeElement($projectUser);

        return $this;
    }

    /**
     * @return Collection<int, Tasks>
     */
    public function getTask(): Collection
    {
        return $this->task;
    }

    public function addTask(Tasks $task): self
    {
        if (!$this->task->contains($task)) {
            $this->task->add($task);
            $task->setProjects($this);
        }

        return $this;
    }

    public function removeTask(Tasks $task): self
    {
        if ($this->task->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getProjects() === $this) {
                $task->setProjects(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
