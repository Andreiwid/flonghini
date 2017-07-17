<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrauDeFormacao
 *
 * @ORM\Table(name="grau_de_formacao")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrauDeFormacaoRepository")
 */
class GrauDeFormacao
{

    const BACHARELADO = 'Bacharelado';
    const MESTRADO = 'Mestrado';
    const DOUTORADO = 'Doutorado';


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="grau", type="string", length=255)
     */
    private $grau;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grau
     *
     * @param string $grau
     *
     * @return GrauDeFormacao
     */
    public function setGrau($grau)
    {
        $this->grau = $grau;

        return $this;
    }

    /**
     * Get grau
     *
     * @return string
     */
    public function getGrau()
    {
        return $this->grau;
    }
}

