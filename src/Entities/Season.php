<?php

namespace Tvtruc\Entities;
//use Doctrine\ORM\Annotation as ORM;
use Doctrine\ORM\Mapping AS ORM;
use Tvtruc\Entities\Serie;
/**
 * @ORM\Entity @ORM\Table(name="tvseasons")
 **/
class Season {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */

    public $id;
	/**
	 * @ORM\Column(name="season", type="string")
	 * @var string
	 */
    public $seasonNumber;

	/**
	 * Les episodes sont liés a une serie
	 * Le serie est en private parce que je veux n'y acceder qu'au travers des getters/setters
	 * @ORM\ManyToOne(targetEntity="Serie", inversedBy="seasons", cascade={"all"}, fetch="LAZY")
	 * @ORM\JoinColumn(nullable=false, name="seriesid", referencedColumnName="id")
	 */
	private $serie;

	/**
	 * Une season a plusieurs episodes
	 * La propriété est definie en public, parce que pour l'utiliser c'est peut-etre aussi simple si j'en ai besoin depuis un autre
	 * Si je ne l'utilise que via *Serie*, donc pas directement je pourrais tout mettre en protected.
	 * @ORM\OneToMany(targetEntity="Episode", mappedBy="season", cascade={"all"}, fetch="LAZY")
	 */
	public $episodes;

    // getters et setters
	public function setEpisode($episodes) {
		$this->episodes = $episodes;
	}

	public function getEpisodes() {
		return($this->episodes);
	}

	public function addEpisode($episode) {
		$this->episodes->add($episode);
	}

	public function __construct() {
		$this->episodes = new ArrayCollection();
	}
}
