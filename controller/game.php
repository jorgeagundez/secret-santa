<?php 

class Game {

	private $idgame;
	private $title;
	private $description;
	private $price;
	private $gameplace;
	private $gamedate;
	private $confirmed;
	private $gamekey;

	public function __construct($id, $name, $email, $price, $gameplace, $gamedate, $confirmed, $gamekey ) {
		$this->setGame($id, $name, $email, $price, $gameplace, $gamedate, $confirmed, $gamekey);
		$this->getGame();
	}

	public function setGame($id, $name, $email, $price, $gameplace, $gamedate, $confirmed, $gamekey) {
		$this->idgame = $id;
		$this->title = $name;
		$this->description = $email;
		$this->price = $price;
		$this->gameplace = $gameplace;
		$this->gamedate = $gamedate;
		$this->confirmed = $confirmed;
		$this->gamekey = $gamekey;

	}

	public function getGame() {
		return array(
			'idgame' => $this->idgame,
			'title' => $this->title,
			'description' => $this->description,
			'price' => $this->price,
			'gameplace' => $this->gameplace,
			'gamedate' => $this->gamedate, 
			'confirmed' => $this->confirmed,
			'gamekey' => $this->gamekey
			);
	}

	public function setIdgame($id) {
		$this->idgame = $id;
	}

	public function getIdgame() {
		return $this->idgame;
	}


	public function setTitle($name) {
		$this->title = $name;
	}

	public function getTitle() {
		return $this->title;
	}


	public function setDescription($email) {
		$this->description = $email;
	}

	public function getDescription() {
		return $this->description;
	}


	public function setPrice($price) {
		$this->price = $price;
	}

	public function getPrice() {
		return $this->price;
	}


	public function setGameplace($gameplace) {
		$this->gameplace = $gameplace;
	}

	public function getGameplace() {
		return $this->gameplace;
	}


	public function setGamedate($gamedate) {
		$this->gamedate = $gamedate;
	}

	public function getGamedate() {
		return $this->gamedate;
	}


	public function setConfirmed($confirmed) {
		$this->confirmed = $confirmed;
	}

	public function getConfirmed() {
		return $this->confirmed;
	}


	public function setGamekey($gamekey) {
		$this->gamekey = $gamekey;
	}

	public function getGamekey() {
		return $this->gamekey;
	}

}
