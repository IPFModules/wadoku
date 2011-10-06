<?php
/**
 * Admin page to manage modulehelps
 *
 * List, add, edit and delete modulehelp objects
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

/**
 * Edit a Modulehelp
 *
 * @param int $modulehelp_id Modulehelpid to be edited
*/
function editmodulehelp($modulehelp_id = 0) {
	global $wadoku_modulehelp_handler, $icmsModule, $icmsAdminTpl;

	$modulehelpObj = $wadoku_modulehelp_handler->get($modulehelp_id);

	if (!$modulehelpObj->isNew()){
		$icmsModule->displayAdminMenu(1, _AM_WADOKU_MODULEHELPS . " > " . _CO_ICMS_EDITING);
		$sform = $modulehelpObj->getForm(_AM_WADOKU_MODULEHELP_EDIT, "addmodulehelp");
		$sform->assign($icmsAdminTpl);
	} else {
		$icmsModule->displayAdminMenu(1, _AM_WADOKU_MODULEHELPS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $modulehelpObj->getForm(_AM_WADOKU_MODULEHELP_CREATE, "addmodulehelp");
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display("db:wadoku_admin_modulehelp.html");
}

include_once "admin_header.php";

$wadoku_modulehelp_handler = icms_getModuleHandler("modulehelp", basename(dirname(dirname(__FILE__))), "wadoku");
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = "";
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ("mod", "changedField", "addmodulehelp", "del", "view", "");

if (isset($_GET["op"])) $clean_op = htmlentities($_GET["op"]);
if (isset($_POST["op"])) $clean_op = htmlentities($_POST["op"]);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_modulehelp_id = isset($_GET["modulehelp_id"]) ? (int)$_GET["modulehelp_id"] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
*/
if (in_array($clean_op, $valid_op, TRUE)) {
	switch ($clean_op) {
		case "mod":
		case "changedField":
			icms_cp_header();
			editmodulehelp($clean_modulehelp_id);
			break;

		case "addmodulehelp":
			$controller = new icms_ipf_Controller($wadoku_modulehelp_handler);
			$controller->storeFromDefaultForm(_AM_WADOKU_MODULEHELP_CREATED, _AM_WADOKU_MODULEHELP_MODIFIED);
			break;

		case "del":
			$controller = new icms_ipf_Controller($wadoku_modulehelp_handler);
			$controller->handleObjectDeletion();
			break;

		case "view" :
			$modulehelpObj = $wadoku_modulehelp_handler->get($clean_modulehelp_id);
			icms_cp_header();
			$modulehelpObj->displaySingleObject();
			break;

		default:
			icms_cp_header();
			$icmsModule->displayAdminMenu(1, _AM_WADOKU_MODULEHELPS);
			$objectTable = new icms_ipf_view_Table($wadoku_modulehelp_handler);
			$objectTable->addColumn(new icms_ipf_view_Column("help_misc_field"));
			$objectTable->addIntroButton("addmodulehelp", "modulehelp.php?op=mod", _AM_WADOKU_MODULEHELP_CREATE);
			$icmsAdminTpl->assign("wadoku_modulehelp_table", $objectTable->fetch());
			$icmsAdminTpl->display("db:wadoku_admin_modulehelp.html");
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */