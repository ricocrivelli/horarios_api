<?php
/**
 * @author: Rico Crivelli <ricardocrivelli@gmail.com>
 * @date: 09/03/2018 10:56
 */

namespace controllers;


use classes\MyPDO;

class Turmas {

	private $PDO;

	/**
	 * Turmas constructor.
	 */
	public function __construct() {
		$this->PDO = new MyPDO();
	}

	public function getAll() {
		global $app;

		$sth = $this->PDO->prepare('SELECT idturma AS id, descricao FROM turmas ORDER BY descricao');
		$sth->execute();
		$result = $sth->fetchAll(\PDO::FETCH_OBJ);
		$app->render('default.php',["data" => $result], 200);
	}

	public function get($id) {
		global $app;
		$sth = $this->PDO->prepare('SELECT idturma AS id, descricao FROM turmas WHERE idturma = :id');
		$sth->bindValue(':id', $id);
		$sth->execute();
		$app->render('default.php',[
			"data" => $sth->fetch(\PDO::FETCH_OBJ)
		], 200);
	}

}