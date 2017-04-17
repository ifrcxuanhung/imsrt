<?php
include_once(dirname(dirname(dirname(__FILE__))) . '/classes/generic.class.php');
global $sql, $query, $generic;

/** Adds profile fields */
$params = array(
	':value' => $_POST['value'],
	':key'    => 'maintenance',
	':group'   => 'setting'
//	':id'      => $key
);

$query = "UPDATE `setting` SET `value` = :value WHERE `key` = :key and `group` = :group";
$stmt = $generic->query($query, $params);


//$addUser = new Add_user();