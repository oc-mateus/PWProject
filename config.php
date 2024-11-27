<?php

	/** O nome do banco de dados*/
	define("DB_NAME", "cczjgxab_wda_crud");

	/** Usuário do banco de dados MySQL */
	define("DB_USER", "cczjgxab_wda_crud");

	/** Senha do banco de dados MySQL */
	define("DB_PASSWORD", "QbcahdDuUuAyfwTB7d6m ");

	/** nome do host do MySQL */
	define("DB_HOST", "localhost");

	/** caminho absoluto para a pasta do sistema **/
	if ( !defined("ABSPATH") )
		define("ABSPATH", dirname(__FILE__) . "/");
		
	/** caminho no server para o sistema **/
	if ( !defined("BASEURL") )
		define("BASEURL", "/cadmanagers.x10.mx/");
		
	/** caminho do arquivo de banco de dados **/
	if ( !defined("DBAPI") )
		define("DBAPI", ABSPATH . "inc/database.php");
	/** caminhos dos templates de header e footer **/

	define("HEADER_TEMPLATE", ABSPATH . "inc/header.php");
	define("FOOTER_TEMPLATE", ABSPATH . "inc/footer.php");
?>