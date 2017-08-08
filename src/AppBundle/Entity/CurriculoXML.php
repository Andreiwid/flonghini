<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class CurriculoXML
{
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="O arquivo deve possuir o formato XML.")
     */
    private $file;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

}