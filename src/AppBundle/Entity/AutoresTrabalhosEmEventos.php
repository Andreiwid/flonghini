<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoresTrabalhosEmEventos
 *
 * @ORM\Table(name="autores_trabalhos_em_eventos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutoresTrabalhosEmEventosRepository")
 */
class AutoresTrabalhosEmEventos
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TrabalhosEmEventos", inversedBy="autores")
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set nomeCompletoDoAutor
     *
     * @param string $nomeCompletoDoAutor
     *
     * @return AutoresTrabalhosEmEventos
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
     * @return AutoresTrabalhosEmEventos
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
     * @return AutoresTrabalhosEmEventos
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

