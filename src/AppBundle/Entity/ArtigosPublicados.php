<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArtigosPublicados
 *
 * @ORM\Table(name="artigos_publicados")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtigosPublicadosRepository")
 */
class ArtigosPublicados
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
     * @var Pesquisador
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pesquisador")
     * @ORM\JoinColumn(name="pesquisador_id", referencedColumnName="id")
     */
    private $pesquisador;

    /**
     * @var string
     *
     * @ORM\Column(name="sequencia_producao", type="string", length=255, nullable=true)
     */
    private $sequenciaProducao;

    /**
     * @var string
     *
     * @ORM\Column(name="natureza", type="string", length=255, nullable=true)
     */
    private $natureza;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_do_artigo", type="string", length=255, nullable=true)
     */
    private $tituloDoArtigo;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_do_artigo", type="string", length=255, nullable=true)
     */
    private $anoDoArtigo;

    /**
     * @var string
     *
     * @ORM\Column(name="pais_de_publicacao", type="string", length=255, nullable=true)
     */
    private $paisDePublicacao;

    /**
     * @var string
     *
     * @ORM\Column(name="idioma", type="string", length=255, nullable=true)
     */
    private $idioma;

    /**
     * @var string
     *
     * @ORM\Column(name="meio_de_divulgacao", type="string", length=255, nullable=true)
     */
    private $meioDeDivulgacao;

    /**
     * @var string
     *
     * @ORM\Column(name="flag_relevancia", type="string", length=255, nullable=true)
     */
    private $flagRelevancia;

    /**
     * @var string
     *
     * @ORM\Column(name="doi", type="string", length=255, nullable=true)
     */
    private $doi;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_artigo_em_ingles", type="string", length=255, nullable=true)
     */
    private $tituloArtigoEmIngles;

    /**
     * @var string
     *
     * @ORM\Column(name="flag_divulgacao_cientifca", type="string", length=255, nullable=true)
     */
    private $flagDivulgacaoCientifca;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_do_periodico_ou_revista", type="string", length=255, nullable=true)
     */
    private $tituloDoPeriodicoOuRevista;

    /**
     * @var string
     *
     * @ORM\Column(name="issn", type="string", length=255, nullable=true)
     */
    private $issn;

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="string", length=255, nullable=true)
     */
    private $volume;

    /**
     * @var string
     *
     * @ORM\Column(name="fasciculo", type="string", length=255, nullable=true)
     */
    private $fasciculo;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255, nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="pagina_inicial", type="string", length=255, nullable=true)
     */
    private $paginaInicial;

    /**
     * @var string
     *
     * @ORM\Column(name="pagina_final", type="string", length=255, nullable=true)
     */
    private $paginaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="local_de_publicacao", type="string", length=255, nullable=true)
     */
    private $localDePublicacao;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AutoresArtigosPublicados", mappedBy="trabalho",
     *     cascade={"persist", "remove"})
     */
    public $autores;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AreasDoConhecimentoArtigo", mappedBy="trabalho",
     *     cascade={"persist", "remove"})
     */
    private $areasDoConhecimento;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SetoresDeAtividadeArtigosPublicados",
     *     mappedBy="artigoAceitoParaPublicacao", cascade={"persist", "remove"})
     */
    private $setoresDeAtividade;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PalavrasChaveArtigosPublicados",
     *     mappedBy="artigoPublicado", cascade={"persist", "remove"})
     */
    private $palavrasChave;

    /**
     * @var string
     *
     * @ORM\Column(name="informacao_adicional", type="string", length=255, nullable=true)
     */
    private $informacaoAdicional;

    public function __construct()
    {
        $this->autores = new ArrayCollection();
        $this->areasDoConhecimento = new ArrayCollection();
        $this->setoresDeAtividade = new ArrayCollection();
        $this->palavrasChave = new ArrayCollection();
    }

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
     * @return Pesquisador
     */
    public function getPesquisador()
    {
        return $this->pesquisador;
    }

    /**
     * @param $pesquisador
     */
    public function setPesquisador($pesquisador)
    {
        $this->pesquisador = $pesquisador;
    }

    /**
     * Set sequenciaProducao
     *
     * @param string $sequenciaProducao
     *
     * @return ArtigosPublicados
     */
    public function setSequenciaProducao($sequenciaProducao)
    {
        $this->sequenciaProducao = $sequenciaProducao;

        return $this;
    }

    /**
     * Get sequenciaProducao
     *
     * @return string
     */
    public function getSequenciaProducao()
    {
        return $this->sequenciaProducao;
    }

    /**
     * Set natureza
     *
     * @param string $natureza
     *
     * @return ArtigosPublicados
     */
    public function setNatureza($natureza)
    {
        $this->natureza = $natureza;

        return $this;
    }

    /**
     * Get natureza
     *
     * @return string
     */
    public function getNatureza()
    {
        return $this->natureza;
    }

    /**
     * Set tituloDoArtigo
     *
     * @param string $tituloDoArtigo
     *
     * @return ArtigosPublicados
     */
    public function setTituloDoArtigo($tituloDoArtigo)
    {
        $this->tituloDoArtigo = $tituloDoArtigo;

        return $this;
    }

    /**
     * Get tituloDoArtigo
     *
     * @return string
     */
    public function getTituloDoArtigo()
    {
        return $this->tituloDoArtigo;
    }

    /**
     * Set anoDoArtigo
     *
     * @param string $anoDoArtigo
     *
     * @return ArtigosPublicados
     */
    public function setAnoDoArtigo($anoDoArtigo)
    {
        $this->anoDoArtigo = $anoDoArtigo;

        return $this;
    }

    /**
     * Get anoDoArtigo
     *
     * @return string
     */
    public function getAnoDoArtigo()
    {
        return $this->anoDoArtigo;
    }

    /**
     * Set paisDePublicacao
     *
     * @param string $paisDePublicacao
     *
     * @return ArtigosPublicados
     */
    public function setPaisDePublicacao($paisDePublicacao)
    {
        $this->paisDePublicacao = $paisDePublicacao;

        return $this;
    }

    /**
     * Get paisDePublicacao
     *
     * @return string
     */
    public function getPaisDePublicacao()
    {
        return $this->paisDePublicacao;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     *
     * @return ArtigosPublicados
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return string
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set meioDeDivulgacao
     *
     * @param string $meioDeDivulgacao
     *
     * @return ArtigosPublicados
     */
    public function setMeioDeDivulgacao($meioDeDivulgacao)
    {
        $this->meioDeDivulgacao = $meioDeDivulgacao;

        return $this;
    }

    /**
     * Get meioDeDivulgacao
     *
     * @return string
     */
    public function getMeioDeDivulgacao()
    {
        return $this->meioDeDivulgacao;
    }

    /**
     * Set flagRelevancia
     *
     * @param string $flagRelevancia
     *
     * @return ArtigosPublicados
     */
    public function setFlagRelevancia($flagRelevancia)
    {
        $this->flagRelevancia = $flagRelevancia;

        return $this;
    }

    /**
     * Get flagRelevancia
     *
     * @return string
     */
    public function getFlagRelevancia()
    {
        return $this->flagRelevancia;
    }

    /**
     * Set doi
     *
     * @param string $doi
     *
     * @return ArtigosPublicados
     */
    public function setDoi($doi)
    {
        $this->doi = $doi;

        return $this;
    }

    /**
     * Get doi
     *
     * @return string
     */
    public function getDoi()
    {
        return $this->doi;
    }

    /**
     * Set tituloArtigoEmIngles
     *
     * @param string $tituloArtigoEmIngles
     *
     * @return ArtigosPublicados
     */
    public function setTituloArtigoEmIngles($tituloArtigoEmIngles)
    {
        $this->tituloArtigoEmIngles = $tituloArtigoEmIngles;

        return $this;
    }

    /**
     * Get tituloArtigoEmIngles
     *
     * @return string
     */
    public function getTituloArtigoEmIngles()
    {
        return $this->tituloArtigoEmIngles;
    }

    /**
     * Set flagDivulgacaoCientifca
     *
     * @param string $flagDivulgacaoCientifca
     *
     * @return ArtigosPublicados
     */
    public function setFlagDivulgacaoCientifca($flagDivulgacaoCientifca)
    {
        $this->flagDivulgacaoCientifca = $flagDivulgacaoCientifca;

        return $this;
    }

    /**
     * Get flagDivulgacaoCientifca
     *
     * @return string
     */
    public function getFlagDivulgacaoCientifca()
    {
        return $this->flagDivulgacaoCientifca;
    }

    /**
     * Set tituloDoPeriodicoOuRevista
     *
     * @param string $tituloDoPeriodicoOuRevista
     *
     * @return ArtigosPublicados
     */
    public function setTituloDoPeriodicoOuRevista($tituloDoPeriodicoOuRevista)
    {
        $this->tituloDoPeriodicoOuRevista = $tituloDoPeriodicoOuRevista;

        return $this;
    }

    /**
     * Get tituloDoPeriodicoOuRevista
     *
     * @return string
     */
    public function getTituloDoPeriodicoOuRevista()
    {
        return $this->tituloDoPeriodicoOuRevista;
    }

    /**
     * Set issn
     *
     * @param string $issn
     *
     * @return ArtigosPublicados
     */
    public function setIssn($issn)
    {
        $this->issn = $issn;

        return $this;
    }

    /**
     * Get issn
     *
     * @return string
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * Set volume
     *
     * @param string $volume
     *
     * @return ArtigosPublicados
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set fasciculo
     *
     * @param string $fasciculo
     *
     * @return ArtigosPublicados
     */
    public function setFasciculo($fasciculo)
    {
        $this->fasciculo = $fasciculo;

        return $this;
    }

    /**
     * Get fasciculo
     *
     * @return string
     */
    public function getFasciculo()
    {
        return $this->fasciculo;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return ArtigosPublicados
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set paginaInicial
     *
     * @param string $paginaInicial
     *
     * @return ArtigosPublicados
     */
    public function setPaginaInicial($paginaInicial)
    {
        $this->paginaInicial = $paginaInicial;

        return $this;
    }

    /**
     * Get paginaInicial
     *
     * @return string
     */
    public function getPaginaInicial()
    {
        return $this->paginaInicial;
    }

    /**
     * Set paginaFinal
     *
     * @param string $paginaFinal
     *
     * @return ArtigosPublicados
     */
    public function setPaginaFinal($paginaFinal)
    {
        $this->paginaFinal = $paginaFinal;

        return $this;
    }

    /**
     * Get paginaFinal
     *
     * @return string
     */
    public function getPaginaFinal()
    {
        return $this->paginaFinal;
    }

    /**
     * Set localDePublicacao
     *
     * @param string $localDePublicacao
     *
     * @return ArtigosPublicados
     */
    public function setLocalDePublicacao($localDePublicacao)
    {
        $this->localDePublicacao = $localDePublicacao;

        return $this;
    }

    /**
     * Get localDePublicacao
     *
     * @return string
     */
    public function getLocalDePublicacao()
    {
        return $this->localDePublicacao;
    }

    /**
     * Set autores
     *
     * @param string $autores
     *
     * @return ArtigosPublicados
     */
    public function setAutores($autores)
    {
        $this->autores = $autores;

        return $this;
    }

    /**
     * Get autores
     *
     * @return string
     */
    public function getAutores()
    {
        return $this->autores;
    }

    /**
     * Set areasDoConhecimento
     *
     * @param string $areasDoConhecimento
     *
     * @return ArtigosPublicados
     */
    public function setAreasDoConhecimento($areasDoConhecimento)
    {
        $this->areasDoConhecimento = $areasDoConhecimento;

        return $this;
    }

    /**
     * Get areasDoConhecimento
     *
     * @return string
     */
    public function getAreasDoConhecimento()
    {
        return $this->areasDoConhecimento;
    }

    /**
     * Set setoresDeAtividade
     *
     * @param string $setoresDeAtividade
     *
     * @return ArtigosPublicados
     */
    public function setSetoresDeAtividade($setoresDeAtividade)
    {
        $this->setoresDeAtividade = $setoresDeAtividade;

        return $this;
    }

    /**
     * Get setoresDeAtividade
     *
     * @return string
     */
    public function getSetoresDeAtividade()
    {
        return $this->setoresDeAtividade;
    }

    /**
     * Set informacaoAdicional
     *
     * @param string $informacaoAdicional
     *
     * @return ArtigosPublicados
     */
    public function setInformacaoAdicional($informacaoAdicional)
    {
        $this->informacaoAdicional = $informacaoAdicional;

        return $this;
    }

    /**
     * Get informacaoAdicional
     *
     * @return string
     */
    public function getInformacaoAdicional()
    {
        return $this->informacaoAdicional;
    }

    /**
     * @return ArrayCollection
     */
    public function getPalavrasChave(): ArrayCollection
    {
        return $this->palavrasChave;
    }

    /**
     * @param ArrayCollection $palavrasChave
     */
    public function setPalavrasChave(ArrayCollection $palavrasChave)
    {
        $this->palavrasChave = $palavrasChave;
    }

}

