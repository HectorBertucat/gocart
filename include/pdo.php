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
		$r = "SELECT * FROM `association_item_basket` aib
		INNER JOIN item i
		ON i.id=aib.id_item
		WHERE aib.id_basket = $basket
		ORDER BY aib.id DESC";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function ins_item_in_basket($item,$basket)
	{
		$req = "INSERT INTO association_item_basket values (NULL,?,?,?)";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $item);
		$rs->bindValue(2, $basket);
		$rs->bindValue(3, 1);
		$rs->execute();
	}

	public function upd_qte_item_in_basket($item,$basket,$way)
	{
		$req = "UPDATE association_item_basket SET quantity=quantity+? WHERE id_item=? AND id_basket=?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $way);
		$rs->bindValue(2, $item);
		$rs->bindValue(3, $basket);

		$rs->execute();
	}

	public function upd_withdraw_date_item_in_basket($id)
	{
		$req = "UPDATE association_item_basket SET withdraw_date=NOW() WHERE id=?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $id);
		$rs->execute();
	}

	public function sel_item($barcode)
	{
		$r = "SELECT * FROM item WHERE barcode='$barcode'";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetch();
		return $r;
	}

	public function sel_item_basket($item, $basket)
	{
		$r = "SELECT * FROM association_item_basket WHERE id_item=$item AND id_basket=$basket";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetch();
		return $r;
	}

	public function del_item_basket($item,$basket)
	{
		$req = "DELETE FROM association_item_basket WHERE id_item=? AND id_basket=?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $item);
		$rs->bindValue(2, $basket);
		$rs->execute();
	}

	



}
