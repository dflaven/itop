<?php


SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'itop-problem-mgmt/1.0.0',
	array(
		// Identification
		//
		'label' => 'Problem Management',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-config-mgmt/1.0.0',
			'itop-tickets/1.0.0',
			'itop-incident-mgmt/1.0.0',
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'model.itop-problem-mgmt.php',
		),
		'dictionary' => array(
			'en.dict.itop-problem-mgmt.php',
			'es_cr.dict.itop-problem-mgmt.php',
			'fr.dict.itop-problem-mgmt.php',
			'de.dict.itop-problem-mgmt.php',
			'pt_br.dict.itop-problem-mgmt.php',
			'ru.dict.itop-problem-mgmt.php',
			'tr.dict.itop-problem-mgmt.php',
			'zh.dict.itop-problem-mgmt.php',
		),
		'data.struct' => array(
			//'data.struct.itop-problem-mgmt.xml',
		),
		'data.sample' => array(
			//'data.sample.itop-problem-mgmt.xml',
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // No manual installation instructions
		'doc.more_information' => '/doc/itop-documentation.htm#ProblemMgmt',

		// Default settings
		//
		'settings' => array(
		),
	)
);

?>
