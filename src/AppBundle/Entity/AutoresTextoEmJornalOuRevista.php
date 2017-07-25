<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoresTextoEmJornalOuRevista
 *
 * @ORM\Table(name="autores_texto_em_jornal_ou_revista")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutoresTextoEmJornalOuRevistaRepository")
 */
class AutoresTextoEmJornalOuRevista
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
     * @ORM\Column(name="nome_completo_do_autor", type="string", length=255, nullable=true)
     */
    private $nomeCompletoDoAutor;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_para_citacao", type="string", length=255, nullable=true)
     */
    private $nomeParaCitacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ordem_de_autoria", type="string", length=255, nullable=true)
     */
    private $ordemDeAutoria;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TextoEmJornalOuRevistaPublicado", inversedBy="autores",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="texto_em_jornal_ou_revista_id", referencedColumnName="id")
     */
    private $textoEmJornalOuRevista;


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
     * @return AutoresTextoEmJornalOuRevista
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
     * @return AutoresTextoEmJornalOuRevista
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
     * @return AutoresTextoEmJornalOuRevista
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
     * Set textoEmJornalOuRevista
     *
     * @param string $textoEmJornalOuRevista
     *
     * @return AutoresTextoEmJornalOuRevista
     */
    public function setTextoEmJornalOuRevista($textoEmJornalOuRevista)
    {
        $this->textoEmJornalOuRevista = $textoEmJornalOuRevista;

        return $this;
    }

    /**
     * Get textoEmJornalOuRevista
     *
     * @return string
     */
    public function getTextoEmJornalOuRevista()
    {
        return $this->textoEmJornalOuRevista;
    }
}

