<?php

namespace Zerbikat\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zerbikat\BackendBundle\Annotation\UdalaEgiaztatu;

/**
 * IsiltasunAdministratiboa
 *
 * @ORM\Table(name="isiltasunadministratiboa")
 * @ORM\Entity
 * @UdalaEgiaztatu(userFieldName="udala_id")
 */
class IsiltasunAdministratiboa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="isiltasuneu", type="string", length=255, nullable=true)
     */
    private $isiltasuneu;

    /**
     * @var string
     *
     * @ORM\Column(name="isiltasunes", type="string", length=255, nullable=true)
     */
    private $isiltasunes;


    /**
     *          ERLAZIOAK
     */

    /**
     * @var udala
     * @ORM\ManyToOne(targetEntity="Udala", cascade={"remove"})
     * @ORM\JoinColumn(name="udala_id", referencedColumnName="id",onDelete="CASCADE")
     *
     */
    private $udala;



    /**
     *          FUNTZIOAK
     */
    
    
    /**
     * @return string
     * 
     */

    public function __toString()
    {
        return $this->getIsiltasuneu();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fitxak = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isiltasuneu
     *
     * @param string $isiltasuneu
     *
     * @return IsiltasunAdministratiboa
     */
    public function setIsiltasuneu($isiltasuneu)
    {
        $this->isiltasuneu = $isiltasuneu;

        return $this;
    }

    /**
     * Get isiltasuneu
     *
     * @return string
     */
    public function getIsiltasuneu()
    {
        return $this->isiltasuneu;
    }

    /**
     * Set isiltasunes
     *
     * @param string $isiltasunes
     *
     * @return IsiltasunAdministratiboa
     */
    public function setIsiltasunes($isiltasunes)
    {
        $this->isiltasunes = $isiltasunes;

        return $this;
    }

    /**
     * Get isiltasunes
     *
     * @return string
     */
    public function getIsiltasunes()
    {
        return $this->isiltasunes;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add fitxak
     *
     * @param \Zerbikat\BackendBundle\Entity\Fitxa $fitxak
     *
     * @return IsiltasunAdministratiboa
     */
    public function addFitxak(\Zerbikat\BackendBundle\Entity\Fitxa $fitxak)
    {
        $this->fitxak[] = $fitxak;

        return $this;
    }

    /**
     * Remove fitxak
     *
     * @param \Zerbikat\BackendBundle\Entity\Fitxa $fitxak
     */
    public function removeFitxak(\Zerbikat\BackendBundle\Entity\Fitxa $fitxak)
    {
        $this->fitxak->removeElement($fitxak);
    }

    /**
     * Get fitxak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFitxak()
    {
        return $this->fitxak;
    }

    /**
     * Set udala
     *
     * @param \Zerbikat\BackendBundle\Entity\Udala $udala
     *
     * @return IsiltasunAdministratiboa
     */
    public function setUdala(\Zerbikat\BackendBundle\Entity\Udala $udala = null)
    {
        $this->udala = $udala;

        return $this;
    }

    /**
     * Get udala
     *
     * @return \Zerbikat\BackendBundle\Entity\Udala
     */
    public function getUdala()
    {
        return $this->udala;
    }
}
