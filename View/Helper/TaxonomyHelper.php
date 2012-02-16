<?php
class TaxonomyHelper extends AppHelper{

	var $helpers = array('Html','Form');
	var $javascript = false; 

	public function input($type,$options = array()){
		$data = $this->request->data;
		if(empty($data)){
			return false; 
		}
		$ref = key($data);
		$this->javascript($ref,$data[$ref]['id']); 
		$html = ''; 
		if(!empty($data['Taxonomy'][$type])){
			foreach($data['Taxonomy'][$type] as $v){
				$url = Router::url(array('controller'=>'Terms','action'=>'delete','plugin'=>'taxonomy','admin'=>true,$v['TermR']['id']));
				$html .= '<span class="tag">'.$v[Configure::read('Taxonomy.field')].' <a href="'.$url.'" class="delTaxo">x</a></span>';
			}
		}

		$options['id'] = $type;
		$options['class'] = 'addTaxo';
		return $this->Form->input('Taxonomy.'.$type,$options).$html; 
	}

	private function javascript($ref,$ref_id){
		if($this->javascript){ return false; }
		$this->javascript = true; 
		$url = Router::url(array('controller'=>'Terms','action'=>'add','plugin'=>'taxonomy','admin'=>true,$ref,$ref_id));
		$urlList = Router::url(array('controller'=>'Terms','action'=>'search','plugin'=>'taxonomy','admin'=>true));
		$this->Html->scriptStart(array('inline'=>false));?>
		jQuery(function($){
			$('.delTaxo').live('click',function(e){
				var a = $(this);
				$.get(a.attr('href'));
				a.parent().fadeOut(); 
				return false; 
			});
			$('.addTaxo').each(function(){
				var input = $(this);
				var cache = {},lastXhr;
				var type = input.attr('id'); 

				input.autocomplete({
					minLength:2,
					source: function( request, response ) {
						request.type = input.attr('id');
						var term = request.term;
						if ( term in cache ) {
							response( cache[ term ] );
							return;
						}

						lastXhr = $.getJSON( "<?php echo $urlList; ?>", request, function( data, status, xhr ) {
							cache[ term ] = data;
							if ( xhr === lastXhr ) {
								response( data );
							}
						});
					},
					select : function(event, ui){
						$.get('<?php echo $url; ?>',{id:ui.item.id,name:ui.item.label,type:type},function(data){
							input.parent().after(data);
							input.val('');  
						});
					}
				});

				input.keypress(function(e){
					if( e.keyCode == 13){
						var val = input.val(); 
						input.val(''); 
						$.get("<?php echo $url; ?>",{name:val,type:type},function(data){
							input.parent().after(data); 
						});
						return false;
					}
				});
			});
		})
		<?php 
		$this->Html->scriptEnd();
	}

}