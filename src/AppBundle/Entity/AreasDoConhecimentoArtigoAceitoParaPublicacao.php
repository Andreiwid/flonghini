<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AreasDoConhecimentoArtigoAceitoParaPublicacao
 *
 * @ORM\Table(name="areas_do_conhecimento_artigo_aceito_para_publicacao")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreasDoConhecimentoArtigoAceitoParaPublicacaoRepository")
 */
class AreasDoConhecimentoArtigoAceitoParaPublicacao
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
    private $nomeGrandeAreadoConhecimento;

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
    private $nomeDaSubAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_da_especialidade", type="string", length=255, nullable=true)
     */
    private $nomeDaEspecialidade;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtigoAceitoParaPublicacao", inversedBy="areasDoConhecimento")
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
     * Set nomeGrandeAreadoConhecimento
     *
     * @param string $nomeGrandeAreadoConhecimento
     *
     * @return AreasDoConhecimentoArtigoAceitoParaPublicacao
     */
    public function setNomeGrandeAreadoConhecimento($nomeGrandeAreadoConhecimento)
    {
        $this->nomeGrandeAreadoConhecimento = $nomeGrandeAreadoConhecimento;

        return $this;
    }

    /**
     * Get nomeGrandeAreadoConhecimento
     *
     * @return string
     */
    public function getNomeGrandeAreadoConhecimento()
    {
        return $this->nomeGrandeAreadoConhecimento;
    }

    /**
     * Set nomeDaAreaDoConhecimento
     *
     * @param string $nomeDaAreaDoConhecimento
     *
     * @return AreasDoConhecimentoArtigoAceitoParaPublicacao
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
     * Set nomeDaSubAreaDoConhecimento
     *
     * @param string $nomeDaSubAreaDoConhecimento
     *
     * @return AreasDoConhecimentoArtigoAceitoParaPublicacao
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
     * @return AreasDoConhecimentoArtigoAceitoParaPublicacao
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


    public function setArtigoAceitoParaPublicacao($artigoAceitoParaPublicacao)
    {
        $this->artigoAceitoParaPublicacao = $artigoAceitoParaPublicacao;

        return $this;
    }


    public function getArtigoAceitoParaPublicacao()
    {
        return $this->artigoAceitoParaPublicacao;
    }
}

