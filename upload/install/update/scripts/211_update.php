<?php

/**
 * This file is part of LEPTON Core, released under the GNU GPL
 * Please see LICENSE and COPYING files in your package for details, specially for terms and warranties.
 *
 * NOTICE:LEPTON CMS Package has several different licenses.
 * Please see the individual license in the header of each single file or info.php of modules and templates.
 *
 * @author          LEPTON Project
 * @copyright       2010-2015 LEPTON Project
 * @link            http://www.LEPTON-cms.org
 * @license         http://www.gnu.org/licenses/gpl.html
 * @license_terms   please see LICENSE and COPYING files in your package
 */

// set error level
 ini_set('display_errors', 1);
 error_reporting(E_ALL|E_STRICT);

echo '<h3>Current process : updating to LEPTON 2.1.1</h3>';

/**
 *  database modifications
 */



/**
 *  install new modules
 *
 */
if (!function_exists('load_module')) require_once( LEPTON_PATH."/framework/summary.functions.php");

$install = array (
"/modules/miniform"
);

// install new modules
foreach ($install as $module)
{
    $temp_path = LEPTON_PATH . $module ;

require ($temp_path.'/info.php');
load_module( $temp_path, true );

foreach(
array(
'module_license', 'module_author'  , 'module_name', 'module_directory',
'module_version', 'module_function', 'module_description',
'module_platform', 'module_guid'
) as $varname )
{
if (isset(  ${$varname} ) ) unset( ${$varname} );
}
}
echo "<h3>install new modules: successfull</h3>"; 
 
/**
 *  run upgrade.php of all modified modules
 *
 */
$upgrade_modules = array(
    "lib_semantic"
		

);

foreach ($upgrade_modules as $module)
{
    $temp_path = LEPTON_PATH . "/modules/" . $module . "/upgrade.php";

    if (file_exists($temp_path))
        require($temp_path);
}
echo "<h3>run upgrade.php of modified modules: successfull</h3>";


// at last: set db to current release-no
$database->query('UPDATE `' . TABLE_PREFIX . 'settings` SET `value` =\'2.1.1\' WHERE `name` =\'lepton_version\'');


/**
 *  success message
 */
echo "<h3>update to LEPTON 2.1.1 successfull!</h3><br />"; 

?>
