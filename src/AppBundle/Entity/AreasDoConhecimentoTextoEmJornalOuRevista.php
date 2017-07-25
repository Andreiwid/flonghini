<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AreasDoConhecimentoTextoEmJornalOuRevista
 *
 * @ORM\Table(name="areas_do_conhecimento_texto_em_jornal_ou_revista")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreasDoConhecimentoTextoEmJornalOuRevistaRepository")
 */
class AreasDoConhecimentoTextoEmJornalOuRevista
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
     * @ORM\Column(name="nome_grande_area_do_conhecimento", type="string", length=255, nullable=true)
     */
    private $nomeGrandeAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_da_area_do_conhecimento", type="string", length=255, nullable=true)
     */
    private $nomeDaAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_da_sub_area_do_conhecimento", type="string", length=255, nullable=true)
     */
    private $nomedaSubAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_da_especialidade", type="string", length=255, nullable=true)
     */
    private $nomeDaEspecialidade;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TextoEmJornalOuRevistaPublicado", inversedBy="areasDoConhecimento",
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
     * Set nomeGrandeAreaDoConhecimento
     *
     * @param string $nomeGrandeAreaDoConhecimento
     *
     * @return AreasDoConhecimentoTextoEmJornalOuRevista
     */
    public function setNomeGrandeAreaDoConhecimento($nomeGrandeAreaDoConhecimento)
    {
        $this->nomeGrandeAreaDoConhecimento = $nomeGrandeAreaDoConhecimento;

        return $this;
    }

    /**
     * Get nomeGrandeAreaDoConhecimento
     *
     * @return string
     */
    public function getNomeGrandeAreaDoConhecimento()
    {
        return $this->nomeGrandeAreaDoConhecimento;
    }

    /**
     * Set nomeDaAreaDoConhecimento
     *
     * @param string $nomeDaAreaDoConhecimento
     *
     * @return AreasDoConhecimentoTextoEmJornalOuRevista
     */
    public function setNomeDaAreaDoConhecimento($nomeDaAreaDoConhecimento)
    {
        $this->nomeDaAreaDoConhecimento = $nomeDaAreaDoConhecimento;

        return $this;
    }

    /**
     * Get nomeDaAreaDoConhecimento
     *
     * @return string
     */
    public function getNomeDaAreaDoConhecimento()
    {
        return $this->nomeDaAreaDoConhecimento;
    }

    /**
     * Set nomedaSubAreaDoConhecimento
     *
     * @param string $nomedaSubAreaDoConhecimento
     *
     * @return AreasDoConhecimentoTextoEmJornalOuRevista
     */
    public function setNomedaSubAreaDoConhecimento($nomedaSubAreaDoConhecimento)
    {
        $this->nomedaSubAreaDoConhecimento = $nomedaSubAreaDoConhecimento;

        return $this;
    }

    /**
     * Get nomedaSubAreaDoConhecimento
     *
     * @return string
     */
    public function getNomedaSubAreaDoConhecimento()
    {
        return $this->nomedaSubAreaDoConhecimento;
    }

    /**
     * Set nomeDaEspecialidade
     *
     * @param string $nomeDaEspecialidade
     *
     * @return AreasDoConhecimentoTextoEmJornalOuRevista
     */
    public function setNomeDaEspecialidade($nomeDaEspecialidade)
    {
        $this->nomeDaEspecialidade = $nomeDaEspecialidade;

        return $this;
    }

    /**
     * Get nomeDaEspecialidade
     *
     * @return string
     */
    public function getNomeDaEspecialidade()
    {
        return $this->nomeDaEspecialidade;
    }

    /**
     * Set textoEmJornalOuRevista
     *
     * @param string $textoEmJornalOuRevista
     *
     * @return AreasDoConhecimentoTextoEmJornalOuRevista
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

