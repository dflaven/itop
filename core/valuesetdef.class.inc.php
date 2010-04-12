<?php

/**
 * ValueSetDefinition
 * value sets API and implementations
 *
 * @package     iTopORM
 * @author      Romain Quetiez <romainquetiez@yahoo.fr>
 * @author      Denis Flaven <denisflave@free.fr>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.itop.com
 * @since       1.0
 * @version     1.1.1.1 $
 */

require_once('MyHelpers.class.inc.php');

abstract class ValueSetDefinition
{
	protected $m_bIsLoaded = false;
	protected $m_aValues = array();


	// Displayable description that could be computed out of the std usage context
	public function GetValuesDescription()
	{
		$aValues = $this->GetValues(array(), '');
		$aDisplayedValues = array();
		foreach($aValues as $key => $value)
		{
			$aDisplayedValues[] = "$key => $value";
		}
		$sAllowedValues = implode(', ', $aDisplayedValues);
		return $sAllowedValues;
	}


	public function GetValues($aArgs, $sBeginsWith = '')
	{
		if (!$this->m_bIsLoaded)
		{
			$this->LoadValues($aArgs);
			$this->m_bIsLoaded = true;
		}
		if (strlen($sBeginsWith) == 0)
		{
			$aRet = $this->m_aValues;
		}
		else
		{
			$iCheckedLen = strlen($sBeginsWith);
			$sBeginsWith = strtolower($sBeginsWith);
			$aRet = array();
			foreach ($this->m_aValues as $sKey=>$sValue)
			{
				if (strtolower(substr($sValue, 0, $iCheckedLen)) == $sBeginsWith)
				{
					$aRet[$sKey] = $sValue;
				}
			}
		}
		return $aRet;
	}

	abstract protected function LoadValues($aArgs);
}


/**
 * Set of existing values for an attribute, given a search filter 
 *
 * @package     iTopORM
 * @author      Romain Quetiez <romainquetiez@yahoo.fr>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.itop.com
 * @since       1.0
 * @version     $itopversion$
 */
class ValueSetObjects extends ValueSetDefinition
{
	protected $m_sFilterExpr; // in SibuSQL
	protected $m_sValueAttCode;
	protected $m_aOrderBy;

	public function __construct($sFilterExp, $sValueAttCode = '', $aOrderBy = array())
	{
		$this->m_sFilterExpr = $sFilterExp;
		$this->m_sValueAttCode = $sValueAttCode;
		$this->m_aOrderBy = $aOrderBy;
	}

	protected function LoadValues($aArgs)
	{
		$this->m_aValues = array();
		
		$oFilter = DBObjectSearch::FromSibusQL($this->m_sFilterExpr, $aArgs);
		if (!$oFilter) return false;

		$oObjects = new DBObjectSet($oFilter, $this->m_aOrderBy, $aArgs);
		while ($oObject = $oObjects->Fetch())
		{
			if (empty($this->m_sValueAttCode))
			{
				$this->m_aValues[$oObject->GetKey()] = $oObject->GetName();
			}
			else
			{
				$this->m_aValues[$oObject->GetKey()] = $oObject->GetAsHTML($this->m_sValueAttCode);
			}
		}
		return true;
	}
	
	public function GetValuesDescription()
	{
		return 'Filter: '.$this->m_sFilterExpr;
	}
}


/**
 * Set of existing values for a link set attribute, given a relation code 
 *
 * @package     iTopORM
 * @author      Romain Quetiez <romainquetiez@yahoo.fr>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.itop.com
 * @since       1.0
 * @version     $itopversion$
 */
class ValueSetRelatedObjectsFromLinkSet extends ValueSetDefinition
{
	protected $m_sLinkSetAttCode;
	protected $m_sExtKeyToRemote;
	protected $m_sRelationCode;
	protected $m_iMaxDepth;
	protected $m_sTargetClass;
	protected $m_sTargetExtKey;
//	protected $m_aOrderBy;

	public function __construct($sLinkSetAttCode, $sExtKeyToRemote, $sRelationCode, $iMaxDepth, $sTargetClass, $sTargetLinkClass, $sTargetExtKey)
	{
		$this->m_sLinkSetAttCode = $sLinkSetAttCode;
		$this->m_sExtKeyToRemote = $sExtKeyToRemote;
		$this->m_sRelationCode = $sRelationCode;
		$this->m_iMaxDepth = $iMaxDepth;
		$this->m_sTargetClass = $sTargetClass;
		$this->m_sTargetLinkClass = $sTargetLinkClass;
		$this->m_sTargetExtKey = $sTargetExtKey;
//		$this->m_aOrderBy = $aOrderBy;
	}

	protected function LoadValues($aArgs)
	{
		$this->m_aValues = array();

		if (!array_key_exists('this', $aArgs))
		{
			throw new CoreException("Missing 'this' in arguments", array('args' => $aArgs));
		}		

		$oTarget = $aArgs['this->object()'];

		// Nodes from which we will start the search for neighbourhood
		$oNodes = DBObjectSet::FromLinkSet($oTarget, $this->m_sLinkSetAttCode, $this->m_sExtKeyToRemote);

		// Neighbours, whatever their class
		$aRelated = $oNodes->GetRelatedObjects($this->m_sRelationCode, $this->m_iMaxDepth);

		$sRootClass = MetaModel::GetRootClass($this->m_sTargetClass);
		if (array_key_exists($sRootClass, $aRelated))
		{
			$aLinksToCreate = array();
			foreach($aRelated[$sRootClass] as $iKey => $oObject)
			{
				if (MetaModel::IsParentClass($this->m_sTargetClass, get_class($oObject)))
				{
					$oNewLink = MetaModel::NewObject($this->m_sTargetLinkClass);
					$oNewLink->Set($this->m_sTargetExtKey, $iKey);
					//$oNewLink->Set('role', 'concerned by an impacted CI');

					$aLinksToCreate[] = $oNewLink;
				}
			}
			// #@# or AddObjectArray($aObjects) ?
			$oSetToCreate = DBObjectSet::FromArray($this->m_sTargetLinkClass, $aLinksToCreate);
			$this->m_aValues[$oObject->GetKey()] = $oObject->GetAsHTML($oObject->GetName());
		}

		return true;
	}
	
	public function GetValuesDescription()
	{
		return 'Filter: '.$this->m_sFilterExpr;
	}
}


/**
 * Fixed set values (could be hardcoded in the business model) 
 *
 * @package     iTopORM
 * @author      Romain Quetiez <romainquetiez@yahoo.fr>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.itop.com
 * @since       1.0
 * @version     $itopversion$
 */
class ValueSetEnum extends ValueSetDefinition
{
	protected $m_values;

	public function __construct($Values)
	{
		$this->m_values = $Values;
	}

	protected function LoadValues($aArgs)
	{
		if (is_array($this->m_values))
		{
			$aValues = $this->m_values;
		}
		else
		{
			$aValues = array();
			foreach (explode(",", $this->m_values) as $sVal)
			{
				$sVal = trim($sVal);
				$sKey = $sVal; 
				$aValues[$sKey] = $sVal;
			}
		}
		$this->m_aValues = $aValues;
		return true;
	}
}


/**
 * Data model classes 
 *
 * @package     iTopORM
 * @author      Romain Quetiez <romainquetiez@yahoo.fr>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.itop.com
 * @since       1.0
 * @version     $itopversion$
 */
class ValueSetEnumClasses extends ValueSetEnum
{
	protected $m_sCategories;

	public function __construct($sCategories = '', $sAdditionalValues = '')
	{
		$this->m_sCategories = $sCategories;
		parent::__construct($sAdditionalValues);
	}

	protected function LoadValues($aArgs)
	{	
		// First, get the additional values
		parent::LoadValues($aArgs);

		// Then, add the classes from the category definition
		foreach (MetaModel::GetClasses($this->m_sCategories) as $sClass)
		{
			$this->m_aValues[$sClass] = MetaModel::GetName($sClass);
		}

		return true;
	}
}

?>
