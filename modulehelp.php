<?php
/**
* Modulehelp page
*
* @copyright	(c) by René Sato
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		佐藤レネー René Sato <rene.sato@gmx.de>
* @package		wadoku
* @version		$Id$
*/

include_once "header.php";

$xoopsOption["template_main"] = "wadoku_modulehelp.html";
include_once ICMS_ROOT_PATH . "/header.php";

$wadoku_modulehelp_handler = icms_getModuleHandler("modulehelp", basename(dirname(__FILE__)), "wadoku");

/** Use a naming convention that indicates the source of the content of the variable */
$clean_modulehelp_id = isset($_GET["modulehelp_id"]) ? (int)$_GET["modulehelp_id"] : 0 ;
$modulehelpObj = $wadoku_modulehelp_handler->get($clean_modulehelp_id);

if ($modulehelpObj && !$modulehelpObj->isNew()) {
	$icmsTpl->assign("wadoku_modulehelp", $modulehelpObj->toArray());
} else {
	$icmsTpl->assign("wadoku_title", _MD_WADOKU_ALL_MODULEHELPS);

	$objectTable = new icms_ipf_view_Table($wadoku_modulehelp_handler, FALSE, array());
	$objectTable->isForUserSide();
	$objectTable->addColumn(new icms_ipf_view_Column("help_misc_field"));
	$icmsTpl->assign("wadoku_modulehelp_table", $objectTable->fetch());
}

$icmsTpl->assign("wadoku_module_home", '<a href="' . ICMS_URL . "/modules/" . icms::$module->getVar("dirname") . '/">' . icms::$module->getVar("name") . "</a>");

include_once "footer.php";