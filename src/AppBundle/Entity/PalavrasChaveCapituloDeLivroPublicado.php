<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PalavrasChaveCapituloDeLivroPublicado
 *
 * @ORM\Table(name="palavras_chave_capitulo_de_livro_publicado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PalavrasChaveCapituloDeLivroPublicadoRepository")
 */
class PalavrasChaveCapituloDeLivroPublicado
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
     * @ORM\Column(name="palavra_chave_1", type="string", length=255, nullable=true)
     */
    private $palavraChave1;

    /**
     * @var string
     *
     * @ORM\Column(name="palavra_chave_2", type="string", length=255, nullable=true)
     */
    private $palavraChave2;

    /**
     * @var string
     *
     * @ORM\Column(name="palavra_chave_3", type="string", length=255, nullable=true)
     */
    private $palavraChave3;

    /**
     * @var string
     *
     * @ORM\Column(name="palavra_chave_4", type="string", length=255, nullable=true)
     */
    private $palavraChave4;

    /**
     * @var string
     *
     * @ORM\Column(name="palavra_chave_5", type="string", length=255, nullable=true)
     */
    private $palavraChave5;

    /**
     * @var string
     *
     * @ORM\Column(name="palavra_chave_6", type="string", length=255, nullable=true)
     */
    private $palavraChave6;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CapituloDeLivroPublicado", inversedBy="palavrasChave",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="capitulo_de_livro_publicado_id", referencedColumnName="id")
     */
    private $capituloDeLivroPublicado;


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
     * Set palavraChave1
     *
     * @param string $palavraChave1
     *
     * @return PalavrasChaveCapituloDeLivroPublicado
     */
    public function setPalavraChave1($palavraChave1)
    {
        $this->palavraChave1 = $palavraChave1;

        return $this;
    }

    /**
     * Get palavraChave1
     *
     * @return string
     */
    public function getPalavraChave1()
    {
        return $this->palavraChave1;
    }

    /**
     * Set palavraChave2
     *
     * @param string $palavraChave2
     *
     * @return PalavrasChaveCapituloDeLivroPublicado
     */
    public function setPalavraChave2($palavraChave2)
    {
        $this->palavraChave2 = $palavraChave2;

        return $this;
    }

    /**
     * Get palavraChave2
     *
     * @return string
     */
    public function getPalavraChave2()
    {
        return $this->palavraChave2;
    }

    /**
     * Set palavraChave3
     *
     * @param string $palavraChave3
     *
     * @return PalavrasChaveCapituloDeLivroPublicado
     */
    public function setPalavraChave3($palavraChave3)
    {
        $this->palavraChave3 = $palavraChave3;

        return $this;
    }

    /**
     * Get palavraChave3
     *
     * @return string
     */
    public function getPalavraChave3()
    {
        return $this->palavraChave3;
    }

    /**
     * Set palavraChave4
     *
     * @param string $palavraChave4
     *
     * @return PalavrasChaveCapituloDeLivroPublicado
     */
    public function setPalavraChave4($palavraChave4)
    {
        $this->palavraChave4 = $palavraChave4;

        return $this;
    }

    /**
     * Get palavraChave4
     *
     * @return string
     */
    public function getPalavraChave4()
    {
        return $this->palavraChave4;
    }

    /**
     * Set palavraChave5
     *
     * @param string $palavraChave5
     *
     * @return PalavrasChaveCapituloDeLivroPublicado
     */
    public function setPalavraChave5($palavraChave5)
    {
        $this->palavraChave5 = $palavraChave5;

        return $this;
    }

    /**
     * Get palavraChave5
     *
     * @return string
     */
    public function getPalavraChave5()
    {
        return $this->palavraChave5;
    }

    /**
     * Set palavraChave6
     *
     * @param string $palavraChave6
     *
     * @return PalavrasChaveCapituloDeLivroPublicado
     */
    public function setPalavraChave6($palavraChave6)
    {
        $this->palavraChave6 = $palavraChave6;

        return $this;
    }

    /**
     * Get palavraChave6
     *
     * @return string
     */
    public function getPalavraChave6()
    {
        return $this->palavraChave6;
    }

    /**
     * Set capituloDeLivroPublicado
     *
     * @param string $capituloDeLivroPublicado
     *
     * @return PalavrasChaveCapituloDeLivroPublicado
     */
    public function setCapituloDeLivroPublicado($capituloDeLivroPublicado)
    {
        $this->capituloDeLivroPublicado = $capituloDeLivroPublicado;

        return $this;
    }

    /**
     * Get capituloDeLivroPublicado
     *
     * @return string
     */
    public function getCapituloDeLivroPublicado()
    {
        return $this->capituloDeLivroPublicado;
    }
}

