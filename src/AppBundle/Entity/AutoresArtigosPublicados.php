<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoresArtigosPublicados
 *
 * @ORM\Table(name="autores_artigos_publicados")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutoresArtigosPublicadosRepository")
 */
class AutoresArtigosPublicados
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
     * @ORM\Column(name="nomeCompletoDoAutor", type="string", length=255, nullable=true)
     */
    private $nomeCompletoDoAutor;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeParaCitacao", type="string", length=255, nullable=true)
     */
    private $nomeParaCitacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ordemDeAutoria", type="string", length=255, nullable=true)
     */
    private $ordemDeAutoria;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtigosPublicados", inversedBy="autores")
     * @ORM\JoinColumn(name="trabalho_id", referencedColumnName="id")
     */
    private $trabalho;


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
     * Set nomeCompletoDoAutor
     *
     * @param string $nomeCompletoDoAutor
     *
     * @return AutoresArtigosPublicados
     */
    public function setNomeCompletoDoAutor($nomeCompletoDoAutor)
    {
        $this->nomeCompletoDoAutor = $nomeCompletoDoAutor;

        return $this;
    }

    /**
     * Get nomeCompletoDoAutor
     *
     * @return string
     */
    public function getNomeCompletoDoAutor()
    {
        return $this->nomeCompletoDoAutor;
    }

    /**
     * Set nomeParaCitacao
     *
     * @param string $nomeParaCitacao
     *
     * @return AutoresArtigosPublicados
     */
    public function setNomeParaCitacao($nomeParaCitacao)
    {
        $this->nomeParaCitacao = $nomeParaCitacao;

        return $this;
    }

    /**
     * Get nomeParaCitacao
     *
     * @return string
     */
    public function getNomeParaCitacao()
    {
        return $this->nomeParaCitacao;
    }

    /**
     * Set ordemDeAutoria
     *
     * @param string $ordemDeAutoria
     *
     * @return AutoresArtigosPublicados
     */
    public function setOrdemDeAutoria($ordemDeAutoria)
    {
        $this->ordemDeAutoria = $ordemDeAutoria;

        return $this;
    }

    /**
     * Get ordemDeAutoria
     *
     * @return string
     */
    public function getOrdemDeAutoria()
    {
        return $this->ordemDeAutoria;
    }

    /**
     * @return mixed
     */
    public function getTrabalho()
    {
        return $this->trabalho;
    }

    /**
     * @param mixed $trabalho
     */
    public function setTrabalho($trabalho)
    {
        $this->trabalho = $trabalho;
    }
}

