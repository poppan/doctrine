<?php

namespace Tvtruc\Entities;
//use Doctrine\ORM\Annotation as ORM;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Tvtruc\Entities\Episode;
use Tvtruc\Entities\Banner;

/**
 * @ORM\Entity @ORM\Table(name="tvseries")
 **/
class Serie {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    protected $id;
	/**
	 * @ORM\Column(name="SeriesName", type="string")
	 * @var string
	 */
    protected $serieName;

	/**
	 * Une serie a plusieurs episodes
	 * La propriété est definie en public, parce que pour l'utiliser c'est peut-etre aussi simple si j'en ai besoin depuis un autre
	 * Si je ne l'utilise que via *Serie*, donc pas directement je pourrais tout mettre en protected.
	 * @ORM\OneToMany(targetEntity="Season", mappedBy="serie", cascade={"all"}, fetch="LAZY")
	 * @ORM\OrderBy({"seasonNumber" = "ASC"})
	 */
	public $seasons;


	public function __construct() {
		$this->seasons = new ArrayCollection();
		//$this->episodes = new ArrayCollection();
	}

    // getters et setters
	public function getTranslation(){
		global $entityManager;
		$repository = $entityManager->getRepository('Tvtruc\Entities\Translation');
		$translation = $repository->findOneBy(array(
			'languageId' => 17, // fr-FR
			'serieId' => $this->id
		));
		//var_dump($banner->fileName);die;
		return (is_null($translation)?'':$translation->name);

	}
	public function getBanner(){
		global $entityManager;
		$repository = $entityManager->getRepository('Tvtruc\Entities\Banner');
		$banner = $repository->findOneBy(array(
			'keyType' => 'series',
			'subKey' => 'graphical',
			'serieId' => $this->id
		));
		//var_dump($banner->fileName);die;
		return (is_null($banner)?'':$banner->fileName);

	}
	public function getFanart(){
		global $entityManager;
		$repository = $entityManager->getRepository('Tvtruc\Entities\Banner');
		$banner = $repository->findOneBy(array(
			'keyType' => 'fanart',
			'subKey' => 'graphical',
			'serieId' => $this->id
		));
		//var_dump($banner->fileName);die;
		return (is_null($banner)?'':$banner->fileName);

	}
	public function getId() {
		return($this->id);
	}

	public function setName($name) {
		$this->serieName = $name;
	}

	public function getName() {
		return($this->serieName);
	}




}
