<?php

namespace Shopware\CustomModels\Seals;

use Shopware\Components\Model\ModelEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_plugin_provenexpert_seals")
 */
class Seals extends ModelEntity
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer $pe_widgetActive
     *
     * @ORM\Column(type="integer", length=1)
     */
    private $pe_widgetActive;

    /**
     * @var string $pe_type
     *
     * @ORM\Column(type="string")
     */
    private $pe_type;

    /**
     * @var string $pe_style
     *
     * @ORM\Column(type="string", length=30)
     */
    private $pe_style;
      
    /**
     * @var integer $pe_feedback
     *
     * @ORM\Column(type="integer")
     */
    private $pe_feedback;            
    
    /**
     * @var integer $pe_avatar
     *
     * @ORM\Column(type="integer")
     */
    private $pe_avatar;
    
    /**
     * @var integer $pe_competence
     *
     * @ORM\Column(type="integer")
     */
    private $pe_competence;

    /**
     * @var string $pe_position
     *
     * @ORM\Column(type="string")
     */
    private $pe_position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param int $pe_widgetActive
     */
    public function setpe_widgetActive($pe_widgetActive)
    {
        $this->pe_widgetActive = $pe_widgetActive;
    }

    /**
     * @return int
     */
    public function getpe_widgetActive()
    {
        return $this->pe_widgetActive;
    }
    
    /**
     * @param string $pe_type
     */
    public function setpe_type($pe_type)
    {
        $this->pe_type = $pe_type;
    }

    /**
     * @return string
     */
    public function getpe_type()
    {
        return $this->pe_type;
    }
    /**
     * @param string $pe_style
     */
    public function setpe_style($pe_style)
    {
        $this->pe_style = $pe_style;
    }

    /**
     * @return string
     */
    public function getpe_style()
    {
        return $this->pe_style;
    }

    /**
     * @param int $pe_feedback
     */
    public function setpe_feedback($pe_feedback)
    {
        $this->pe_feedback = $pe_feedback;
    }

    /**
     * @return int
     */
    public function getpe_feedback()
    {
        return $this->pe_feedback;
    }

    /**
     * @param int $pe_avatar
     */
    public function setpe_avatar($pe_avatar)
    {
        $this->pe_avatar = $pe_avatar;
    }

    /**
     * @return int
     */
    public function getpe_avatar()
    {
        return $this->pe_avatar;
    }
    /**
     * @param int $pe_competence
     */
    public function setpe_competence($pe_competence)
    {
        $this->pe_competence = $pe_competence;
    }

    /**
     * @return int
     */
    public function getpe_competence()
    {
        return $this->pe_competence;
    }

    /**
     * @param string $pe_position
     */
    public function setpe_position($pe_position)
    {
        $this->pe_position = $pe_position;
    }

    /**
     * @return string
     */
    public function getpe_position()
    {
        return $this->pe_position;
    }
}
