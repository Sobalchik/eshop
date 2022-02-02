<?php

namespace App\Entity;

class Excursion
{
	private $id;
	private $name;
	private $price;
	private $shortDescription;
	private $fullDescription;
	private $active;
	private $dateCreate;
	private $dateUpdate;

	/**
	 * @param $id
	 * @param $name
	 * @param $price
	 * @param $shortDescription
	 * @param $fullDescription
	 * @param $active
	 * @param $dateCreate
	 * @param $dateUpdate
	 */
	public function __construct($id, $name, $price, $shortDescription, $fullDescription, $active, $dateCreate,
		$dateUpdate)
	{
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
		$this->shortDescription = $shortDescription;
		$this->fullDescription = $fullDescription;
		$this->active = $active;
		$this->dateCreate = $dateCreate;
		$this->dateUpdate = $dateUpdate;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * @return mixed
	 */
	public function getShortDescription()
	{
		return $this->shortDescription;
	}

	/**
	 * @param mixed $shortDescription
	 */
	public function setShortDescription($shortDescription)
	{
		$this->shortDescription = $shortDescription;
	}

	/**
	 * @return mixed
	 */
	public function getFullDescription()
	{
		return $this->fullDescription;
	}

	/**
	 * @param mixed $fullDescription
	 */
	public function setFullDescription($fullDescription)
	{
		$this->fullDescription = $fullDescription;
	}

	/**
	 * @return mixed
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * @param mixed $active
	 */
	public function setActive($active)
	{
		$this->active = $active;
	}

	/**
	 * @return mixed
	 */
	public function getDateCreate()
	{
		return $this->dateCreate;
	}

	/**
	 * @param mixed $dateCreate
	 */
	public function setDateCreate($dateCreate)
	{
		$this->dateCreate = $dateCreate;
	}

	/**
	 * @return mixed
	 */
	public function getDateUpdate()
	{
		return $this->dateUpdate;
	}

	/**
	 * @param mixed $dateUpdate
	 */
	public function setDateUpdate($dateUpdate)
	{
		$this->dateUpdate = $dateUpdate;
	}

}