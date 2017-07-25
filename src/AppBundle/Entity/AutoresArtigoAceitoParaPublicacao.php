<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoresArtigoAceitoParaPublicacao
 *
 * @ORM\Table(name="autores_artigo_aceito_para_publicacao")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutoresArtigoAceitoParaPublicacaoRepository")
 */
class AutoresArtigoAceitoParaPublicacao
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtigoAceitoParaPublicacao", inversedBy="autores",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="artigo_aceito_para_publicacao_id", referencedColumnName="id")
     */
    private $artigoAceitoParaPublicacao;


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
     * @return AutoresArtigoAceitoParaPublicacao
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
     * @return AutoresArtigoAceitoParaPublicacao
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
     * @return AutoresArtigoAceitoParaPublicacao
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
     * Set artigoAceitoParaPublicacao
     *
     * @param string $artigoAceitoParaPublicacao
     *
     * @return AutoresArtigoAceitoParaPublicacao
     */
    public function setArtigoAceitoParaPublicacao($artigoAceitoParaPublicacao)
    {
        $this->artigoAceitoParaPublicacao = $artigoAceitoParaPublicacao;

        return $this;
    }

    /**
     * Get artigoAceitoParaPublicacao
     *
     * @return string
     */
    public function getArtigoAceitoParaPublicacao()
    {
        return $this->artigoAceitoParaPublicacao;
    }
}

