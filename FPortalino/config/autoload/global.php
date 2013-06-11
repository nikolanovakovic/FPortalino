<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

/*return array(
    // ...
); */

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