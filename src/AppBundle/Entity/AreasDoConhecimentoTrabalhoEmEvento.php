<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AreasDoConhecimentoTrabalhoEmEvento
 *
 * @ORM\Table(name="areas_do_conhecimento_trabalho_em_evento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreasDoConhecimentoTrabalhoEmEventoRepository")
 */
class AreasDoConhecimentoTrabalhoEmEvento
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
     * @ORM\Column(name="nomeAreaDoConhecimento", type="string", length=255, nullable=true)
     */
    private $nomeAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeGrandeAreaDoConhecimento", type="string", length=255, nullable=true)
     */
    private $nomeGrandeAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeDaSubAreaDoConhecimento", type="string", length=255, nullable=true)
     */
    private $nomeDaSubAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeDaEspecialidade", type="string", length=255, nullable=true)
     */
    private $nomeDaEspecialidade;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TrabalhosEmEventos", inversedBy="areasDoConhecimento",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="trabalho_em_evento_id", referencedColumnName="id")
     */
    private $trabalhoEmEvento;


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
     * Set nomeAreaDoConhecimento
     *
     * @param string $nomeAreaDoConhecimento
     *
     * @return AreasDoConhecimentoTrabalhoEmEvento
     */
    public function setNomeAreaDoConhecimento($nomeAreaDoConhecimento)
    {
        $this->nomeAreaDoConhecimento = $nomeAreaDoConhecimento;

        return $this;
    }

    /**
     * Get nomeAreaDoConhecimento
     *
     * @return string
     */
    public function getNomeAreaDoConhecimento()
    {
        return $this->nomeAreaDoConhecimento;
    }

    /**
     * Set nomeGrandeAreaDoConhecimento
     *
     * @param string $nomeGrandeAreaDoConhecimento
     *
     * @return AreasDoConhecimentoTrabalhoEmEvento
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
     * Set nomeDaSubAreaDoConhecimento
     *
     * @param string $nomeDaSubAreaDoConhecimento
     *
     * @return AreasDoConhecimentoTrabalhoEmEvento
     */
    public function setNomeDaSubAreaDoConhecimento($nomeDaSubAreaDoConhecimento)
    {
        $this->nomeDaSubAreaDoConhecimento = $nomeDaSubAreaDoConhecimento;

        return $this;
    }

    /**
     * Get nomeDaSubAreaDoConhecimento
     *
     * @return string
     */
    public function getNomeDaSubAreaDoConhecimento()
    {
        return $this->nomeDaSubAreaDoConhecimento;
    }

    /**
     * Set nomeDaEspecialidade
     *
     * @param string $nomeDaEspecialidade
     *
     * @return AreasDoConhecimentoTrabalhoEmEvento
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
     * @return mixed
     */
    public function getTrabalhoEmEvento()
    {
        return $this->trabalhoEmEvento;
    }

    /**
     * @param mixed $trabalhoEmEvento
     */
    public function setTrabalhoEmEvento($trabalhoEmEvento)
    {
        $this->trabalhoEmEvento = $trabalhoEmEvento;
    }


}

