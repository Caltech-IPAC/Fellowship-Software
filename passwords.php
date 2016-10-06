<?
// Use this script to generate a password hash.
// Store the hash in the "password" field in the "users" table.
// Ideally use a unique salt for each password and
// store the salt in the database also.
//
// If PHP version is 5.5 or above, use password_hash and
// password_verify functions instead.
//

include 'config.php';

$userpass = 'password';
$pwhash = crypt($userpass, $salt);
echo $pwhash;

?>