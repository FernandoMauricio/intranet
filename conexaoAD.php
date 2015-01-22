<?php

	// identificação do servidor, usuário e senha.
	$ldap_server = "ldap://nome ou ip do domain controler";
	$auth_user = "domínio\usuário";
	$auth_pass = "senha";
	
	// identificação da base que será acessada.
	$base_dn = "Ou=principal, dc=dominio, dc=com, dc=br";

	// conexão com o servidor.
	if (!($connect=@ldap_connect($ldap_server))) {
	die("Could not connect to ldap server");
	}

	// conexão autentica com o servidor.
	if (!($bind=@ldap_bind($connect, $auth_user, $auth_pass))) {
	die("Unable to bind to server");
	}

?>