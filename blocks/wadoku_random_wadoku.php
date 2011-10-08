<?php
/**
 * Holds the functions for the random wadoku block
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

/**
 * Prepares the random wadoku block for display
 *
 * @param array $options
 * @return string 
 */
function wadoku_random_wadoku_show($options) {
	
	$block = array();
	$display = (int)$options[0];
	$wadoku_japaneseword_handler = icms_getModuleHandler('japaneseword', basename(dirname(dirname(__FILE__))), 'wadoku');
	
	if (!$display) {
		
		// display a random japaneseword
		$wadoku_count = $wadoku_japaneseword_handler->getCount();
		$random = mt_rand(1, $wadoku_count);
		$criteria = icms_buildCriteria(array('online_status' => '1'));
		$criteria->setStart($random -1);
		$criteria->setLimit(1);
		$japanesewordObjArray = $wadoku_japaneseword_handler->getObjects($criteria);
		$japanesewordObj = array_shift($japanesewordObjArray);
		
	} else {
		
	// display a fixed japaneseword
		$japanesewordObj = $wadoku_japaneseword_handler->get($display);
		if ($japanesewordObj->getVar('online_status', 'e') != 1) {
			unset($japanesewordObj);
		}
	}
	
	if ($japanesewordObj) {
		
		$block['midashi_go_field'] = $japanesewordObj->getVar('midashi_go_field');
		$block['hiragana_field'] = $japanesewordObj->getVar('hiragana_field');
		$block['romaji_field'] = $japanesewordObj->getVar('romaji_field');
		$block['translation_field'] = $japanesewordObj->getVar('translation_field');
	}
	
	return $block;
}

/**
 * Edit options for the random wadoku block
 *
 * @param array $options
 * @return string 
 */
function wadoku_random_wadoku_edit($options) {
	
	// display random japaneseword (0) or a fixed japaneseword (enter ID number)
	$form = '<table><tr>';
	$form .= '<tr><td>' . _MB_WADOKU_RANDOM_OR_FIXED_JAPANESEWORD . '</td>';
	$form .= '<td>' . '<input type="text" name="options[]" value="' . $options[0] . '" /></td>';
	$form .= '</tr></table>';
	
	return $form;
}