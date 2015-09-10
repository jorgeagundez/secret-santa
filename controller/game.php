<?php 

class Game {

	private $idgame;
	private $title;
	private $description;
	private $confirmed;
	private $gamekey;
	private $ended;

	public function __construct($id, $name, $email, $confirmed, $gamekey, $ended ) {
		$this->setGame($id, $name, $email, $confirmed, $gamekey, $ended);
		$this->getGame();
	}

	public function setGame($id, $name, $email, $confirmed, $gamekey, $ended) {
		$this->idgame = $id;
		$this->title = $name;
		$this->description = $email;
		$this->confirmed = $confirmed;
		$this->gamekey = $gamekey;
		$this->ended = $ended;

	}

	public function getGame() {
		return array(
			'idgame' => $this->idgame,
			'title' => $this->title,
			'description' => $this->description,
			'confirmed' => $this->confirmed,
			'gamekey' => $this->gamekey,
			'ended' => $this->ended
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

	public function setEnded($ended) {
		$this->ended = $ended;
	}

	public function getEnded() {
		return $this->ended;
	}

}
