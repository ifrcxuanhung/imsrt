<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'imsrt_user1';
$db['default']['password'] = 'imsrt_pass';
$db['default']['database'] = 'imsrt_data';
/*$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'vnefrc2';*/
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

/*CONECT TO DATABASE 2*/
$db['database']['hostname'] = 'localhost';
$db['database']['username'] = 'imsrt_user1';
$db['database']['password'] = 'imsrt_pass';
$db['database']['database'] = 'imsrt_data';
$db['database']['dbdriver'] = 'mysqli';
$db['database']['dbprefix'] = '';
$db['database']['pconnect'] = TRUE;
$db['database']['db_debug'] = TRUE;
$db['database']['cache_on'] = FALSE;
$db['database']['cachedir'] = '';
$db['database']['char_set'] = 'utf8';
$db['database']['dbcollat'] = 'utf8_general_ci';
$db['database']['swap_pre'] = '';
$db['database']['autoinit'] = TRUE;
$db['database']['stricton'] = FALSE;

$db['database1']['hostname'] = 'localhost';
$db['database1']['username'] = 'vnxindex_user';
$db['database1']['password'] = 'indexvnx';
$db['database1']['database'] = 'vnxindex_data';
$db['database1']['dbdriver'] = 'mysqli';
$db['database1']['dbprefix'] = '';
$db['database1']['pconnect'] = TRUE;
$db['database1']['db_debug'] = TRUE;
$db['database1']['cache_on'] = FALSE;
$db['database1']['cachedir'] = '';
$db['database1']['char_set'] = 'utf8';
$db['database1']['dbcollat'] = 'utf8_general_ci';
$db['database1']['swap_pre'] = '';
$db['database1']['autoinit'] = TRUE;
$db['database1']['stricton'] = FALSE;

/*CONECT TO DATABASE vndmi*/
$db['database2']['hostname'] = 'localhost';
$db['database2']['username'] = 'vndmicom_user1';
$db['database2']['password'] = 'vndmicom';
$db['database2']['database'] = 'vndmicom_data';
$db['database2']['dbdriver'] = 'mysqli';
$db['database2']['dbprefix'] = '';
$db['database2']['pconnect'] = TRUE;
$db['database2']['db_debug'] = TRUE;
$db['database2']['cache_on'] = FALSE;
$db['database2']['cachedir'] = '';
$db['database2']['char_set'] = 'utf8';
$db['database2']['dbcollat'] = 'utf8_general_ci';
$db['database2']['swap_pre'] = '';
$db['database2']['autoinit'] = TRUE;
$db['database2']['stricton'] = FALSE;
//vndmi host
$db['database3']['hostname'] = 'local.itvn.fr';
$db['database3']['username'] = 'local';
$db['database3']['password'] = 'ifrcvn';
$db['database3']['database'] = 'ims_production';
$db['database3']['dbdriver'] = 'mysqli';
$db['database3']['dbprefix'] = '';
$db['database3']['pconnect'] = TRUE;
$db['database3']['db_debug'] = TRUE;
$db['database3']['cache_on'] = FALSE;
$db['database3']['cachedir'] = '';
$db['database3']['char_set'] = 'utf8';
$db['database3']['dbcollat'] = 'utf8_general_ci';
$db['database3']['swap_pre'] = '';
$db['database3']['autoinit'] = TRUE;
$db['database3']['stricton'] = FALSE;

$db['database5']['hostname'] = 'local.itvn.fr';
$db['database5']['username'] = 'local';
$db['database5']['password'] = 'ifrcvn';
$db['database5']['database'] = 'vnxindex_data';
$db['database5']['dbdriver'] = 'mysqli';
$db['database5']['dbprefix'] = '';
$db['database5']['pconnect'] = TRUE;
$db['database5']['db_debug'] = TRUE;
$db['database5']['cache_on'] = FALSE;
$db['database5']['cachedir'] = '';
$db['database5']['char_set'] = 'utf8';
$db['database5']['dbcollat'] = 'utf8_general_ci';
$db['database5']['swap_pre'] = '';
$db['database5']['autoinit'] = TRUE;
$db['database5']['stricton'] = FALSE;

// --------------------------------------------
//$db['database6']['hostname'] = 'linux.itvn.fr'; in file controller settup
$db['database6']['hostname'] = '116.118.110.164';
$db['database6']['username'] = 'imsrt_user1';
$db['database6']['password'] = 'imsrt_pass';
$db['database6']['database'] = 'imsrt_data';
$db['database6']['dbdriver'] = 'mysqli';
$db['database6']['dbprefix'] = '';
$db['database6']['pconnect'] = TRUE;
$db['database6']['db_debug'] = TRUE;
$db['database6']['cache_on'] = FALSE;
$db['database6']['cachedir'] = '';
$db['database6']['char_set'] = 'utf8';
$db['database6']['dbcollat'] = 'utf8_general_ci';
$db['database6']['swap_pre'] = '';
$db['database6']['autoinit'] = TRUE;
$db['database6']['stricton'] = FALSE;

// --------------------------------------------
$db['database8']['hostname'] = 'localhost';
$db['database8']['username'] = 'efrcuser_user';
$db['database8']['password'] = 'RC&comefrcvn&IF';
$db['database8']['database'] = 'efrcuser_data';
$db['database8']['dbdriver'] = 'mysqli';
$db['database8']['dbprefix'] = '';
$db['database8']['pconnect'] = TRUE;
$db['database8']['db_debug'] = TRUE;
$db['database8']['cache_on'] = FALSE;
$db['database8']['cachedir'] = '';
$db['database8']['char_set'] = 'utf8';
$db['database8']['dbcollat'] = 'utf8_general_ci';
$db['database8']['swap_pre'] = '';
$db['database8']['autoinit'] = TRUE;
$db['database8']['stricton'] = FALSE;

/*Config DB Send Mail*/
$db['default']['hostname_db_mail'] = 'local.itvn.fr';
$db['default']['username_db_mail'] = 'local';
$db['default']['password_db_mail'] = 'ifrcvn';
$db['default']['database_db_mail'] = 'upmd_sendmail';
$db['default']['name_group_mail'] = 'EMAIL_SUBSCRIBE_NEWS';

/* End of file database.php */
/* Location: ./application/config/database.php */