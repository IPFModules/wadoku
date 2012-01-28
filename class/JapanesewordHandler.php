<?php
/**
 * Classes responsible for managing wadoku japaneseword objects
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_wadoku_JapanesewordHandler extends icms_ipf_Handler {
	/**
	 * Constructor
	 *
	 * @param icms_db_legacy_Database $db database connection object
	 */
	public function __construct(&$db) {
		parent::__construct($db, "japaneseword", "japaneseword_id", "midashi_go_field", "romaji_field", "wadoku");

	}
	
	/** Provides global search functionality for Wadoku module
	*
	*/
	public function getJapanesewordsForSearch($queryarray, $andor, $limit, $offset, $userid) {
		$criteria = new CriteriaCompo();
		$criteria->setStart($offset);
		$criteria->setLimit($limit);
		$criteria->setSort('word_date_field');
		$criteria->setOrder('DESC');

		if ($userid != 0) {
			$criteria->add(new Criteria('submitter', $userid));
		}
		if ($queryarray) {
			$criteriaKeywords = new CriteriaCompo();
			for ($i = 0; $i < count($queryarray); $i++) {
				$criteriaKeyword = new CriteriaCompo();
				$criteriaKeyword->add(new Criteria('midashi_go_field', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
				$criteriaKeyword->add(new Criteria('hiragana_field', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
				$criteriaKeyword->add(new Criteria('romaji_field', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
				$criteriaKeyword->add(new Criteria('translation_field', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
				
				$criteriaKeywords->add($criteriaKeyword, $andor);
				unset ($criteriaKeyword);
			}
			$criteria->add($criteriaKeywords);
		}
		return $this->getObjects($criteria, true, false);
	}
	
	/**
	* Switches an items status from online to offline or vice versa
	*
	* @return null
	*/
	public function changeVisible($japaneseword_id) {
		$visibility = '';
		$japanesewordObj = $this->get($japaneseword_id);
		if ($japanesewordObj->getVar('online_status', 'e') == true) {
			$japanesewordObj->setVar('online_status', 0);
			$visibility = 0;
		} else {
			$japanesewordObj->setVar('online_status', 1);
			$visibility = 1;
		}
			$this->insert($japanesewordObj, true);
		return $visibility;
	
	}
	
	/**
	* Converts status value to human readable text
	*
	* @return array
	*/
	public function online_status_filter() {
	return array(0 => 'Offline', 1 => 'Online');
		}
		
	public function updateComments($japaneseword_id, $total_num) {
		$japanesewordObj = $this->get($japaneseword_id);
		if ($japanesewordObj && !$japanesewordObj->isNew()) {
			$japanesewordObj->setVar('japaneseword_comments', $total_num);
			$this->insert($japanesewordObj, true);
		}
	}
	
	
	//counter
	public function updateCounter($japaneseword_id) {
		global $wadoku_isAdmin;
			$japanesewordObj = $this->get($japaneseword_id);
		if (!is_object($japanesewordObj)) return false;
	
		if (isset($japanesewordObj->vars['counter']) && !is_object(icms::$user) || (!$wadoku_isAdmin )) {
			$new_counter = $japanesewordObj->getVar('counter') + 1;
			$sql = 'UPDATE ' . $this->table . ' SET counter=' . $new_counter
				. ' WHERE ' . $this->keyName . '=' . $japanesewordObj->id();
			$this->query($sql, null, true);
		}
		return true;
	}
		
	//notifications
	protected function afterSave(&$obj) {
		global $wadokuConfig;
		if ($obj->updating_counter)
		return true;
		if ($obj->isNew()) {
			$obj->sendWadokuNotification('new_vocabulary');
		} else {
			$obj->sendWadokuNotification('vocabulary_modified');
		}
		return TRUE;
	}
}