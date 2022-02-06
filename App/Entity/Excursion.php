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
	private $fullDescription;
	private $internetRating;
	private $entertainmentRating;
	private $serviceRating;
	private $rating;
	private $degrees;
	private $active;
	private $dateCreate;
	private $dateUpdate;
	private $tagList;
	private $imageList;

	/**
	 * @param int $id
	 * @param string $nameCity
	 * @param string $nameCountry
	 * @param string $dateTravel
	 * @param float $price
	 * @param string $fullDescription
	 * @param float $internetRating
	 * @param float $entertainmentRating
	 * @param float $serviceRating
	 * @param float $rating
	 * @param float $degrees
	 * @param bool $active
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 * @param string $imageList
	 */
	public function __construct(
		int $id,
		string $nameCity, string $nameCountry,
		string $dateTravel,
		float $price,
		string $fullDescription,
		float $internetRating, float $entertainmentRating,
		float $serviceRating, float $rating, float $degrees,
		bool $active,
		string $dateCreate, string $dateUpdate,
		string $imageList)
	{
		$this->id = $id;
		$this->nameCity = $nameCity;
		$this->nameCountry = $nameCountry;
		$this->dateTravel = $dateTravel;
		$this->price = $price;
		$this->fullDescription = $fullDescription;
		$this->internetRating = $internetRating;
		$this->entertainmentRating = $entertainmentRating;
		$this->serviceRating = $serviceRating;
		$this->rating = $rating;
		$this->degrees = $degrees;
		$this->active = $active;
		$this->dateCreate = $dateCreate;
		$this->dateUpdate = $dateUpdate;
		$this->imageList = $imageList;
	}

	/**
	 * @return int
	 */
	public function getId(): int
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
	 * @return string
	 */
	public function getNameCity(): string
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
	 * @return string
	 */
	public function getNameCountry(): string
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
	 * @return string
	 */
	public function getDateTravel(): string
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
	 * @return float
	 */
	public function getPrice(): float
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
	 * @return string
	 */
	public function getFullDescription(): string
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
	 * @return float
	 */
	public function getInternetRating(): float
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
	 * @return float
	 */
	public function getEntertainmentRating(): float
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
	 * @return float
	 */
	public function getServiceRating(): float
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
	 * @return float
	 */
	public function getRating(): float
	{
		return $this->rating;
	}

	/**
	 * @return float
	 */
	public function getDegrees(): float
	{
		return $this->degrees;
	}

	/**
	 * @param mixed $rating
	 */
	public function setRating($rating): void
	{
		$this->rating = $rating;
	}

	/**
	 * @return bool
	 */
	public function getActive(): bool
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
	 * @return string
	 */
	public function getDateCreate(): string
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
	 * @return string
	 */
	public function getDateUpdate(): string
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
	 * @return array
	 */
	public function getTagList(): array
	{
		return $this->tagList;
	}

	/**
	 * @param array $tagList
	 */
	public function setTagList(array $tagList): void
	{
		$this->tagList = $tagList;
	}

	/**
	 * @return string
	 */
	public function getImageList(): string
	{
		return $this->imageList;
	}

	/**
	 * @param string $imageList
	 */
	public function setImageList(string $imageList): void
	{
		$this->imageList = $imageList;
	}

}