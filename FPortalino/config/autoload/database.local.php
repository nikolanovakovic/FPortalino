<?php
$dbParams = array(
		'database'  => 'finso',
		'username'  => 'finso',
		'password'  => 'finso2013',
		'hostname'  => 'finso-db.my.phpcloud.com',
);

return array(
		'service_manager' => array(
				'factories' => array(
						'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
							return new Zend\Db\Adapter\Adapter(array(
									'driver'    => 'Pdo_Mysql',
									'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
									'database'  => $dbParams['database'],
									'username'  => $dbParams['username'],
									'password'  => $dbParams['password'],
									'hostname'  => $dbParams['hostname'],
							));
						},
				),
		),
);