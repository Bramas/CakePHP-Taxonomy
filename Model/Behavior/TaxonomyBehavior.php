<?php
class TaxonomyBehavior extends ModelBehavior{

	public function listTerms($model){
		return $model->Term->find('list',array(
			'fields' => array('id',Configure::read('Taxonomy.field'),'type'),
			'conditions' => array('type'=>Configure::read('Taxonomy.checkbox'))
		));
	}


	public function setup($model,$options = array()){
		$model->hasAndBelongsToMany['Term'] = array(
			'className'  => 'Taxonomy.Term',
			'associationForeignKey' => 'term_id',
			'with'      => 'Taxonomy.TermR',
			'foreignKey' => 'ref_id',
			'joinTable'  => 'term_relationships',
			'conditions' => 'ref = "'.$model->name.'"'
		);
	}

	public function afterSave($model){
		if(isset($model->data[$model->name]['terms'])){
			$model->deleteTerms(); 
			$terms = $model->data[$model->name]['terms'];
			foreach($terms as $term_id){
				$model->Term->TermR->create();
				$model->Term->TermR->save(array(
					'term_id' => $term_id,
					'ref'	  => $model->name,
					'ref_id'  => $model->id
				));
			}
		}
	}

	public function afterFind($model,$data){
		foreach($data as $k=>$v){
			if(!empty($v['Term'])){
				$data[$k][$model->name]['terms'] = Set::Combine($v['Term'],'{n}.id','{n}.id');
				$data[$k]['Taxonomy'] = Set::Combine($v['Term'],'{n}.id','{n}','{n}.type');
			}
		}
		return $data;
	}


	public function deleteTerms($model){
		$terms = $model->Term->find('list',array(
			'fields' => array('id','id'),
			'conditions' => array('Term.type'=>Configure::read('Taxonomy.checkbox'))
		));
		$model->Term->TermR->deleteAll(array(
			'ref' => $model->name,
			'ref_id'=>$model->id,
			'term_id' => $terms
		));
	}

	public function addTerm($model,$name,$type){
		$d = array(
			Configure::read('Taxonomy.field') => $name,
			'type' => $type
		);
		$term = $model->Term->find('first',array('conditions' => $d,'fields' => array('id')));
		if(empty($term)){
			$model->Term->create(); 
			$model->Term->save($d); 
			$term_id = $model->Term->id; 
		}else{
			$term_id = $term['Term']['id'];
		}
		$d = array(
			'ref'     => $model->name,
			'ref_id'  => $model->id,
			'term_id' => $term_id
		);
		$count = $model->Term->TermR->find('count',array('conditions'=>$d));
		if($count == 0){
			$model->Term->TermR->create(); 
			$model->Term->TermR->save($d);
		}
		return true;
	}



}