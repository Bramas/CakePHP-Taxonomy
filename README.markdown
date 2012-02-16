Taxonomy Plugin for CakePHP 2.0 Alpha (Work in progress)
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

The Helper
-------------------------------------------------------
The Taxonomy helper allow you to create a quick and easy Taxonomy system

ToDo
-------------------------------------------------------
This plugin is a Work in progress
* remove the unused terms
* clean the afterSave hook to clean the right term_relationship