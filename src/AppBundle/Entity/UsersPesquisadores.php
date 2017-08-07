<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pesquisador
 *
 * @ORM\Table(name="user_pesquisadores")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersPesquisadoresRepository")
 */
class UsersPesquisadores
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pesquisador")
     * @ORM\JoinColumn(name="pesquisador", referencedColumnName="id")
     */
    private $pesquisador;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPesquisador()
    {
        return $this->pesquisador;
    }

    /**
     * @param mixed $pesquisador
     */
    public function setPesquisador($pesquisador)
    {
        $this->pesquisador = $pesquisador;
    }


}