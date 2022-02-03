<?php

namespace App\Entity;

class Excursion
{
	// внимание: типы данных double изменены на float
	// проверить вместимость

	private int $id;
	private string $nameCity;
	private string $nameCountry;
	private string $dateTravel;
	private float $price;
	private string $shortDescription;
	private string $fullDescription;
	private float $internetRating;
	private float $entertainmentRating;
	private float $serviceRating;
	private float $rating;
	private bool $active;
	private string $dateCreate;
	private string $dateUpdate;
	private array $tagList;
	private array $imageList;

	/**
	 * @param int $id
	 * @param string $nameCity
	 * @param string $nameCountry
	 * @param string $dateTravel
	 * @param float $price
	 * @param string $shortDescription
	 * @param string $fullDescription
	 * @param float $internetRating
	 * @param float $entertainmentRating
	 * @param float $serviceRating
	 * @param float $rating
	 * @param bool $active
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 * @param array $tagList
	 * @param array $imageList
	 */
	public function __construct(int $id, string $nameCity, string $nameCountry, string $dateTravel, float $price,
		string $shortDescription, string $fullDescription, float $internetRating, float $entertainmentRating,
		float $serviceRating, float $rating, bool $active, string $dateCreate, string $dateUpdate, array $tagList,
		array $imageList)
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
		$this->tagList = $tagList;
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
	 * @param int $id
	 */
	public function setId(int $id): void
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
	 * @param string $nameCity
	 */
	public function setNameCity(string $nameCity): void
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
	 * @param string $nameCountry
	 */
	public function setNameCountry(string $nameCountry): void
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
	 * @param string $dateTravel
	 */
	public function setDateTravel(string $dateTravel): void
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
	 * @param float $price
	 */
	public function setPrice(float $price): void
	{
		$this->price = $price;
	}

	/**
	 * @return string
	 */
	public function getShortDescription(): string
	{
		return $this->shortDescription;
	}

	/**
	 * @param string $shortDescription
	 */
	public function setShortDescription(string $shortDescription): void
	{
		$this->shortDescription = $shortDescription;
	}

	/**
	 * @return string
	 */
	public function getFullDescription(): string
	{
		return $this->fullDescription;
	}

	/**
	 * @param string $fullDescription
	 */
	public function setFullDescription(string $fullDescription): void
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
	 * @param float $internetRating
	 */
	public function setInternetRating(float $internetRating): void
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
	 * @param float $entertainmentRating
	 */
	public function setEntertainmentRating(float $entertainmentRating): void
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
	 * @param float $serviceRating
	 */
	public function setServiceRating(float $serviceRating): void
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
	 * @param float $rating
	 */
	public function setRating(float $rating): void
	{
		$this->rating = $rating;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive(bool $active): void
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
	 * @param string $dateCreate
	 */
	public function setDateCreate(string $dateCreate): void
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
	 * @param string $dateUpdate
	 */
	public function setDateUpdate(string $dateUpdate): void
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
	 * @return array
	 */
	public function getImageList(): array
	{
		return $this->imageList;
	}

	/**
	 * @param array $imageList
	 */
	public function setImageList(array $imageList): void
	{
		$this->imageList = $imageList;
	}


}