<?php

namespace Zerbikat\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


/**
 * Fitxa
 *
 * @ORM\Table(name="fitxa", indexes={@ORM\Index(name="aurreikusi_id_idx", columns={"aurreikusi_id"}), @ORM\Index(name="arrunta_id_idx", columns={"arrunta_id"}), @ORM\Index(name="norkebatzi_id_idx", columns={"norkebatzi_id"}), @ORM\Index(name="azpisaila_id_idx", columns={"azpisaila_id"}), @ORM\Index(name="datuenbabesa_id_idx", columns={"datuenbabesa_id"}), @ORM\Index(name="zerbitzua_id_idx", columns={"zerbitzua_id"})})
 * @ORM\Entity
 * @ExclusionPolicy("all") 
 */
class Fitxa
{
    /**
     * @var integer
     *
     * @Expose
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Udala") */
    private $udala;

    /**
     * @var string
     * @Expose
     * @ORM\Column(name="espedientekodea", type="string", length=9, nullable=true)
     */
    private $espedientekodea;

    /**
     * @var string
     * @Expose
     * @ORM\Column(name="deskribapenaeu", type="string", length=255, nullable=true)
     */
    private $deskribapenaeu;

    /**
     * @var string
     * @Expose
     * @ORM\Column(name="deskribapenaes", type="string", length=255, nullable=true)
     */
    private $deskribapenaes;

    /**
     * @var string
     *
     * @ORM\Column(name="helburuaeu", type="text", length=65535, nullable=true)
     */
    private $helburuaeu;

    /**
     * @var string
     *
     * @ORM\Column(name="helburuaes", type="text", length=65535, nullable=true)
     */
    private $helburuaes;

    /**
     * @var string
     *
     * @ORM\Column(name="norkeu", type="text", length=65535, nullable=true)
     */
    private $norkeu;

    /**
     * @var string
     *
     * @ORM\Column(name="norkes", type="text", length=65535, nullable=true)
     */
    private $norkes;

    /**
     * @var string
     *
     * @ORM\Column(name="dokumentazioaeu", type="text", length=65535, nullable=true)
     */
    private $dokumentazioaeu;

    /**
     * @var string
     *
     * @ORM\Column(name="dokumentazioaes", type="text", length=65535, nullable=true)
     */
    private $dokumentazioaes;

    /**
     * @var string
     *
     * @ORM\Column(name="kostuaeu", type="text", length=65535, nullable=true)
     */
    private $kostuaeu;

    /**
     * @var string
     *
     * @ORM\Column(name="kostuaes", type="text", length=65535, nullable=true)
     */
    private $kostuaes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ebazpensinpli", type="boolean", nullable=true)
     */
    private $ebazpensinpli;

    /**
     * @var boolean
     *
     * @ORM\Column(name="arduraaitorpena", type="boolean", nullable=true)
     */
    private $arduraaitorpena;

    /**
     * @var string
     *
     * @ORM\Column(name="araudiaeu", type="text", length=65535, nullable=true)
     */
    private $araudiaeu;

    /**
     * @var string
     *
     * @ORM\Column(name="araudiaes", type="text", length=65535, nullable=true)
     */
    private $araudiaes;

    /**
     * @var string
     *
     * @ORM\Column(name="prozeduraeu", type="text", length=65535, nullable=true)
     */
    private $prozeduraeu;

    /**
     * @var string
     *
     * @ORM\Column(name="prozeduraes", type="text", length=65535, nullable=true)
     */
    private $prozeduraes;

    /**
     * @var string
     *
     * @ORM\Column(name="tramiteakeu", type="text", length=65535, nullable=true)
     */
    private $tramiteakeu;

    /**
     * @var string
     *
     * @ORM\Column(name="tramiteakes", type="text", length=65535, nullable=true)
     */
    private $tramiteakes;

    /**
     * @var string
     *
     * @ORM\Column(name="doklaguneu", type="text", length=65535, nullable=true)
     */
    private $doklaguneu;

    /**
     * @var string
     *
     * @ORM\Column(name="doklagunes", type="text", length=65535, nullable=true)
     */
    private $doklagunes;

    /**
     * @var string
     *
     * @ORM\Column(name="oharrakeu", type="text", length=65535, nullable=true)
     */
    private $oharrakeu;

    /**
     * @var string
     *
     * @ORM\Column(name="oharrakes", type="text", length=65535, nullable=true)
     */
    private $oharrakes;

    /**
     * @var datuenbabesaeu
     *
     * @ORM\Column(name="datuenbabesaeu", type="text", length=65535, nullable=true)
     */
    private $datuenbabesaeu;

    /**
     * @var datuenbabesaes
     *
     * @ORM\Column(name="datuenbabesaes", type="text", length=65535, nullable=true)
     */
    private $datuenbabesaes;

    /**
     * @var norkonartueu
     *
     * @ORM\Column(name="norkonartueu", type="text", length=65535, nullable=true)
     */
    private $norkonartueu;

    /**
     * @var norkonartues
     *
     * @ORM\Column(name="norkonartues", type="text", length=65535, nullable=true)
     */
    private $norkonartues;


    /**
     * @var boolean
     *
     * @ORM\Column(name="publikoa", type="boolean", nullable=true)
     */
    private $publikoa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hitzarmena", type="boolean", nullable=true)
     */
    private $hitzarmena;


    /**
     * @var integer
     *
     * @ORM\Column(name="kontsultak", type="bigint", nullable=true)
     */
    private $kontsultak;

    /**
     * @var string
     *
     * @ORM\Column(name="parametroa", type="string", length=50, nullable=true)
     */
    private $parametroa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;



    /**
     * @var \Zerbikat\BackendBundle\Entity\Norkebatzi
     *
     * @ORM\ManyToOne(targetEntity="Zerbikat\BackendBundle\Entity\Norkebatzi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="norkebatzi_id", referencedColumnName="id")
     * })
     */
    private $norkebatzi;

    /**
     * @var \Zerbikat\BackendBundle\Entity\Zerbitzua
     *
     * @ORM\ManyToOne(targetEntity="Zerbikat\BackendBundle\Entity\Zerbitzua")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zerbitzua_id", referencedColumnName="id")
     * })
     */
    private $zerbitzua;

    /**
     * @var \Zerbikat\BackendBundle\Entity\Datuenbabesa
     *
     * @ORM\ManyToOne(targetEntity="Zerbikat\BackendBundle\Entity\Datuenbabesa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="datuenbabesa_id", referencedColumnName="id")
     * })
     */
    private $datuenbabesa;

    /**
     * @var \Zerbikat\BackendBundle\Entity\Azpisaila
     *
     * @ORM\ManyToOne(targetEntity="Zerbikat\BackendBundle\Entity\Azpisaila")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="azpisaila_id", referencedColumnName="id")
     * })
     */
    private $azpisaila;

    /**
     * @var \Zerbikat\BackendBundle\Entity\Aurreikusi
     *
     * @ORM\ManyToOne(targetEntity="Zerbikat\BackendBundle\Entity\Aurreikusi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aurreikusi_id", referencedColumnName="id")
     * })
     */
    private $aurreikusi;

    /**
     * @var \Zerbikat\BackendBundle\Entity\Arrunta
     *
     * @ORM\ManyToOne(targetEntity="Zerbikat\BackendBundle\Entity\Arrunta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="arrunta_id", referencedColumnName="id")
     * })
     */
    private $arrunta;

    /**
     * @var string
     *
     * @ORM\Column(name="besteak1eu", type="text", length=65535, nullable=true)
     */
    private $besteak1eu;

    /**
     * @var string
     *
     * @ORM\Column(name="besteak1es", type="text", length=65535, nullable=true)
     */
    private $besteak1es;
    /**
     * @var string
     *
     * @ORM\Column(name="besteak2eu", type="text", length=65535, nullable=true)
     */
    private $besteak2eu;

    /**
     * @var string
     *
     * @ORM\Column(name="besteak2es", type="text", length=65535, nullable=true)
     */
    private $besteak2es;
    /**
     * @var string
     *
     * @ORM\Column(name="besteak3eu", type="text", length=65535, nullable=true)
     */
    private $besteak3eu;

    /**
     * @var string
     *
     * @ORM\Column(name="besteak3es", type="text", length=65535, nullable=true)
     */
    private $besteak3es;

    /**
     * @var kanalaeu
     *
     * @ORM\Column(name="kanalaeu", type="text", length=65535, nullable=true)
     */
    private $kanalaeu;

    /**
     * @var kanalaes
     *
     * @ORM\Column(name="kanalaes", type="text", length=65535, nullable=true)
     */
    private $kanalaes;



    /**
     *      ERLAZIOAK
     */


    /**
     * @var araudiak[]
     *
     * @ORM\OneToMany(targetEntity="FitxaAraudia", mappedBy="fitxa", cascade={"remove"})
     */
    private $araudiak;

    /**
     * @var dokumentazioak[]
     *
     * @ORM\OneToMany(targetEntity="FitxaDokumentazioa", mappedBy="fitxa", cascade={"remove"})
     */
    private $dokumentazioak;

    /**
     * @var kanalak[]
     *
     * @ORM\ManyToMany(targetEntity="Kanala",cascade={"remove"},inversedBy="fitxak")
     */
    private $kanalak;



    /**
     * @var familiak[]
     *
     * @ORM\ManyToMany(targetEntity="Familia",cascade={"remove"},inversedBy="fitxak")
     */
    private $familiak;

    /**
     * @var besteak1ak[]
     *
     * @ORM\ManyToMany(targetEntity="Besteak1",cascade={"remove"},inversedBy="fitxak")
     */
    private $besteak1ak;

    /**
     * @var besteak2ak[]
     *
     * @ORM\ManyToMany(targetEntity="Besteak2",cascade={"remove"},inversedBy="fitxak")
     */
    private $besteak2ak;

    /**
     * @var besteak3ak[]
     *
     * @ORM\ManyToMany(targetEntity="Besteak3",cascade={"remove"},inversedBy="fitxak")
     */
    private $besteak3ak;
    
    /**
     * @var etiketak[]
     *
     * @ORM\ManyToMany(targetEntity="Etiketa",cascade={"remove"},inversedBy="fitxak")
     */
    private $etiketak;

//    /**
//     * @var tramiteak[]
//     *
//     * @ORM\OneToMany(targetEntity="FitxaTramitea", mappedBy="fitxa", cascade={"remove"})
//     */
//    private $tramiteak;

    /**
     * @ORM\ManyToMany(targetEntity="Tramitea")
     * @ORM\JoinTable(name="fitxa_tramitea",
     *      joinColumns={@ORM\JoinColumn(name="fitxa_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tramitea_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $tramiteak;



    /**
     * @var norkeskatuak[]
     *
     * @ORM\ManyToMany(targetEntity="Norkeskatu",inversedBy="fitxak",cascade={"remove"})
     */
    private $norkeskatuak;

    /**
     * @var doklagunak[]
     *
     * @ORM\ManyToMany(targetEntity="Doklagun",inversedBy="fitxak",cascade={"remove"})
     */
    private $doklagunak;

//    /**
//     * @var prozedurak[]
//     *
//     * @ORM\OneToMany(targetEntity="FitxaProzedura" , mappedBy="fitxa" , cascade={"remove"})
//     */
//    private $prozedurak;

    /**
     * @ORM\ManyToMany(targetEntity="Prozedura")
     * @ORM\JoinTable(name="fitxa_prozedura",
     *      joinColumns={@ORM\JoinColumn(name="fitxa_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="prozedura_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $prozedurak;



    /**
     * @var azpiatalak[]
     *
     * @ORM\ManyToMany(targetEntity="Azpiatala",inversedBy="fitxak",cascade={"remove"})
     * @ORM\JoinTable(name="fitxa_azpiatala")
     */
    private $azpiatalak;


    /**
     * @var \Zerbikat\BackendBundle\Entity\IsiltasunAdministratiboa
     *
     * @ORM\ManyToOne(targetEntity="Zerbikat\BackendBundle\Entity\IsiltasunAdministratiboa",inversedBy="fitxak")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="isiltasunadmin_id", referencedColumnName="id")
     * })
     */
    private $isiltasunadmin;



    /**
     *
     *
     *      FUNTZIOAK
     *
     *
     *
     */



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->araudiak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dokumentazioak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->kanalak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->familiak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->besteak1ak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->besteak2ak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->besteak3ak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etiketak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tramiteak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->norkeskatuak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->doklagunak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prozedurak = new \Doctrine\Common\Collections\ArrayCollection();
        $this->azpiatalak = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set espedientekodea
     *
     * @param string $espedientekodea
     *
     * @return Fitxa
     */
    public function setEspedientekodea($espedientekodea)
    {
        $this->espedientekodea = $espedientekodea;

        return $this;
    }

    /**
     * Get espedientekodea
     *
     * @return string
     */
    public function getEspedientekodea()
    {
        return $this->espedientekodea;
    }

    /**
     * Set deskribapenaeu
     *
     * @param string $deskribapenaeu
     *
     * @return Fitxa
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
     * @return Fitxa
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
     * Set helburuaeu
     *
     * @param string $helburuaeu
     *
     * @return Fitxa
     */
    public function setHelburuaeu($helburuaeu)
    {
        $this->helburuaeu = $helburuaeu;

        return $this;
    }

    /**
     * Get helburuaeu
     *
     * @return string
     */
    public function getHelburuaeu()
    {
        return $this->helburuaeu;
    }

    /**
     * Set helburuaes
     *
     * @param string $helburuaes
     *
     * @return Fitxa
     */
    public function setHelburuaes($helburuaes)
    {
        $this->helburuaes = $helburuaes;

        return $this;
    }

    /**
     * Get helburuaes
     *
     * @return string
     */
    public function getHelburuaes()
    {
        return $this->helburuaes;
    }

    /**
     * Set norkeu
     *
     * @param string $norkeu
     *
     * @return Fitxa
     */
    public function setNorkeu($norkeu)
    {
        $this->norkeu = $norkeu;

        return $this;
    }

    /**
     * Get norkeu
     *
     * @return string
     */
    public function getNorkeu()
    {
        return $this->norkeu;
    }

    /**
     * Set norkes
     *
     * @param string $norkes
     *
     * @return Fitxa
     */
    public function setNorkes($norkes)
    {
        $this->norkes = $norkes;

        return $this;
    }

    /**
     * Get norkes
     *
     * @return string
     */
    public function getNorkes()
    {
        return $this->norkes;
    }

    /**
     * Set dokumentazioaeu
     *
     * @param string $dokumentazioaeu
     *
     * @return Fitxa
     */
    public function setDokumentazioaeu($dokumentazioaeu)
    {
        $this->dokumentazioaeu = $dokumentazioaeu;

        return $this;
    }

    /**
     * Get dokumentazioaeu
     *
     * @return string
     */
    public function getDokumentazioaeu()
    {
        return $this->dokumentazioaeu;
    }

    /**
     * Set dokumentazioaes
     *
     * @param string $dokumentazioaes
     *
     * @return Fitxa
     */
    public function setDokumentazioaes($dokumentazioaes)
    {
        $this->dokumentazioaes = $dokumentazioaes;

        return $this;
    }

    /**
     * Get dokumentazioaes
     *
     * @return string
     */
    public function getDokumentazioaes()
    {
        return $this->dokumentazioaes;
    }

    /**
     * Set kostuaeu
     *
     * @param string $kostuaeu
     *
     * @return Fitxa
     */
    public function setKostuaeu($kostuaeu)
    {
        $this->kostuaeu = $kostuaeu;

        return $this;
    }

    /**
     * Get kostuaeu
     *
     * @return string
     */
    public function getKostuaeu()
    {
        return $this->kostuaeu;
    }

    /**
     * Set kostuaes
     *
     * @param string $kostuaes
     *
     * @return Fitxa
     */
    public function setKostuaes($kostuaes)
    {
        $this->kostuaes = $kostuaes;

        return $this;
    }

    /**
     * Get kostuaes
     *
     * @return string
     */
    public function getKostuaes()
    {
        return $this->kostuaes;
    }

    /**
     * Set ebazpensinpli
     *
     * @param boolean $ebazpensinpli
     *
     * @return Fitxa
     */
    public function setEbazpensinpli($ebazpensinpli)
    {
        $this->ebazpensinpli = $ebazpensinpli;

        return $this;
    }

    /**
     * Get ebazpensinpli
     *
     * @return boolean
     */
    public function getEbazpensinpli()
    {
        return $this->ebazpensinpli;
    }

    /**
     * Set arduraaitorpena
     *
     * @param boolean $arduraaitorpena
     *
     * @return Fitxa
     */
    public function setArduraaitorpena($arduraaitorpena)
    {
        $this->arduraaitorpena = $arduraaitorpena;

        return $this;
    }

    /**
     * Get arduraaitorpena
     *
     * @return boolean
     */
    public function getArduraaitorpena()
    {
        return $this->arduraaitorpena;
    }

    /**
     * Set araudiaeu
     *
     * @param string $araudiaeu
     *
     * @return Fitxa
     */
    public function setAraudiaeu($araudiaeu)
    {
        $this->araudiaeu = $araudiaeu;

        return $this;
    }

    /**
     * Get araudiaeu
     *
     * @return string
     */
    public function getAraudiaeu()
    {
        return $this->araudiaeu;
    }

    /**
     * Set araudiaes
     *
     * @param string $araudiaes
     *
     * @return Fitxa
     */
    public function setAraudiaes($araudiaes)
    {
        $this->araudiaes = $araudiaes;

        return $this;
    }

    /**
     * Get araudiaes
     *
     * @return string
     */
    public function getAraudiaes()
    {
        return $this->araudiaes;
    }

    /**
     * Set prozeduraeu
     *
     * @param string $prozeduraeu
     *
     * @return Fitxa
     */
    public function setProzeduraeu($prozeduraeu)
    {
        $this->prozeduraeu = $prozeduraeu;

        return $this;
    }

    /**
     * Get prozeduraeu
     *
     * @return string
     */
    public function getProzeduraeu()
    {
        return $this->prozeduraeu;
    }

    /**
     * Set prozeduraes
     *
     * @param string $prozeduraes
     *
     * @return Fitxa
     */
    public function setProzeduraes($prozeduraes)
    {
        $this->prozeduraes = $prozeduraes;

        return $this;
    }

    /**
     * Get prozeduraes
     *
     * @return string
     */
    public function getProzeduraes()
    {
        return $this->prozeduraes;
    }

    /**
     * Set tramiteakeu
     *
     * @param string $tramiteakeu
     *
     * @return Fitxa
     */
    public function setTramiteakeu($tramiteakeu)
    {
        $this->tramiteakeu = $tramiteakeu;

        return $this;
    }

    /**
     * Get tramiteakeu
     *
     * @return string
     */
    public function getTramiteakeu()
    {
        return $this->tramiteakeu;
    }

    /**
     * Set tramiteakes
     *
     * @param string $tramiteakes
     *
     * @return Fitxa
     */
    public function setTramiteakes($tramiteakes)
    {
        $this->tramiteakes = $tramiteakes;

        return $this;
    }

    /**
     * Get tramiteakes
     *
     * @return string
     */
    public function getTramiteakes()
    {
        return $this->tramiteakes;
    }

    /**
     * Set doklaguneu
     *
     * @param string $doklaguneu
     *
     * @return Fitxa
     */
    public function setDoklaguneu($doklaguneu)
    {
        $this->doklaguneu = $doklaguneu;

        return $this;
    }

    /**
     * Get doklaguneu
     *
     * @return string
     */
    public function getDoklaguneu()
    {
        return $this->doklaguneu;
    }

    /**
     * Set doklagunes
     *
     * @param string $doklagunes
     *
     * @return Fitxa
     */
    public function setDoklagunes($doklagunes)
    {
        $this->doklagunes = $doklagunes;

        return $this;
    }

    /**
     * Get doklagunes
     *
     * @return string
     */
    public function getDoklagunes()
    {
        return $this->doklagunes;
    }

    /**
     * Set oharrakeu
     *
     * @param string $oharrakeu
     *
     * @return Fitxa
     */
    public function setOharrakeu($oharrakeu)
    {
        $this->oharrakeu = $oharrakeu;

        return $this;
    }

    /**
     * Get oharrakeu
     *
     * @return string
     */
    public function getOharrakeu()
    {
        return $this->oharrakeu;
    }

    /**
     * Set oharrakes
     *
     * @param string $oharrakes
     *
     * @return Fitxa
     */
    public function setOharrakes($oharrakes)
    {
        $this->oharrakes = $oharrakes;

        return $this;
    }

    /**
     * Get oharrakes
     *
     * @return string
     */
    public function getOharrakes()
    {
        return $this->oharrakes;
    }

    /**
     * Set datuenbabesaeu
     *
     * @param string $datuenbabesaeu
     *
     * @return Fitxa
     */
    public function setDatuenbabesaeu($datuenbabesaeu)
    {
        $this->datuenbabesaeu = $datuenbabesaeu;

        return $this;
    }

    /**
     * Get datuenbabesaeu
     *
     * @return string
     */
    public function getDatuenbabesaeu()
    {
        return $this->datuenbabesaeu;
    }

    /**
     * Set datuenbabesaes
     *
     * @param string $datuenbabesaes
     *
     * @return Fitxa
     */
    public function setDatuenbabesaes($datuenbabesaes)
    {
        $this->datuenbabesaes = $datuenbabesaes;

        return $this;
    }

    /**
     * Get datuenbabesaes
     *
     * @return string
     */
    public function getDatuenbabesaes()
    {
        return $this->datuenbabesaes;
    }

    /**
     * Set norkonartueu
     *
     * @param string $norkonartueu
     *
     * @return Fitxa
     */
    public function setNorkonartueu($norkonartueu)
    {
        $this->norkonartueu = $norkonartueu;

        return $this;
    }

    /**
     * Get norkonartueu
     *
     * @return string
     */
    public function getNorkonartueu()
    {
        return $this->norkonartueu;
    }

    /**
     * Set norkonartues
     *
     * @param string $norkonartues
     *
     * @return Fitxa
     */
    public function setNorkonartues($norkonartues)
    {
        $this->norkonartues = $norkonartues;

        return $this;
    }

    /**
     * Get norkonartues
     *
     * @return string
     */
    public function getNorkonartues()
    {
        return $this->norkonartues;
    }

    /**
     * Set publikoa
     *
     * @param boolean $publikoa
     *
     * @return Fitxa
     */
    public function setPublikoa($publikoa)
    {
        $this->publikoa = $publikoa;

        return $this;
    }

    /**
     * Get publikoa
     *
     * @return boolean
     */
    public function getPublikoa()
    {
        return $this->publikoa;
    }

    /**
     * Set hitzarmena
     *
     * @param boolean $hitzarmena
     *
     * @return Fitxa
     */
    public function setHitzarmena($hitzarmena)
    {
        $this->hitzarmena = $hitzarmena;

        return $this;
    }

    /**
     * Get hitzarmena
     *
     * @return boolean
     */
    public function getHitzarmena()
    {
        return $this->hitzarmena;
    }

    /**
     * Set kontsultak
     *
     * @param integer $kontsultak
     *
     * @return Fitxa
     */
    public function setKontsultak($kontsultak)
    {
        $this->kontsultak = $kontsultak;

        return $this;
    }

    /**
     * Get kontsultak
     *
     * @return integer
     */
    public function getKontsultak()
    {
        return $this->kontsultak;
    }

    /**
     * Set parametroa
     *
     * @param string $parametroa
     *
     * @return Fitxa
     */
    public function setParametroa($parametroa)
    {
        $this->parametroa = $parametroa;

        return $this;
    }

    /**
     * Get parametroa
     *
     * @return string
     */
    public function getParametroa()
    {
        return $this->parametroa;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Fitxa
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Fitxa
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Set besteak1eu
     *
     * @param string $besteak1eu
     *
     * @return Fitxa
     */
    public function setBesteak1eu($besteak1eu)
    {
        $this->besteak1eu = $besteak1eu;

        return $this;
    }

    /**
     * Get besteak1eu
     *
     * @return string
     */
    public function getBesteak1eu()
    {
        return $this->besteak1eu;
    }

    /**
     * Set besteak1es
     *
     * @param string $besteak1es
     *
     * @return Fitxa
     */
    public function setBesteak1es($besteak1es)
    {
        $this->besteak1es = $besteak1es;

        return $this;
    }

    /**
     * Get besteak1es
     *
     * @return string
     */
    public function getBesteak1es()
    {
        return $this->besteak1es;
    }

    /**
     * Set besteak2eu
     *
     * @param string $besteak2eu
     *
     * @return Fitxa
     */
    public function setBesteak2eu($besteak2eu)
    {
        $this->besteak2eu = $besteak2eu;

        return $this;
    }

    /**
     * Get besteak2eu
     *
     * @return string
     */
    public function getBesteak2eu()
    {
        return $this->besteak2eu;
    }

    /**
     * Set besteak2es
     *
     * @param string $besteak2es
     *
     * @return Fitxa
     */
    public function setBesteak2es($besteak2es)
    {
        $this->besteak2es = $besteak2es;

        return $this;
    }

    /**
     * Get besteak2es
     *
     * @return string
     */
    public function getBesteak2es()
    {
        return $this->besteak2es;
    }

    /**
     * Set besteak3eu
     *
     * @param string $besteak3eu
     *
     * @return Fitxa
     */
    public function setBesteak3eu($besteak3eu)
    {
        $this->besteak3eu = $besteak3eu;

        return $this;
    }

    /**
     * Get besteak3eu
     *
     * @return string
     */
    public function getBesteak3eu()
    {
        return $this->besteak3eu;
    }

    /**
     * Set besteak3es
     *
     * @param string $besteak3es
     *
     * @return Fitxa
     */
    public function setBesteak3es($besteak3es)
    {
        $this->besteak3es = $besteak3es;

        return $this;
    }

    /**
     * Get besteak3es
     *
     * @return string
     */
    public function getBesteak3es()
    {
        return $this->besteak3es;
    }

    /**
     * Set kanalaeu
     *
     * @param string $kanalaeu
     *
     * @return Fitxa
     */
    public function setKanalaeu($kanalaeu)
    {
        $this->kanalaeu = $kanalaeu;

        return $this;
    }

    /**
     * Get kanalaeu
     *
     * @return string
     */
    public function getKanalaeu()
    {
        return $this->kanalaeu;
    }

    /**
     * Set kanalaes
     *
     * @param string $kanalaes
     *
     * @return Fitxa
     */
    public function setKanalaes($kanalaes)
    {
        $this->kanalaes = $kanalaes;

        return $this;
    }

    /**
     * Get kanalaes
     *
     * @return string
     */
    public function getKanalaes()
    {
        return $this->kanalaes;
    }

    /**
     * Set udala
     *
     * @param \Zerbikat\BackendBundle\Entity\Udala $udala
     *
     * @return Fitxa
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
     * Set norkebatzi
     *
     * @param \Zerbikat\BackendBundle\Entity\Norkebatzi $norkebatzi
     *
     * @return Fitxa
     */
    public function setNorkebatzi(\Zerbikat\BackendBundle\Entity\Norkebatzi $norkebatzi = null)
    {
        $this->norkebatzi = $norkebatzi;

        return $this;
    }

    /**
     * Get norkebatzi
     *
     * @return \Zerbikat\BackendBundle\Entity\Norkebatzi
     */
    public function getNorkebatzi()
    {
        return $this->norkebatzi;
    }

    /**
     * Set zerbitzua
     *
     * @param \Zerbikat\BackendBundle\Entity\Zerbitzua $zerbitzua
     *
     * @return Fitxa
     */
    public function setZerbitzua(\Zerbikat\BackendBundle\Entity\Zerbitzua $zerbitzua = null)
    {
        $this->zerbitzua = $zerbitzua;

        return $this;
    }

    /**
     * Get zerbitzua
     *
     * @return \Zerbikat\BackendBundle\Entity\Zerbitzua
     */
    public function getZerbitzua()
    {
        return $this->zerbitzua;
    }

    /**
     * Set datuenbabesa
     *
     * @param \Zerbikat\BackendBundle\Entity\Datuenbabesa $datuenbabesa
     *
     * @return Fitxa
     */
    public function setDatuenbabesa(\Zerbikat\BackendBundle\Entity\Datuenbabesa $datuenbabesa = null)
    {
        $this->datuenbabesa = $datuenbabesa;

        return $this;
    }

    /**
     * Get datuenbabesa
     *
     * @return \Zerbikat\BackendBundle\Entity\Datuenbabesa
     */
    public function getDatuenbabesa()
    {
        return $this->datuenbabesa;
    }

    /**
     * Set azpisaila
     *
     * @param \Zerbikat\BackendBundle\Entity\Azpisaila $azpisaila
     *
     * @return Fitxa
     */
    public function setAzpisaila(\Zerbikat\BackendBundle\Entity\Azpisaila $azpisaila = null)
    {
        $this->azpisaila = $azpisaila;

        return $this;
    }

    /**
     * Get azpisaila
     *
     * @return \Zerbikat\BackendBundle\Entity\Azpisaila
     */
    public function getAzpisaila()
    {
        return $this->azpisaila;
    }

    /**
     * Set aurreikusi
     *
     * @param \Zerbikat\BackendBundle\Entity\Aurreikusi $aurreikusi
     *
     * @return Fitxa
     */
    public function setAurreikusi(\Zerbikat\BackendBundle\Entity\Aurreikusi $aurreikusi = null)
    {
        $this->aurreikusi = $aurreikusi;

        return $this;
    }

    /**
     * Get aurreikusi
     *
     * @return \Zerbikat\BackendBundle\Entity\Aurreikusi
     */
    public function getAurreikusi()
    {
        return $this->aurreikusi;
    }

    /**
     * Set arrunta
     *
     * @param \Zerbikat\BackendBundle\Entity\Arrunta $arrunta
     *
     * @return Fitxa
     */
    public function setArrunta(\Zerbikat\BackendBundle\Entity\Arrunta $arrunta = null)
    {
        $this->arrunta = $arrunta;

        return $this;
    }

    /**
     * Get arrunta
     *
     * @return \Zerbikat\BackendBundle\Entity\Arrunta
     */
    public function getArrunta()
    {
        return $this->arrunta;
    }

    /**
     * Add araudiak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaAraudia $araudiak
     *
     * @return Fitxa
     */
    public function addAraudiak(\Zerbikat\BackendBundle\Entity\FitxaAraudia $araudiak)
    {
        $this->araudiak[] = $araudiak;

        return $this;
    }

    /**
     * Remove araudiak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaAraudia $araudiak
     */
    public function removeAraudiak(\Zerbikat\BackendBundle\Entity\FitxaAraudia $araudiak)
    {
        $this->araudiak->removeElement($araudiak);
    }

    /**
     * Get araudiak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAraudiak()
    {
        return $this->araudiak;
    }

    /**
     * Add dokumentazioak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaDokumentazioa $dokumentazioak
     *
     * @return Fitxa
     */
    public function addDokumentazioak(\Zerbikat\BackendBundle\Entity\FitxaDokumentazioa $dokumentazioak)
    {
        $this->dokumentazioak[] = $dokumentazioak;

        return $this;
    }

    /**
     * Remove dokumentazioak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaDokumentazioa $dokumentazioak
     */
    public function removeDokumentazioak(\Zerbikat\BackendBundle\Entity\FitxaDokumentazioa $dokumentazioak)
    {
        $this->dokumentazioak->removeElement($dokumentazioak);
    }

    /**
     * Get dokumentazioak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDokumentazioak()
    {
        return $this->dokumentazioak;
    }

    /**
     * Add kanalak
     *
     * @param \Zerbikat\BackendBundle\Entity\Kanala $kanalak
     *
     * @return Fitxa
     */
    public function addKanalak(\Zerbikat\BackendBundle\Entity\Kanala $kanalak)
    {
        $this->kanalak[] = $kanalak;

        return $this;
    }

    /**
     * Remove kanalak
     *
     * @param \Zerbikat\BackendBundle\Entity\Kanala $kanalak
     */
    public function removeKanalak(\Zerbikat\BackendBundle\Entity\Kanala $kanalak)
    {
        $this->kanalak->removeElement($kanalak);
    }

    /**
     * Get kanalak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKanalak()
    {
        return $this->kanalak;
    }

    /**
     * Add familiak
     *
     * @param \Zerbikat\BackendBundle\Entity\Familia $familiak
     *
     * @return Fitxa
     */
    public function addFamiliak(\Zerbikat\BackendBundle\Entity\Familia $familiak)
    {
        $this->familiak[] = $familiak;

        return $this;
    }

    /**
     * Remove familiak
     *
     * @param \Zerbikat\BackendBundle\Entity\Familia $familiak
     */
    public function removeFamiliak(\Zerbikat\BackendBundle\Entity\Familia $familiak)
    {
        $this->familiak->removeElement($familiak);
    }

    /**
     * Get familiak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFamiliak()
    {
        return $this->familiak;
    }

    /**
     * Add besteak1ak
     *
     * @param \Zerbikat\BackendBundle\Entity\Besteak1 $besteak1ak
     *
     * @return Fitxa
     */
    public function addBesteak1ak(\Zerbikat\BackendBundle\Entity\Besteak1 $besteak1ak)
    {
        $this->besteak1ak[] = $besteak1ak;

        return $this;
    }

    /**
     * Remove besteak1ak
     *
     * @param \Zerbikat\BackendBundle\Entity\Besteak1 $besteak1ak
     */
    public function removeBesteak1ak(\Zerbikat\BackendBundle\Entity\Besteak1 $besteak1ak)
    {
        $this->besteak1ak->removeElement($besteak1ak);
    }

    /**
     * Get besteak1ak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBesteak1ak()
    {
        return $this->besteak1ak;
    }

    /**
     * Add besteak2ak
     *
     * @param \Zerbikat\BackendBundle\Entity\Besteak2 $besteak2ak
     *
     * @return Fitxa
     */
    public function addBesteak2ak(\Zerbikat\BackendBundle\Entity\Besteak2 $besteak2ak)
    {
        $this->besteak2ak[] = $besteak2ak;

        return $this;
    }

    /**
     * Remove besteak2ak
     *
     * @param \Zerbikat\BackendBundle\Entity\Besteak2 $besteak2ak
     */
    public function removeBesteak2ak(\Zerbikat\BackendBundle\Entity\Besteak2 $besteak2ak)
    {
        $this->besteak2ak->removeElement($besteak2ak);
    }

    /**
     * Get besteak2ak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBesteak2ak()
    {
        return $this->besteak2ak;
    }

    /**
     * Add besteak3ak
     *
     * @param \Zerbikat\BackendBundle\Entity\Besteak3 $besteak3ak
     *
     * @return Fitxa
     */
    public function addBesteak3ak(\Zerbikat\BackendBundle\Entity\Besteak3 $besteak3ak)
    {
        $this->besteak3ak[] = $besteak3ak;

        return $this;
    }

    /**
     * Remove besteak3ak
     *
     * @param \Zerbikat\BackendBundle\Entity\Besteak3 $besteak3ak
     */
    public function removeBesteak3ak(\Zerbikat\BackendBundle\Entity\Besteak3 $besteak3ak)
    {
        $this->besteak3ak->removeElement($besteak3ak);
    }

    /**
     * Get besteak3ak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBesteak3ak()
    {
        return $this->besteak3ak;
    }

    /**
     * Add etiketak
     *
     * @param \Zerbikat\BackendBundle\Entity\Etiketa $etiketak
     *
     * @return Fitxa
     */
    public function addEtiketak(\Zerbikat\BackendBundle\Entity\Etiketa $etiketak)
    {
        $this->etiketak[] = $etiketak;

        return $this;
    }

    /**
     * Remove etiketak
     *
     * @param \Zerbikat\BackendBundle\Entity\Etiketa $etiketak
     */
    public function removeEtiketak(\Zerbikat\BackendBundle\Entity\Etiketa $etiketak)
    {
        $this->etiketak->removeElement($etiketak);
    }

    /**
     * Get etiketak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtiketak()
    {
        return $this->etiketak;
    }

    /**
     * Add tramiteak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaTramitea $tramiteak
     *
     * @return Fitxa
     */
    public function addTramiteak(\Zerbikat\BackendBundle\Entity\FitxaTramitea $tramiteak)
    {
        $this->tramiteak[] = $tramiteak;

        return $this;
    }

    /**
     * Remove tramiteak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaTramitea $tramiteak
     */
    public function removeTramiteak(\Zerbikat\BackendBundle\Entity\FitxaTramitea $tramiteak)
    {
        $this->tramiteak->removeElement($tramiteak);
    }

    /**
     * Get tramiteak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTramiteak()
    {
        return $this->tramiteak;
    }

    /**
     * Add norkeskatuak
     *
     * @param \Zerbikat\BackendBundle\Entity\Norkeskatu $norkeskatuak
     *
     * @return Fitxa
     */
    public function addNorkeskatuak(\Zerbikat\BackendBundle\Entity\Norkeskatu $norkeskatuak)
    {
        $this->norkeskatuak[] = $norkeskatuak;

        return $this;
    }

    /**
     * Remove norkeskatuak
     *
     * @param \Zerbikat\BackendBundle\Entity\Norkeskatu $norkeskatuak
     */
    public function removeNorkeskatuak(\Zerbikat\BackendBundle\Entity\Norkeskatu $norkeskatuak)
    {
        $this->norkeskatuak->removeElement($norkeskatuak);
    }

    /**
     * Get norkeskatuak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNorkeskatuak()
    {
        return $this->norkeskatuak;
    }

    /**
     * Add doklagunak
     *
     * @param \Zerbikat\BackendBundle\Entity\Doklagun $doklagunak
     *
     * @return Fitxa
     */
    public function addDoklagunak(\Zerbikat\BackendBundle\Entity\Doklagun $doklagunak)
    {
        $this->doklagunak[] = $doklagunak;

        return $this;
    }

    /**
     * Remove doklagunak
     *
     * @param \Zerbikat\BackendBundle\Entity\Doklagun $doklagunak
     */
    public function removeDoklagunak(\Zerbikat\BackendBundle\Entity\Doklagun $doklagunak)
    {
        $this->doklagunak->removeElement($doklagunak);
    }

    /**
     * Get doklagunak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDoklagunak()
    {
        return $this->doklagunak;
    }

    /**
     * Add prozedurak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaProzedura $prozedurak
     *
     * @return Fitxa
     */
    public function addProzedurak(\Zerbikat\BackendBundle\Entity\FitxaProzedura $prozedurak)
    {
        $this->prozedurak[] = $prozedurak;

        return $this;
    }

    /**
     * Remove prozedurak
     *
     * @param \Zerbikat\BackendBundle\Entity\FitxaProzedura $prozedurak
     */
    public function removeProzedurak(\Zerbikat\BackendBundle\Entity\FitxaProzedura $prozedurak)
    {
        $this->prozedurak->removeElement($prozedurak);
    }

    /**
     * Get prozedurak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProzedurak()
    {
        return $this->prozedurak;
    }

    /**
     * Add azpiatalak
     *
     * @param \Zerbikat\BackendBundle\Entity\Azpiatala $azpiatalak
     *
     * @return Fitxa
     */
    public function addAzpiatalak(\Zerbikat\BackendBundle\Entity\Azpiatala $azpiatalak)
    {
        $this->azpiatalak[] = $azpiatalak;

        return $this;
    }

    /**
     * Remove azpiatalak
     *
     * @param \Zerbikat\BackendBundle\Entity\Azpiatala $azpiatalak
     */
    public function removeAzpiatalak(\Zerbikat\BackendBundle\Entity\Azpiatala $azpiatalak)
    {
        $this->azpiatalak->removeElement($azpiatalak);
    }

    /**
     * Get azpiatalak
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAzpiatalak()
    {
        return $this->azpiatalak;
    }

    /**
     * Set isiltasunadmin
     *
     * @param \Zerbikat\BackendBundle\Entity\IsiltasunAdministratiboa $isiltasunadmin
     *
     * @return Fitxa
     */
    public function setIsiltasunadmin(\Zerbikat\BackendBundle\Entity\IsiltasunAdministratiboa $isiltasunadmin = null)
    {
        $this->isiltasunadmin = $isiltasunadmin;

        return $this;
    }

    /**
     * Get isiltasunadmin
     *
     * @return \Zerbikat\BackendBundle\Entity\IsiltasunAdministratiboa
     */
    public function getIsiltasunadmin()
    {
        return $this->isiltasunadmin;
    }
}
