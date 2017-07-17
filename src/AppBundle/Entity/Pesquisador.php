<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pesquisador
 *
 * @ORM\Table(name="pesquisador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PesquisadorRepository")
 */
class Pesquisador
{
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
     * @ORM\Column(name="nome_completo", type="string", length=255)
     */
    private $nomeCompleto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_em_citacoes", type="string", length=255)
     */
    private $nomeEmCitacoes;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidade", type="string", length=255)
     */
    private $nacionalidade;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FormacaoAcademica", mappedBy="pesquisador")
     */
    private $formacaoAcademica;


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
     * Set nomeCompleto
     *
     * @param string $nomeCompleto
     *
     * @return Pesquisador
     */
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;

        return $this;
    }

    /**
     * Get nomeCompleto
     *
     * @return string
     */
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * Set nomeEmCitacoes
     *
     * @param string $nomeEmCitacoes
     *
     * @return Pesquisador
     */
    public function setNomeEmCitacoes($nomeEmCitacoes)
    {
        $this->nomeEmCitacoes = $nomeEmCitacoes;

        return $this;
    }

    /**
     * Get nomeEmCitacoes
     *
     * @return string
     */
    public function getNomeEmCitacoes()
    {
        return $this->nomeEmCitacoes;
    }

    /**
     * Set nacionalidade
     *
     * @param string $nacionalidade
     *
     * @return Pesquisador
     */
    public function setNacionalidade($nacionalidade)
    {
        $this->nacionalidade = $nacionalidade;

        return $this;
    }

    /**
     * Get nacionalidade
     *
     * @return string
     */
    public function getNacionalidade()
    {
        return $this->nacionalidade;
    }
}

