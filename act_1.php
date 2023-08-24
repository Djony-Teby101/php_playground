<?php
#tester le cryptage argon2i

#variable.
$pass="Lorince101";

$hash_pass=password_hash($pass, PASSWORD_ARGON2I);
print_r($hash_pass);
?>
<br>

<?php
#verifier si $pass== hash_pass.
if(password_verify($pass, $hash_pass)){
    header("location:index.php");
}else{
    echo"😕 ";
}

?>