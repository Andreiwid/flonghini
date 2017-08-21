<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArtigoAceitoParaPublicacao
 *
 * @ORM\Table(name="artigo_aceito_para_publicacao")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtigoAceitoParaPublicacaoRepository")
 */
class ArtigoAceitoParaPublicacao
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
     * @ORM\Column(name="titulo_do_artigo_em_ingles", type="string", length=255, nullable=true)
     */
    private $tituloDoArtigoEmIngles;

    /**
     * @var string
     *
     * @ORM\Column(name="flag_divulgacao_cientifica", type="string", length=255, nullable=true)
     */
    private $flagDivulgacaoCientifica;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AutoresArtigoAceitoParaPublicacao",
     *     mappedBy="artigo_aceito_para_publicacao", cascade={"persist", "remove"})
     */
    private $autores;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AreasDoConhecimentoArtigoAceitoParaPublicacao",
     *     mappedBy="artigo_aceito_para_publicacao", cascade={"persist", "remove"})
     */
    private $areasDoConhecimento;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SetoresDeAtividadeArtigoAceitoParaPublicacao",
     *     mappedBy="artigoPublicado", cascade={"persist", "remove"})
     */
    private $setoresDeAtividade;

    /**
     * @var string
     *
     * @ORM\Column(name="informacao_adicional", type="string", length=255, nullable=true)
     */
    private $informacaoAdicional;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PalavrasChaveArtigoAceitoParaPublicacao",
     *     mappedBy="artigoAceitoParaPublicacao", cascade={"persist", "remove"}, fetch="EAGER")
     */
    private $palavrasChave;

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
     * Set sequenciaProducao
     *
     * @param string $sequenciaProducao
     *
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * Set tituloDoArtigoEmIngles
     *
     * @param string $tituloDoArtigoEmIngles
     *
     * @return ArtigoAceitoParaPublicacao
     */
    public function setTituloDoArtigoEmIngles($tituloDoArtigoEmIngles)
    {
        $this->tituloDoArtigoEmIngles = $tituloDoArtigoEmIngles;

        return $this;
    }

    /**
     * Get tituloDoArtigoEmIngles
     *
     * @return string
     */
    public function getTituloDoArtigoEmIngles()
    {
        return $this->tituloDoArtigoEmIngles;
    }

    /**
     * Set flagDivulgacaoCientifica
     *
     * @param string $flagDivulgacaoCientifica
     *
     * @return ArtigoAceitoParaPublicacao
     */
    public function setFlagDivulgacaoCientifica($flagDivulgacaoCientifica)
    {
        $this->flagDivulgacaoCientifica = $flagDivulgacaoCientifica;

        return $this;
    }

    /**
     * Get flagDivulgacaoCientifica
     *
     * @return string
     */
    public function getFlagDivulgacaoCientifica()
    {
        return $this->flagDivulgacaoCientifica;
    }

    /**
     * Set tituloDoPeriodicoOuRevista
     *
     * @param string $tituloDoPeriodicoOuRevista
     *
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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


    public function setAreasDoConhecimento($areasDoConhecimento)
    {
        $this->areasDoConhecimento = $areasDoConhecimento;

        return $this;
    }


    public function getAreasDoConhecimento()
    {
        return $this->areasDoConhecimento;
    }

    /**
     * Set setoresDeAtividade
     *
     * @param string $setoresDeAtividade
     *
     * @return ArtigoAceitoParaPublicacao
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
     * @return ArtigoAceitoParaPublicacao
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
     * @return Pesquisador
     */
    public function getPesquisador(): Pesquisador
    {
        return $this->pesquisador;
    }

    /**
     * @param Pesquisador $pesquisador
     */
    public function setPesquisador(Pesquisador $pesquisador)
    {
        $this->pesquisador = $pesquisador;
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

