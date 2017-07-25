<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CapituloDeLivroPublicado
 *
 * @ORM\Table(name="capitulo_de_livro_publicado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CapituloDeLivroPublicadoRepository")
 */
class CapituloDeLivroPublicado
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
     * @ORM\Column(name="sequenciaProducao", type="string", length=255, nullable=true)
     */
    private $sequenciaProducao;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="tituloDoCapituloDoLivro", type="string", length=255, nullable=true)
     */
    private $tituloDoCapituloDoLivro;

    /**
     * @var string
     *
     * @ORM\Column(name="ano", type="string", length=4, nullable=true)
     */
    private $ano;

    /**
     * @var string
     *
     * @ORM\Column(name="paisDePublicacao", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="meioDeDivulgacao", type="string", length=255, nullable=true)
     */
    private $meioDeDivulgacao;

    /**
     * @var string
     *
     * @ORM\Column(name="flagDeRelevancia", type="string", length=255, nullable=true)
     */
    private $flagDeRelevancia;

    /**
     * @var string
     *
     * @ORM\Column(name="doi", type="string", length=255, nullable=true)
     */
    private $doi;

    /**
     * @var string
     *
     * @ORM\Column(name="tituloDoCapituloDoLivroIngles", type="string", length=255, nullable=true)
     */
    private $tituloDoCapituloDoLivroIngles;

    /**
     * @var string
     *
     * @ORM\Column(name="flagDivulgacaoCientifica", type="string", length=255, nullable=true)
     */
    private $flagDivulgacaoCientifica;

    /**
     * @var string
     *
     * @ORM\Column(name="tituloDoLivro", type="string", length=255, nullable=true)
     */
    private $tituloDoLivro;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDeVolumes", type="string", length=255, nullable=true)
     */
    private $numeroDeVolumes;

    /**
     * @var string
     *
     * @ORM\Column(name="paginaInicial", type="string", length=255, nullable=true)
     */
    private $paginaInicial;

    /**
     * @var string
     *
     * @ORM\Column(name="paginaFinal", type="string", length=255, nullable=true)
     */
    private $paginaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=255, nullable=true)
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="organizadores", type="string", length=255, nullable=true)
     */
    private $organizadores;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDaEdicaoRevisao", type="string", length=255, nullable=true)
     */
    private $numeroDaEdicaoRevisao;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDaSerie", type="string", length=255, nullable=true)
     */
    private $numeroDaSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="cidadeDaEditora", type="string", length=255, nullable=true)
     */
    private $cidadeDaEditora;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeDaEditora", type="string", length=255, nullable=true)
     */
    private $nomeDaEditora;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AutoresCapituloDeLivroPublicado", mappedBy="capitulo",
     *     cascade={"persist", "remove"})
     */
    public $autores;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AreasDoConhecimentoCapituloDeLivro", mappedBy="capitulo",
     *     cascade={"persist", "remove"})
     */
    private $areasDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="setorDeAtividade", type="string", length=255, nullable=true)
     */
    private $setorDeAtividade;

    /**
     * @var string
     *
     * @ORM\Column(name="informacaoAdicional", type="string", length=255, nullable=true)
     */
    private $informacaoAdicional;


    public function __construct()
    {
        $this->autores = new ArrayCollection();
        $this->areasDoConhecimento = new ArrayCollection();
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
     * @return CapituloDeLivroPublicado
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return CapituloDeLivroPublicado
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set tituloDoCapituloDoLivro
     *
     * @param string $tituloDoCapituloDoLivro
     *
     * @return CapituloDeLivroPublicado
     */
    public function setTituloDoCapituloDoLivro($tituloDoCapituloDoLivro)
    {
        $this->tituloDoCapituloDoLivro = $tituloDoCapituloDoLivro;

        return $this;
    }

    /**
     * Get tituloDoCapituloDoLivro
     *
     * @return string
     */
    public function getTituloDoCapituloDoLivro()
    {
        return $this->tituloDoCapituloDoLivro;
    }

    /**
     * Set ano
     *
     * @param string $ano
     *
     * @return CapituloDeLivroPublicado
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return string
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set paisDePublicacao
     *
     * @param string $paisDePublicacao
     *
     * @return CapituloDeLivroPublicado
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
     * @return CapituloDeLivroPublicado
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
     * @return CapituloDeLivroPublicado
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
     * Set flagDeRelevancia
     *
     * @param string $flagDeRelevancia
     *
     * @return CapituloDeLivroPublicado
     */
    public function setFlagDeRelevancia($flagDeRelevancia)
    {
        $this->flagDeRelevancia = $flagDeRelevancia;

        return $this;
    }

    /**
     * Get flagDeRelevancia
     *
     * @return string
     */
    public function getFlagDeRelevancia()
    {
        return $this->flagDeRelevancia;
    }

    /**
     * Set doi
     *
     * @param string $doi
     *
     * @return CapituloDeLivroPublicado
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
     * Set tituloDoCapituloDoLivroIngles
     *
     * @param string $tituloDoCapituloDoLivroIngles
     *
     * @return CapituloDeLivroPublicado
     */
    public function setTituloDoCapituloDoLivroIngles($tituloDoCapituloDoLivroIngles)
    {
        $this->tituloDoCapituloDoLivroIngles = $tituloDoCapituloDoLivroIngles;

        return $this;
    }

    /**
     * Get tituloDoCapituloDoLivroIngles
     *
     * @return string
     */
    public function getTituloDoCapituloDoLivroIngles()
    {
        return $this->tituloDoCapituloDoLivroIngles;
    }

    /**
     * Set flagDivulgacaoCientifica
     *
     * @param string $flagDivulgacaoCientifica
     *
     * @return CapituloDeLivroPublicado
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
     * Set tituloDoLivro
     *
     * @param string $tituloDoLivro
     *
     * @return CapituloDeLivroPublicado
     */
    public function setTituloDoLivro($tituloDoLivro)
    {
        $this->tituloDoLivro = $tituloDoLivro;

        return $this;
    }

    /**
     * Get tituloDoLivro
     *
     * @return string
     */
    public function getTituloDoLivro()
    {
        return $this->tituloDoLivro;
    }

    /**
     * Set numeroDeVolumes
     *
     * @param string $numeroDeVolumes
     *
     * @return CapituloDeLivroPublicado
     */
    public function setNumeroDeVolumes($numeroDeVolumes)
    {
        $this->numeroDeVolumes = $numeroDeVolumes;

        return $this;
    }

    /**
     * Get numeroDeVolumes
     *
     * @return string
     */
    public function getNumeroDeVolumes()
    {
        return $this->numeroDeVolumes;
    }

    /**
     * Set paginaInicial
     *
     * @param string $paginaInicial
     *
     * @return CapituloDeLivroPublicado
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
     * @return CapituloDeLivroPublicado
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
     * Set isbn
     *
     * @param string $isbn
     *
     * @return CapituloDeLivroPublicado
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set organizadores
     *
     * @param string $organizadores
     *
     * @return CapituloDeLivroPublicado
     */
    public function setOrganizadores($organizadores)
    {
        $this->organizadores = $organizadores;

        return $this;
    }

    /**
     * Get organizadores
     *
     * @return string
     */
    public function getOrganizadores()
    {
        return $this->organizadores;
    }

    /**
     * Set numeroDaEdicaoRevisao
     *
     * @param string $numeroDaEdicaoRevisao
     *
     * @return CapituloDeLivroPublicado
     */
    public function setNumeroDaEdicaoRevisao($numeroDaEdicaoRevisao)
    {
        $this->numeroDaEdicaoRevisao = $numeroDaEdicaoRevisao;

        return $this;
    }

    /**
     * Get numeroDaEdicaoRevisao
     *
     * @return string
     */
    public function getNumeroDaEdicaoRevisao()
    {
        return $this->numeroDaEdicaoRevisao;
    }

    /**
     * Set numeroDaSerie
     *
     * @param string $numeroDaSerie
     *
     * @return CapituloDeLivroPublicado
     */
    public function setNumeroDaSerie($numeroDaSerie)
    {
        $this->numeroDaSerie = $numeroDaSerie;

        return $this;
    }

    /**
     * Get numeroDaSerie
     *
     * @return string
     */
    public function getNumeroDaSerie()
    {
        return $this->numeroDaSerie;
    }

    /**
     * Set cidadeDaEditora
     *
     * @param string $cidadeDaEditora
     *
     * @return CapituloDeLivroPublicado
     */
    public function setCidadeDaEditora($cidadeDaEditora)
    {
        $this->cidadeDaEditora = $cidadeDaEditora;

        return $this;
    }

    /**
     * Get cidadeDaEditora
     *
     * @return string
     */
    public function getCidadeDaEditora()
    {
        return $this->cidadeDaEditora;
    }

    /**
     * Set nomeDaEditora
     *
     * @param string $nomeDaEditora
     *
     * @return CapituloDeLivroPublicado
     */
    public function setNomeDaEditora($nomeDaEditora)
    {
        $this->nomeDaEditora = $nomeDaEditora;

        return $this;
    }

    /**
     * Get nomeDaEditora
     *
     * @return string
     */
    public function getNomeDaEditora()
    {
        return $this->nomeDaEditora;
    }

    /**
     * Set autores
     *
     * @param string $autores
     *
     * @return CapituloDeLivroPublicado
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


    public function setAreaDoConhecimento($areaDoConhecimento)
    {
        $this->areaDoConhecimento = $areaDoConhecimento;

        return $this;
    }


    public function getAreaDoConhecimento()
    {
        return $this->areaDoConhecimento;
    }

    /**
     * Set setorDeAtividade
     *
     * @param string $setorDeAtividade
     *
     * @return CapituloDeLivroPublicado
     */
    public function setSetorDeAtividade($setorDeAtividade)
    {
        $this->setorDeAtividade = $setorDeAtividade;

        return $this;
    }

    /**
     * Get setorDeAtividade
     *
     * @return string
     */
    public function getSetorDeAtividade()
    {
        return $this->setorDeAtividade;
    }

    /**
     * Set informacaoAdicional
     *
     * @param string $informacaoAdicional
     *
     * @return CapituloDeLivroPublicado
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


}

