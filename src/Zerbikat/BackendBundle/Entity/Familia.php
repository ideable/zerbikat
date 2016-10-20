<?php

    namespace Zerbikat\BackendBundle\Entity;

    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;
    use JMS\Serializer\Annotation\ExclusionPolicy;
    use JMS\Serializer\Annotation\Expose;
    use Zerbikat\BackendBundle\Annotation\UdalaEgiaztatu;

    /**
     * Familia
     *
     * @ORM\Table(name="familia")
     * @ORM\Entity
     * @ExclusionPolicy("all")
     * @UdalaEgiaztatu(userFieldName="udala_id")
     */
    class Familia
    {

        /**
         * @var integer
         * @Expose
         *
         * @ORM\Column(name="id", type="bigint")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         *
         * @var string
         * @Expose
         *
         * @ORM\Column(name="familiaeu", type="string", length=255, nullable=true)
         */
        private $familiaeu;


        /**
         * @var string
         * @Expose
         *
         * @ORM\Column(name="familiaes", type="string", length=255, nullable=true)
         */
        private $familiaes;

        /**
         * @var string
         * @Expose
         *
         * @ORM\Column(name="deskribapenaeu", type="string", length=255, nullable=true)
         */
        private $deskribapenaeu;

        /**
         * @var string
         * @Expose
         *
         * @ORM\Column(name="deskribapenaes", type="string", length=255, nullable=true)
         */
        private $deskribapenaes;


        /**
         *
         *      ERLAZIOAK
         *
         */

        /**
         * @var udala
         * @ORM\ManyToOne(targetEntity="Udala")
         * @ORM\JoinColumn(name="udala_id", referencedColumnName="id",onDelete="CASCADE")
         *
         */
        private $udala;

        /**
         * @ORM\OneToMany(targetEntity="Zerbikat\BackendBundle\Entity\Fitxafamilia", mappedBy="familia")
         */
        private $fitxafamilia;


        /**
         *      FUNTZIOAK
         */

        /**
         * @return string
         */

        public function __toString ()
        {
            return $this->getFamiliaeu();
        }

        /**
         * Constructor
         */
        public function __construct ()
        {
            $this->fitxafamilia = new ArrayCollection();
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
     * Set familiaeu
     *
     * @param string $familiaeu
     *
     * @return Familia
     */
    public function setFamiliaeu($familiaeu)
    {
        $this->familiaeu = $familiaeu;

        return $this;
    }

    /**
     * Get familiaeu
     *
     * @return string
     */
    public function getFamiliaeu()
    {
        return $this->familiaeu;
    }

    /**
     * Set familiaes
     *
     * @param string $familiaes
     *
     * @return Familia
     */
    public function setFamiliaes($familiaes)
    {
        $this->familiaes = $familiaes;

        return $this;
    }

    /**
     * Get familiaes
     *
     * @return string
     */
    public function getFamiliaes()
    {
        return $this->familiaes;
    }

    /**
     * Set deskribapenaeu
     *
     * @param string $deskribapenaeu
     *
     * @return Familia
     */
    public function setDeskribapenaeu($deskribapenaeu)
    {
        $this->deskribapenaeu = $deskribapenaeu;

        return $this;
    }

    /**
     * Get deskribapenaeu
     *
     * @return string
     */
    public function getDeskribapenaeu()
    {
        return $this->deskribapenaeu;
    }

    /**
     * Set deskribapenaes
     *
     * @param string $deskribapenaes
     *
     * @return Familia
     */
    public function setDeskribapenaes($deskribapenaes)
    {
        $this->deskribapenaes = $deskribapenaes;

        return $this;
    }

    /**
     * Get deskribapenaes
     *
     * @return string
     */
    public function getDeskribapenaes()
    {
        return $this->deskribapenaes;
    }

    /**
     * Set udala
     *
     * @param \Zerbikat\BackendBundle\Entity\Udala $udala
     *
     * @return Familia
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

    /**
     * Add fitxafamilium
     *
     * @param \Zerbikat\BackendBundle\Entity\Fitxafamilia $fitxafamilium
     *
     * @return Familia
     */
    public function addFitxafamilium(\Zerbikat\BackendBundle\Entity\Fitxafamilia $fitxafamilium)
    {
        $this->fitxafamilia[] = $fitxafamilium;

        return $this;
    }

    /**
     * Remove fitxafamilium
     *
     * @param \Zerbikat\BackendBundle\Entity\Fitxafamilia $fitxafamilium
     */
    public function removeFitxafamilium(\Zerbikat\BackendBundle\Entity\Fitxafamilia $fitxafamilium)
    {
        $this->fitxafamilia->removeElement($fitxafamilium);
    }

    /**
     * Get fitxafamilia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFitxafamilia()
    {
        return $this->fitxafamilia;
    }
}
