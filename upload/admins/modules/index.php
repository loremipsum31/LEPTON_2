<?php

/**
 * This file is part of LEPTON Core, released under the GNU GPL
 * Please see LICENSE and COPYING files in your package for details, specially for terms and warranties.
 * 
 * NOTICE:LEPTON CMS Package has several different licenses.
 * Please see the individual license in the header of each single file or info.php of modules and templates.
 *
 * @author          Website Baker Project, LEPTON Project
 * @copyright       2004-2010 Website Baker Project
 * @copyright       2010-2015 LEPTON Project
 * @link            http://www.LEPTON-cms.org
 * @license         http://www.gnu.org/licenses/gpl.html
 * @license_terms   please see LICENSE and COPYING files in your package
 *
 */

// include class.secure.php to protect this file and the whole CMS!
if (defined('LEPTON_PATH')) {	
	include(LEPTON_PATH.'/framework/class.secure.php'); 
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

require_once(LEPTON_PATH.'/framework/class.admin.php');
$admin = new admin('Addons', 'modules');

// Setup template object
$template = new Template(THEME_PATH.'/templates');
$template->set_file('page', 'modules.htt');
$template->set_block('page', 'main_block', 'main');

// Insert values into module list
$template->set_block('main_block', 'module_list_block', 'module_list');

$all_modules = array();
$database->execute_query(
	"SELECT * FROM ".TABLE_PREFIX."addons WHERE type = 'module' order by name",
	true,
	$all_modules
);

foreach($all_modules as $addon) {
	$template->set_var('VALUE', $addon['directory']);
	$template->set_var('NAME', $addon['name']);
	$template->parse('module_list', 'module_list_block', true);
}
// fill the uninstall select
$template->set_block('main_block', 'module_list_block_uninstall', 'module_list_uninstall');
foreach($all_modules as $addon) {
	
	// looking for the info.php and for the $module_delete value.
	if (isset($module_delete)) unset($module_delete);
	
	// test for existing info.php
	$temp_filename = LEPTON_PATH."/modules/".$addon['directory']."/info.php";
	if (!file_exists($temp_filename)) {
		$database->query("DELETE FROM `".TABLE_PREFIX."addons` WHERE `addon_id`='".$addon['addon_id']."'");
		continue;
	}
	
	require_once( LEPTON_PATH."/modules/".$addon['directory']."/info.php" );
	if (isset($module_delete)) {
		if ( false === $module_delete ) continue;
	}
	
	$template->set_var('VALUE', $addon['directory']);
	$template->set_var('NAME', $addon['name']);
	$template->parse('module_list_uninstall', 'module_list_block_uninstall', true);
}

// Insert modules which includes a install.php file to install list
$module_files = glob(LEPTON_PATH . '/modules/*');
$template->set_block('main_block', 'install_list_block', 'install_list');
$template->set_block('main_block', 'upgrade_list_block', 'upgrade_list');
$template->set_var(array('INSTALL_VISIBLE' => 'hide', 'UPGRADE_VISIBLE' => 'hide', 'UNINSTALL_VISIBLE' => 'hide'));

$show_block = false;
foreach ($module_files as $index => $path) {
	if (is_dir($path)) {
		$temp_name = basename($path);
		if (file_exists($path . '/install.php')) {
			$show_block = true;
			$template->set_var('INSTALL_VISIBLE', '');
			$template->set_var('VALUE', $temp_name);
			$template->set_var('NAME', $temp_name);
			$template->parse('install_list', 'install_list_block', true);
		}

		if (file_exists($path . '/upgrade.php')) {
			$show_block = true;
			$template->set_var('UPGRADE_VISIBLE', '');
			$template->set_var('VALUE', $temp_name);
			$template->set_var('NAME', $temp_name);
			$template->parse('upgrade_list', 'upgrade_list_block', true);
		} 
		
	} else {
		unset($module_files[$index]);
	}
}

// Insert permissions values
if($admin->get_permission('modules_install') != true) {
	$template->set_var('DISPLAY_INSTALL', 'hide');
}
if($admin->get_permission('modules_uninstall') != true) {
	$template->set_var('DISPLAY_UNINSTALL', 'hide');
}
if($admin->get_permission('modules_view') != true) {
	$template->set_var('DISPLAY_LIST', 'hide');
}
// only show block if there is something to show
if(!$show_block || count($module_files) == 0 || !isset($_GET['advanced']) || $admin->get_permission('admintools') != true) {
	$template->set_var('DISPLAY_MANUAL_INSTALL', 'hide');
}

// Insert language headings
$template->set_var(array(
		'HEADING_INSTALL_MODULE' => $HEADING['INSTALL_MODULE'],
		'HEADING_UNINSTALL_MODULE' => $HEADING['UNINSTALL_MODULE'],
		'HEADING_MODULE_DETAILS' => $HEADING['MODULE_DETAILS'],
		'HEADING_INVOKE_MODULE_FILES' => $HEADING['INVOKE_MODULE_FILES']
) );

// insert urls
$template->set_var(array(
		'ADMIN_URL' => ADMIN_URL,
		'LEPTON_URL' => LEPTON_URL,
		'LEPTON_PATH' => LEPTON_PATH,
		'THEME_URL' => THEME_URL
) );

// Insert language text and messages
$template->set_var(array(
	'URL_TEMPLATES' => $admin->get_permission('templates') ?
		'<a class="button" href="' . ADMIN_URL . '/templates/index.php">' . $MENU['TEMPLATES'] . '</a>' : '',
	'URL_LANGUAGES' => $admin->get_permission('languages') ? 
		'<a class="button" href="' . ADMIN_URL . '/languages/index.php">' . $MENU['LANGUAGES'] . '</a>' : '',
	'URL_ADVANCED' => $admin->get_permission('admintools') ? 
		'<a class="button" href="' . ADMIN_URL . '/modules/index.php?advanced">' . $TEXT['ADVANCED'] . '</a>' : '',
	'TEXT_INSTALL' => $TEXT['INSTALL'],
	'TEXT_UNINSTALL' => $TEXT['UNINSTALL'],
	'TEXT_VIEW_DETAILS' => $TEXT['VIEW_DETAILS'],
	'TEXT_PLEASE_SELECT' => $TEXT['PLEASE_SELECT'],
	'TEXT_MANUAL_INSTALLATION' => $MESSAGE['ADDON_MANUAL_INSTALLATION'],
	'TEXT_MANUAL_INSTALLATION_WARNING' => $MESSAGE['ADDON_MANUAL_INSTALLATION_WARNING'],
	'TEXT_EXECUTE' => $TEXT['EXECUTE'],
	'TEXT_FILE' => $TEXT['FILE']
));

// Parse template object
$template->parse('main', 'main_block', false);
$template->pparse('output', 'page');

// Print admin footer
$admin->print_footer();

?>