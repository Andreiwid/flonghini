<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TrabalhosEmEventos
 *
 * @ORM\Table(name="trabalhos_em_eventos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrabalhosEmEventosRepository")
 */
class TrabalhosEmEventos
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
     * @var int
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pesquisador")
     * @ORM\JoinColumn(name="pesquisador_id", referencedColumnName="id")
     */
    private $pesquisador;

    /**
     * @var int
     *
     * @ORM\Column(name="sequencia_producao", type="integer", nullable=true)
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
     * @ORM\Column(name="titulo_do_trabalho", type="string", length=255, nullable=true)
     */
    private $tituloDoTrabalho;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_do_trabalho", type="string", length=255, nullable=true)
     */
    private $anoDoTrabalho;

    /**
     * @var string
     *
     * @ORM\Column(name="pais_do_evento", type="string", length=255, nullable=true)
     */
    private $paisDoEvento;

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
     * @ORM\Column(name="titulo_do_trabalho_ingles", type="string", length=255, nullable=true)
     */
    private $tituloDoTrabalhoIngles;

    /**
     * @var string
     *
     * @ORM\Column(name="flag_divulgacao_cientifica", type="string", length=255, nullable=true)
     */
    private $flagDivulgacaoCientifica;

    /**
     * @var string
     *
     * @ORM\Column(name="classificacao_do_evento", type="string", length=255, nullable=true)
     */
    private $classificacaoDoEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_do_evento", type="string", length=255, nullable=true)
     */
    private $nomeDoEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade_do_evento", type="string", length=255, nullable=true)
     */
    private $cidadeDoEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_de_realizacao", type="string", length=4, nullable=true)
     */
    private $anoDeRealizacao;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_dos_anais_ou_proceedings", type="string", length=255, nullable=true)
     */
    private $tituloDosAnaisOuProceedings;

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
     * @ORM\Column(name="isbn", type="string", length=255, nullable=true)
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_da_editora", type="string", length=255, nullable=true)
     */
    private $nomeDaEditora;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade_da_editora", type="string", length=255, nullable=true)
     */
    private $cidadeDaEditora;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AutoresTrabalhosEmEventos", mappedBy="trabalho",
     *     cascade={"persist", "remove"})
     */
    public $autores;

    /**
     * @var string
     *
     * @ORM\Column(name="areas_do_conhecimento", type="string", length=255, nullable=true)
     */
    private $nomeAreaDoConhecimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_grande_area_do_conhecimento", type="string", length=255, nullable=true)
     */
    private $nomeGrandeAreaDoConhecimento;

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

    public function __construct()
    {
        $this->autores = new ArrayCollection();
    }

    public function addAutores(AutoresTrabalhosEmEventos $autores)
    {
        $autores->setTrabalho($this);
        $this->autores->add($autores);
    }

    public function removeAutores(AutoresTrabalhosEmEventos $autores)
    {
        $this->autores->removeElement($autores);
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
     * @param integer $sequenciaProducao
     *
     * @return TrabalhosEmEventos
     */
    public function setSequenciaProducao($sequenciaProducao)
    {
        $this->sequenciaProducao = $sequenciaProducao;

        return $this;
    }

    /**
     * Get sequenciaProducao
     *
     * @return int
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
     * @return TrabalhosEmEventos
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
     * Set tituloDoTrabalho
     *
     * @param string $tituloDoTrabalho
     *
     * @return TrabalhosEmEventos
     */
    public function setTituloDoTrabalho($tituloDoTrabalho)
    {
        $this->tituloDoTrabalho = $tituloDoTrabalho;

        return $this;
    }

    /**
     * Get tituloDoTrabalho
     *
     * @return string
     */
    public function getTituloDoTrabalho()
    {
        return $this->tituloDoTrabalho;
    }

    /**
     * Set anoDoTrabalho
     *
     * @param string $anoDoTrabalho
     *
     * @return TrabalhosEmEventos
     */
    public function setAnoDoTrabalho($anoDoTrabalho)
    {
        $this->anoDoTrabalho = $anoDoTrabalho;

        return $this;
    }

    /**
     * Get anoDoTrabalho
     *
     * @return string
     */
    public function getAnoDoTrabalho()
    {
        return $this->anoDoTrabalho;
    }

    /**
     * Set paisDoEvento
     *
     * @param string $paisDoEvento
     *
     * @return TrabalhosEmEventos
     */
    public function setPaisDoEvento($paisDoEvento)
    {
        $this->paisDoEvento = $paisDoEvento;

        return $this;
    }

    /**
     * Get paisDoEvento
     *
     * @return string
     */
    public function getPaisDoEvento()
    {
        return $this->paisDoEvento;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     *
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * Set tituloDoTrabalhoIngles
     *
     * @param string $tituloDoTrabalhoIngles
     *
     * @return TrabalhosEmEventos
     */
    public function setTituloDoTrabalhoIngles($tituloDoTrabalhoIngles)
    {
        $this->tituloDoTrabalhoIngles = $tituloDoTrabalhoIngles;

        return $this;
    }

    /**
     * Get tituloDoTrabalhoIngles
     *
     * @return string
     */
    public function getTituloDoTrabalhoIngles()
    {
        return $this->tituloDoTrabalhoIngles;
    }

    /**
     * Set flagDivulgacaoCientifica
     *
     * @param string $flagDivulgacaoCientifica
     *
     * @return TrabalhosEmEventos
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
     * Set classificacaoDoEvento
     *
     * @param string $classificacaoDoEvento
     *
     * @return TrabalhosEmEventos
     */
    public function setClassificacaoDoEvento($classificacaoDoEvento)
    {
        $this->classificacaoDoEvento = $classificacaoDoEvento;

        return $this;
    }

    /**
     * Get classificacaoDoEvento
     *
     * @return string
     */
    public function getClassificacaoDoEvento()
    {
        return $this->classificacaoDoEvento;
    }

    /**
     * Set nomeDoEvento
     *
     * @param string $nomeDoEvento
     *
     * @return TrabalhosEmEventos
     */
    public function setNomeDoEvento($nomeDoEvento)
    {
        $this->nomeDoEvento = $nomeDoEvento;

        return $this;
    }

    /**
     * Get nomeDoEvento
     *
     * @return string
     */
    public function getNomeDoEvento()
    {
        return $this->nomeDoEvento;
    }

    /**
     * Set cidadeDoEvento
     *
     * @param string $cidadeDoEvento
     *
     * @return TrabalhosEmEventos
     */
    public function setCidadeDoEvento($cidadeDoEvento)
    {
        $this->cidadeDoEvento = $cidadeDoEvento;

        return $this;
    }

    /**
     * Get cidadeDoEvento
     *
     * @return string
     */
    public function getCidadeDoEvento()
    {
        return $this->cidadeDoEvento;
    }

    /**
     * Set anoDeRealizacao
     *
     * @param string $anoDeRealizacao
     *
     * @return TrabalhosEmEventos
     */
    public function setAnoDeRealizacao($anoDeRealizacao)
    {
        $this->anoDeRealizacao = $anoDeRealizacao;

        return $this;
    }

    /**
     * Get anoDeRealizacao
     *
     * @return string
     */
    public function getAnoDeRealizacao()
    {
        return $this->anoDeRealizacao;
    }

    /**
     * Set tituloDosAnaisOuProceedings
     *
     * @param string $tituloDosAnaisOuProceedings
     *
     * @return TrabalhosEmEventos
     */
    public function setTituloDosAnaisOuProceedings($tituloDosAnaisOuProceedings)
    {
        $this->tituloDosAnaisOuProceedings = $tituloDosAnaisOuProceedings;

        return $this;
    }

    /**
     * Get tituloDosAnaisOuProceedings
     *
     * @return string
     */
    public function getTituloDosAnaisOuProceedings()
    {
        return $this->tituloDosAnaisOuProceedings;
    }

    /**
     * Set volume
     *
     * @param string $volume
     *
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * Set nomeDaEditora
     *
     * @param string $nomeDaEditora
     *
     * @return TrabalhosEmEventos
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
     * Set cidadeDaEditora
     *
     * @param string $cidadeDaEditora
     *
     * @return TrabalhosEmEventos
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
     * Set nomeCompletoDoAutor
     *
     * @param string $nomeCompletoDoAutor
     *
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return string
     */
    public function getNomeAreaDoConhecimento()
    {
        return $this->nomeAreaDoConhecimento;
    }

    /**
     * @param string $nomeAreaDoConhecimento
     */
    public function setNomeAreaDoConhecimento($nomeAreaDoConhecimento)
    {
        $this->nomeAreaDoConhecimento = $nomeAreaDoConhecimento;
    }


    /**
     * Set nomeGrandeAreaDoConhecimento
     *
     * @param string $nomeGrandeAreaDoConhecimento
     *
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return TrabalhosEmEventos
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
     * @return int
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






}

