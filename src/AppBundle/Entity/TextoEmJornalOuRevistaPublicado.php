<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TextoEmJornalOuRevistaPublicado
 *
 * @ORM\Table(name="texto_em_jornal_ou_revista_publicado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TextoEmJornalOuRevistaPublicadoRepository")
 */
class TextoEmJornalOuRevistaPublicado
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
     * @ORM\Column(name="titulo_do_texto", type="string", length=255, nullable=true)
     */
    private $tituloDoTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_do_texto", type="string", length=255, nullable=true)
     */
    private $anoDoTexto;

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
     * @ORM\Column(name="titulo_do_texto_em_ingles", type="string", length=255, nullable=true)
     */
    private $tituloDoTextoEmIngles;

    /**
     * @var string
     *
     * @ORM\Column(name="flag_divulgacao_cientifica", type="string", length=255, nullable=true)
     */
    private $flagDivulgacaoCientifica;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_do_jornal_ou_revista", type="string", length=255, nullable=true)
     */
    private $tituloDoJornalOuRevista;

    /**
     * @var string
     *
     * @ORM\Column(name="issn", type="string", length=255, nullable=true)
     */
    private $issn;

    /**
     * @var string
     *
     * @ORM\Column(name="formato_data_de_publicacao", type="string", length=255, nullable=true)
     */
    private $formatoDataDePublicacao;

    /**
     * @var string
     *
     * @ORM\Column(name="data_de_publicacao", type="string", length=255, nullable=true)
     */
    private $dataDePublicacao;

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="string", length=255, nullable=true)
     */
    private $volume;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AutoresTextoEmJornalOuRevista", mappedBy="textoEmJornalOuRevista",
     *     cascade={"persist", "remove"})
     */
    private $autores;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AreasDoConhecimentoTextoEmJornalOuRevista",
     *     mappedBy="textoEmJornalOuRevista", cascade={"persist", "remove"})
     */
    private $areasDoConhecimento;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SetoresDeAtividadeTextoEmJornalOuRevista",
     *     mappedBy="textoEmJornalOuRevista", cascade={"persist", "remove"})
     */
    private $setoresDeAtividade;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PalavrasChaveTextoEmJornalOuRevista",
     *     mappedBy="textoEmJornalOuRevista", cascade={"persist", "remove"}, fetch="EAGER")
     */
    private $palavrasChave;

    /**
     * @var string
     *
     * @ORM\Column(name="informacao_adicional", type="text", nullable=true)
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
     * Set sequenciaProducao
     *
     * @param string $sequenciaProducao
     *
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * Set tituloDoTexto
     *
     * @param string $tituloDoTexto
     *
     * @return TextoEmJornalOuRevistaPublicado
     */
    public function setTituloDoTexto($tituloDoTexto)
    {
        $this->tituloDoTexto = $tituloDoTexto;

        return $this;
    }

    /**
     * Get tituloDoTexto
     *
     * @return string
     */
    public function getTituloDoTexto()
    {
        return $this->tituloDoTexto;
    }

    /**
     * Set anoDoTexto
     *
     * @param string $anoDoTexto
     *
     * @return TextoEmJornalOuRevistaPublicado
     */
    public function setAnoDoTexto($anoDoTexto)
    {
        $this->anoDoTexto = $anoDoTexto;

        return $this;
    }

    /**
     * Get anoDoTexto
     *
     * @return string
     */
    public function getAnoDoTexto()
    {
        return $this->anoDoTexto;
    }

    /**
     * Set paisDePublicacao
     *
     * @param string $paisDePublicacao
     *
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * Set tituloDoTextoEmIngles
     *
     * @param string $tituloDoTextoEmIngles
     *
     * @return TextoEmJornalOuRevistaPublicado
     */
    public function setTituloDoTextoEmIngles($tituloDoTextoEmIngles)
    {
        $this->tituloDoTextoEmIngles = $tituloDoTextoEmIngles;

        return $this;
    }

    /**
     * Get tituloDoTextoEmIngles
     *
     * @return string
     */
    public function getTituloDoTextoEmIngles()
    {
        return $this->tituloDoTextoEmIngles;
    }

    /**
     * Set flagDivulgacaoCientifica
     *
     * @param string $flagDivulgacaoCientifica
     *
     * @return TextoEmJornalOuRevistaPublicado
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
     * Set tituloDoJornalOuRevista
     *
     * @param string $tituloDoJornalOuRevista
     *
     * @return TextoEmJornalOuRevistaPublicado
     */
    public function setTituloDoJornalOuRevista($tituloDoJornalOuRevista)
    {
        $this->tituloDoJornalOuRevista = $tituloDoJornalOuRevista;

        return $this;
    }

    /**
     * Get tituloDoJornalOuRevista
     *
     * @return string
     */
    public function getTituloDoJornalOuRevista()
    {
        return $this->tituloDoJornalOuRevista;
    }

    /**
     * Set issn
     *
     * @param string $issn
     *
     * @return TextoEmJornalOuRevistaPublicado
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
     * Set formatoDataDePublicacao
     *
     * @param string $formatoDataDePublicacao
     *
     * @return TextoEmJornalOuRevistaPublicado
     */
    public function setFormatoDataDePublicacao($formatoDataDePublicacao)
    {
        $this->formatoDataDePublicacao = $formatoDataDePublicacao;

        return $this;
    }

    /**
     * Get formatoDataDePublicacao
     *
     * @return string
     */
    public function getFormatoDataDePublicacao()
    {
        return $this->formatoDataDePublicacao;
    }

    /**
     * Set dataDePublicacao
     *
     * @param string $dataDePublicacao
     *
     * @return TextoEmJornalOuRevistaPublicado
     */
    public function setDataDePublicacao($dataDePublicacao)
    {
        $this->dataDePublicacao = $dataDePublicacao;

        return $this;
    }

    /**
     * Get dataDePublicacao
     *
     * @return string
     */
    public function getDataDePublicacao()
    {
        return $this->dataDePublicacao;
    }

    /**
     * Set volume
     *
     * @param string $volume
     *
     * @return TextoEmJornalOuRevistaPublicado
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
     * Set paginaInicial
     *
     * @param string $paginaInicial
     *
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
     */
    public function setAreasDeConhecimento($areasDoConhecimento)
    {
        $this->areasDoConhecimento = $areasDoConhecimento;

        return $this;
    }

    /**
     * Get areasDoConhecimento
     *
     * @return string
     */
    public function getAreasDeConhecimento()
    {
        return $this->areasDoConhecimento;
    }

    /**
     * Set setoresDeAtividade
     *
     * @param string $setoresDeAtividade
     *
     * @return TextoEmJornalOuRevistaPublicado
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
     * @return TextoEmJornalOuRevistaPublicado
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
    public function getAreasDoConhecimento(): ArrayCollection
    {
        return $this->areasDoConhecimento;
    }

    /**
     * @param ArrayCollection $areasDoConhecimento
     */
    public function setAreasDoConhecimento(ArrayCollection $areasDoConhecimento)
    {
        $this->areasDoConhecimento = $areasDoConhecimento;
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

