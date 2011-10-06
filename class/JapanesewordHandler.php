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
		parent::__construct($db, "japaneseword", "japaneseword_id", "midashi_go_field", "midashi_go_field", "wadoku");

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
}