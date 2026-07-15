<?php

namespace App\Entity;

use App\Repository\LignesCommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LignesCommandeRepository::class)]
class LignesCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lignesCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $commande = null;

    #[ORM\ManyToOne(inversedBy: 'lignesCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?articles $article = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $quantité = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $prixUnitaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?Commandes
    {
        return $this->commande;
    }

    public function setCommande(?Commandes $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    public function getArticle(): ?articles
    {
        return $this->article;
    }

    public function setArticle(?articles $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(int $quantité): static
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }
}
