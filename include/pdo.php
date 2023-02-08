<?php

class PdoGsb
{
	private static $serveur = 'mysql:host=localhost';
	private static $bdd = 'dbname=gocart';
	private static $user = 'root';
	private static $mdp = 'root';
	private static $monPdo;
	private static $monPdoGsb = null;

	private function __construct()
	{
		PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct()
	{
		PdoGsb::$monPdo = null;
	}

	public  static function getPdoGsb()
	{
		if (PdoGsb::$monPdoGsb == null) {
			PdoGsb::$monPdoGsb = new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;
	}


	public function sel_emails()
	{
		$r = "SELECT email FROM user";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_cards()
	{
		$r = "SELECT card_number FROM user";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_user($email)
	{
		$r = "SELECT * FROM user WHERE email='$email'";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetch();
		return $r;
	}

	public function sel_client($card)
	{
		$r = "SELECT * FROM user WHERE card_number=$card";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetch();
		return $r;
	}

	public function sel_basket($cart,$user)
	{
		$r = "SELECT * FROM basket WHERE id_cart=$cart AND id_user=$user ORDER BY id DESC LIMIT 1";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_items_basket($basket)
	{
		$r = "SELECT i.name, i.price, COUNT(id_item) as qte_item FROM `association_item_basket` aib
		INNER JOIN item i
		ON i.id=aib.id_item
		WHERE aib.id_basket = 2
		GROUP BY aib.id_item";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function ins_item_in_basket($item,$basket,$date)
	{
		$req = "INSERT INTO association_item_basket values (NULL,?,?,?,NULL)";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $item);
		$rs->bindValue(2, $basket);
		$rs->bindValue(3, $date);
		$rs->execute();
	}

	public function upd_item_in_basket($id,$date)
	{
		$req = "UPDATE association_item_basket SET withdraw_date=? WHERE id=?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $date);
		$rs->bindValue(2, $id);
		$rs->execute();
	}
	



}
