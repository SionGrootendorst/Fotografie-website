<?php

// Vul hier je database inloggegevens in
define('_MYSQL_HOST', 'localhost');
define('_MYSQL_USER', 'db_Foto');
define('_MYSQL_DB', 'db_Foto');
define('_MYSQL_PASS', '#1Geheim');


// In de backend code worden de onderstaande _URL en _URLPATH soms samengevoegd, dus zorg ervoor dat het klopt.
// Met het voorbeeld zou het dus worden: "https://12345.ict-lab.nl/microsoft/logintestpagina"

// Vul hier de URL in naar het domeinnaam waar deze bestanden op staan.
// LET OP! Voeg geen directory toe aan de URL.
define('_URL', 'https://glrfotografieexpo.sd-lab.nl/');

// Vul hier de directory in naar het pad waar de webapplicatie op staat.
// Laat leeg als dit niet nodig is. Zorg ervoor dat je begint met een slash.
//define('_URLPATH', '/beroeps/fotografie_project');
// Om hem leeg te laten: (uncomment het)
define('_URLPATH', '');


// Gegevens die bedoeld zijn voor aan de Microsoft kant. Hier hoef je niks aan te veranderen, tenzij je weet wat je doet.
define('_OAUTH_TENANTID', '69f77188-635e-4aa6-8794-339171ab04f8');
define('_OAUTH_CLIENTID', 'fb37addc-b7f2-42c5-85b3-e6184f571c6f');
define('_OAUTH_LOGOUT', 'https://login.microsoftonline.com/common/wsfederation?wa=wsignout1.0');
define('_OAUTH_SECRET', 'yvj7Q~-m_wke4GWTX.A0ig1rjS6ua5k6x.Jsp');
define('_OAUTH_CALLBACK', 'callback.php');


// Mocht je de scopes willen aanpassen, dan kun je dat hier doen. Zorg ervoor dat scopes apart van elkaar staan met "%20".
// Voor een lijst met alle scopes, ga naar: https://docs.microsoft.com/en-us/graph/permissions-reference
define('_OAUTH_SCOPE', 'openid%20offline_access%20profile%20user.read');

?>
