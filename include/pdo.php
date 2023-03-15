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

	public function sel_article_type()
	{
		$r = "SELECT id, name FROM item_type";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_carts()
	{
		$r = "SELECT * FROM cart";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_items_sold_day_amount($day, $article_type_id, $cart_id)
	{
		// start is $day at 00:00:00
		$start = date('Y-m-d H:i:s', strtotime($day));
		// end is $day at 23:59:59
		$end = date('Y-m-d H:i:s', strtotime($day . ' +1 day -1 second'));

		if ($article_type_id != 0 || $cart_id != 0) {
			$filter_article_type = "";
			$filter_cart = "";

			if ($article_type_id != 0) {
				$filter_article_type = " AND i.id_item_type = '$article_type_id'";
			}

			if ($cart_id != 0) {
				$filter_cart = " AND b.id_cart = '$cart_id'";
			}

			$r = "SELECT HOUR(b.closing_date) as hour, SUM(aib.id_item*i.price*aib.quantity) as amount
			FROM association_item_basket aib
			LEFT JOIN item i
			ON aib.id_item = i.id
			" . $filter_article_type . "
			LEFT JOIN basket b
			ON b.id = aib.id_basket
			WHERE b.closing_date BETWEEN '$start' AND '$end'
			" . $filter_cart . "
			AND b.canceling_date IS NULL
			GROUP BY aib.id_basket, HOUR(b.closing_date)";
		} else {
			$r = "SELECT HOUR(date) AS hour, SUM(amount) as amount FROM sale WHERE date BETWEEN '$start' AND '$end' GROUP BY HOUR(date)";
		}

		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_items_sold_week_amount($day, $article_type_id, $cart_id)
	{
		// start is the monday of the week of $day at 00:00:00
		$start = date('Y-m-d H:i:s', strtotime($day . ' -' . date('w', strtotime($day)) . ' days'));
		// end is the sunday of the week of $day at 23:59:59
		$end = date('Y-m-d H:i:s', strtotime($day . ' +' . (6 - date('w', strtotime($day))) . ' days +1 day -1 second'));

		if ($article_type_id != 0 || $cart_id != 0) {
			$filter_article_type = "";
			$filter_cart = "";

			if ($article_type_id != 0) {
				$filter_article_type = " AND i.id_item_type = '$article_type_id'";
			}

			if ($cart_id != 0) {
				$filter_cart = " AND b.id_cart = '$cart_id'";
			}

			$r = "SELECT WEEKDAY(b.closing_date) as day, SUM(aib.id_item*i.price*aib.quantity) as amount
			FROM association_item_basket aib
			LEFT JOIN item i
			ON aib.id_item = i.id
			" . $filter_article_type . "
			LEFT JOIN basket b
			ON b.id = aib.id_basket
			WHERE b.closing_date BETWEEN '$start' AND '$end'
			" . $filter_cart . "
			AND b.canceling_date IS NULL
			GROUP BY aib.id_basket, WEEKDAY(b.closing_date)";
		} else {
			$r = "SELECT WEEKDAY(date) AS day, SUM(amount) as amount FROM sale WHERE date BETWEEN '$start' AND '$end' GROUP BY WEEKDAY(date)";
		}

		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_items_sold_day_quantity($day, $article_type_id, $cart_id)
	{
		// start is $day at 00:00:00
		$start = date('Y-m-d H:i:s', strtotime($day));
		// end is $day at 23:59:59
		$end = date('Y-m-d H:i:s', strtotime($day . ' +1 day -1 second'));

		if ($article_type_id != 0 || $cart_id != 0) {
			$filter_article_type = "";
			$filter_cart = "";

			if ($article_type_id != 0) {
				$filter_article_type = " AND i.id_item_type = '$article_type_id'";
			}

			if ($cart_id != 0) {
				$filter_cart = " AND b.id_cart = '$cart_id'";
			}

			$r = "SELECT HOUR(b.closing_date) as hour, COUNT(aib.id_basket) as quantity
			FROM association_item_basket aib
			LEFT JOIN item i
			ON aib.id_item = i.id
			" . $filter_article_type . "
			LEFT JOIN basket b
			ON b.id = aib.id_basket
			WHERE b.closing_date BETWEEN '$start' AND '$end'
			" . $filter_cart . "
			AND b.canceling_date IS NULL
			GROUP BY aib.id_basket, HOUR(b.closing_date)";
		} else {
			$r = "SELECT HOUR(date) AS hour, COUNT(id) as quantity FROM sale WHERE date BETWEEN '$start' AND '$end' GROUP BY HOUR(date)";
		}

		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_items_sold_week_quantity($day, $article_type_id, $cart_id)
	{
		// start is the monday of the week of $day at 00:00:00
		$start = date('Y-m-d H:i:s', strtotime($day . ' -' . date('w', strtotime($day)) . ' days'));
		// end is the sunday of the week of $day at 23:59:59
		$end = date('Y-m-d H:i:s', strtotime($day . ' +' . (6 - date('w', strtotime($day))) . ' days +1 day -1 second'));

		if ($article_type_id != 0 || $cart_id != 0) {
			$filter_article_type = "";
			$filter_cart = "";

			if ($article_type_id != 0) {
				$filter_article_type = " AND i.id_item_type = '$article_type_id'";
			}

			if ($cart_id != 0) {
				$filter_cart = " AND b.id_cart = '$cart_id'";
			}

			$r = "SELECT WEEKDAY(b.closing_date) as day, COUNT(aib.id_basket) as quantity
			FROM association_item_basket aib
			LEFT JOIN item i
			ON aib.id_item = i.id
			" . $filter_article_type . "
			LEFT JOIN basket b
			ON b.id = aib.id_basket
			WHERE b.closing_date BETWEEN '$start' AND '$end'
			" . $filter_cart . "
			AND b.canceling_date IS NULL
			GROUP BY aib.id_basket, WEEKDAY(b.closing_date)";
		} else {
			$r = "SELECT WEEKDAY(date) AS day, COUNT(id) as quantity FROM sale WHERE date BETWEEN '$start' AND '$end' GROUP BY WEEKDAY(date)";
		}

		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_basket($cart, $user)
	{
		$r = "SELECT * FROM basket WHERE id_cart=$cart AND id_user=$user ORDER BY id DESC LIMIT 1";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}


	public function sel_carts_state($state)
	{
		$r = "SELECT * FROM cart WHERE state=$state";
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

	public function ins_basket($user, $cart)
	{
		$req = "INSERT INTO basket values (NULL,?,?,NOW(),NULL,NULL)";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $user);
		$rs->bindValue(2, $cart);
		$rs->execute();
	}

	public function ins_support_request($user, $cart)
	{
		$req = "INSERT INTO support_request values (NULL,?,?,NOW(),NULL)";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $user);
		$rs->bindValue(2, $cart);
		$rs->execute();
	}

	public function upd_support_request($last)
	{
		$req = "UPDATE support_request SET support_date = NOW() WHERE id = ?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $last);
		$rs->execute();
	}
	public function upd_cancel_basket($last)
	{
		$req = "UPDATE basket SET canceling_date = NOW(), closing_date = NOW() WHERE id = ?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $last);
		$rs->execute();
	}

	public function upd_sell_basket($last)
	{
		$req = "UPDATE basket SET closing_date = NOW() WHERE id = ?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $last);
		$rs->execute();
	}


	public function sel_last_support_request($user, $cart)
	{
		$r = "SELECT * FROM support_request WHERE id_user=$user AND id_cart = $cart ORDER BY id DESC LIMIT 1";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_last_basket($user, $cart)
	{
		$r = "SELECT * FROM basket WHERE id_user=$user AND id_cart = $cart ORDER BY id DESC LIMIT 1";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}


	public function sel_last_sale($basket)
	{
		$r = "SELECT * FROM sale WHERE id_basket = $basket ORDER BY id DESC LIMIT 1";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function ins_item_in_basket($item, $basket)
	{
		$req = "INSERT INTO association_item_basket values (NULL,?,?,?)";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $item);
		$rs->bindValue(2, $basket);
		$rs->bindValue(3, 1);
		$rs->execute();
	}

	public function ins_sale($basket, $amount)
	{
		$req = "INSERT INTO sale values (NULL,?,?,NOW())";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $basket);
		$rs->bindValue(2, $amount);
		$rs->execute();
	}


	public function upd_qte_item_in_basket($item, $basket, $way)
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

	public function upd_state_cart($id, $state)
	{
		$req = "UPDATE cart SET state=? WHERE id=?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $state);
		$rs->bindValue(2, $id);
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

	public function del_item_basket($item, $basket)
	{
		$req = "DELETE FROM association_item_basket WHERE id_item=? AND id_basket=?";
		$rs = PdoGsb::$monPdo->prepare($req);
		$rs->bindValue(1, $item);
		$rs->bindValue(2, $basket);
		$rs->execute();
	}
}
