<?php 

$senha = 1234;
// $hash = password_hash($senha, PASSWORD_DEFAULT);
// echo $hash;
echo password_verify($senha, '$2y$12$Qfs02V3xU0Bo4FMiXauhtuyBqj1ectL27lWWu82jqKjC3Y/iuVTj.');