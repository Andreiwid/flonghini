<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AreasDoConhecimentoCapituloDeLivro
 *
 * @ORM\Table(name="areas_do_conhecimento_capitulo_de_livro")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreasDoConhecimentoCapituloDeLivroRepository")
 */
class AreasDoConhecimentoCapituloDeLivro
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
    private $nomeGrandeAreaDoConhecimento;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CapituloDeLivroPublicado", inversedBy="areasDoConhecimento",
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
     * Set nomeGrandeAreaDoConhecimento
     *
     * @param string $nomeGrandeAreaDoConhecimento
     *
     * @return AreasDoConhecimentoCapituloDeLivro
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
     * Set nomeDaAreaDoConhecimento
     *
     * @param string $nomeDaAreaDoConhecimento
     *
     * @return AreasDoConhecimentoCapituloDeLivro
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
     * @return AreasDoConhecimentoCapituloDeLivro
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
     * @return AreasDoConhecimentoCapituloDeLivro
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

