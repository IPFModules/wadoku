<?php
/**
* Japaneseword page
*
* @copyright	(c) by René Sato
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		佐藤レネー René Sato <rene.sato@gmx.de>
* @package		wadoku
* @version		$Id$
*/

include_once "header.php";

$xoopsOption["template_main"] = "wadoku_japaneseword.html";
include_once ICMS_ROOT_PATH . "/header.php";

$wadoku_japaneseword_handler = icms_getModuleHandler("japaneseword", basename(dirname(__FILE__)), "wadoku");

/** Use a naming convention that indicates the source of the content of the variable */
$clean_japaneseword_id = isset($_GET["japaneseword_id"]) ? (int)$_GET["japaneseword_id"] : 0 ;
$japanesewordObj = $wadoku_japaneseword_handler->get($clean_japaneseword_id);

if($japanesewordObj && !$japanesewordObj->isNew()) {
	$icmsTpl->assign("wadoku_japaneseword", $japanesewordObj->toArray());

	$icms_metagen = new icms_ipf_Metagen($japanesewordObj->getVar("midashi_go_field"), $japanesewordObj->getVar("meta_keywords", "n"), $japanesewordObj->getVar("meta_description", "n"));
	$icms_metagen->createMetaTags();
} else {
	$icmsTpl->assign("wadoku_title", _MD_WADOKU_ALL_JAPANESEWORDS);

	$objectTable = new icms_ipf_view_Table($wadoku_japaneseword_handler, FALSE, array());
	$objectTable->isForUserSide();
	$objectTable->addColumn(new icms_ipf_view_Column("midashi_go_field"));
	$objectTable->addColumn(new icms_ipf_view_Column("hiragana_field"));
	$objectTable->addColumn(new icms_ipf_view_Column("translation_field"));
	$objectTable->addQuickSearch(array('midashi_go_field', 'hiragana_field', 'romaji_field', 'translation_field'));
	$icmsTpl->assign("wadoku_japaneseword_table", $objectTable->fetch());
}

$icmsTpl->assign("wadoku_module_home", '<a href="' . ICMS_URL . "/modules/" . icms::$module->getVar("dirname") . '/">' . icms::$module->getVar("name") . "</a>");

include_once "footer.php";