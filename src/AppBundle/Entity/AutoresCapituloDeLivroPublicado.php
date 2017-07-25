<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoresCapituloDeLivroPublicado
 *
 * @ORM\Table(name="autores_capitulo_de_livro_publicado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutoresCapituloDeLivroPublicadoRepository")
 */
class AutoresCapituloDeLivroPublicado
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
     * @ORM\Column(name="nome_completo_do_autor", type="string", length=255, nullable=true)
     */
    private $nomeCompletoDoAutor;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_para_citacao", type="string", length=255, nullable=true)
     */
    private $nomeParaCitacao;

    /**
     * @var string
     *
     * @ORM\Column(name="ordem_de_autoria", type="string", length=255, nullable=true)
     */
    private $ordemDeAutoria;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CapituloDeLivroPublicado", inversedBy="autores",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="capitulo_id", referencedColumnName="id")
     */
    private $capitulo;


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
     * @return AutoresCapituloDeLivroPublicado
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
     * @return AutoresCapituloDeLivroPublicado
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
     * @return AutoresCapituloDeLivroPublicado
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
     * @return mixed
     */
    public function getCapitulo()
    {
        return $this->capitulo;
    }

    /**
     * @param mixed $capitulo
     */
    public function setCapitulo($capitulo)
    {
        $this->capitulo = $capitulo;
    }


}

