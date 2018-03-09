<?php
/**
 * @author: Rico Crivelli <ricardocrivelli@gmail.com>
 * @date: 09/03/2018 11:08
 */

namespace controllers;


use classes\MyPDO;

class HorariosDisciplinas {

	/**
	 * @var MyPDO
	 */
	private $PDO;

	/**
	 * HorariosDisciplinas constructor.
	 */
	public function __construct() {
		$this->PDO = new MyPDO();
		$this->PDO->query("SET CHARACTER SET utf8");
	}

	/**
	 * @param int $idTurma
	 */
	public function getByIdTurma($idTurma) {
		global $app;

		$sql = "select h.periodo periodo, h.descricao aula, " .
		       "h.inicio inicio, h.fim fim, d.sigla materia, p.nome professor, hd.diasemana " .
		       "from ifsp_horarios.horarios_disciplinas hd " .
		       "inner join ifsp_horarios.disciplinas d on (hd.iddisciplina=d.iddisciplina) " .
		       "inner join ifsp_horarios.horarios h on (hd.idhorario=h.idhorario) " .
		       "inner join ifsp_horarios.turmas t on (hd.idturma=t.idturma) " .
		       "inner join ifsp_horarios.professores p on (hd.idprofessor=p.idprofessor) " .
		       "where (hd.idturma = :id_turma)" .
		       "order by hd.diasemana, periodo, inicio";

		$sth = $this->PDO->prepare($sql);
		$sth->bindValue(':id_turma', $idTurma);
		$sth->execute();
		$result = $sth->fetchAll(\PDO::FETCH_OBJ);
		$app->render('default.php',["data" => $result], 200);
	}

}