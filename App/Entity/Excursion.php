<?php

namespace App\Entity;

class Excursion
{
	// внимание: типы данных double изменены на float
	// проверить вместимость

	private $id;
	private $nameCity;
	private $nameCountry;
	private $dateTravel;
	private $price;
	private $shortDescription;
	private $fullDescription;
	private $internetRating;
	private $entertainmentRating;
	private $serviceRating;
	private $rating;
	private $active;
	private $dateCreate;
	private $dateUpdate;
	private $tagList;
	private $imageList;

	/**
	 * @param $id
	 * @param $nameCity
	 * @param $nameCountry
	 * @param $dateTravel
	 * @param $price
	 * @param $shortDescription
	 * @param $fullDescription
	 * @param $internetRating
	 * @param $entertainmentRating
	 * @param $serviceRating
	 * @param $rating
	 * @param $active
	 * @param $dateCreate
	 * @param $dateUpdate
	 // * @param $tagList
	 * @param $imageList
	 */
	public function __construct($id, $nameCity, $nameCountry, $dateTravel, $price, $shortDescription, $fullDescription,
		$internetRating, $entertainmentRating, $serviceRating, $rating, $active, $dateCreate, $dateUpdate,
		$imageList)
	{
		$this->id = $id;
		$this->nameCity = $nameCity;
		$this->nameCountry = $nameCountry;
		$this->dateTravel = $dateTravel;
		$this->price = $price;
		$this->shortDescription = $shortDescription;
		$this->fullDescription = $fullDescription;
		$this->internetRating = $internetRating;
		$this->entertainmentRating = $entertainmentRating;
		$this->serviceRating = $serviceRating;
		$this->rating = $rating;
		$this->active = $active;
		$this->dateCreate = $dateCreate;
		$this->dateUpdate = $dateUpdate;
		$this->imageList = $imageList;
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
	public function setId($id): void
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getNameCity()
	{
		return $this->nameCity;
	}

	/**
	 * @param mixed $nameCity
	 */
	public function setNameCity($nameCity): void
	{
		$this->nameCity = $nameCity;
	}

	/**
	 * @return mixed
	 */
	public function getNameCountry()
	{
		return $this->nameCountry;
	}

	/**
	 * @param mixed $nameCountry
	 */
	public function setNameCountry($nameCountry): void
	{
		$this->nameCountry = $nameCountry;
	}

	/**
	 * @return mixed
	 */
	public function getDateTravel()
	{
		return $this->dateTravel;
	}

	/**
	 * @param mixed $dateTravel
	 */
	public function setDateTravel($dateTravel): void
	{
		$this->dateTravel = $dateTravel;
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
	public function setPrice($price): void
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
	public function setShortDescription($shortDescription): void
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
	public function setFullDescription($fullDescription): void
	{
		$this->fullDescription = $fullDescription;
	}

	/**
	 * @return mixed
	 */
	public function getInternetRating()
	{
		return $this->internetRating;
	}

	/**
	 * @param mixed $internetRating
	 */
	public function setInternetRating($internetRating): void
	{
		$this->internetRating = $internetRating;
	}

	/**
	 * @return mixed
	 */
	public function getEntertainmentRating()
	{
		return $this->entertainmentRating;
	}

	/**
	 * @param mixed $entertainmentRating
	 */
	public function setEntertainmentRating($entertainmentRating): void
	{
		$this->entertainmentRating = $entertainmentRating;
	}

	/**
	 * @return mixed
	 */
	public function getServiceRating()
	{
		return $this->serviceRating;
	}

	/**
	 * @param mixed $serviceRating
	 */
	public function setServiceRating($serviceRating): void
	{
		$this->serviceRating = $serviceRating;
	}

	/**
	 * @return mixed
	 */
	public function getRating()
	{
		return $this->rating;
	}

	/**
	 * @param mixed $rating
	 */
	public function setRating($rating): void
	{
		$this->rating = $rating;
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
	public function setActive($active): void
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
	public function setDateCreate($dateCreate): void
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
	public function setDateUpdate($dateUpdate): void
	{
		$this->dateUpdate = $dateUpdate;
	}

	/**
	 * @return mixed
	 */
	public function getTagList()
	{
		return $this->tagList;
	}

	/**
	 * @param mixed $tagList
	 */
	public function setTagList($tagList): void
	{
		$this->tagList = $tagList;
	}

	/**
	 * @return mixed
	 */
	public function getImageList()
	{
		return $this->imageList;
	}

	/**
	 * @param mixed $imageList
	 */
	public function setImageList($imageList): void
	{
		$this->imageList = $imageList;
	}



}