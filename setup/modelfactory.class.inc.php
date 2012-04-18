<?php
// Copyright (C) 2011 Combodo SARL
//
/**
 * ModelFactory: in-memory manipulation of the XML MetaModel
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     Combodo Private
 */


require_once(APPROOT.'setup/moduleinstaller.class.inc.php');


 /**
 * ModelFactoryItem: an item managed by the ModuleFactory
 * @package ModelFactory
 */
abstract class MFItem
{
	public function __construct($sName, $sValue) 
	{
		parent::__construct($sName, $sValue);
	}
	
	/**
	 * List the source files for this item
	 */
	public function ListSources()
	{
		
	}
	/**
	 * List the rights/restrictions for this item
	 */
	public function ListRights()
	{
		
	}
}
 /**
 * ModelFactoryModule: the representation of a Module (i.e. element that can be selected during the setup)
 * @package ModelFactory
 */
class MFModule extends MFItem
{
	protected $sId;
	protected $sName;
	protected $sVersion;
	protected $sRootDir;
	protected $sLabel;
	protected $aDataModels;
	
	public function __construct($sId, $sRootDir, $sLabel)
	{
		$this->sId = $sId;	
		
		list($this->sName, $this->sVersion) = ModuleDiscovery::GetModuleName($sId);
		if (strlen($this->sVersion) == 0)
		{
			$this->sVersion = '1.0.0';
		}

		$this->sRootDir = $sRootDir;
		$this->sLabel = $sLabel;
		$this->aDataModels = array();
	
		// Scan the module's root directory to find the datamodel(*).xml files
		if ($hDir = opendir($sRootDir))
		{
			// This is the correct way to loop over the directory. (according to the documentation)
			while (($sFile = readdir($hDir)) !== false)
			{
				if (preg_match('/^datamodel(.*)\.xml$/i', $sFile, $aMatches))
				{
					$this->aDataModels[] = $this->sRootDir.'/'.$aMatches[0];
				}
			}
			closedir($hDir);
		}
	}
	
	
	public function GetId()
	{
		return $this->sId;
	}
	
	public function GetName()
	{
		return $this->sName;
	}

	public function GetVersion()
	{
		return $this->sVersion;
	}

	public function GetLabel()
	{
		return $this->sLabel;
	}
	
	public function GetRootDir()
	{
		return $this->sRootDir;
	}

	public function GetModuleDir()
	{
		return basename($this->sRootDir);
	}

	public function GetDataModelFiles()
	{
		return $this->aDataModels;
	}
			
	/**
	 * List all classes in this module
	 */
	public function ListClasses()
	{
		return array();
	}
}

class MFWorkspace extends MFModule
{
	public function __construct($sRootDir)
	{
		$this->sId = 'itop-workspace';	
		
		$this->sName = 'workspace';
		$this->sVersion = '1.0';

		$this->sRootDir = $sRootDir;
		$this->sLabel = 'Workspace';
		$this->aDataModels = array();

		$this->aDataModels[] = $this->GetWorkspacePath();
	}

	public function GetWorkspacePath()
	{
		return $this->sRootDir.'/workspace.xml';
	}
	
	public function GetName()
	{
		return ''; // The workspace itself has no name so that objects created inside it retain their original module's name
	}
}

 /**
 * ModelFactoryClass: the representation of a Class (i.e. a PHP class)
 * @package ModelFactory
 */
class MFClass extends MFItem
{
	/**
	 * List all fields of this class
	 */
	public function ListFields()
	{
		return array();
	}
	
	/**
	 * List all methods of this class
	 */
	public function ListMethods()
	{
		return array();
	}
	
	/**
	 * Whether or not the class has a lifecycle
	 * @return bool
	 */
	public function HasLifeCycle()
	{
		return true; //TODO implement
	}
	
	/**
	 * Returns the code of the attribute used to store the lifecycle state
	 * @return string
	 */
	public function GetLifeCycleAttCode()
	{
		if ($this->HasLifeCycle())
		{
			
		}
		return '';
	}
	
	/**
	 * List all states of this class
	 */
	public function ListStates()
	{
		return array();
	}
	/**
	 * List all relations of this class
	 */
	public function ListRelations()
	{
		return array();
	}
	/**
	 * List all transitions of this class
	 */
	public function ListTransitions()
	{
		return array();
	}
}

 /**
 * ModelFactoryField: the representation of a Field (i.e. a property of a class)
 * @package ModelFactory
 */
class MFField extends MFItem
{
}

 /**
 * ModelFactoryMethod: the representation of a Method (i.e. a method of a class)
 * @package ModelFactory
 */
class MFMethod extends MFItem
{
}

 /**
 * ModelFactoryState: the representation of a state in the life cycle of the class
 * @package ModelFactory
 */
class MFState extends MFItem
{
}

 /**
 * ModelFactoryRelation: the representation of a n:n relationship between two classes
 * @package ModelFactory
 */
class MFRelation extends MFItem
{
}

 /**
 * ModelFactoryTransition: the representation of a transition between two states in the life cycle of the class
 * @package ModelFactory
 */
class MFTransition extends MFItem
{
}


/**
 * ModelFactory: the class that manages the in-memory representation of the XML MetaModel
 * @package ModelFactory
 */
class ModelFactory
{
	protected $sRootDir;
	protected $oDOMDocument;
	protected $oRoot;
	protected $oClasses;
	protected $oMenus;
	static protected $aLoadedClasses;
	static protected $aLoadedMenus;
	static protected $aWellKnownParents = array('DBObject', 'CMDBObject','cmdbAbstractObject');
//	static protected $aWellKnownMenus = array('DataAdministration', 'Catalogs', 'ConfigManagement', 'Contact', 'ConfigManagementCI', 'ConfigManagement:Shortcuts', 'ServiceManagement');
	static protected $aLoadedModules;
	static protected $aLoadErrors;

	
	public function __construct($sRootDir)
	{
		$this->sRootDir = $sRootDir;
		$this->oDOMDocument = new DOMDocument('1.0', 'UTF-8');
		$this->oDOMDocument->registerNodeClass('DOMElement', 'MFElement');
		$this->oRoot = $this->oDOMDocument->CreateElement('itop_design');
		$this->oDOMDocument->AppendChild($this->oRoot);
		$this->oClasses = $this->oDOMDocument->CreateElement('classes');
		$this->oRoot->AppendChild($this->oClasses);
		foreach (self::$aWellKnownParents as $sWellKnownParent)
		{
			$oWKClass = $this->oDOMDocument->CreateElement('class');
			$oWKClass->setAttribute('id', $sWellKnownParent);
			$this->oClasses->AppendChild($oWKClass);
		}
		$this->oMenus = $this->oDOMDocument->CreateElement('menus');
		$this->oRoot->AppendChild($this->oMenus);
//		foreach (self::$aWellKnownMenus as $sWellKnownMenu)
//		{
//			$oWKMenu = $this->oDOMDocument->CreateElement('menu');
//			$oWKMenu->setAttribute('id', $sWellKnownMenu);
//			$this->oMenus->AppendChild($oWKMenu);
//		}
		self::$aLoadedClasses = array();
		self::$aLoadedMenus = array();
		self::$aLoadedModules = array();
		self::$aLoadErrors = array();

		libxml_use_internal_errors(true);
	}
	
	public function Dump($oNode = null)
	{
		if (is_null($oNode))
		{
			$oNode = $this->oMenus;
		}
		echo htmlentities($this->oDOMDocument->saveXML($oNode));
	}

	/**
	 * To progressively replace LoadModule
	 * @param xxx xxx
	 */
	public function LoadDelta(DOMDocument $oDeltaDoc, $oSourceNode, $oTargetParentNode)
	{
		if (!$oSourceNode instanceof DOMElement) return;
		//echo "Load $oSourceNode->tagName::".$oSourceNode->getAttribute('id')." (".$oSourceNode->getAttribute('_delta').")<br/>\n";
		$oTarget = $this->oDOMDocument;

		$sSearchId = $oSourceNode->hasAttribute('_rename_from') ? $oSourceNode->getAttribute('_rename_from') : null;

		if (($oSourceNode->tagName == 'class') && ($sParentId = $oSourceNode->GetChildText('parent')))
		{
			// This tag is organized in hierarchy: determine the real parent node (as a subnode of the current node)
			$oXPath = new DOMXPath($oTarget);

			//TODO - exclure les noeuds marqués pour effacement
			//       VOIR AUSSI LES AUTRES CAS DE RECHERCHE (findexistingnode)


			$sPath = '//'.$oSourceNode->tagName."[@id='$sParentId']";
			$oTargetParentNode = $oXPath->query($sPath)->item(0);
			if (!$oTargetParentNode)
			{
				echo "Dumping target doc - looking for '$sPath'<br/>\n";
				$this->oDOMDocument->firstChild->Dump();
				throw new Exception("XML datamodel loader: could not find parent node for $oSourceNode->tagName/".$oSourceNode->getAttribute('id')." with parent id $sParentId");
			}
		}

		switch ($oSourceNode->getAttribute('_delta'))
		{
		case 'must_exist':
			// Find it and go deeper
			$oTargetNode = $this->_priv_FindExistingNode($oTargetParentNode, $oSourceNode, $sSearchId);
			if (!$oTargetNode)
			{
				echo "Dumping parent node<br/>\n";
				$oTargetParentNode->Dump();
				throw new Exception("XML datamodel loader: could not find $oSourceNode->tagName/".$oSourceNode->getAttribute('id')." in $oTargetParentNode->tagName");
			}			
			foreach($oSourceNode->childNodes as $oSourceChild)
			{
				$this->LoadDelta($oDeltaDoc, $oSourceChild, $oTargetNode);
			}			
			break;

		case 'merge':
		case '':
			// Structural node, add it if not already present and go deeper
			$oTargetNode = $this->_priv_FindExistingNode($oTargetParentNode, $oSourceNode);
			if (!$oTargetNode)
			{
				$oTargetNode = $oTarget->CreateElement($oSourceNode->tagName);
				$oTargetParentNode->appendChild($oTargetNode);
			}
			foreach($oSourceNode->childNodes as $oSourceChild)
			{
				$this->LoadDelta($oDeltaDoc, $oSourceChild, $oTargetNode);
			}			
			break;

		case 'define':
			// New node - copy child nodes as well
			$oTargetNode = $oTarget->ImportNode($oSourceNode, true);
			$this->_priv_AddNode($oTargetParentNode, $oTargetNode);
			break;

		case 'redefine':
			// Replace the existing node by the given node - copy child nodes as well
			$oTargetNode = $oTarget->ImportNode($oSourceNode, true);
			$this->_priv_ModifyNode($oTargetParentNode, $oTargetNode);
			break;

		case 'delete':
			$oTargetNode = $this->_priv_FindExistingNode($oTargetParentNode, $oSourceNode);
			$this->_priv_RemoveNode($oTargetNode);
			break;
		}

		if ($oSourceNode->hasAttribute('_rename_from'))
		{
			$this->_priv_RenameNode($oTargetNode, $oSourceNode->getAttribute('id'));
		}
		if ($oTargetNode->hasAttribute('_delta'))
		{
			$oTargetNode->removeAttribute('_delta');
		}
	}

	/**
	 * Loads the definitions corresponding to the given Module
	 * @param MFModule $oModule
	 */
	public function LoadModule(MFModule $oModule)
	{
		$aDataModels = $oModule->GetDataModelFiles();
		$sModuleName = $oModule->GetName();
		$aClasses = array();
		self::$aLoadedModules[] = $oModule;
		foreach($aDataModels as $sXmlFile)
		{
			$oDocument = new DOMDocument('1.0', 'UTF-8');
			$oDocument->registerNodeClass('DOMElement', 'MFElement');
			libxml_clear_errors();
			$oDocument->load($sXmlFile, LIBXML_NOBLANKS);
			$bValidated = $oDocument->schemaValidate(APPROOT.'setup/itop_design.xsd');
			$aErrors = libxml_get_errors();
			if (count($aErrors) > 0)
			{
				self::$aLoadErrors[$sModuleName] = $aErrors;
				return;
			}

			$oXPath = new DOMXPath($oDocument);
			$oNodeList = $oXPath->query('//class');
			foreach($oNodeList as $oNode)
			{
				$oNode->SetAttribute('_source', $sXmlFile);
			}

			$oDeltaRoot = $oDocument->childNodes->item(0);
			$this->LoadDelta($oDocument, $oDeltaRoot, $this->oDOMDocument);
		}
	}

	/**
	 *	XML load errors (XML format and validation)
	 */	
	function HasLoadErrors()
	{
		return (count(self::$aLoadErrors) > 0);
	}
	function GetLoadErrors()
	{
		return self::$aLoadErrors;
	}

	function GetLoadedModules($bExcludeWorkspace = true)
	{
		if ($bExcludeWorkspace)
		{
			$aModules = array();
			foreach(self::$aLoadedModules as $oModule)
			{
				if (!$oModule instanceof MFWorkspace)
				{
					$aModules[] = $oModule;
				}
			}
		}
		else
		{
			$aModules = self::$aLoadedModules;
		}
		return $aModules;
	}
	
	
	function GetModule($sModuleName)
	{
		foreach(self::$aLoadedModules as $oModule)
		{
			if ($oModule->GetName() == $sModuleName) return $oModule;
		}
		return null;
	}
	
	
	/**
	 * Check if the class specified by the given node already exists in the loaded DOM
	 * @param DOMNode $oClassNode The node corresponding to the class to load
	 * @throws Exception
	 * @return bool True if the class exists, false otherwise
	 */
	protected function ClassExists(DOMNode $oClassNode)
	{
	assert(false);
		if ($oClassNode->hasAttribute('id'))
		{
			$sClassName = $oClassNode->GetAttribute('id');
		}
		else
		{
			throw new Exception('ModelFactory::AddClass: Cannot add a class with no name');
		}
	
		return (array_key_exists($sClassName, self::$aLoadedClasses));
	}
	
	/**
	 * Check if the class specified by the given name already exists in the loaded DOM
	 * @param string $sClassName The node corresponding to the class to load
	 * @throws Exception
	 * @return bool True if the class exists, false otherwise
	 */
	protected function ClassNameExists($sClassName, $bFlattenLayers = true)
	{
		return !is_null($this->GetClass($sClassName, $bFlattenLayers));
	}
	/**
	 * Add the given class to the DOM
	 * @param DOMNode $oClassNode
	 * @param string $sModuleName The name of the module in which this class is declared
	 * @throws Exception
	 */
	public function AddClass(DOMNode $oClassNode, $sModuleName)
	{
		if ($oClassNode->hasAttribute('id'))
		{
			$sClassName = $oClassNode->GetAttribute('id');
		}
		else
		{
			throw new Exception('ModelFactory::AddClass: Cannot add a class with no name');
		}
		if ($this->ClassExists($oClassNode))
		{
			throw new Exception("ModelFactory::AddClass: Cannot add the already existing class $sClassName");
		}
		
		$sParentClass = $oClassNode->GetChildText('parent', '');
		$oParentNode = $this->GetClass($sParentClass);
		if ($oParentNode == null)
		{
			throw new Exception("ModelFactory::AddClass: Cannot find the parent class of $sClassName: $sParentClass");
		}
		else
		{
			if ($sModuleName != '')
			{
				$oClassNode->SetAttribute('_created_in', $sModuleName);
			}
			$this->_priv_AddNode($oParentNode, $this->oDOMDocument->importNode($oClassNode, true));
		}
	}
	
	/**
	 * Remove a class from the DOM
	 * @param string $sClass
	 * @throws Exception
	 */
	public function RemoveClass($sClass)
	{
		$oClassNode = $this->GetClass($sClass);
		if ($oClassNode == null)
		{
			throw new Exception("ModelFactory::RemoveClass: Cannot remove the non existing class $sClass");
		}

		//TODO: also mark as removed the child classes

		$this->_priv_RemoveNode($oClassNode);
	}

	/**
	 * Modify a class within the DOM
	 * @param string $sMenuId
	 * @param DOMNode $oMenuNode
	 * @throws Exception
	 */
	public function AlterClass($sClassName, DOMNode $oClassNode)
	{
		$sOriginalName = $sClassName;
		if ($this->ClassNameExists($sClassName))
		{
			$oDestNode = self::$aLoadedClasses[$sClassName];
		}
		else
		{
			$sOriginalName = $oClassNode->getAttribute('_original_name');
			if ($this->ClassNameExists($sOriginalName))
			{
				// Class was renamed !
				$oDestNode = self::$aLoadedClasses[$sOriginalName];
			}
			else
			{
				throw new Exception("ModelFactory::AddClass: Cannot alter the non-existing class $sClassName / $sOriginalName");
			}
		}
		$this->_priv_AlterNode($oDestNode, $oClassNode);
		$sClassName = $oDestNode->getAttribute('id');
		if ($sOriginalName != $sClassName)
		{
			unset(self::$aLoadedClasses[$sOriginalName]);
			self::$aLoadedClasses[$sClassName] = $oDestNode;
		}
		$this->_priv_SetFlag($oDestNode, 'modified');
	}

	/**
	 * Add the given menu to the DOM
	 * @param DOMNode $oMenuNode
	 * @param string $sModuleName The name of the module in which this class is declared
	 * @throws Exception
	 */
	public function AddMenu($oMenuNode, $sModuleName)
	{
		$sMenuId = $oMenuNode->GetAttribute('id');

		self::$aLoadedMenus[$sMenuId] = $this->oDOMDocument->ImportNode($oMenuNode, true /* bDeep */);
		self::$aLoadedMenus[$sMenuId]->SetAttribute('_operation', 'added');
		if ($sModuleName != '')
		{
			self::$aLoadedMenus[$sMenuId]->SetAttribute('_created_in', $sModuleName);
		}
		$this->oMenus->AppendChild(self::$aLoadedMenus[$sMenuId]);
	}
	
	/**
	 * Remove a menu from the DOM
	 * @param string $sMenuId
	 * @throws Exception
	 */
	public function RemoveMenu($sMenuId)
	{
		$oMenuNode = self::$aLoadedMenus[$sClass];
		if ($oMenuNode->getAttribute('_operation') == 'added')
		{
			$oMenuNode->parentNode->RemoveChild($oMenuNode);
			unset(self::$aLoadedMenus[$sMenuId]);	
		}
		else
		{
			self::$aLoadedMenus[$sMenuId]->SetAttribute('_operation', 'removed');
		}
		
	}

	/**
	 * Modify a menu within the DOM
	 * @param string $sMenuId
	 * @param DOMNode $oMenuNode
	 * @throws Exception
	 */
	public function AlterMenu($sMenuId, DOMNode $oMenuNode)
	{
		// Todo - implement... do we have to handle menu renaming ???
	}


	protected function _priv_AlterNode(DOMNode $oNode, DOMNode $oDeltaNode)
	{
		foreach ($oDeltaNode->attributes as $sName => $oAttrNode)
		{
			$sCurrentValue = $oNode->getAttribute($sName);
			$sNewValue = $oAttrNode->value;
			$oNode->setAttribute($sName, $oAttrNode->value);
		}
		
		$aSrcChildNodes = $oNode->childNodes;
		foreach($oDeltaNode->childNodes as $index => $oChildNode)
		{
			if (!$oChildNode instanceof DOMElement)
			{
				// Text or CData nodes are treated by position
				$sOperation = $oChildNode->parentNode->getAttribute('_operation');
				switch($sOperation)
				{
					case 'removed':
					// ???
					break;
					
					case 'modified':
					case 'replaced':
					case 'added':
					$oNewNode = $this->oDOMDocument->importNode($oChildNode);
					$oSrcChildNode = $aSrcChildNodes->item($index);
					if ($oSrcChildNode)
					{
						$oNode->replaceChild($oNewNode, $oSrcChildNode);
					}
					else
					{
						$oNode->appendChild($oNewNode);
					}
					
					break;
					
					case '':
					// Do nothing
				}
			}
			else
			{
				$sOperation = $oChildNode->getAttribute('_operation');
				$sPath = $oChildNode->tagName;
				$sName = $oChildNode->getAttribute('id');
				if ($sName != '')
				{
					$sPath .= "[@id='$sName']";
				}
				switch($sOperation)
				{
					case 'removed':
					$oToRemove = $this->_priv_GetNodes($sPath, $oNode)->item(0);
					if ($oToRemove != null)
					{
						$this->_priv_SetFlag($oToRemove, 'removed');
					}
					break;
					
					case 'modified':
					$oToModify = $this->_priv_GetNodes($sPath, $oNode)->item(0);
					if ($oToModify != null)
					{
						$this->_priv_AlterNode($oToModify, $oChildNode);
					}
					else
					{
						throw new Exception("Cannot modify the non-existing node '$sPath' in '".$oNode->getNodePath()."'");
					}
					break;
					
					case 'replaced':
					$oNewNode = $this->oDOMDocument->importNode($oChildNode, true); // Import the node and its child nodes
					$oToModify = $this->_priv_GetNodes($sPath, $oNode)->item(0);
					$oNode->replaceChild($oNewNode, $oToModify);	
					break;
					
					case 'added':
					$oNewNode = $this->oDOMDocument->importNode($oChildNode);
					$oNode->appendChild($oNewNode);
					$this->_priv_SetFlag($oNewNode, 'added');
					break;
					
					case '':
					// Do nothing
				}
			}
		}	
	}
	
	public function GetClassXMLTemplate($sName, $sIcon)
	{
		$sHeader = '<?xml version="1.0" encoding="utf-8"?'.'>';
		return
<<<EOF
$sHeader
<class id="$sName">
	<comment/>
	<properties>
	</properties>
	<naming format=""><attributes/></naming>
	<reconciliation><attributes/></reconciliation>
	<display_template/>
	<icon>$sIcon</icon>
	</properties>
	<fields/>
	<lifecycle/>
	<methods/>
	<presentation>
		<details><items/></details>
		<search><items/></search>
		<list><items/></list>
	</presentation>
</class>
EOF
		;
	}
	/**
	 * List all classes from the DOM, for a given module
	 * @param string $sModuleNale
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function ListClasses($sModuleName, $bFlattenLayers = true)
	{
		$sXPath = "//class[@_created_in='$sModuleName']";
		if ($bFlattenLayers)
		{
			$sXPath = "//class[@_created_in='$sModuleName' and @_operation!='removed']";
		}
		return $this->_priv_GetNodes($sXPath);
	}
		
	/**
	 * List all classes from the DOM, for a given module
	 * @param string $sModuleNale
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function ListAllClasses($bFlattenLayers = true)
	{
		$sXPath = "//class";
		if ($bFlattenLayers)
		{
			$sXPath = "//class[@_operation!='removed']";
		}
		return $this->_priv_GetNodes($sXPath);
	}
	
	public function GetClass($sClassName, $bFlattenLayers = true)
	{
		$oClassNode = $this->_priv_GetNodes("//classes/class[@id='$sClassName']")->item(0);
		if ($oClassNode == null)
		{
			return null;
		}
		elseif ($bFlattenLayers)
		{
			$sOperation = $oClassNode->getAttribute('_alteration');
			if ($sOperation == 'removed')
			{
				$oClassNode = null;
			}
		}
		return $oClassNode;
	}
	
	public function GetChildClasses($oClassNode, $bFlattenLayers = true)
	{
		$sXPath = "class";
		if ($bFlattenLayers)
		{
			$sXPath = "class[(@_operation!='removed')]";
		}
		return $this->_priv_GetNodes($sXPath, $oClassNode);
	}
		
	
	public function GetField($sClassName, $sAttCode, $bFlattenLayers = true)
	{
		if (!$this->ClassNameExists($sClassName))
		{
			return null;
		}
		$oClassNode = self::$aLoadedClasses[$sClassName];
		if ($bFlattenLayers)
		{
			$sOperation = $oClassNode->getAttribute('_operation');
			if ($sOperation == 'removed')
			{
				$oClassNode = null;
			}
		}
		$sXPath = "fields/field[@id='$sAttCode']";
		if ($bFlattenLayers)
		{
			$sXPath = "fields/field[(@id='$sAttCode' and (not(@_operation) or @_operation!='removed'))]";
		}
		$oFieldNode = $this->_priv_GetNodes($sXPath, $oClassNode)->item(0);
		if (($oFieldNode == null) && ($sParentClass = $oClassNode->GetChildText('parent')))
		{
			return $this->GetField($sParentClass, $sAttCode, $bFlattenLayers);
		}
		return $oFieldNode;
	}
		
	/**
	 * List all classes from the DOM
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function ListFields(DOMNode $oClassNode, $bFlattenLayers = true)
	{
		$sXPath = "fields/field";
		if ($bFlattenLayers)
		{
			$sXPath = "fields/field[not(@_operation) or @_operation!='removed']";
		}
		return $this->_priv_GetNodes($sXPath, $oClassNode);
	}
	
	public function AddField(DOMNode $oClassNode, $sFieldCode, $sFieldType, $sSQL, $defaultValue, $bIsNullAllowed, $aExtraParams)
	{
		$oNewField = $this->oDOMDocument->createElement('field');
		$oNewField->setAttribute('id', $sFieldCode);
		$this->_priv_AlterField($oNewField, $sFieldType, $sSQL, $defaultValue, $bIsNullAllowed, $aExtraParams);
		$oFields = $oClassNode->getElementsByTagName('fields')->item(0);
		$oFields->AppendChild($oNewField);
		$this->_priv_SetFlag($oNewField, 'added');
	}
	
	public function RemoveField(DOMNode $oClassNode, $sFieldCode)
	{
		$sXPath = "fields/field[@id='$sFieldCode']";
		$oFieldNodes = $this->_priv_GetNodes($sXPath, $oClassNode);
		if (is_object($oFieldNodes) && (is_object($oFieldNodes->item(0))))
		{
			$oFieldNode = $oFieldNodes->item(0);
			$sOpCode = $oFieldNode->getAttribute('_operation');
			if ($oFieldNode->getAttribute('_operation') == 'added')
			{
				$oFieldNode->parentNode->removeChild($oFieldNode);
			}
			else
			{
				$this->_priv_SetFlag($oFieldNode, 'removed');
			}
		}
	}
	
	public function AlterField(DOMNode $oClassNode, $sFieldCode, $sFieldType, $sSQL, $defaultValue, $bIsNullAllowed, $aExtraParams)
	{
		$sXPath = "fields/field[@id='$sFieldCode']";
		$oFieldNodes = $this->_priv_GetNodes($sXPath, $oClassNode);
		if (is_object($oFieldNodes) && (is_object($oFieldNodes->item(0))))
		{
			$oFieldNode = $oFieldNodes->item(0);
			//@@TODO: if the field was 'added' => then let it as 'added'
			$sOpCode = $oFieldNode->getAttribute('_operation');
			switch($sOpCode)
			{
				case 'added':
				case 'modified':
				// added or modified, let it as it is
				break;
				
				default:
				$this->_priv_SetFlag($oFieldNodes->item(0), 'modified');
			}
			$this->_priv_AlterField($oFieldNodes->item(0), $sFieldType, $sSQL, $defaultValue, $bIsNullAllowed, $aExtraParams);
		}
	}

	protected function _priv_AlterField(DOMNode $oFieldNode, $sFieldType, $sSQL, $defaultValue, $bIsNullAllowed, $aExtraParams)
	{
		switch($sFieldType)
		{			
			case 'Blob':
			case 'Boolean':
			case 'CaseLog':
			case 'Deadline':
			case 'Duration':
			case 'EmailAddress':
			case 'EncryptedString':
			case 'HTML':
			case 'IPAddress':
			case 'LongText':
			case 'OQL':
			case 'OneWayPassword':
			case 'Password':
			case 'Percentage':
			case 'String':
			case 'Text':
			case 'Text':
			case 'TemplateHTML':
			case 'TemplateString':
			case 'TemplateText':
			case 'URL':
			case 'Date':
			case 'DateTime':
			case 'Decimal':
			case 'Integer':
			break;	
			
			case 'ExternalKey':
			$this->_priv_AddFieldAttribute($oFieldNode, 'target_class', $aExtraParams);
			// Fall through
			case 'HierarchicalKey':
			$this->_priv_AddFieldAttribute($oFieldNode, 'on_target_delete', $aExtraParams);
			$this->_priv_AddFieldAttribute($oFieldNode, 'filter', $aExtraParams);
			break;

			case 'ExternalField':
			$this->_priv_AddFieldAttribute($oFieldNode, 'extkey_attcode', $aExtraParams);
			$this->_priv_AddFieldAttribute($oFieldNode, 'target_attcode', $aExtraParams);
			break;
				
			case 'Enum':
			$this->_priv_SetFieldValues($oFieldNode, $aExtraParams);
			break;
			
			case 'LinkedSetIndirect':
			$this->_priv_AddFieldAttribute($oFieldNode, 'ext_key_to_remote', $aExtraParams);
			// Fall through
			case 'LinkedSet':
			$this->_priv_AddFieldAttribute($oFieldNode, 'linked_class', $aExtraParams);
			$this->_priv_AddFieldAttribute($oFieldNode, 'ext_key_to_me', $aExtraParams);
			$this->_priv_AddFieldAttribute($oFieldNode, 'count_min', $aExtraParams);
			$this->_priv_AddFieldAttribute($oFieldNode, 'count_max', $aExtraParams);
			break;
			
			default:
			throw(new Exception('Unsupported type of field: '.$sFieldType));
		}
		$this->_priv_SetFieldDependencies($oFieldNode, $aExtraParams);
		$oFieldNode->setAttribute('type', $sFieldType);
		$oFieldNode->setAttribute('sql', $sSQL);
		$oFieldNode->setAttribute('default_value', $defaultValue);
		$oFieldNode->setAttribute('is_null_alllowed', $bIsNullAllowed ? 'true' : 'false');
	}
	
	protected function _priv_AddFieldAttribute(DOMNode $oFieldNode, $sAttributeCode, $aExtraParams, $bMandatory = false)
	{
		$value = array_key_exists($sAttributeCode, $aExtraParams) ? $aExtraParams[$sAttributeCode] : '';
		if (($value == '') && (!$bMandatory)) return;
		$oFieldNode->setAttribute($sAttributeCode, $value);
	}
	
	protected function _priv_SetFieldDependencies($oFieldNode, $aExtraParams)
	{
		$aDeps = array_key_exists('dependencies', $aExtraParams) ? $aExtraParams['dependencies'] : '';
		$oDependencies = $oFieldNode->getElementsByTagName('dependencies')->item(0);

		// No dependencies before, and no dependencies to add, exit
		if (($oDependencies == null) && ($aDeps == '')) return;
		
		// Remove the previous dependencies
		$oFieldNode->removeChild($oDependencies);
		// If no dependencies, exit
		if ($aDeps == '') return;

		// Build the new list of dependencies
		$oDependencies = $this->oDOMDocument->createElement('dependencies');

		foreach($aDeps as $sAttCode)
		{
			$oDep = $this->oDOMDocument->createElement('attribute');
			$oDep->setAttribute('id', $sAttCode);
			$oDependencies->addChild($oDep);
		}
		$oFieldNode->addChild($oDependencies);
	}
	
	protected function _priv_SetFieldValues($oFieldNode, $aExtraParams)
	{
		$aVals = array_key_exists('values', $aExtraParams) ? $aExtraParams['values'] : '';
		$oValues = $oFieldNode->getElementsByTagName('values')->item(0);

		// No dependencies before, and no dependencies to add, exit
		if (($oValues == null) && ($aVals == '')) return;
		
		// Remove the previous dependencies
		$oFieldNode->removeChild($oValues);
		// If no dependencies, exit
		if ($aVals == '') return;

		// Build the new list of dependencies
		$oValues = $this->oDOMDocument->createElement('values');

		foreach($aVals as $sValue)
		{
			$oVal = $this->oDOMDocument->createElement('value', $sValue);
			$oValues->appendChild($oVal);
		}
		$oFieldNode->appendChild($oValues);
	}

	public function SetPresentation(DOMNode $oClassNode, $sPresentationCode, $aPresentation)
	{
		$oPresentation = $oClassNode->getElementsByTagName('presentation')->item(0);
		if (!is_object($oPresentation))
		{
			$oPresentation = $this->oDOMDocument->createElement('presentation');
			$oClassNode->appendChild($oPresentation);
		}
		$oZlist = $oPresentation->getElementsByTagName($sPresentationCode)->item(0);
		if (is_object($oZlist))
		{
			// Remove the previous Zlist
			$oPresentation->removeChild($oZlist);
		}
		// Create the ZList anew
		$oZlist = $this->oDOMDocument->createElement($sPresentationCode);
		$oPresentation->appendChild($oZlist);
		$this->AddZListItem($oZlist, $aPresentation);
		$this->_priv_SetFlag($oZlist, 'replaced');
	}

	protected function AddZListItem($oXMLNode, $value)
	{
		if (is_array($value))
		{
			$oXmlItems = $this->oDOMDocument->CreateElement('items');
			$oXMLNode->appendChild($oXmlItems);
			
			foreach($value as $key => $item)
			{
				$oXmlItem = $this->oDOMDocument->CreateElement('item');
				$oXmlItems->appendChild($oXmlItem);
	
				if (is_string($key))
				{
					$oXmlItem->SetAttribute('key', $key);
				}
				$this->AddZListItem($oXmlItem, $item);
			}
		}
		else
		{
			$oXmlText = $this->oDOMDocument->CreateTextNode((string) $value);
			$oXMLNode->appendChild($oXmlText);
		}
	}
	
	public function _priv_SetFlag($oNode, $sFlagValue)
	{
		$sPreviousFlag = $oNode->getAttribute('_operation');
		if ($sPreviousFlag == 'added')
		{
			// Do nothing ??
		}
		else
		{
			$oNode->setAttribute('_operation', $sFlagValue);
		}
		if ($oNode->tagName != 'class')
		{
			$this->_priv_SetFlag($oNode->parentNode, 'modified');
		}
	}
	/**
	 * List all transitions from a given state
	 * @param DOMNode $oStateNode The state
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function ListTransitions(DOMNode $oStateNode, $bFlattenLayers = true)
	{
		$sXPath = "transitions/transition";
		if ($bFlattenLayers)
		{
			//$sXPath = "transitions/transition[@_operation!='removed']";
		}
		return $this->_priv_GetNodes($sXPath, $oStateNode);
	}
		
	/**
	 * List all states of a given class
	 * @param DOMNode $oClassNode The class
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function ListStates(DOMNode $oClassNode, $bFlattenLayers = true)
	{
		$sXPath = "lifecycle/states/state";
		if ($bFlattenLayers)
		{
			//$sXPath = "lifecycle/states/state[@_operation!='removed']";
		}
		return $this->_priv_GetNodes($sXPath, $oClassNode);
	}
		
	/**
	 * List Zlists from the DOM for a given class
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function ListZLists(DOMNode $oClassNode, $bFlattenLayers = true)
	{
		// Not yet implemented !!!
		return array();
	}
		
	/**
	 * List all menus from the DOM, for a given module
	 * @param string $sModuleName
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function ListMenus($sModuleName, $bFlattenLayers = true)
	{
		$sXPath = "//menu[@_created_in='$sModuleName']";
		if ($bFlattenLayers)
		{
			$sXPath = "//menu[@_created_in='$sModuleName' and @_operation!='removed']";
		}
		return $this->_priv_GetNodes($sXPath, $this->oMenus);
	}
		
	/**
	 * Get a menu, given its is id
	 * @param string $sModuleName
	 * @param bool $bFlattenLayers
	 * @throws Exception
	 */
	public function GetMenu($sMenuId, $bFlattenLayers = true)
	{
		if (!array_key_exists($sMenuId, self::$aLoadedMenus))
		{
			return null;
		}
		$oMenuNode = self::$aLoadedMenus[$sMenuId];
		if ($bFlattenLayers)
		{
			$sOperation = $oMenuNode->getAttribute('_operation');
			if ($sOperation == 'removed')
			{
				$oMenuNode = null;
			}
		}
		return $oMenuNode;
	}
	

	public function ApplyChanges()
	{
		$oNodes = $this->ListChanges();
		foreach($oNodes as $oNode)
		{
			$sOperation = $oNode->GetAttribute('_alteration');
			switch($sOperation)
			{
				case 'added':
				case 'replaced':
				// marked as added or modified, just reset the flag
				$oNode->removeAttribute('_alteration');
				break;
				
				case 'removed':
				// marked as deleted, let's remove the node from the tree
				$oNode->parentNode->removeChild($oNode);
				// TODO!!!!!!!
				//unset(self::$aLoadedClasses[$sClass]);
				break;
			}
			if ($oNode->hasAttribute('_old_id'))
			{
				$oNode->removeAttribute('_old_id');
			}
		}
	}
	
	public function ListChanges()
	{
		return $this->_priv_GetNodes('//*[@_alteration or @_old_id]', $this->oDOMDocument->firstChild);
	}


	/**
	 * Create path for the delta
	 * @param DOMDocument oTargetDoc  Where to attach the top of the hierarchy
	 * @param MFElement   oNode       The node to import with its path	 	 
	 */
	protected function ImportNodeAndPathDelta($oTargetDoc, $oNode)
	{
		// Preliminary: skip the parent if this node is organized hierarchically into the DOM
		// The criteria to detect a hierarchy is: same tag + have an id
		$oParent = $oNode->parentNode;
		while (($oParent instanceof DOMElement) && ($oParent->tagName == $oNode->tagName) && $oParent->hasAttribute('id'))
		{
			$oParent = $oParent->parentNode;
		}
		// Recursively create the path for the parent
		if ($oParent instanceof DOMElement)
		{
			$oParentClone = $this->ImportNodeAndPathDelta($oTargetDoc, $oParent);
		}
		else
		{
			// We've reached the top let's add the node into the root recipient
			$oParentClone = $oTargetDoc;
		}
		// Look for the node into the parent node
		// Note: this is an identified weakness of the algorithm,
		//       because for each node modified, and each node of its path
		//       we will have to lookup for the existing entry
		//       Anyhow, this loop is quite quick to execute because in the delta
		//       the number of nodes is limited
		$oNodeClone = null;
		foreach ($oParentClone->childNodes as $oChild)
		{
			if (($oChild instanceof DOMElement) && ($oChild->tagName == $oNode->tagName))
			{
				if (!$oNode->hasAttribute('id') || ($oNode->getAttribute('id') == $oChild->getAttribute('id')))
				{
					$oNodeClone = $oChild;
					break;
				}
			}
		} 
		if (!$oNodeClone)
		{
			$sAlteration = $oNode->getAttribute('_alteration');
			$bCopyContents = ($sAlteration == 'replaced') || ($sAlteration == 'added');
			$oNodeClone = $oTargetDoc->importNode($oNode->cloneNode($bCopyContents), $bCopyContents);
			$oNodeClone->removeAttribute('_alteration');
			if ($oNodeClone->hasAttribute('_old_id'))
			{
				$oNodeClone->setAttribute('_rename_from', $oNodeClone->getAttribute('_old_id'));
				$oNodeClone->removeAttribute('_old_id');
			}
			switch ($sAlteration)
			{
			case '':
				if ($oNodeClone->hasAttribute('id'))
				{
					$oNodeClone->setAttribute('_delta', 'must_exist');
				}
				break;
			case 'added':
				$oNodeClone->setAttribute('_delta', 'define');
				break;
			case 'replaced':
				$oNodeClone->setAttribute('_delta', 'redefine');
				break;
			case 'removed':
				$oNodeClone->setAttribute('_delta', 'delete');
				break;
			}
			$oParentClone->appendChild($oNodeClone);
		}
		return $oNodeClone;
	}

	/**
	 * Get the text/XML version of the delta
	 */	
	public function GetDelta()
	{
		$oDelta = new DOMDocument('1.0', 'UTF-8');
		$oDelta->registerNodeClass('DOMElement', 'MFElement');
		
		foreach($this->ListChanges() as $oAlteredNode)
		{
			$this->ImportNodeAndPathDelta($oDelta, $oAlteredNode);
		}

		$oDelta->formatOutput = true; // indent (must by loaded with option LIBXML_NOBLANKS)
		$oDelta->preserveWhiteSpace = true; // otherwise the formatOutput option would have no effect
		return $oDelta->saveXML();
	}
	
	/**
	 * Searches on disk in the root directory for module description files
	 * and returns an array of MFModules
	 * @return array Array of MFModules
	 */
	public function FindModules($sSubDirectory = '')
	{
		$aAvailableModules = ModuleDiscovery::GetAvailableModules($this->sRootDir, $sSubDirectory);
		$aResult = array();
		foreach($aAvailableModules as $sId => $aModule)
		{
			$aResult[] = new MFModule($sId, $aModule['root_dir'], $aModule['label']);
		}
		return $aResult;
	}
	
	/**
	 * Replaces a node by another one, making sure that recursive nodes are preserved
	 * @param MFElement $oNewNode The replacement
	 * @param MFElement $oOldNode The former node
	 */	
	protected function _priv_replaceNode($oNewNode, $oOldNode)
	{
		if ($oOldNode->tagName == 'class')
		{
		}
		// Move the classes from the old node into the new one
		foreach($this->_priv_GetNodes('class', $oOldNode) as $oChild)
		{
			$oNewNode->appendChild($oChild);
		}
		

		$oParentNode = $oOldNode->parentNode;
		$oParentNode->replaceChild($oNewNode, $oOldNode);
	}


	/**
	 * Find the child node matching the given node
	 * @param mixe      $oParentNode The container
	 * @param MFElement $oRefNode The node to search for
	 * @param bool      $sSearchId substitutes to the value of the 'id' attribute 
	 */	
	protected function _priv_FindExistingNode($oParentNode, $oRefNode, $sSearchId = null)
	{
		$oRes = null;
		if ($oRefNode->hasAttribute('id'))
		{
			// Find the first element having the same tag name and id
			if (!$sSearchId)
			{
				$sSearchId = $oRefNode->getAttribute('id');
			}
			foreach($oParentNode->childNodes as $oChildNode)
			{
				if (($oChildNode instanceof DOMElement) && ($oChildNode->tagName == $oRefNode->tagName))
				{
					if ($oChildNode->hasAttribute('id') && ($oChildNode->getAttribute('id') == $sSearchId))
					{
						$oRes = $oChildNode;
						break;
					}
				}
			}
		}
		else
		{
			// Get the first one having the same tag name (ignore others)
			foreach($oParentNode->childNodes as $oChildNode)
			{
				if (($oChildNode instanceof DOMElement) && ($oChildNode->tagName == $oRefNode->tagName))
				{
					$oRes = $oChildNode;
					break;
				}
			}
		}
		return $oRes;
	}


	/**
	 * Add a node and set the flags that will be used to compute the delta
	 * @param MFElement $oParentNode The node into which the new node will be attached
	 * @param MFElement $oNode The node (including all subnodes) to add
	 */	
	protected function _priv_AddNode($oParentNode, $oNode)
	{
		$sFlag = null;

		$oExisting = $this->_priv_FindExistingNode($oParentNode, $oNode);
		if ($oExisting)
		{
			if ($oExisting->getAttribute('_alteration') != 'removed')
			{
				throw new Exception("Attempting to add a node that already exists: $oNode->tagName (id: ".$oNode->getAttribute('id')."");
			}
			$sFlag = 'replaced';
			$this->_priv_replaceNode($oNode, $oExisting);
		}
		else
		{
			$oParentNode->appendChild($oNode);

			$sFlag = 'added';
			// Iterate through the parents: reset the flag if any of them has a flag set 
			for($oParent = $oNode ; $oParent instanceof MFElement ; $oParent = $oParent->parentNode)
			{
				if ($oParent->getAttribute('_alteration') != '')
				{
					$sFlag = null;
					break;
				}
			}
		}
		if ($sFlag)
		{
			$oNode->setAttribute('_alteration', $sFlag);
		}
	}

	/**
	 * Modify a node and set the flags that will be used to compute the delta
	 * @param MFElement $oParentNode The node into which the new node will be changed
	 * @param MFElement $oNode       The node (including all subnodes) to set
	 */	
	protected function _priv_ModifyNode($oParentNode, $oNode)
	{
		$oExisting = $this->_priv_FindExistingNode($oParentNode, $oNode);
		if (!$oExisting)
		{
			throw new Exception("Attempting to modify a non existing node: $oNode->tagName (id: ".$oNode->getAttribute('id').")");
		}
		if ($oExisting->getAttribute('_alteration') == 'removed')
		{
			throw new Exception("Attempting to modify a deleted node: $oNode->tagName (id: ".$oNode->getAttribute('id')."");
		}
		$this->_priv_replaceNode($oNode, $oExisting);
			
		if ($oNode->getAttribute('_alteration') != '')
		{
			// added or modified: leave the flag unchanged
			$sFlag = null;
		}
		else
		{
			$sFlag = 'replaced';
			// Iterate through the parents: reset the flag if any of them has a flag set 
			for($oParent = $oNode ; $oParent instanceof MFElement ; $oParent = $oParent->parentNode)
			{
				if ($oParent->getAttribute('_alteration') != '')
				{
					$sFlag = null;
					break;
				}
			}
		}
		if ($sFlag)
		{
			$oNode->setAttribute('_alteration', $sFlag);
		}
	}

	/**
	 * Remove a node and set the flags that will be used to compute the delta
	 * @param MFElement $oNode The node to remove
	 */	
	protected function _priv_RemoveNode($oNode)
	{
		$oParent = $oNode->parentNode;
		if ($oNode->getAttribute('_alteration') == 'replaced')
		{
			$sFlag = 'removed';
		}
		elseif ($oNode->getAttribute('_alteration') == 'added')
		{
			$sFlag = null;
		}
		else
		{
			$sFlag = 'removed';
			// Iterate through the parents: reset the flag if any of them has a flag set 
			for($oParent = $oNode ; $oParent instanceof MFElement ; $oParent = $oParent->parentNode)
			{
				if ($oParent->getAttribute('_alteration') != '')
				{
					$sFlag = null;
					break;
				}
			}
		}
		if ($sFlag)
		{
			$oNode->setAttribute('_alteration', $sFlag);
			$oNode->DeleteChildren();
		}
		else
		{
			// Remove the node entirely
			$oParent->removeChild($oNode);
		}
	}

	/**
	 * Renames a node and set the flags that will be used to compute the delta
	 * @param MFElement $oNode The node to rename
	 * @param String    $sNewId The new id	 
	 */	
	protected function _priv_RenameNode($oNode, $sId)
	{
		$oNode->setAttribute('_old_id', $oNode->getAttribute('id'));
		$oNode->setAttribute('id', $sId);
	}


	public function TestAlteration()
	{
		echo "<h4>Extrait des données chargées</h4>\n";
		$oRoot = $this->_priv_GetNodes("//class[@id='Contact']")->item(0);
		$oRoot->Dump();

return;
		$sHeader = '<?xml version="1.0" encoding="utf-8"?'.'>';
		$sOriginalXML =
<<<EOF
$sHeader
<itop_design>
	<a id="first a">
		<b>Text</b>
		<c id="1">
			<d>D1</d>
			<d>D2</d>
		</c>
	</a>
	<a id="second a">
		<parent>first a</parent>
	</a>
	<a id="third a">
		<parent>first a</parent>
		<x>blah</x>
	</a>
</itop_design>
EOF;

		$this->oDOMDocument = new DOMDocument('1.0', 'UTF-8');
		$this->oDOMDocument->registerNodeClass('DOMElement', 'MFElement');
		$this->oDOMDocument->loadXML($sOriginalXML, LIBXML_NOBLANKS);

		echo "<h4>Données d'origine</h4>\n";
		$oRoot = $this->_priv_GetNodes('//itop_design')->item(0);
		$oRoot->Dump();

		$oNode = $this->_priv_GetNodes('a/b', $oRoot)->item(0);
		$oNew = $this->oDOMDocument->CreateElement('b', 'New text');
		$this->_priv_ModifyNode($oNode->parentNode, $oNew);		

		$oNode = $this->_priv_GetNodes('a/c', $oRoot)->item(0);
		$oNew = $this->oDOMDocument->CreateElement('c');
		$oNew->setAttribute('id', '1');
		$oNew->appendChild($this->oDOMDocument->CreateElement('d', 'x'));
		$oNew->appendChild($this->oDOMDocument->CreateElement('d', 'y'));
		$oNew->appendChild($this->oDOMDocument->CreateElement('d', 'z'));
		$this->_priv_ModifyNode($oNode->parentNode, $oNew);		

		$oNode = $this->_priv_GetNodes("//a[@id='second a']", $oRoot)->item(0);
		$this->_priv_RenameNode($oNode, 'el secundo A');		
		$oNew = $this->oDOMDocument->CreateElement('e', 'Something new here');
		$this->_priv_AddNode($oNode, $oNew);		
		$oNew = $this->oDOMDocument->CreateElement('a');
		$oNew->setAttribute('id', 'new a');
		$oNew->appendChild($this->oDOMDocument->CreateElement('parent', 'el secundo A'));
		$oNew->appendChild($this->oDOMDocument->CreateElement('f', 'Welcome to the newcomer'));
		$this->_priv_AddNode($oNode, $oNew);		

		$oNode = $this->_priv_GetNodes("//a[@id='third a']", $oRoot)->item(0);
		$this->_priv_RemoveNode($oNode);		

		echo "<h4>Après modifications (avec les APIs de ModelFactory)</h4>\n";
		$oRoot->Dump();
		
		echo "<h4>Delta calculé</h4>\n";
		$sDeltaXML = $this->GetDelta();
		echo "<pre>\n";
		echo htmlentities($sDeltaXML);
		echo "</pre>\n";

		echo "<h4>Réitération: on recharge le modèle épuré</h4>\n";
		$this->oDOMDocument = new DOMDocument('1.0', 'UTF-8');
		$this->oDOMDocument->registerNodeClass('DOMElement', 'MFElement');
		$this->oDOMDocument->loadXML($sOriginalXML, LIBXML_NOBLANKS);
		$oRoot = $this->_priv_GetNodes('//itop_design')->item(0);
		$oRoot->Dump();

		echo "<h4>On lui applique le delta calculé vu ci-dessus, et on obtient...</h4>\n";
		$oDeltaDoc = new DOMDocument('1.0', 'UTF-8');
		$oDeltaDoc->registerNodeClass('DOMElement', 'MFElement');
		$oDeltaDoc->loadXML($sDeltaXML, LIBXML_NOBLANKS);
		$oDeltaRoot = $oDeltaDoc->childNodes->item(0);
		$this->LoadDelta($oDeltaDoc, $oDeltaRoot, $this->oDOMDocument);
		$oRoot->Dump();
	} // TEST !


	/**
	 * Extracts some nodes from the DOM
	 * @param string $sXPath A XPath expression
	 * @return DOMNodeList
	 */
	public function _priv_GetNodes($sXPath, $oContextNode = null)
	{
		$oXPath = new DOMXPath($this->oDOMDocument);
		
		if (is_null($oContextNode))
		{
			return $oXPath->query($sXPath);
		}
		else
		{
			return $oXPath->query($sXPath, $oContextNode);
		}
	}
}


/**
 * MFElement: helper to read the information from the DOM
 * @package ModelFactory
 */
class MFElement extends DOMElement
{
	/**
	 * For debugging purposes
	 */
	public function Dump()
	{
		$this->ownerDocument->formatOutput = true; // indent (must by loaded with option LIBXML_NOBLANKS)
		$this->ownerDocument->preserveWhiteSpace = true; // otherwise the formatOutput option would have no effect
		echo "<pre>\n";	 	
		echo htmlentities($this->ownerDocument->saveXML($this));
		echo "</pre>\n";	 	
	}

	/**
	 * Returns the node directly under the given node 
	 */ 
	public function GetUniqueElement($sTagName, $bMustExist = true)
	{
		$oNode = null;
		foreach($this->childNodes as $oChildNode)
		{
			if ($oChildNode->nodeName == $sTagName)
			{
				$oNode = $oChildNode;
				break;
			}
		}
		if ($bMustExist && is_null($oNode))
		{
			throw new DOMFormatException('Missing unique tag: '.$sTagName);
		}
		return $oNode;
	}
	
	/**
	 * Returns the node directly under the current node, or null if missing 
	 */ 
	public function GetOptionalElement($sTagName)
	{
		return $this->GetUniqueElement($sTagName, false);
	}
	
	
	/**
	 * Returns the TEXT of the current node (possibly from several subnodes) 
	 */ 
	public function GetText($sDefault = null)
	{
		$sText = null;
		foreach($this->childNodes as $oChildNode)
		{
			if ($oChildNode instanceof DOMCharacterData) // Base class of DOMText and DOMCdataSection
			{
				if (is_null($sText)) $sText = '';
				$sText .= $oChildNode->wholeText;
			}
		}
		if (is_null($sText))
		{
			return $sDefault;
		}
		else
		{
			return $sText;
		}
	}
	
	/**
	 * Get the TEXT value from the child node 
	 */ 
	public function GetChildText($sTagName, $sDefault = null)
	{
		$sRet = $sDefault;
		if ($oChild = $this->GetOptionalElement($sTagName))
		{
			$sRet = $oChild->GetText($sDefault);
		}
		return $sRet;
	}

	/**
	 * Assumes the current node to be either a text or
	 * <items>
	 *   <item [key]="..."]>value<item>
	 *   <item [key]="..."]>value<item>
	 * </items>
	 * where value can be the either a text or an array of items... recursively 
	 * Returns a PHP array 
	 */ 
	public function GetNodeAsArrayOfItems()
	{
		$oItems = $this->GetOptionalElement('items');
		if ($oItems)
		{
			$res = array();
			foreach($oItems->childNodes as $oItem)
			{
				// When an attribute is missing
				if ($oItem->hasAttribute('id'))
				{
					$key = $oItem->getAttribute('id');
					$res[$key] = $oItem->GetNodeAsArrayOfItems();
				}
				else
				{
					$res[] = $oItem->GetNodeAsArrayOfItems();
				}
			}
		}
		else
		{
			$res = $this->GetText();
		}
		return $res;
	}

	/**
	 * Helper to remove child nodes	
	 */	
	public function DeleteChildren()
	{
		while (isset($this->firstChild))
		{
			if ($this->firstChild instanceof MFElement)
			{
				$this->firstChild->DeleteChildren();
			}
			$this->removeChild($this->firstChild);
		}
	} 
}