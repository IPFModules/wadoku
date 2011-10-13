<?php
/**
 * Admin page to manage japanesewords
 *
 * List, add, edit and delete japaneseword objects
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

/**
 * Edit a Japaneseword
 *
 * @param int $japaneseword_id Japanesewordid to be edited
*/
function editjapaneseword($japaneseword_id = 0) {
	global $wadoku_japaneseword_handler, $icmsModule, $icmsAdminTpl;

	$japanesewordObj = $wadoku_japaneseword_handler->get($japaneseword_id);

	if (!$japanesewordObj->isNew()){
		$icmsModule->displayAdminMenu(0, _AM_WADOKU_JAPANESEWORDS . " > " . _CO_ICMS_EDITING);
		$sform = $japanesewordObj->getForm(_AM_WADOKU_JAPANESEWORD_EDIT, "addjapaneseword");
		$sform->assign($icmsAdminTpl);
	} else {
		$icmsModule->displayAdminMenu(0, _AM_WADOKU_JAPANESEWORDS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $japanesewordObj->getForm(_AM_WADOKU_JAPANESEWORD_CREATE, "addjapaneseword");
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display("db:wadoku_admin_japaneseword.html");
}

include_once "admin_header.php";

$wadoku_japaneseword_handler = icms_getModuleHandler("japaneseword", basename(dirname(dirname(__FILE__))), "wadoku");
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = "";
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ("mod", "changedField", "addjapaneseword", "del", "view", "changeStatus", "");

if (isset($_GET["op"])) $clean_op = htmlentities($_GET["op"]);
if (isset($_POST["op"])) $clean_op = htmlentities($_POST["op"]);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_japaneseword_id = isset($_GET["japaneseword_id"]) ? (int)$_GET["japaneseword_id"] : 0 ;

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
			editjapaneseword($clean_japaneseword_id);
			break;

		case "addjapaneseword":
			$controller = new icms_ipf_Controller($wadoku_japaneseword_handler);
			$controller->storeFromDefaultForm(_AM_WADOKU_JAPANESEWORD_CREATED, _AM_WADOKU_JAPANESEWORD_MODIFIED);
			break;

		case "del":
			$controller = new icms_ipf_Controller($wadoku_japaneseword_handler);
			$controller->handleObjectDeletion();
			break;

		case "view" :
			$japanesewordObj = $wadoku_japaneseword_handler->get($clean_japaneseword_id);
			icms_cp_header();
			$japanesewordObj->displaySingleObject();
			break;
			
		case "changeStatus":
			$status = $ret = '';
			$status = $wadoku_japaneseword_handler->changeOnlineStatus($clean_japaneseword_id, 'online_status');
			$ret = '/modules/' . basename(dirname(dirname(__FILE__))) . '/admin/japaneseword.php';
			if (!$status) {
				redirect_header(ICMS_URL . $ret, 2, _AM_WADOKU_JAPANESEWORD_OFFLINE);
			} else {
				redirect_header(ICMS_URL . $ret, 2, _AM_WADOKU_JAPANESEWORD_ONLINE);
			}
			break;
					
		default:
			icms_cp_header();
			$icmsModule->displayAdminMenu(0, _AM_WADOKU_JAPANESEWORDS);
			$objectTable = new icms_ipf_view_Table($wadoku_japaneseword_handler);
			$objectTable->addColumn(new icms_ipf_view_Column("online_status", "center", TRUE));
			$objectTable->addColumn(new icms_ipf_view_Column("japaneseword_id", "center"));
			$objectTable->addColumn(new icms_ipf_view_Column("midashi_go_field"));
			$objectTable->addColumn(new icms_ipf_view_Column("hiragana_field"));
			$objectTable->addColumn(new icms_ipf_view_Column("romaji_field"));
			//$objectTable->addColumn(new icms_ipf_view_Column("translation_field"));
			$objectTable->addColumn(new icms_ipf_view_Column("counter", "center"));
			$objectTable->addIntroButton("addjapaneseword", "japaneseword.php?op=mod", _AM_WADOKU_JAPANESEWORD_CREATE);
			$objectTable->addQuickSearch(array('midashi_go_field', 'hiragana_field', 'romaji_field', 'translation_field', 'entry_tags_field'));
			$objectTable->setDefaultSort('japaneseword_id');
			$objectTable->setDefaultOrder('DESC');
			$icmsAdminTpl->assign("wadoku_japaneseword_table", $objectTable->fetch());
			$icmsAdminTpl->display("db:wadoku_admin_japaneseword.html");
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */