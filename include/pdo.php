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

	public function sel_items_sold_day($day)
	{
		// start is $day at 00:00:00
		$start = date('Y-m-d H:i:s', strtotime($day));
		// end is $day at 23:59:59
		$end = date('Y-m-d H:i:s', strtotime($day . ' +1 day -1 second'));

		$r = "SELECT HOUR(date) AS hour, SUM(amount) as amount FROM sale WHERE date BETWEEN '$start' AND '$end' GROUP BY HOUR(date)";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}

	public function sel_items_sold_week($day)
	{
		// start is the monday of the week of $day at 00:00:00
		$start = date('Y-m-d H:i:s', strtotime($day . ' -' . date('w', strtotime($day)) . ' days'));
		// end is the sunday of the week of $day at 23:59:59
		$end = date('Y-m-d H:i:s', strtotime($day . ' +' . (6 - date('w', strtotime($day))) . ' days +1 day -1 second'));

		$r = "SELECT WEEKDAY(date) AS day, SUM(amount) as amount FROM sale WHERE date BETWEEN '$start' AND '$end' GROUP BY WEEKDAY(date)";
		$r = PdoGsb::$monPdo->query($r);
		$r = $r->fetchAll();
		return $r;
	}
}
