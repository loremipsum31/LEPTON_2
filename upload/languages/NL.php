<?php

/**
 * This file is part of LEPTON Core, released under the GNU GPL
 * Please see LICENSE and COPYING files in your package for details, specially for terms and warranties.
 *
 * NOTICE:LEPTON CMS Package has several different licenses.
 * Please see the individual license in the header of each single file or info.php of modules and templates.
 *
 * @author          Website Baker Project, LEPTON Project
 * @copyright       2004-2010, Website Baker Project
 * @copyright       2010-2013 LEPTON Project
 * @link            http://www.LEPTON-cms.org
 * @license         http://www.gnu.org/licenses/gpl.html
 * @license_terms   please see LICENSE and COPYING files in your package
 * @version         $Id: NL.php 1586 2012-01-03 09:49:34Z erpe $
 *
 */


// include class.secure.php to protect this file and the whole CMS!
if (defined('WB_PATH')) {
	include(WB_PATH.'/framework/class.secure.php');
} else {
	$oneback = "../";
	$root = $oneback;
	$level = 1;
	while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
		$root .= $oneback;
		$level += 1;
	}
	if (file_exists($root.'/framework/class.secure.php')) {
		include($root.'/framework/class.secure.php');
	} else {
		trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
	}
}
// end include class.secure.php



// Define that this file is loaded
if(!defined('LANGUAGE_LOADED')) {
	define('LANGUAGE_LOADED', true);
}

// Set the language information
$language_code = 'NL';
$language_name = 'Nederlands';
$language_version = '1.0';
$language_platform = '1.0.x';
$language_author = 'bpe';
$language_license = 'GNU General Public License';
$language_guid = '18bb3637-6f95-4a81-b1c0-796df2d326f0';

$MENU = array(
	'ACCESS' 				=> 'Toegang',
	'ADDON' 				=> 'Add-on',
	'ADDONS' 				=> 'Extra&rsquo;s',
	'ADMINTOOLS' 			=> 'Beheerfuncties',
	'BREADCRUMB' 			=> 'U bent hier: ',
	'FORGOT' 				=> 'Inloggegevens opnieuw aanvragen',
	'GROUP' 				=> 'Groep',
	'GROUPS' 				=> 'Groepen',
	'HELP' 					=> 'Help',
	'LANGUAGES' 			=> 'Talen',
	'LOGIN' 				=> 'Inloggen',
	'LOGOUT' 				=> 'Uitloggen',
	'MEDIA' 				=> 'Media',
	'MODULES' 				=> 'Modules',
	'PAGES' 				=> 'Pagina&rsquo;s',
	'PREFERENCES' 			=> 'Profiel',
	'SETTINGS' 				=> 'Instellingen',
	'START' 				=> 'Start',
	'TEMPLATES' 			=> 'Templates',
	'USERS' 				=> 'Gebruikers',
	'VIEW' 					=> 'Bekijken',
	'SERVICE'				=> 'Onderhoud'
); // $MENU

$TEXT = array(
	'ACCOUNT_SIGNUP' 		=> 'Aanmelden als gebruiker',
	'ACTION_NOT_SUPPORTED'	=> 'Actie niet ondersteund',
	'ACTIONS' 				=> 'Acties',
	'ACTIVE' 				=> 'Actief',
	'ADD' 					=> 'Toevoegen',
	'ADDON' 				=> 'Add-on',
	'ADD_SECTION' 			=> 'Toevoegen sectie',
	'ADMIN' 				=> 'Beheer',
	'ADMINISTRATION' 		=> 'Beheer',
	'ADMINISTRATION_TOOL' 	=> 'Beheeropties',
	'ADMINISTRATOR' 		=> 'Beheerder',
	'ADMINISTRATORS' 		=> 'Beheerders',
	'ADVANCED' 				=> 'Geavanceerd',
	'ALLOWED_FILETYPES_ON_UPLOAD' => 'Toegestane bestandstypes bij uploaden',
	'ALLOWED_VIEWERS' 		=> 'Toegestane kijkers',
	'ALLOW_MULTIPLE_SELECTIONS' => 'Meerdere selecties toestaan',
	'ALL_WORDS' 			=> 'Term of deel van term',
	'ANCHOR' 				=> 'Anker',
	'ANONYMOUS' 			=> 'Anoniem',
	'ANY_WORDS' 			=> 'E&eacute;n van de termen',
	'APP_NAME' 				=> 'Applicatienaam',
	'ARE_YOU_SURE' 			=> 'Weet u het zeker?',
	'AUTHOR' 				=> 'Auteur',
	'BACK' 					=> 'Terug',
	'BACKUP' 				=> 'Backup',
	'BACKUP_ALL_TABLES' 	=> 'Backup van alle tabellen in de database',
	'BACKUP_DATABASE' 		=> 'Backup van de database maken',
	'BACKUP_MEDIA' 			=> 'Backup van de Media-map maken',
	'BACKUP_WB_SPECIFIC' 	=> 'Backup van alleen LETON-gerelateerde tabellen',
	'BASIC' 				=> 'Basis',
	'BLOCK' 				=> 'Blok',
	'BACKEND_TITLE'	=>	'Backendtitle',
	'CALENDAR' 				=> 'Kalender',
	'CANCEL' 				=> 'Annuleren',
	'CAN_DELETE_HIMSELF' 	=> 'Kan zichzelf verwijderen',
	'CAPTCHA_VERIFICATION' 	=> 'Captcha-verificatie',
	'CAP_EDIT_CSS' 			=> 'Wijzig CSS',
	'CHANGE' 				=> 'Verander',
	'CHANGES' 				=> 'Veranderingen',
	'CHANGE_SETTINGS' 		=> 'Wijzig instellingen',
	'CHARSET' 				=> 'Tekenset',
	'CHECKBOX_GROUP' 		=> 'Aankruisvakjes',
	'CLOSE' 				=> 'Sluiten',
	'CODE' 					=> 'Code',
	'CODE_SNIPPET' 			=> 'Code-snippet',
	'COLLAPSE' 				=> 'Inklappen',
	'COMMENT' 				=> 'Reageren',
	'COMMENTING' 			=> 'Reactie-opties',
	'COMMENTS' 				=> 'Reacties',
	'CREATE_FOLDER' 		=> 'Toevoegen nieuwe map',
	'CURRENT' 				=> 'Huidig(e)',
	'CURRENT_FOLDER' 		=> 'Huidige map',
	'CURRENT_PAGE' 			=> 'Huidige pagina',
	'CURRENT_PASSWORD' 		=> 'Huidig wachtwoord',
	'CUSTOM' 				=> 'Handmatige invoer',
	'DATABASE' 				=> 'Database',
	'DATE' 					=> 'Datum',
	'DATE_FORMAT' 			=> 'Datumweergave',
	'DEFAULT' 				=> 'Standaard',
	'DEFAULT_CHARSET' 		=> 'Standaard tekenset',
	'DEFAULT_TEXT' 			=> 'Standaardtekst',
	'DELETE' 				=> 'Verwijderen',
	'DELETED' 				=> 'Verwijderd',
	'DELETE_DATE' 			=> 'Wis datum',
	'DELETE_ZIP' 			=> 'Verwijder ZIP van server na uitpakken',
	'DESCRIPTION' 			=> 'Beschrijving',
	'DESIGNED_FOR' 			=> 'Ontworpen voor',
	'DIRECTORIES' 			=> 'Mappen',
	'DIRECTORY_MODE' 		=> 'Directory-modus',
	'DISABLED' 				=> 'Uit',
	'DISPLAY_NAME' 			=> 'Naamweergave',
	'EMAIL' 				=> 'E-mail',
	'EMAIL_ADDRESS' 		=> 'E-mailadres',
	'EMPTY_TRASH' 			=> 'Prullenbak legen',
	'ENABLE_JAVASCRIPT'		=> 'Javascript moet aan staan om dit formulier te gebruiken.',
	'ENABLED' 				=> 'Aan',
	'END' 					=> 'Einde',
	'ERROR' 				=> 'Fout',
	'EXACT_MATCH' 			=> 'Exacte term',
	'EXECUTE' 				=> 'Uitvoeren',
	'EXPAND' 				=> 'Uitklappen',
	'EXTENSION' 			=> 'Extensie',
	'FIELD' 				=> 'Veld',
	'FILE' 					=> 'Bestand',
	'FILES' 				=> 'bestanden',
	'FILESYSTEM_PERMISSIONS' => 'Bestandssysteembevoegdheden',
	'FILE_MODE' 			=> 'Bestandsmodus',
	'FINISH_PUBLISHING' 	=> 'Einde publicatie',
	'FOLDER' 				=> 'Map',
	'FOLDERS' 				=> 'Mappen',
	'FOOTER' 				=> 'Footer',
	'FORGOTTEN_DETAILS' 	=> 'Gegevens vergeten?',
	'FORGOT_DETAILS' 		=> 'Gegevens vergeten?',
	'FROM' 					=> 'Van',
	'FRONTEND' 				=> 'Website',
	'FULL_NAME' 			=> 'Volledige naam',
	'FUNCTION' 				=> 'Functie',
	'GROUP' 				=> 'Groep',
	'HEADER' 				=> 'Header',
	'HEADING' 				=> 'Titel',
	'HEADING_CSS_FILE' 		=> 'Actuele modulebestand: ',
	'HEIGHT' 				=> 'Hoogte',
		'HELP_LEPTOKEN_LIFETIME'		=> 'in seconds, 0 means no CSRF protection!',
		'HELP_MAX_ATTEMPTS'		=> 'When reaching this number, more login attempts are not possible for this session.',
	'HIDDEN' 				=> 'Verborgen',
	'HIDE' 					=> 'Verbergen',
	'HIDE_ADVANCED' 		=> 'Verberg geavanceerde opties',
	'HOME' 					=> 'Home',
	'HOMEPAGE_REDIRECTION' 	=> 'Homepage-omleiding',
	'HOME_FOLDER' 			=> 'Home-map',
	'HOME_FOLDERS' 			=> 'Home-mappen',
	'HOST' 					=> 'Host',
	'ICON' 					=> 'Icoon',
	'IMAGE' 				=> 'Afbeelding',
	'INLINE' 				=> 'Inline',
	'INSTALL' 				=> 'Installeren',
	'INSTALLATION' 			=> 'Installatie',
	'INSTALLATION_PATH' 	=> 'Installatiepad',
	'INSTALLATION_URL' 		=> 'Installatie-URL',
	'INSTALLED' 			=> 'ge&iuml;nstalleerd',
	'INTRO' 				=> 'Introductie',
	'INTRO_PAGE' 			=> 'Introductiepagina',
	'INVALID_SIGNS' 		=> 'moet met een letter beginnen of heeft ongeldige tekens',
	'KEYWORDS' 				=> 'Steekwoorden',
	'LANGUAGE' 				=> 'Taal',
	'LAST_UPDATED_BY' 		=> 'Laatste wijzigingen door',
	'LENGTH' 				=> 'Lengte',
		'LEPTOKEN_LIFETIME'		=> 'Leptoken Lifetime',
	'LEVEL' 				=> 'Niveau',
	'LIBRARY'				=> 'Bibliotheek',
	'LICENSE'				=> 'Licentie',
	'LINK' 					=> 'Link',
	'LINUX_UNIX_BASED' 		=> 'Linux/Unix',
	'LIST_OPTIONS' 			=> 'Lijstopties',
	'LOGGED_IN' 			=> 'Ingelogd',
	'LOGIN' 				=> 'Inloggen',
	'LONG' 					=> 'Lang',
	'LONG_TEXT' 			=> 'Lange tekst',
	'LOOP' 					=> 'Herhaal',
	'MAIN' 					=> 'Primair(e)',
	'MANAGE' 				=> 'Beheren',
	'MANAGE_GROUPS' 		=> 'Groepenbeheer',
	'MANAGE_USERS' 			=> 'Gebruikersbeheer',
	'MATCH' 				=> 'Gelijk aan',
	'MATCHING' 				=> 'Overeenkomend',
		'MAX_ATTEMPTS'		=> 'Allowed wrong login attempts',
	'MAX_EXCERPT' 			=> 'Maximaal aantal gelijktijdige zoekacties',
	'MAX_SUBMISSIONS_PER_HOUR' => 'Maximaal aantal inzendingen per uur',
	'MEDIA_DIRECTORY' 		=> 'Media-map',
	'MENU' 					=> 'Menu',
	'MENU_ICON_0' 			=> 'Menu-icoon normal',
	'MENU_ICON_1' 			=> 'Menu-icoon hover',
	'MENU_TITLE' 			=> 'Menutitel',
	'MESSAGE' 				=> 'Bericht',
	'MODIFY' 				=> 'Wijzigen',
	'MODIFY_CONTENT' 		=> 'Wijzig inhoud',
	'MODIFY_SETTINGS' 		=> 'Wijzig instellingen',
	'MODULE_ORDER' 			=> 'Modules doorzoeken',
	'MODULE_PERMISSIONS' 	=> 'Modulebevoegdheden',
	'MORE' 					=> 'Meer',
	'MOVE_DOWN' 			=> 'Naar beneden',
	'MOVE_UP' 				=> 'Naar boven',
	'MULTIPLE_MENUS' 		=> 'Meerdere menu&rsquo;s',
	'MULTISELECT' 			=> 'Meervoudige selectie',
	'NAME' 					=> 'Naam',
	'NEED_CURRENT_PASSWORD' => 'Bevestig met uw huidig wachtwoord',
	'NEED_PASSWORD_TO_CONFIRM' => 'Bevestig de aanpassingen met uw huidig wachtwoord',
	'NEED_TO_LOGIN' 		=> 'Inloggen?',
	'NEW_PASSWORD' 			=> 'Nieuw wachtwoord',
	'NEW_USER_HINT'			=> 'Minimum length for user name: %d chars, &nbsp; Minimum length for Password: %d chars!',
	'NEW_WINDOW' 			=> 'Nieuw scherm',
	'NEXT' 					=> 'Volgende',
	'NEXT_PAGE' 			=> 'Volgende pagina',
	'NO' 					=> 'Nee',
	'NO_LEPTON_ADDON'  		=> 'Deze add-on kan niet gebruikt worden met LEPTON',
	'NONE' 					=> 'Geen',
	'NONE_FOUND' 			=> 'Geen gevonden',
	'NOT_FOUND' 			=> 'Niet gevonden',
	'NOT_INSTALLED' 		=> 'Niet ge&iuml;nstalleerd',
	'NO_RESULTS' 			=> 'Geen resultaten',
	'OF' 					=> 'van de',
	'ON' 					=> 'Op',
	'OPEN' 					=> 'Openen',
	'OPTION' 				=> 'Optie',
	'OTHERS' 				=> 'Anderen',
	'OUT_OF' 				=> 'Buiten',
	'OVERWRITE_EXISTING' 	=> 'Overschrijf bestaande',
	'PAGE' 					=> 'Pagina',
	'PAGES_DIRECTORY' 		=> 'Pagina&rsquo;s-map',
	'PAGES_PERMISSION' 		=> 'Paginabevoegdheid',
	'PAGES_PERMISSIONS' 	=> 'Paginabevoegdheden',
	'PAGE_EXTENSION' 		=> 'Pagina-extensie',
	'PAGE_ICON' 			=> 'Pagina-icoon',
	'PAGE_ID'      			=> 'Pagina ID',
	'PAGE_LANGUAGES' 		=> 'Paginataal',
	'PAGE_LEVEL_LIMIT' 		=> 'Pagina-niveaulimiet',
	'PAGE_SPACER' 			=> 'Pagina-spacer',
	'PAGE_TITLE' 			=> 'Paginatitel',
	'PAGE_TRASH' 			=> 'Paginaprullenbak',
	'PARENT' 				=> 'Ouder',
	'PASSWORD' 				=> 'Wachtwoord',
	'PATH' 					=> 'Pad',
	'PHP_ERROR_LEVEL' 		=> 'PHP-foutmeldingsniveau',
	'PLEASE_LOGIN' 			=> 'Inloggen a.u.b.',
	'PLEASE_SELECT' 		=> 'Selecteer',
	'POST' 					=> 'Bericht',
	'POSTS_PER_PAGE' 		=> 'Berichten per pagina',
	'POST_FOOTER' 			=> 'Bericht-footer',
	'POST_HEADER' 			=> 'Bericht-header',
	'PREVIOUS' 				=> 'Vorige',
	'PREVIOUS_PAGE' 		=> 'Vorige pagina',
	'PRIVATE' 				=> 'Aangemeld',
	'PRIVATE_VIEWERS' 		=> 'Aangemelde bezoekers',
	'PROFILES_EDIT' 		=> 'Wijzig profiel',
	'PUBLIC' 				=> 'Iedereen',
	'PUBL_END_DATE' 		=> 'Einddatum',
	'PUBL_START_DATE' 		=> 'Startdatum',
	'RADIO_BUTTON_GROUP' 	=> 'Radio buttons',
	'READ' 					=> 'Lees',
	'READ_MORE' 			=> 'Lees meer',
	'REDIRECT_AFTER' 		=> 'Omleiding na (sec.)',
	'REGISTERED' 			=> 'Geregistreerd',
	'REGISTERED_VIEWERS' 	=> 'Geregistreerde bezoekers',
	'REGISTERED_CONTENT'	=> 'Aan geregistreerde bezoekers hebben toegang tot deze inhoud',
	'RELOAD' 				=> 'Vernieuwen',
	'REMEMBER_ME' 			=> 'Onthoud mijn gegevens',
	'RENAME' 				=> 'Hernoemen',
	'RENAME_FILES_ON_UPLOAD' => 'Bestanden hernoemen bij uploaden',
	'REQUIRED' 				=> 'Verplicht',
	'REQUIREMENT' 			=> 'Benodigd',
	'RESET' 				=> 'Opnieuw',
	'RESIZE' 				=> 'Veranderen grootte',
	'RESIZE_IMAGE_TO' 		=> 'Verander afbeeldingsgrootte naar',
	'RESTORE' 				=> 'Backup terugzetten',
	'RESTORE_DATABASE' 		=> 'Backup van de database terugzetten',
	'RESTORE_MEDIA' 		=> 'Backup van de Media-map terugzetten',
	'RESULTS' 				=> 'Resultaten',
	'RESULTS_FOOTER' 		=> 'Zoekresultaten-footer',
	'RESULTS_FOR' 			=> 'Resultaten voor',
	'RESULTS_HEADER' 		=> 'Zoekresultaten-header',
	'RESULTS_LOOP' 			=> 'Zoekresultaten',
	'RETYPE_NEW_PASSWORD' 	=> 'Herhaal nieuw wachtwoord',
	'RETYPE_PASSWORD' 		=> 'Herhaal wachtwoord',
	'SAME_WINDOW' 			=> 'Zelfde scherm',
	'SAVE' 					=> 'Opslaan',
	'SEARCH' 				=> 'Zoeken',
	'SEARCH_FOR'  			=> 'Zoeken naar',
	'SEARCHING' 			=> 'Zoekfunctie',
	'SECTION' 				=> 'Sectie',
	'SECTION_BLOCKS' 		=> 'Sectieblokken',
	'SECTION_ID' 			=> 'Sectie ID',
	'SEC_ANCHOR' 			=> 'Sessie-voorvoegsel',
	'SELECT_BOX' 			=> 'Selectiemenu',
	'SEND_DETAILS' 			=> 'Stuur gegevens',
	'SEPARATE' 				=> 'Gescheiden',
	'SEPERATOR' 			=> 'Scheidingsteken',
	'SERVER_EMAIL' 			=> 'Server e-mail',
	'SERVER_OPERATING_SYSTEM' => 'Serverbesturingssysteem',
	'SESSION_IDENTIFIER' 	=> 'Sessie-identificatie',
	'SETTINGS' 				=> 'Instellingen',
	'SHORT' 				=> 'Kort',
	'SHORT_TEXT' 			=> 'Korte tekst',
	'SHOW' 					=> 'Tonen',
	'SHOW_ADVANCED' 		=> 'Toon geavanceerde opties',
	'SIGNUP' 				=> 'Registratie',
	'SIZE' 					=> 'Grootte',
	'SMART_LOGIN' 			=> 'Snel inloggen',
	'START' 				=> 'Aanvang',
	'START_PUBLISHING' 		=> 'Aanvang publicatie',
	'SUBJECT' 				=> 'Onderwerp',
	'SUBMISSIONS' 			=> 'Inzendingen',
	'SUBMISSIONS_STORED_IN_DATABASE' => 'Maximaal aantal te bewaren inzendingen',
	'SUBMISSION_ID' 		=> 'Ingezonden bericht',
	'SUBMITTED' 			=> 'Ingezonden',
	'SUCCESS' 				=> 'Succes',
	'SYSTEM_DEFAULT' 		=> 'Standaardinstellingen',
	'SYSTEM_PERMISSIONS' 	=> 'Systeembevoegdheden',
	'TABLE_PREFIX' 			=> 'Tabelvoorvoegsel',
	'TARGET' 				=> 'Doel',
	'TARGET_FOLDER' 		=> 'Doelmap',
	'TEMPLATE' 				=> 'Template',
	'TEMPLATE_PERMISSIONS' 	=> 'Templatebevoegdheden',
	'TEXT' 					=> 'Tekst',
	'TEXTAREA' 				=> 'Tekstveld',
	'TEXTFIELD' 			=> 'Tekstregel',
	'THEME' 				=> 'Thema Website-beheer',
	'TIME' 					=> 'Tijd',
	'TIMEZONE' 				=> 'Tijdzone',
	'TIME_FORMAT' 			=> 'Tijdweergave',
	'TIME_LIMIT' 			=> 'Maximale zoektijd per module',
	'TITLE' 				=> 'Titel',
	'TO' 					=> 'Aan',
	'TOP_FRAME' 			=> 'Bovenste frame',
	'TRASH_EMPTIED' 		=> 'Prullenbak geleegd',
	'TXT_EDIT_CSS_FILE' 	=> 'Wijzig de CSS-definities in het tekstveld hieronder.',
	'TYPE' 					=> 'Type',
	'UNDER_CONSTRUCTION' 	=> 'In bewerking',
	'UNINSTALL' 			=> 'Verwijderen',
	'UNKNOWN' 				=> 'Onbekend(e)',
	'UNLIMITED' 			=> 'Ongelimiteerd',
	'UNZIP_FILE' 			=> 'Uploaden en uitpakken van ZIP-bestand',
	'UP' 					=> 'Omhoog',
	'UPGRADE' 				=> 'Upgrade',
	'UPLOAD_FILES' 			=> 'Uploaden bestand(en)',
	'URL' 					=> 'URL',
	'USER' 					=> 'Gebruiker',
	'USERNAME' 				=> 'Gebruikersnaam',
	'USERS_ACTIVE' 			=> 'gebruiker is op actief gezet',
	'USERS_CAN_SELFDELETE' 	=> 'gebruiker kan zijn eigen account verwijderen',
	'USERS_CHANGE_SETTINGS' => 'Gebruiker kan de eigen instellingen aanpassen',
	'USERS_DELETED' 		=> 'Gebruiker is gemarkeerd als verwijderd',
	'USERS_FLAGS' 			=> 'User-Flags',
	'USERS_PROFILE_ALLOWED' => 'Gebruiker kan uitgebreid profiel aanmaken',
	'VERIFICATION' 			=> 'Verificatie',
	'VERSION' 				=> 'Versie',
	'VIEW' 					=> 'Bekijken',
	'VIEW_DELETED_PAGES' 	=> 'Bekijk verwijderde pagina&rsquo;s',
	'VIEW_DETAILS' 			=> 'Gegevens bekijken',
	'VISIBILITY' 			=> 'Zichtbaarheid',
	'WBMAILER_DEFAULT_SENDER_MAIL' => 'Standaard afzendermailadres',
	'WBMAILER_DEFAULT_SENDER_NAME' => 'Standaard afzendernaam',
	'WBMAILER_DEFAULT_SETTINGS_NOTICE' => 'Specificeer hieronder een standaard afzenderadres en afzendernaam. Het is aanbevolen om een afzenderadres als: <strong>admin@uwdomein.nl</strong> te gebruiken. Om verspreiding van spam tegen te gaan, kunnen sommige mailproviders (bijv. <em>mail.com</em>) mails verwerpen met een afzenderadres als <em>name@mail.com</em>, die verzonden worden vanaf een relay-server. Onderstaande standaardwaarden worden enkel gebruikt indien geen andere waarden gespecifieerd worden door Lepton. Indien uw server <acronym title="Simple mail transfer protocol">SMTP</acronym> ondersteunt kunt u deze optie gebruiken voor het versturen van uitgaande mails.',
	'WBMAILER_FUNCTION' 	=> 'Mailafhandeling',
	'WBMAILER_NOTICE' 		=> '<strong>Instellingen SMTP Mailer:</strong><br />Onderstaande instellingen zijn alleen van toepassing indien u mails wilt verzenden via <acronym title="Simple mail transfer protocol">SMTP</acronym>. Indien u de naam of instellingen van de SMTP-server niet kent, selecteer dan bij de standaard mailroutine: PHP MAIL.',
	'WBMAILER_PHP' 			=> 'PHP MAIL',
	'WBMAILER_SEND_TESTMAIL' => 'Vestuur een testmail',
	'WBMAILER_SMTP' 		=> 'SMTP',
	'WBMAILER_SMTP_AUTH' 	=> 'SMTP-authenticatie',
	'WBMAILER_SMTP_AUTH_NOTICE' => 'Alleen wanneer men zich dient aan te melden bij de SMTP-host',
	'WBMAILER_SMTP_HOST' 	=> 'SMTP-host',
	'WBMAILER_SMTP_PASSWORD' => 'SMTP-wachtwoord',
	'WBMAILER_SMTP_USERNAME' => 'SMTP-gebruikersnaam',
  'WBMAILER_TESTMAIL_FAILED' => 'De testmail kan niet verzonden worden! Controleer de instellingen!',
	'WBMAILER_TESTMAIL_SUCCESS' => 'De testmail is goed verzonden. Controleer je postvak-in.',
  'WBMAILER_TESTMAIL_TEXT' => 'Dit is de testmail: php mailer werkt!',
	'WEBSITE' 				=> 'Website',
	'WEBSITE_DESCRIPTION' 	=> 'Metatag "Description"',
	'WEBSITE_FOOTER' 		=> 'Website-footer',
	'WEBSITE_HEADER' 		=> 'Website-header',
	'WEBSITE_KEYWORDS' 		=> 'Metatag "Keywords"',
	'WEBSITE_TITLE' 		=> 'Metatag "Title"',
	'WELCOME_BACK' 			=> 'Welkom terug',
	'WIDTH' 				=> 'Breedte',
	'WINDOW' 				=> 'Scherm',
	'WINDOWS' 				=> 'Windows',
	'WORLD_WRITEABLE_FILE_PERMISSIONS' => 'CHMOD 777 alle bestanden',
	'WRITE' 				=> 'Schrijf',
	'WYSIWYG_EDITOR' 		=> 'WYSIWYG-editor',
	'WYSIWYG_STYLE'	 		=> 'WYSIWYG-stijl',
	'YES' 					=> 'Ja',
	'BASICS'	=> array(
		'day'		=> "dag",		# day, singular
		'day_pl'	=> "dagen",		# day, plural
		'hour'		=> "uur", 		# hour, singular
		'hour_pl'	=> "uren",		# hour, plural
		'minute'	=> "minuut",	# minute, singular
		'minute_pl'	=> "minuten",	# minute, plural
	)
); // $TEXT

$HEADING = array(
	'ADDON_PRECHECK_FAILED' => 'Module voldoet niet aan de eisen',
	'ADD_CHILD_PAGE' 		=> 'Toevoegen subpagina',
	'ADD_GROUP' 			=> 'Toevoegen groep',
	'ADD_GROUPS' 			=> 'Toevoegen groepen',
	'ADD_HEADING' 			=> 'Toevoegen titel',
	'ADD_PAGE' 				=> 'Toevoegen nieuwe pagina',
	'ADD_USER' 				=> 'Toevoegen gebruiker',
	'ADMINISTRATION_TOOLS' 	=> 'Beheerfuncties',
	'BROWSE_MEDIA' 			=> 'Bladeren door Media-map',
	'CREATE_FOLDER' 		=> 'Toevoegen nieuwe map',
	'DEFAULT_SETTINGS' 		=> 'Standaardinstellingen',
	'DELETED_PAGES' 		=> 'Verwijderde pagina&rsquo;s',
	'FILESYSTEM_SETTINGS' 	=> 'Bestandssysteeminstellingen',
	'GENERAL_SETTINGS' 		=> 'Algemene instellingen',
	'INSTALL_LANGUAGE' 		=> 'Toevoegen taalbestand',
	'INSTALL_MODULE' 		=> 'Toevoegen module',
	'INSTALL_TEMPLATE' 		=> 'Toevoegen template',
	'INVOKE_MODULE_FILES' 	=> 'Handmatige module-installatie',
	'LANGUAGE_DETAILS' 		=> 'Taalbestandgegevens',
	'MANAGE_SECTIONS' 		=> 'Sectiebeheer',
	'MODIFY_ADVANCED_PAGE_SETTINGS' => 'Geavanceerde pagina-instellingen',
	'MODIFY_DELETE_GROUP' 	=> 'Beheren groep',
	'MODIFY_DELETE_PAGE' 	=> 'Beheren bestaande pagina&rsquo;s',
	'MODIFY_DELETE_USER' 	=> 'Beheren gebruikers',
	'MODIFY_GROUP' 			=> 'Beheren groep',
	'MODIFY_GROUPS' 		=> 'Beheren groepen',
	'MODIFY_INTRO_PAGE' 	=> 'Wijzigen introductiepagina',
	'MODIFY_PAGE' 			=> 'Aanpassen pagina',
	'MODIFY_PAGE_SETTINGS' 	=> 'Pagina-instellingen',
	'MODIFY_USER' 			=> 'Gebruikersgegevens',
	'MODULE_DETAILS' 		=> 'Modulegegevens',
	'MY_EMAIL' 				=> 'Mijn e-mailadres',
	'MY_PASSWORD' 			=> 'Mijn wachtwoord',
	'MY_SETTINGS' 			=> 'Mijn gegevens',
	'SEARCH_SETTINGS' 		=> 'Zoekinstellingen',
	'SEARCH_PAGE' 			=> 'Search Page',
	'SECURITY_SETTINGS'		=> 'Security Setting',
	'SERVER_SETTINGS' 		=> 'Serverinstellingen',
	'TEMPLATE_DETAILS' 		=> 'Templategegevens',
	'UNINSTALL_LANGUAGE' 	=> 'Verwijderen taalbestand',
	'UNINSTALL_MODULE' 		=> 'Verwijderen module',
	'UNINSTALL_TEMPLATE' 	=> 'Verwijderen template',
	'UPGRADE_LANGUAGE' 		=> 'Upgraden/inschakelen taalbestand',
	'UPLOAD_FILES' 			=> 'Uploaden bestanden',
	'VISIBILITY' 			=> 'Zichtbaarheid',
	'WBMAILER_SETTINGS' 	=> 'Mailer-instellingen'
); // $HEADING

$MESSAGE = array(
	'ADDON_ERROR_RELOAD' 				=> 'Fout tijdens het updaten van de add-on bestanden.',
	'ADDON_GROUPS_MARKALL' 				=> 'Selecteer / deselecteer alles',
	'ADDON_LANGUAGES_RELOADED' 			=> 'Taalbestanden succesvol herladen',
	'ADDON_MANUAL_FTP_LANGUAGE' 		=> '<strong>ATTENTIE!</strong> Om veiligheidsredenen dient u de taalbestanden in de folder /languages/ via FTP te uploaden en vervolgens de Upgrade-functie te gebruiken om ze aan het systeem toe te voegen.',
	'ADDON_MANUAL_FTP_WARNING' 			=> 'Waarschuwing: bestaande module database-informatie zal verloren gaan! ',
	'ADDON_MANUAL_INSTALLATION' 		=> 'Wanneer modules geupload zijn met FTP (niet aaabevolen), zullen de functies <tt>installeren</tt>, <tt>upgraden</tt> of <tt>verwijderen</tt> niet automatisch uitgevoerd worden. Deze modules werken niet correct of zijn niet goed verwijderd.<br /><br />Je kunt de functies hieronder handmatig starten.',
	'ADDON_MANUAL_INSTALLATION_WARNING' => 'Waarschuwing: de bestaande module database-informatie zal verloren gaan! Gebruik deze optie alleen indien u ervaring heeft met modules die zijn geupload via FTP.',
	'ADDON_MANUAL_RELOAD_WARNING' 		=> 'Waarschuwing: de bestaande module database-informatie zal verloren gaan! ',
	'ADDON_MODULES_RELOADED' 			=> 'Modules succesvol herladen',
	'ADDON_PRECHECK_FAILED' 			=> 'Add-on installatie mislukt. Uw systeem voldoet niet aan de eisen van deze add-on. Om deze situatie te veranderen kunt u de informatie hieronder toepassen.',
	'ADDON_RELOAD' 						=> 'Update database met informatie uit de add-on bestanden (bijvoorbeeld na FTP-upload).',
	'ADDON_TEMPLATES_RELOADED' 			=> 'Templates succesvol herladen',
	'ADMIN_INSUFFICIENT_PRIVELLIGES' 	=> 'Onvoldoende rechten om hier te zijn',
	'FORGOT_PASS_ALREADY_RESET' 		=> 'Sorry, het wachtwoord kan maximaal eens per uur worden aangepast.',
	'FORGOT_PASS_CANNOT_EMAIL' 			=> 'Het is niet mogelijk uw wachtwoord per e-mail te versturen. Neem contact op met de beheerder',
	'FORGOT_PASS_EMAIL_NOT_FOUND' 		=> 'Het door u opgegeven e-mailadres is niet gevonden in onze database',
	'FORGOT_PASS_NO_DATA' 				=> 'Vult u alstublieft hieronder uw e-mailadres in',
	'FORGOT_PASS_PASSWORD_RESET' 		=> 'Uw gebruikersnaam en wachtwoord zijn verzonden naar het opgegeven e-mailadres',
	'FRONTEND_SORRY_NO_ACTIVE_SECTIONS' => 'Sorry, er is niets om af te beelden',
	'FRONTEND_SORRY_NO_VIEWING_PERMISSIONS' => 'Sorry, u heeft geen bevoegdheden om deze pagina te bekijken',
	'GENERIC_ALREADY_INSTALLED' 		=> 'Is al ge&iuml;nstalleerd',
	'GENERIC_BAD_PERMISSIONS' 			=> 'Kan niet schrijven naar doelmap',
	'GENERIC_CANNOT_UNINSTALL' 			=> 'Kan niet de&iuml;nstalleren',
	'GENERIC_CANNOT_UNINSTALL_IN_USE' 	=> 'Kan niet de&iuml;nstalleren: het geselecteerde bestand is in gebruik',
	'GENERIC_CANNOT_UNINSTALL_IN_USE_TMPL' => '<br /><br />De {{type}} <b>{{type_name}}</b> kan niet verwijderd worden omdat het in gebruik is op {{pages}}:<br /><br />',
	'GENERIC_CANNOT_UNINSTALL_IN_USE_TMPL_PAGES' => 'volgende pagina;volgende pagina\'s',
	'GENERIC_CANNOT_UNINSTALL_IS_DEFAULT_TEMPLATE' => 'De template <b>{{name}}</b> kan niet verwijderd worden omdat het de standaard-template is.',
	'GENERIC_CANNOT_UNZIP' 				=> 'Kan het bestand niet uitpakken',
	'GENERIC_CANNOT_UPLOAD' 			=> 'Kan het bestand niet uploaden',
	'GENERIC_COMPARE' 					=> ' succesvol',
	'GENERIC_ERROR_OPENING_FILE' 		=> 'Kan het bestand niet openen.',
	'GENERIC_FAILED_COMPARE' 			=> ' mislukt',
	'GENERIC_FILE_TYPE' 				=> 'Let op: het bestand moet het volgende formaat hebben:',
	'GENERIC_FILE_TYPES' 				=> 'Let op: de bestanden moeten het volgende formaat hebben:',
	'GENERIC_FILL_IN_ALL' 				=> 'Niet alle velden zijn ingevuld. Probeert u het nog eens',
	'GENERIC_INSTALLED' 				=> 'Installatie voltooid',
	'GENERIC_INVALID' 					=> 'Ongeldig bestand',
	'GENERIC_INVALID_ADDON_FILE' 		=> 'Ongeldig Lepton installatiebestand. Controleer het *.zip bestand.',
	'GENERIC_INVALID_LANGUAGE_FILE' 	=> 'Ongeldig Lepton taalbestand. Controleer het tekstbestand.',
	'GENERIC_IN_USE' 					=> ' gebruikt in ',
	'GENERIC_MODULE_VERSION_ERROR' 		=> 'De module is niet juist ge&iuml;nstalleerd!',
	'GENERIC_NOT_COMPARE' 				=> ' niet mogelijk',
	'GENERIC_NOT_INSTALLED' 			=> 'Niet ge&iuml;nstalleerd',
	'GENERIC_NOT_UPGRADED' 				=> 'Actualisatie niet mogelijk',
	'GENERIC_PLEASE_BE_PATIENT' 		=> 'Even geduld aub, dit kan even duren.',
	'GENERIC_PLEASE_CHECK_BACK_SOON' 	=> 'Probeert u het a.u.b. binnenkort nog eens.',
	'GENERIC_SECURITY_ACCESS'			=> 'Veiligheidsrisico! Toegang geweigerd!',
	'GENERIC_SECURITY_OFFENSE'			=> 'Veiligheidsrisico! Data-opslag geweigerd!',
	'GENERIC_UNINSTALLED' 				=> 'De&iuml;nstallatie voltooid',
	'GENERIC_UPGRADED' 					=> 'Upgrade voltooid',
	'GENERIC_VERSION_COMPARE' 			=> 'Versievergelijking',
	'GENERIC_VERSION_GT' 				=> 'Upgrade noodzakelijk!',
	'GENERIC_VERSION_LT' 				=> 'Downgrade',
	'GENERIC_WEBSITE_UNDER_CONSTRUCTION' => 'Website in bewerking.',
	'GROUPS_ADDED' 						=> 'Groep toegevoegd',
	'GROUPS_CONFIRM_DELETE' 			=> 'Weet u zeker dat u de geselecteerde groep wilt verwijderen (en alle daarbij behorende gebruikers)?',
	'GROUPS_DELETED' 					=> 'Groep verwijderd',
	'GROUPS_GROUP_NAME_BLANK' 			=> 'Groepsnaam is niet ingevuld',
	'GROUPS_GROUP_NAME_EXISTS' 			=> 'Groepnaam is reeds in gebruik',
	'GROUPS_NO_GROUPS_FOUND' 			=> 'Geen groep gevonden',
	'GROUPS_SAVED' 						=> 'Groep opgeslagen',
	'LANG_MISSING_PARTS_NOTICE' 		=> 'Taalbestand installatie mislukt, een (of meer) van de volgende variabelen zijn niet aanwezig:<br />language_code<br />language_name<br />language_version<br />language_license',
	'LOGIN_AUTHENTICATION_FAILED' 		=> 'Gebruikersnaam en/of wachtwoord incorrect',
	'LOGIN_BOTH_BLANK' 					=> 'Vul uw gebruikersnaam en wachtwoord in:',
	'LOGIN_PASSWORD_BLANK' 				=> 'Vul uw wachtwoord in',
	'LOGIN_PASSWORD_TOO_LONG' 			=> 'Dit wachtwoord is te lang',
	'LOGIN_PASSWORD_TOO_SHORT' 			=> 'Dit wachtwoord is te kort',
	'LOGIN_USERNAME_BLANK' 				=> 'Vul uw gebruikersnaam in',
	'LOGIN_USERNAME_TOO_LONG' 			=> 'Deze gebruikersnaam is te lang',
	'LOGIN_USERNAME_TOO_SHORT' 			=> 'Deze gebruikersnaam is te kort',
	'MEDIA_BLANK_EXTENSION' 			=> 'U heeft geen bestandsextensie opgegeven',
	'MEDIA_BLANK_NAME' 					=> 'U heeft geen nieuwe naam opgegeven',
	'MEDIA_CANNOT_DELETE_DIR' 			=> 'Kan geselecteerde map niet verwijderen',
	'MEDIA_CANNOT_DELETE_FILE' 			=> 'Kan geselecteerde bestand niet verwijderen',
	'MEDIA_CANNOT_RENAME' 				=> 'Hernoemen niet gelukt',
	'MEDIA_CONFIRM_DELETE' 				=> 'Weet u zeker dat u het volgende bestand of map wilt verwijderen?',
	'MEDIA_CONFIRM_DELETE_FILE'			=> 'Weet u zeker dat u het volgende bestand wilt verwijderen {name}?',
	'MEDIA_CONFIRM_DELETE_DIR'			=> 'Weet u zeker dat u de volgende map wilt verwijderen {name}?',
	'MEDIA_DELETED_DIR' 				=> 'Map verwijderd',
	'MEDIA_DELETED_FILE' 				=> 'Bestand verwijderd',
	'MEDIA_DIR_ACCESS_DENIED' 			=> 'Map bestaat niet of toegang geweigerd.',
	'MEDIA_DIR_DOES_NOT_EXIST' 			=> 'Map bestaat niet',
	'MEDIA_DIR_DOT_DOT_SLASH' 			=> 'Gebruik van ../ in de mapnaam is niet toegestaan',
	'MEDIA_DIR_EXISTS' 					=> 'Opgegeven naam van de map bestaat al',
	'MEDIA_DIR_MADE' 					=> 'Map aangemaakt',
	'MEDIA_DIR_NOT_MADE' 				=> 'Aanmaken map mislukt',
	'MEDIA_FILE_EXISTS' 				=> 'Opgegeven bestandsnaam bestaat al',
	'MEDIA_FILE_NOT_FOUND' 				=> 'Bestand niet gevonden',
	'MEDIA_NAME_DOT_DOT_SLASH' 			=> 'Gebruik van ../ in de naam is niet toegestaan',
	'MEDIA_NAME_INDEX_PHP' 				=> 'index.php als naam is niet toegestaan',
	'MEDIA_NONE_FOUND' 					=> 'Geen mediabestanden gevonden in de huidige map',
	'MEDIA_RENAMED' 					=> 'Hernoemen geslaagd',
	'MEDIA_SINGLE_UPLOADED' 			=> ' geupload',
	'MEDIA_TARGET_DOT_DOT_SLASH' 		=> 'Gebruik van ../ in de map is niet toegestaan',
	'MEDIA_UPLOADED' 					=> ' geupload',
	'MOD_MISSING_PARTS_NOTICE' 			=> 'De installatie van de module "%s" is mislukt, een (of meer) van de volgende variabelen zijn niet aanwezig: <br />module_directory<br />module_name<br />module_version<br />module_author<br />module_license<br />module_guid<br />module_function',
	'MOD_FORM_EXCESS_SUBMISSIONS' 		=> 'Dit formulier is te vaak verstuurd binnen dit uur. Probeert u het over een uur nog eens.',
	'MOD_FORM_INCORRECT_CAPTCHA' 		=> 'Het verificatienummer (ook wel Captcha genoemd) dat u hebt ingevoerd is incorrect. Als u de Captcha niet goed kunt lezen, stuur dan een e-mail naar: <a href="mailto:'.SERVER_EMAIL.'">'.SERVER_EMAIL.'</a>',
	'MOD_FORM_REQUIRED_FIELDS' 			=> 'De volgende velden zijn verplicht',
	'PAGES_ADDED' 						=> 'Pagina toegevoegd',
	'PAGES_ADDED_HEADING' 				=> 'Paginatitel opgeslagen',
	'PAGES_BLANK_MENU_TITLE' 			=> 'Vul a.u.b. een menutitel in',
	'PAGES_BLANK_PAGE_TITLE' 			=> 'Vul a.u.b. een paginatitel in',
	'PAGES_CANNOT_CREATE_ACCESS_FILE' 	=> 'Kan geen bestanden opslaan in de pages-map (page) (onvoldoende rechten)',
	'PAGES_CANNOT_DELETE_ACCESS_FILE' 	=> 'Kan geen bestanden verwijderen uit de pages-map (page) (onvoldoende rechten)',
	'PAGES_CANNOT_REORDER' 				=> 'Fout bij herordenen pagina',
	'PAGES_DELETED' 					=> 'Pagina verwijderd',
	'PAGES_DELETE_CONFIRM' 				=> 'Weet u zeker dat u deze pagina &laquo;%s&raquo; wilt verwijderen (en al zijn subpagina&rsquo;s)',
	'PAGES_INSUFFICIENT_PERMISSIONS' 	=> 'U heeft niet de rechten om deze pagina aan te passen',
	'PAGES_INTRO_EMPTY' 		=> 'Please insert content, an empty intro page cannot be saved.',
	'PAGES_INTRO_LINK' 					=> 'Klik hier om de introductiepagina aan te passen',
	'PAGES_INTRO_NOT_WRITABLE' 			=> 'Kan instellingen niet opslaan in het bestand pages-map (page)/intro.php (onvoldoende rechten)',
	'PAGES_INTRO_SAVED' 				=> 'Introductiepagina opgeslagen',
	'PAGES_LAST_MODIFIED' 				=> 'Als laatste aangepast door',
	'PAGES_NOT_FOUND' 					=> 'Pagina niet gevonden',
	'PAGES_NOT_SAVED' 					=> 'Fout tijdens opslaan pagina',
	'PAGES_PAGE_EXISTS' 				=> 'Een pagina met dezelfde naam bestaat al',
	'PAGES_REORDERED' 					=> 'Pagina herordend',
	'PAGES_RESTORED' 					=> 'Pagina teruggehaald',
	'PAGES_RETURN_TO_PAGES' 			=> 'Keer terug naar pagina&rsquo;s',
	'PAGES_SAVED' 						=> 'Pagina opgeslagen',
	'PAGES_SAVED_SETTINGS' 				=> 'Pagina-instellingen opgeslagen',
	'PAGES_SECTIONS_PROPERTIES_SAVED' 	=> 'Sectie-instellingen opgeslagen',
	'PREFERENCES_CURRENT_PASSWORD_INCORRECT' => 'Het (huidige) ingevoerde wachtwoord is niet correct',
	'PREFERENCES_DETAILS_SAVED' 		=> 'Details opgeslagen',
	'PREFERENCES_EMAIL_UPDATED' 		=> 'E-mail gewijzigd',
	'PREFERENCES_INVALID_CHARS' 		=> 'Ongeldige wachtwoordtekens gebruikt, geldige tekens: a-z\A-Z\0-9\_\-\!\#\*\+',
	'PREFERENCES_PASSWORD_CHANGED' 		=> 'Wachtwoord gewijzigd',
	'RECORD_MODIFIED_FAILED' 			=> 'De aanpassing is mislukt.',
	'RECORD_MODIFIED_SAVED' 			=> 'De aanpassing is opgeslagen.',
	'RECORD_NEW_FAILED' 				=> 'De toevoeging is mislukt.',
	'RECORD_NEW_SAVED' 					=> 'De toevoeging is opgeslagen.',
	'SETTINGS_MODE_SWITCH_WARNING' 		=> 'Opgelet: sla eerst de wijzigingen op die u eventueel zojuist heeft aangebracht!',
	'SETTINGS_SAVED' 					=> 'Instellingen opgeslagen',
	'SETTINGS_UNABLE_OPEN_CONFIG' 		=> 'Het configuratiebestand kan niet worden geopend',
	'SETTINGS_UNABLE_WRITE_CONFIG' 		=> 'Het configuratiebestand kan niet worden opgeslagen',
	'SETTINGS_WORLD_WRITEABLE_WARNING' 	=> 'Opgelet: dit is alleen bedoeld voor testdoeleinden!',
	'SIGNUP2_ADMIN_INFO' 	=> '
Een nieuwe gebruiker heeft zich aangemeld.

Gebruikersnaam: {LOGIN_NAME}
Gebruiker ID: {LOGIN_ID}
E-mailadres: {LOGIN_EMAIL}
IP-adres: {LOGIN_IP}
Registratiedatum: {SIGNUP_DATE}
----------------------------------------
Dit bericht is automatisch aangemaakt!

',
	'SIGNUP2_BODY_LOGIN_FORGOT' => '
Beste {LOGIN_DISPLAY_NAME},

deze mail is aan u verzonden omdat u de \'wachtwoord vergeten\' functie heeft gebruikt.

Uw nieuwe \'{LOGIN_WEBSITE_TITLE}\' inloggegevens zijn:

Gebruikersnaam: {LOGIN_NAME}
Wachtwoord: {LOGIN_PASSWORD}

Let op: dit is een automatisch aangemaakt nieuw wachtwoord. Uw oude wachtwoord is niet meer geldig!
Heeft u vragen of opmerkingen, neem dan contact op met de websitebeheerder.

Het is aan te raden om uw browser-cache te legen voordat u het nieuwe wachtwoord gebruikt.

Vriendelijke groet

------------------------------------
Dit bericht is automatisch aangemaakt!

',
	'SIGNUP2_BODY_LOGIN_INFO' => '
Beste {LOGIN_DISPLAY_NAME},

Welkom bij \'{LOGIN_WEBSITE_TITLE}\'.

Uw \'{LOGIN_WEBSITE_TITLE}\' inloggegevens zijn:
Gebruikersnaam: {LOGIN_NAME}
Wachtwoord: {LOGIN_PASSWORD}

Vriendelijke groet

-------------------------------------
Dit bericht is automatisch aangemaakt!
',


	'SIGNUP2_SUBJECT_LOGIN_INFO' 		=> 'Uw inloggegevens...',
	'SIGNUP_NO_EMAIL' 					=> 'U moet een e-mailadres invullen',
	'START_CURRENT_USER' 				=> 'U bent ingelogd als',
	'START_INSTALL_DIR_EXISTS' 			=> 'Waarschuwing, de installatiemap bestaat nog steeds. U dient deze te verwijderen om veiligheidsrisico&rsquo;s te vermijden!',
	'START_WELCOME_MESSAGE' 			=> 'Welkom bij het websitebeheer',
	'SYSTEM_FUNCTION_DEPRECATED'		=> 'De functie <b>%s</b> bestaat niet meer, gebruik hiervoor de volgende functie: <b>%s</b> !',
	'SYSTEM_FUNCTION_NO_LONGER_SUPPORTED' => 'De functie <b>%s</b> is verouderd en wordt niet langer ondersteund!',
	'SYSTEM_SETTING_NO_LONGER_SUPPORTED' => 'De instelling <b>%s</b> wordt niet langer ondersteund en zal worden genegeerd!',
	'TEMPLATES_CHANGE_TEMPLATE_NOTICE' 	=> 'Attentie: om de template aan te passen moet u naar de instellingensectie',
	'TEMPLATES_MISSING_PARTS_NOTICE' 	=> 'De installatie van de template is mislukt, een (of meer) van de volgende variabelen zijn niet aanwezig: <br />template_directory<br />template_name<br />template_version<br />template_author<br />template_license<br />template_guid<br />template_function ("theme" oder "template")',
	'USERS_ADDED' 						=> 'Gebruiker toegevoegd',
	'USERS_CANT_SELFDELETE' 			=> 'Functie geweigerd. U kunt zichzelf niet verwijderen!',
	'USERS_CHANGING_PASSWORD' 			=> 'Attentie: vul alleen de bovenstaande velden in wanneer u het wachtwoord van de gebruiker wilt veranderen',
	'USERS_CONFIRM_DELETE' 				=> 'Weet u zeker dat u de geselecteerde gebruiker wilt verwijderen?',
	'USERS_DELETED' 					=> 'Gebruiker verwijderd',
	'USERS_EMAIL_TAKEN' 				=> 'Het ingevoerde e-mailadres is al in gebruik',
	'USERS_INVALID_EMAIL' 				=> 'Het ingevoerde e-mailadres is niet correct',
	'USERS_NAME_INVALID_CHARS' 			=> 'Ongeldige tekens voor de gebruikersnaam ingevoerd',
	'USERS_NO_GROUP' 					=> 'Geen groep geselecteerd',
	'USERS_PASSWORD_MISMATCH' 			=> 'De ingevoerde wachtwoorden komen niet overeen',
	'USERS_PASSWORD_TOO_SHORT' 			=> 'Het ingevoerde wachtwoord is te kort',
	'USERS_SAVED' 						=> 'Gebruiker opgeslagen',
	'USERS_USERNAME_TAKEN' 				=> 'De ingevoerde gebruikersnaam is al in gebruik',
	'USERS_USERNAME_TOO_SHORT' 			=> 'De ingevoerde  gebruikersnaam is te kort'
); // $MESSAGE

$OVERVIEW = array(
	'ADMINTOOLS' 			=> 'Diverse extra beheerinstellingen.',
	'GROUPS' 				=> 'Beheren van de gebruikersgroepen en hun rechten.',
	'HELP' 					=> 'Uitgebreide hulp voor het gebruik van dit systeem.',
	'LANGUAGES' 			=> 'Beheren van de aanwezige taalbestanden.',
	'MEDIA' 				=> 'Beheren van bestanden in de Media-map.',
	'MODULES' 				=> 'Beheren van modules die extra functies toevoegen aan uw site.',
	'PAGES' 				=> 'Aanmaken en beheren van de sitestructuur en pagina&rsquo;s.',
	'PREFERENCES' 			=> 'Beheren van uw persoonlijk profiel. ',
	'SETTINGS' 				=> 'Beheren van de technische website-instellingen.',
	'START' 				=> 'Websitebeheer',
	'TEMPLATES' 			=> 'Beheren van de templates die u kunt toepassen.',
	'USERS' 				=> 'Beheren van de gebruikers van uw website.',
	'VIEW' 					=> 'Bekijk uw website zoals deze voor bezoekers te zien is (in een nieuw venster).'
);

/*
 * Create the old languages definitions only if specified in settings
 */
if (ENABLE_OLD_LANGUAGE_DEFINITIONS) {
	foreach ($MESSAGE as $key => $value) {
		$x = strpos($key, '_');
		$MESSAGE[substr($key, 0, $x)][substr($key, $x+1)] = $value;
	}
}
?>