<?php
/**
 * File containing onUpdate and onInstall functions for the module
 *
 * This file is included by the core in order to trigger onInstall or onUpdate functions when needed.
 * Of course, onUpdate function will be triggered when the module is updated, and onInstall when
 * the module is originally installed. The name of this file needs to be defined in the
 * icms_version.php
 *
 * <code>
 * $modversion['onInstall'] = "include/onupdate.inc.php";
 * $modversion['onUpdate'] = "include/onupdate.inc.php";
 * </code>
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

// this needs to be the latest db version
define('WADOKU_DB_VERSION', 1);

/**
 * it is possible to define custom functions which will be call when the module is updating at the
 * correct time in update incrementation. Simpy define a function named <direname_db_upgrade_db_version>
 */
/*
function wadoku_db_upgrade_1() {
}
function wadoku_db_upgrade_2() {
}
*/

function icms_module_update_wadoku($module) {
	/**
	 * Using the IcmsDatabaseUpdater to automaticallly manage the database upgrade dynamically
	 * according to the class defined in the module
	 */
	$icmsDatabaseUpdater = XoopsDatabaseFactory::getDatabaseUpdater();
	$icmsDatabaseUpdater->moduleUpgrade($module);
    return TRUE;
}

function icms_module_install_wadoku($module) {
	global $xoopsDB;
	
	// insert some licenses so that it is ready for use on installation
	$queries = array();
	
	// a generic tag to hold untagged content
	$queries[] = "INSERT into " . $xoopsDB->prefix('wadoku_japaneseword') . " (`japaneseword_id`, `online_status`, `midashi_go_field`, `hiragana_field`, `romaji_field`, `transkription_field`, `translation_field`, `entry_tags_field`, `userid_field`, `word_date_field`, `admin_extra_field`, `counter`, `meta_keywords`, `meta_description`, `short_url`) values 
	(1, 1, '和独', 'わどく', 'WaDoku', 'N.', '[1] Japanisch und Deutsch || (als adnominales Attribut) japanisch-deutsch (z.B. Wörterbuch) || Japan (n) und Deutschland (n). [2] japanisch-deutsches Wörterbuch n. => <Wadoku·jiten> (和独辞典)', '', 5, 1317395400, '', 0, 'わどく', '[1] Japanisch und Deutsch || (als adnominales Attribut) japanisch-deutsch (z.B. Wörterbuch) || Japan (n) und Deutschland (n). [2] japanisch-deutsches Wörterbuch n. => <Wadoku·jiten> (和独辞典)', '和独'),
	(2, 1, '調べる', 'しらべる', 'shiraberu', '1‑st. trans. V. auf <‑e>', 'untersuchen; prüfen; erforschen; ermitteln; nachforschen; durchsehen; nachschlagen; verhören; zensieren.', '', 5, 1317395400, '', 0, 'しらべる', 'untersuchen; prüfen; erforschen; ermitteln; nachforschen; durchsehen; nachschlagen; verhören; zensieren.', '調べる'),
	(3, 1, '払う', 'はらう', 'harau', '5‑st. trans. V. auf ‑[w]a mit Geminaten-Onbin = <‑tte>', '[1] bezahlen; zahlen; begleichen. [2] abwischen; abstauben; abfegen; wegfegen; wegbürsten; ausbürsten. [3] vertreiben; beschwören; besprechen.', '', 5, 1317870000, '', 0, 'はらう', '[1] bezahlen; zahlen; begleichen. [2] abwischen; abstauben; abfegen; wegfegen; wegbürsten; ausbürsten. [3] vertreiben; beschwören; besprechen.', '払う'),
	(4, 1, '届ける', 'とどける', 'todokeru', '1‑st. trans. V. auf <‑e>', '[1] melden; benachrichtigen. [2] senden; liefern; schicken; zuschicken; abgeben.', '', 5, 1317882600, '', 0, 'とどける', '[1] melden; benachrichtigen. [2] senden; liefern; schicken; zuschicken; abgeben.', '届ける'),
	(5, 1, '閉める', 'しめる', 'shimeru', '1‑st. trans. V. auf <‑e>', 'schließen; zuschließen.', '', 5, 1317883200, '', 0, 'しめる', 'schließen; zuschließen.', '閉める'),
	(6, 1, '選ぶ', 'えらぶ', 'erabu', '5‑st. trans. V. auf <‑ba>; mit regelm. Nasal‑Onbin = <‑nde>', '[1] auswählen; auserwählen; auslesen. [2] wählen. [3] lieber mögen; vorziehen. [4] festlegen.', '', 5, 1317883200, '', 0, 'えらぶ', '[1] auswählen; auserwählen; auslesen. [2] wählen. [3] lieber mögen; vorziehen. [4] festlegen.', '選ぶ'),
	(7, 1, '噛む', 'かむ', 'kamu', '5‑st. trans. V. auf <‑ma>; mit regelm. Nasal‑Onbin = <‑nde>', '[1] beißen. [2] kauen; nagen. [3] ugs. stammeln; sich versprechen.', '', 5, 1317883200, '', 0, 'かむ', '[1] beißen. [2] kauen; nagen. [3] ugs. stammeln; sich versprechen.', '噛む'),
	(8, 1, '塗る', 'ぬる', 'nuru', '5‑st. trans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>', '[1] streichen; anstreichen; malen || bewerfen (mit Putz); stuckieren || tünchen; firnissen; glasieren || schminken. [2] die Schuld aufbürden; anschwärzen; in die Schuhe schieben; zur Last legen.', '', 5, 1317883800, '', 0, 'ぬる', '[1] streichen; anstreichen; malen || bewerfen (mit Putz); stuckieren || tünchen; firnissen; glasieren || schminken. [2] die Schuld aufbürden; anschwärzen; in die Schuhe schieben; zur Last legen.', '塗る'),
	(9, 1, '驚く', 'おどろく', 'odoroku', '5‑st. intrans. V. auf <‑ka> mit i‑Onbin = <‑ite>', '[1] erstaunt sein; sich wundern; überrascht sein; erschrecken; einen Schrecken bekommen; bestürzt sein; verwirrt sein; verblüfft sein. [2] beeindruckt sein; bewundern. [3] mit einem Schrecken bemerken. [4] aufwachen.', '', 5, 1317884400, '', 0, 'おどろく', '[1] erstaunt sein; sich wundern; überrascht sein; erschrecken; einen Schrecken bekommen; bestürzt sein; verwirrt sein; verblüfft sein. [2] beeindruckt sein; bewundern. [3] mit einem Schrecken bemerken. [4] aufwachen.', '驚く'),
	(10, 1, '飾る', 'かざる', 'kazaru', '5‑st. trans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>', '[1] schmücken; verzieren; dekorieren; garnieren. [2] sich aufputzen; sich herausputzen; sich ausstaffieren. [3] ausstellen. [4] ausschmücken (z.B. eine Rede).', '', 5, 1317884400, '', 0, 'かざる', '[1] schmücken; verzieren; dekorieren; garnieren. [2] sich aufputzen; sich herausputzen; sich ausstaffieren. [3] ausstellen. [4] ausschmücken (z.B. eine Rede).', '飾る'),
	(11, 1, '眠る', 'ねむる', 'nemuru', '5‑st. intrans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>', '[1] schlafen; schlummern; einschlafen. [2] entschlafen; sterben. [3] ertraglos liegen; nutzlos liegen.', '', 5, 1317885000, '', 0, 'ねむる', '[1] schlafen; schlummern; einschlafen. [2] entschlafen; sterben. [3] ertraglos liegen; nutzlos liegen.', '眠る'),
	(12, 1, '叱る', 'しかる', 'shikaru', '5‑st. trans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>', 'schimpfen; schelten; rügen; zurechtweisen (um den anderen zur besseren Einsicht zu bringen).', '', 5, 1317885000, '', 0, 'しかる', 'schimpfen; schelten; rügen; zurechtweisen (um den anderen zur besseren Einsicht zu bringen).', '叱る'),
	(13, 1, '沸かす', 'わかす', 'wakasu', '5‑st. trans. V. auf <‑sa>', '[1] heiß machen; kochen; zum Kochen bringen; sieden. [2] aufregen; begeistern; erregen.', '', 5, 1317885600, '', 0, 'わかす', '[1] heiß machen; kochen; zum Kochen bringen; sieden. [2] aufregen; begeistern; erregen.', '沸かす'),
	(22, 1, '約束', 'やくそく', 'yakusoku', 'N.; mit <suru> trans. V.', '[1] Versprechen n; Abmachung f; Vertrag m; Bedingung f. [2] Verabredung f; Rendezvous n; Daten. [3] Konvention f; Statuten fpl. [4] Bestimmung f; vorbestimmtes Schicksal n.', '', 5, 1317889800, '', 0, 'やくそく', '[1] Versprechen n; Abmachung f; Vertrag m; Bedingung f. [2] Verabredung f; Rendezvous n; Daten. [3] Konvention f; Statuten fpl. [4] Bestimmung f; vorbestimmtes Schicksal n.', '約束'),
	(14, 1, '冷える', 'ひえる', 'hieru', '1‑st. intrans. V. auf <‑e>', 'kalt werden; erkalten; abkühlen (auch übertr.)', '', 5, 1317885600, '', 0, 'ひえる', 'kalt werden; erkalten; abkühlen (auch übertr.)', '冷える'),
	(15, 1, '下がる', 'さがる', 'sagaru', '5‑st. intrans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>', '[1] herabhängen; herunterhängen. [2] fallen; sinken; sich senken. [3] verlassen; weggehen; sich zurückziehen. [4] zurücktreten; rückwärts gehen. [5] verliehen werden; bewilligt werden; gewährt werden.', '', 5, 1317885600, '', 0, 'さがる', '[1] herabhängen; herunterhängen. [2] fallen; sinken; sich senken. [3] verlassen; weggehen; sich zurückziehen. [4] zurücktreten; rückwärts gehen. [5] verliehen werden; bewilligt werden; gewährt werden.', '下がる'),
	(16, 1, '挙げる', 'あげる', 'ageru', '1‑st. trans. od. intrans. V. auf <‑e>', '[1] heben. [2] geben; anführen; erbringen. [3] (eine Zeremonie) abhalten. [4] gefangen genommen werden; festgenommen werden. [5] gebären.', '', 5, 1317885600, '', 0, 'あげる', '[1] heben. [2] geben; anführen; erbringen. [3] (eine Zeremonie) abhalten. [4] gefangen genommen werden; festgenommen werden. [5] gebären.', '挙げる'),
	(17, 1, '治る', 'なおる', 'naoru', '5‑st. intrans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>', 'genesen; heilen; wieder gesund werden.', '', 5, 1317886200, '', 0, 'なおる', 'genesen; heilen; wieder gesund werden.', '治る'),
	(18, 1, '戻す', 'もどす', 'modosu', '5‑st. trans. V. auf <‑sa>', '[1] zurückgeben; wiedergeben; wiederbringen; zurücksenden; zurücklegen; zurückzahlen. [2] zurückstellen; rückgängig machen; wiederherstellen; zurückfahren. [3] abweisen; zurückweisen. [4] sich übergeben; sich erbrechen.', '', 5, 1317886200, '', 0, 'もどす', '[1] zurückgeben; wiedergeben; wiederbringen; zurücksenden; zurücklegen; zurückzahlen. [2] zurückstellen; rückgängig machen; wiederherstellen; zurückfahren. [3] abweisen; zurückweisen. [4] sich übergeben; sich erbrechen.', '戻す'),
	(19, 1, '暮れる', 'くれる', 'kureru', '1‑st. intrans. V. auf <‑e>', '[1] dämmern; dunkel werden. [2] sich neigen; zu Ende gehen; Nacht werden; Abend werden. [3] ratlos sein.', '', 5, 1317886200, '', 0, 'くれる', '[1] dämmern; dunkel werden. [2] sich neigen; zu Ende gehen; Nacht werden; Abend werden. [3] ratlos sein.', '暮れる'),
	(20, 1, '濡れる', 'ぬれる', 'nureru', '1‑st. intrans. V. auf <‑e>', 'nass werden; durchnässt werden.', '', 5, 1317886200, '', 0, 'ぬれる', 'nass werden; durchnässt werden.', '濡れる'),
	(21, 1, '売り場', 'うりば', 'uriba', 'N.', 'Verkaufsstand m; Verkaufsabteilung f.', '', 5, 1317886800, '', 0, 'うりば', 'Verkaufsstand m; Verkaufsabteilung f.', '売り場'),
	(23, 1, '味', 'あじ', 'aji', 'N.', '[1] Geschmack m; Aroma n; Würze f. [2] guter Geschmack m; gute Küche f. [3] Gefühl n für etw.; Erfahrung f. [4] Geschmack m; Kunstverständnis n.', '', 5, 1318474200, '', 0, 'あじ', '[1] Geschmack m; Aroma n; Würze f. [2] guter Geschmack m; gute Küche f. [3] Gefühl n für etw.; Erfahrung f. [4] Geschmack m; Kunstverständnis n.', '味');
	";
	foreach($queries as $query) {
	$result = $xoopsDB->query($query);
	}
	return TRUE;
}