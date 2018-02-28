<?php

namespace Tvtruc\Entities;
//use Doctrine\ORM\Annotation as ORM;
use Doctrine\ORM\Mapping AS ORM;
use Tvtruc\Entities\Serie;
/**
 * @ORM\Entity @ORM\Table(name="translation_seriesname")
 **/
class Translation {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    protected $id;
	/**
	 * @ORM\Column(name="seriesId", type="integer")
	 * @var integer
	 */
	protected $serieId;
	/**
	 * @ORM\Column(name="languageid", type="integer")
	 * @var integer
	 */
	protected $languageId;
	/**
	 * @ORM\Column(name="translation", type="string")
	 * @var string
	 */
	public $name;

}
