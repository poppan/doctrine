<?php

namespace Tvtruc\Entities;
//use Doctrine\ORM\Annotation as ORM;
use Doctrine\ORM\Mapping AS ORM;
use Tvtruc\Entities\Serie;
/**
 * @ORM\Entity @ORM\Table(name="banners")
 **/
class Banner {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */

    protected $id;
	/**
	 * @ORM\Column(name="fileName", type="string")
	 * @var string
	 */
    public $fileName;
	/**
	 * @ORM\Column(name="keytype", type="string")
	 * @var string
	 */
	protected $keyType;
	/**
	 * @ORM\Column(name="subkey", type="string")
	 * @var string
	 */
	protected $subKey;
	/**
	 * @ORM\Column(name="keyvalue", type="integer")
	 * @var integer
	 */
	protected $serieId;
	// getters et setters
	// ensembles de fonctions/methodes publiques permettant de modifier/acceder aux propriétés private

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id): void {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getFileName(): string {
		return $this->fileName;
	}

	/**
	 * @param string $fileName
	 */
	public function setFileName(string $fileName): void {
		$this->fileName = $fileName;
	}

	/**
	 * @return string
	 */
	public function getKeyType(): string {
		return $this->keyType;
	}

	/**
	 * @param string $keyType
	 */
	public function setKeyType(string $keyType): void {
		$this->keyType = $keyType;
	}

	/**
	 * @return string
	 */
	public function getSubKey(): string {
		return $this->subKey;
	}

	/**
	 * @param string $subKey
	 */
	public function setSubKey(string $subKey): void {
		$this->subKey = $subKey;
	}

	/**
	 * @return int
	 */
	public function getSerieId(): int {
		return $this->serieId;
	}

	/**
	 * @param int $serieId
	 */
	public function setSerieId(int $serieId): void {
		$this->serieId = $serieId;
	}



}
