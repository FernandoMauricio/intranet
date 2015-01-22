<?php

  // importação do código anterior
  require_once('ConexaoAD.php');

?>

<?php

  // usuário do AD logado na máquina, ele separa usuário e domínio casso o meu ficaria sem o "*****\" que tem 6 caracteres
  $usuario = substr($_SERVER['LOGON_USER'], 6);





// Este filtro você pode utilizar pra trazer todos os usuário de uma OU. no lugar do " '(|(samaccountname='.$usuario.'))' "(sem as "").
$filter = "(&(objectClass=user)(objectCategory=person)(cn=*))";//este filtro serve quando você não quer filtrar pelo usuário e capturar todos que existem no ad de uma determinada OU


// Busca no AD

if (!($search=@ldap_search($connect, $base_dn, '(|(samaccountname='.$usuario.'))'))) {
die("Unable to search ldap server");
}
// verificar o número de usuários localizados no AD.
$number_returned = ldap_count_entries($connect,$search);

// condição que verifica se o usuário foi localizado na base padrão. No meu cado eu possuo uma ou principal para usuários normais e outra pra usuário administradores.
if ($number_returned<="0"){
	$erro = 1;
	$base_dn = "Ou=Administradores, dc=tiisa, dc=com, dc=br";
	if (!($search=@ldap_search($connect, $base_dn, '(|(samaccountname='.$usuario.'))'))) ;
        $number_returned = ldap_count_entries($connect,$search);
}

// captura dos dados
$info = ldap_get_entries($connect, $search);

// definição das variáveis referente ao usuário
if($number_returned>0){
for ($i=0; $i<$info["count"]; $i++) {

   // definição das variáveis.
   $userad = $info[$i]["name"][0];
   $mailad = $info[$i]["mail"][0];


}
}else{
	
	$userad = "Usuário Não Cadastrado";
	$mailad = "";
	$usuario = "";
}

// Impressão dos dados localizados no AD
echo $userad."<br>";
echo $mailad."<br>";
echo $usuario."<br>";


ldap_close($connect);
?>