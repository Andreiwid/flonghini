<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormacaoAcademica
 *
 * @ORM\Table(name="formacao_academica")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormacaoAcademicaRepository")
 */
class FormacaoAcademica
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pesquisador", inversedBy="formacaoAcademica")
     * @ORM\JoinColumn(name="pesquisador_id", referencedColumnName="id")
     */
    private $pesquisador;

    /**
     * @var string
     *
     * @ORM\Column(name="grau_de_formacao", type="string", length=255, nullable=true)
     */
    private $grauDeFormacao;

    /**
     * @var string
     *
     * @ORM\Column(name="instituicao", type="string", length=255, nullable=true)
     */
    private $instituicao;

    /**
     * @var string
     *
     * @ORM\Column(name="curso", type="string", length=255, nullable=true)
     */
    private $curso;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_inicio", type="string", length=4, nullable=true)
     */
    private $anoInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_fim",  type="string", length=4, nullable=true)
     */
    private $anoFim;


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
     * Set pesquisador
     *
     * @param Pesquisador $pesquisador
     *
     * @return FormacaoAcademica
     */
    public function setPesquisador($pesquisador)
    {
        $this->pesquisador = $pesquisador;

        return $this;
    }

    /**
     * Get pesquisador
     *
     * @return int
     */
    public function getPesquisador()
    {
        return $this->pesquisador;
    }

    /**
     * @param $grauDeFormacao
     * @return $this
     */
    public function setGrauDeFormacao($grauDeFormacao)
    {
        $this->grauDeFormacao = $grauDeFormacao;
        return $this;
    }

    /**
     * Get grauDeFormacao
     *
     * @return int
     */
    public function getGrauDeFormacao()
    {
        return $this->grauDeFormacao;
    }

    /**
     * Set instituicao
     *
     * @param string $instituicao
     *
     * @return FormacaoAcademica
     */
    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    /**
     * Get instituicao
     *
     * @return string
     */
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * Set curso
     *
     * @param string $curso
     *
     * @return FormacaoAcademica
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return string
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set anoInicio
     *
     * @param string $anoInicio
     *
     * @return FormacaoAcademica
     */
    public function setAnoInicio($anoInicio)
    {
        $this->anoInicio = $anoInicio;

        return $this;
    }

    /**
     * Get anoInicio
     *
     * @return string
     */
    public function getAnoInicio()
    {
        return $this->anoInicio;
    }

    /**
     * Set anoFim
     *
     * @param integer $anoFim
     *
     * @return FormacaoAcademica
     */
    public function setAnoFim($anoFim)
    {
        $this->anoFim = $anoFim;

        return $this;
    }

    /**
     * Get anoFim
     *
     * @return int
     */
    public function getAnoFim()
    {
        return $this->anoFim;
    }
}

