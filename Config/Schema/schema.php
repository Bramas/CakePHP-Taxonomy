<?php 
/* generated on: 2012-02-16 14:52:44 : 1329403964 */
class TaxonomySchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $term_relationships = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'ref' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'ref_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index', 'collate' => NULL, 'comment' => ''),
		'term_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 20, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ref_id_ref_term_id' => array('column' => array('ref_id', 'ref', 'term_id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	public $terms = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'type' => array('column' => 'type', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
}
