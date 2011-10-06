<?php
/**
 * wadoku version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

function wadoku_search($queryarray, $andor, $limit, $offset, $userid)
{
	$wadoku_japaneseword_handler = icms_getModuleHandler('japaneseword', basename(dirname(dirname(__FILE__))), 'wadoku');
	$wadokusArray = $wadoku_japaneseword_handler->getJapanesewordsForSearch($queryarray, $andor, $limit, $offset, $userid);

	$ret = array();

	foreach ($wadokusArray as $wadokuArray) {
		$item['image'] = "images/icon_small.png";
		$item['link'] = $wadokuArray['itemUrl'];
		$item['title'] = $wadokuArray['title'];
		$item['time'] = strtotime($wadokuArray['date']);
		$item['uid'] = $wadokuArray['submitter'];
		$ret[] = $item;
		unset($item);
	}
	return $ret;
}