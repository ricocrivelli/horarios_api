<?php

namespace classes;

use PDO;

class MyPDO extends PDO {
	public function __construct( $file = 'settings.ini' ) {
		if ( ! $settings = parse_ini_file( $file, true ) ) {
			die( 'Não foi possível abrir ' . $file );
		}

		$dns = $settings['database']['driver'] .
		       ':host=' . $settings['database']['host'] .
		       ( ( ! empty( $settings['database']['port'] ) ) ? ( ';port=' . $settings['database']['port'] ) : '' ) .
		       ';dbname=' . $settings['database']['schema'];

		parent::__construct( $dns, $settings['database']['username'], $settings['database']['password'], array('charset'=>'utf8') );
	}
}
