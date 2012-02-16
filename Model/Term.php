<?php
class Term extends AppModel{
	
	public $recursive = -1; 
	public $hasMany = array('TermR' => array(
		'className' => 'Taxonomy.TermR',
		'dependent' => true
	)); 

	public function afterFind($data){
		foreach($data as $k=>$v){
			if(isset($v['Term']['name_'.Configure::read('Config.language')])){
				$data[$k]['Term']['name'] = $v['Term']['name_'.Configure::read('Config.language')];
			}
		}
		return $data; 
	}

}