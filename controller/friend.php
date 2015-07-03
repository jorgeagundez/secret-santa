<?php 

class Friend {

	private $idfriend;
	private $friendname;
	private $friendemail;
	private $invitation;
	private $confirmation;

	public function __construct($id, $name, $email, $invitation, $confirmation) {
		$this->setFriend($id, $name, $email, $invitation, $confirmation);
		$this->getFriend();
	}

	public function setFriend($id, $name, $email, $invitation, $confirmation) {
		$this->idfriend = $id;
		$this->friendname = $name;
		$this->friendemail = $email;
		$this->invitation = $invitation;
		$this->confirmation = $confirmation;
	}

	public function getFriend() {
		return array(
			'idfriend' => $this->idfriend,
			'friendname' => $this->friendname,
			'friendemail' => $this->friendemail,
			'invitation' => $this->invitation,
			'confirmation' => $this->confirmation,
			);
	}

	public function setIdfriend($id) {
		$this->idfriend = $id;
	}

	public function getIdfriend() {
		return $this->idfriend;
	}


	public function setFriendname($name) {
		$this->friendname = $name;
	}

	public function getFriendname() {
		return $this->friendname;
	}


	public function setFriendemail($email) {
		$this->friendemail = $email;
	}

	public function getFriendemail() {
		return $this->friendemail;
	}


	public function setInvitation($invitation) {
		$this->invitation = $invitation;
	}

	public function getInvitation() {
		return $this->invitation;
	}


	public function setConfirmation($confirmation) {
		$this->confirmation = $confirmation;
	}

	public function getConfirmation() {
		return $this->confirmation;
	}

}
