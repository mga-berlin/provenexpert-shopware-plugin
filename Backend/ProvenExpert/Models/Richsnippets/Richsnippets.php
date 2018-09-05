<?php

namespace Shopware\CustomModels\Richsnippets;

use Shopware\Components\Model\ModelEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_plugin_provenexpert_rs")
 */
class Richsnippets extends ModelEntity
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $pe_rsApiScriptVersion
     *
     * @ORM\Column(type="string", length=3)
     */
    private $pe_rsApiScriptVersion;
    
    /**
     * @var integer $pe_rsStatus
     *
     * @ORM\Column(type="integer", length=1)
     */
    private $pe_rsStatus;    
    
    /**
     * @var integer $pe_rsVersion
     *
     * @ORM\Column(type="integer", length=1)
     */
    private $pe_rsVersion;    

    /**
     * @return int
     */
    public function getId()
    {
        return $this->rsid;
    }

    /**
     * @param string $pe_rsApiScriptVersion
     */
    public function setpe_rsApiScriptVersion($pe_rsApiScriptVersion)
    {
        $this->pe_rsApiScriptVersion = $pe_rsApiScriptVersion;
    }

    /**
     * @return string
     */
    public function getpe_rsApiScriptVersion()
    {
        return $this->pe_rsApiScriptVersion;
    }
      
    /**
     * @param integer $pe_rsStatus
     */
    public function setpe_rsStatus($pe_rsStatus)
    {
        $this->pe_rsStatus = $pe_rsStatus;
    }

    /**
     * @return integer
     */
    public function getpe_rsStatus()
    {
        return $this->pe_rsStatus;
    }     
    
    /**
     * @param integer $pe_rsVersion
     */
    public function setpe_rsVersion($pe_rsVersion)
    {
        $this->pe_rsVersion = $pe_rsVersion;
    }

    /**
     * @return integer
     */
    public function getpe_rsVersion()
    {
        return $this->pe_rsVersion;
    }      
}
