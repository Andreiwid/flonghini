<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SetoresDeAtividadeCapituloDeLivroPublicado
 *
 * @ORM\Table(name="setores_de_atividade_capitulo_de_livro_publicado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SetoresDeAtividadeCapituloDeLivroPublicadoRepository")
 */
class SetoresDeAtividadeCapituloDeLivroPublicado
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
     * @ORM\Column(name="setor_de_atividade_1", type="string", length=255, nullable=true)
     */
    private $setorDeAtividade1;

    /**
     * @var string
     *
     * @ORM\Column(name="setor_de_atividade_2", type="string", length=255, nullable=true)
     */
    private $setorDeAtividade2;

    /**
     * @var string
     *
     * @ORM\Column(name="setor_de_atividade_3", type="string", length=255, nullable=true)
     */
    private $setorDeAtividade3;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CapituloDeLivroPublicado", inversedBy="setoresDeAtividade",
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
     * Set setorDeAtividade1
     *
     * @param string $setorDeAtividade1
     *
     * @return SetoresDeAtividadeCapituloDeLivroPublicado
     */
    public function setSetorDeAtividade1($setorDeAtividade1)
    {
        $this->setorDeAtividade1 = $setorDeAtividade1;

        return $this;
    }

    /**
     * Get setorDeAtividade1
     *
     * @return string
     */
    public function getSetorDeAtividade1()
    {
        return $this->setorDeAtividade1;
    }

    /**
     * Set setorDeAtividade2
     *
     * @param string $setorDeAtividade2
     *
     * @return SetoresDeAtividadeCapituloDeLivroPublicado
     */
    public function setSetorDeAtividade2($setorDeAtividade2)
    {
        $this->setorDeAtividade2 = $setorDeAtividade2;

        return $this;
    }

    /**
     * Get setorDeAtividade2
     *
     * @return string
     */
    public function getSetorDeAtividade2()
    {
        return $this->setorDeAtividade2;
    }

    /**
     * Set setorDeAtividade3
     *
     * @param string $setorDeAtividade3
     *
     * @return SetoresDeAtividadeCapituloDeLivroPublicado
     */
    public function setSetorDeAtividade3($setorDeAtividade3)
    {
        $this->setorDeAtividade3 = $setorDeAtividade3;

        return $this;
    }

    /**
     * Get setorDeAtividade3
     *
     * @return string
     */
    public function getSetorDeAtividade3()
    {
        return $this->setorDeAtividade3;
    }

    /**
     * Set capituloDeLivroPublicado
     *
     * @param string $capituloDeLivroPublicado
     *
     * @return SetoresDeAtividadeCapituloDeLivroPublicado
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

