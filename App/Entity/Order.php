<?php

namespace App\Entity;

class Order
{
	private $id;
	private $fio;
	private $email;
	private $phone;
	private $dateOrder;
	private $comment;
	private $statusId;
	private $productId;
	private $dateCreate;
	private $dateUpdate;

	/**
	 * @param int $id
	 * @param string $fio
	 * @param string $email
	 * @param string $phone
	 * @param string $dateOrder
	 * @param string $comment
	 * @param int $statusId
	 * @param int $productId
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 */

	public function __construct(
		int $id,
		string $fio, string $email, string $phone,
		string $dateOrder, string $comment,
		int $statusId, int $productId,
		string $dateCreate, string $dateUpdate
	)
	{
		$this->id=$id;
		$this->fio=$fio;
		$this->email=$email;
		$this->phone=$phone;
		$this->dateOrder=$dateOrder;
		$this->comment=$comment;
		$this->statusId=$statusId;
		$this->productId=$productId;
		$this->dateCreate=$dateCreate;
		$this->dateUpdate=$dateUpdate;
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
	public function getFio(): string
	{
		return $this->fio;
	}

	/**
	 * @param string $fio
	 */
	public function setFio(string $fio): void
	{
		$this->fio = $fio;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getPhone(): string
	{
		return $this->phone;
	}

	/**
	 * @param string $phone
	 */
	public function setPhone(string $phone): void
	{
		$this->phone = $phone;
	}

	/**
	 * @return string
	 */
	public function getDateOrder(): string
	{
		return $this->dateOrder;
	}

	/**
	 * @param string $dateOrder
	 */
	public function setDateOrder(string $dateOrder): void
	{
		$this->dateOrder = $dateOrder;
	}

	/**
	 * @return string
	 */
	public function getComment(): string
	{
		return $this->comment;
	}

	/**
	 * @param string $comment
	 */
	public function setComment(string $comment): void
	{
		$this->comment = $comment;
	}

	/**
	 * @return int
	 */
	public function getStatusId(): int
	{
		return $this->statusId;
	}

	/**
	 * @param int $statusId
	 */
	public function setStatusId(int $statusId): void
	{
		$this->statusId = $statusId;
	}

	/**
	 * @return int
	 */
	public function getProductId(): int
	{
		return $this->productId;
	}

	/**
	 * @param int $productId
	 */
	public function setProductId(int $productId): void
	{
		$this->productId = $productId;
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
}