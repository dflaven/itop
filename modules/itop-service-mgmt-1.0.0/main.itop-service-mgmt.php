<?php
// Copyright (C) 2010 Combodo SARL
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU General Public License as published by
//   the Free Software Foundation; version 3 of the License.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of the GNU General Public License
//   along with this program; if not, write to the Free Software
//   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

$oServiceManagementGroup = new MenuGroup('ServiceManagement', 60 /* fRank */);
$iRank = 0;
new TemplateMenuNode('Service:Overview', dirname(__FILE__).'/overview.html', $oServiceManagementGroup->GetIndex() /* oParent */, $iRank++ /* fRank */);
new OQLMenuNode('ProviderContract', 'SELECT ProviderContract', $oServiceManagementGroup->GetIndex(), $iRank++,true /* bsearch */);
new OQLMenuNode('CustomerContract', 'SELECT CustomerContract', $oServiceManagementGroup->GetIndex(),  $iRank++,true /* bsearch */);
new OQLMenuNode('Service', 'SELECT Service', $oServiceManagementGroup->GetIndex(), $iRank++,true /* bsearch */);
new OQLMenuNode('ServiceSubcategory', 'SELECT ServiceSubcategory', $oServiceManagementGroup->GetIndex(), $iRank++,true /* bsearch */);
new OQLMenuNode('SLA', 'SELECT SLA', $oServiceManagementGroup->GetIndex(), $iRank++,true /* bsearch */);
new OQLMenuNode('SLT', 'SELECT SLT', $oServiceManagementGroup->GetIndex(), $iRank++,true /* bsearch */);

?>
