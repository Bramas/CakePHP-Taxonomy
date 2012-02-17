Taxonomy Plugin for CakePHP 2.0 Beta
============================================================


Installation
-------------------------------------------------------
Copy this plugin in a directory called "Taxonomy" inside of your plugin directory
You can now load the plugin in your bootstrap.php using

    CakePlugin::load('Taxonomy',array('bootstrap'=>true));

After you have to create the two tables (terms and term_relationships)
You can create theses tables easily using the CakePHP Console :

	cake Taxonomy.create

The behavior
-------------------------------------------------------
Now the plugin is ready to use you have a "Term" model that you can use to store your taxonomy. If you want to add a Taxonomy to your model just add 
the "Taxonomy.Taxonomy" behavior.

You can now add a "term" to your model using

	$this->Model->addTerm('TermName','type')

For instance

	$this->Model->id = 3;
	$this->Model->addTerm('dog','pet');
	$this->Model->addTerm('cat','pet');

Moreover the behavior add a "terms" virtual field within your find results (if you properly set the recursive) and a "Taxonomy" index containing all
your terms indexed by their type.
If you want to create checkboxes for editing a specifing Taxonomy
	
	$this->Form->input('Model.terms.type',array('type'=>'select','multiple'=>'checkbox','options'=>$options));

For instance if you want to edit the pet of an User

	$this->Form->input('Model.terms.pet',array('type'=>'select','multiple'=>'checkbox','options'=>$pets)))

If you want to find the list of some terms

	$this->Model->listTerms('pet','category','tag',....);


The Helper
-------------------------------------------------------
The Taxonomy helper allow you to create a quick and easy Taxonomy system
Firstly you have to load the Helper

	public $helper = array('Html','Form','Taxonomy.Taxonomy');

To create a quick and easy tag manager use
	
	$this->Taxonomy->input('pet',array('label'=>'My pet'));

The first parameter is the taxonomy type
The second parameter is an array of option (the same than FormHelper::Input); 

