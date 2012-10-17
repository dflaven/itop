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

/**
 * @author	Erwan Taloc <erwan.taloc@combodo.com>
 * @author	Romain Quetiez <romain.quetiez@combodo.com>
 * @author	Denis Flaven <denis.flaven@combodo.com>
 * @licence	http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:ProviderContract' => 'Contrat fournisseur',
	'Class:ProviderContract+' => '',
	'Class:ProviderContract/Attribute:provider_id' => 'Fournisseur',
	'Class:ProviderContract/Attribute:provider_id+' => '',
	'Class:ProviderContract/Attribute:provider_name' => 'Fournisseur',
	'Class:ProviderContract/Attribute:provider_name+' => '',
	'Class:ProviderContract/Attribute:sla' => 'Niveau de service',
	'Class:ProviderContract/Attribute:sla+' => 'Accord de niveau de service (SLA)',
	'Class:ProviderContract/Attribute:coverage' => 'Couverture',
	'Class:ProviderContract/Attribute:coverage+' => '',
	'Class:CustomerContract' => 'Contrat client',
	'Class:CustomerContract+' => '',
	'Class:CustomerContract/Attribute:org_id' => 'Client',
	'Class:CustomerContract/Attribute:org_id+' => '',
	'Class:CustomerContract/Attribute:org_name' => 'Client',
	'Class:CustomerContract/Attribute:org_name+' => '',
	'Class:CustomerContract/Attribute:provider_id' => 'Fournisseur',
	'Class:CustomerContract/Attribute:provider_id+' => '',
	'Class:CustomerContract/Attribute:provider_name' => 'Fournisseur',
	'Class:CustomerContract/Attribute:provider_name+' => '',
	'Class:CustomerContract/Attribute:support_team_id' => 'Equipe de support',
	'Class:CustomerContract/Attribute:support_team_id+' => '',
	'Class:CustomerContract/Attribute:support_team_name' => 'Equipe de support',
	'Class:CustomerContract/Attribute:support_team_name+' => '',
	'Class:CustomerContract/Attribute:sla_list' => 'Niveaux de service',
	'Class:CustomerContract/Attribute:sla_list+' => 'Accords de niveau de service',
	'Class:CustomerContract/Attribute:provider_list' => 'Fournisseurs',
	'Class:CustomerContract/Attribute:provider_list+' => '',
	'Class:lnkCustomerContractToProviderContract' => 'lien Contact Client Contrat Fournisseur',
	'Class:lnkCustomerContractToProviderContract+' => '',
	'Class:lnkCustomerContractToProviderContract/Attribute:customer_contract_id' => 'Contrat Client',
	'Class:lnkCustomerContractToProviderContract/Attribute:customer_contract_id+' => '',
	'Class:lnkCustomerContractToProviderContract/Attribute:customer_contract_name' => 'Nom',
	'Class:lnkCustomerContractToProviderContract/Attribute:customer_contract_name+' => '',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_contract_id' => 'Contrat Fournisseur',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_contract_id+' => '',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_contract_name' => 'Nom',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_contract_name+' => '',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_sla' => 'Niveau de service du fournisseur',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_sla+' => '',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_coverage' => 'Heures d\'ouverture',
	'Class:lnkCustomerContractToProviderContract/Attribute:provider_coverage+' => '',
	'Class:lnkContractToSLA' => 'Contrat/SLA',
	'Class:lnkContractToSLA+' => '',
	'Class:lnkContractToSLA/Attribute:contract_id' => 'Contrat',
	'Class:lnkContractToSLA/Attribute:contract_id+' => '',
	'Class:lnkContractToSLA/Attribute:contract_name' => 'Contrat',
	'Class:lnkContractToSLA/Attribute:contract_name+' => '',
	'Class:lnkContractToSLA/Attribute:sla_id' => 'Niveau de service',
	'Class:lnkContractToSLA/Attribute:sla_id+' => '',
	'Class:lnkContractToSLA/Attribute:sla_name' => 'Niveau de service',
	'Class:lnkContractToSLA/Attribute:sla_name+' => '',
	'Class:lnkContractToSLA/Attribute:sla_service_name' => 'Niveau de service',
	'Class:lnkContractToSLA/Attribute:sla_service_name+' => '',
	'Class:lnkContractToSLA/Attribute:coverage' => 'Couverture',
	'Class:lnkContractToSLA/Attribute:coverage+' => '',
	'Class:lnkContractToDoc' => 'Contrat/Document',
	'Class:lnkContractToDoc+' => '',
	'Class:lnkContractToDoc/Attribute:contract_id' => 'Contrat',
	'Class:lnkContractToDoc/Attribute:contract_id+' => '',
	'Class:lnkContractToDoc/Attribute:contract_name' => 'Contrat',
	'Class:lnkContractToDoc/Attribute:contract_name+' => '',
	'Class:lnkContractToDoc/Attribute:document_id' => 'Document',
	'Class:lnkContractToDoc/Attribute:document_id+' => '',
	'Class:lnkContractToDoc/Attribute:document_name' => 'Document',
	'Class:lnkContractToDoc/Attribute:document_name+' => '',
	'Class:lnkContractToDoc/Attribute:document_type' => 'Type du document',
	'Class:lnkContractToDoc/Attribute:document_type+' => '',
	'Class:lnkContractToDoc/Attribute:document_status' => 'Etat du document',
	'Class:lnkContractToDoc/Attribute:document_status+' => '',
	'Class:lnkContractToContact' => 'Contrat/Contact',
	'Class:lnkContractToContact+' => '',
	'Class:lnkContractToContact/Attribute:contract_id' => 'Contrat',
	'Class:lnkContractToContact/Attribute:contract_id+' => '',
	'Class:lnkContractToContact/Attribute:contract_name' => 'Contrat',
	'Class:lnkContractToContact/Attribute:contract_name+' => '',
	'Class:lnkContractToContact/Attribute:contact_id' => 'Contact',
	'Class:lnkContractToContact/Attribute:contact_id+' => '',
	'Class:lnkContractToContact/Attribute:contact_name' => 'Contact',
	'Class:lnkContractToContact/Attribute:contact_name+' => '',
	'Class:lnkContractToContact/Attribute:contact_email' => 'Email du contact',
	'Class:lnkContractToContact/Attribute:contact_email+' => '',
	'Class:lnkContractToContact/Attribute:role' => 'Rôle',
	'Class:lnkContractToContact/Attribute:role+' => '',
	'Class:lnkContractToCI' => 'Contrat/CI',
	'Class:lnkContractToCI+' => '',
	'Class:lnkContractToCI/Attribute:contract_id' => 'Contrat',
	'Class:lnkContractToCI/Attribute:contract_id+' => '',
	'Class:lnkContractToCI/Attribute:contract_name' => 'Contrat',
	'Class:lnkContractToCI/Attribute:contract_name+' => '',
	'Class:lnkContractToCI/Attribute:ci_id' => 'CI',
	'Class:lnkContractToCI/Attribute:ci_id+' => '',
	'Class:lnkContractToCI/Attribute:ci_name' => 'CI',
	'Class:lnkContractToCI/Attribute:ci_name+' => '',
	'Class:lnkContractToCI/Attribute:ci_status' => 'Etat du CI',
	'Class:lnkContractToCI/Attribute:ci_status+' => '',
	'Class:Service' => 'Service',
	'Class:Service+' => '',
	'Class:Service/Attribute:org_id' => 'Fournisseur',
	'Class:Service/Attribute:org_id+' => '',
	'Class:Service/Attribute:provider_name' => 'Fournisseur',
	'Class:Service/Attribute:provider_name+' => '',
	'Class:Service/Attribute:name' => 'Nom',
	'Class:Service/Attribute:name+' => '',
	'Class:Service/Attribute:description' => 'Description',
	'Class:Service/Attribute:description+' => '',
	'Class:Service/Attribute:type' => 'Type',
	'Class:Service/Attribute:type+' => '',
	'Class:Service/Attribute:type/Value:IncidentManagement' => 'Gestion d\'incident',
	'Class:Service/Attribute:type/Value:IncidentManagement+' => '',
	'Class:Service/Attribute:type/Value:RequestManagement' => 'Gestion des demandes utilisateurs',
	'Class:Service/Attribute:type/Value:RequestManagement+' => '',
	'Class:Service/Attribute:status' => 'Etat',
	'Class:Service/Attribute:status+' => '',
	'Class:Service/Attribute:status/Value:design' => 'En conception',
	'Class:Service/Attribute:status/Value:design+' => '',
	'Class:Service/Attribute:status/Value:obsolete' => 'Obsolète',
	'Class:Service/Attribute:status/Value:obsolete+' => '',
	'Class:Service/Attribute:status/Value:production' => 'En production',
	'Class:Service/Attribute:status/Value:production+' => '',
	'Class:Service/Attribute:subcategory_list' => 'Eléments de service',
	'Class:Service/Attribute:subcategory_list+' => '',
	'Class:Service/Attribute:sla_list' => 'Niveaux de service',
	'Class:Service/Attribute:sla_list+' => '',
	'Class:Service/Attribute:document_list' => 'Documents',
	'Class:Service/Attribute:document_list+' => 'Documents liés au service',
	'Class:Service/Attribute:contact_list' => 'Contacts',
	'Class:Service/Attribute:contact_list+' => 'Contacts ayant un rôle pour ce service',
	'Class:ServiceSubcategory' => 'Elément de service',
	'Class:ServiceSubcategory+' => '',
	'Class:ServiceSubcategory/Attribute:name' => 'Nom',
	'Class:ServiceSubcategory/Attribute:name+' => '',
	'Class:ServiceSubcategory/Attribute:description' => 'Description',
	'Class:ServiceSubcategory/Attribute:description+' => '',
	'Class:ServiceSubcategory/Attribute:service_id' => 'Service',
	'Class:ServiceSubcategory/Attribute:service_id+' => '',
	'Class:ServiceSubcategory/Attribute:service_name' => 'Service',
	'Class:ServiceSubcategory/Attribute:service_name+' => '',
	'Class:ServiceSubcategory/Attribute:org_id' => 'Organisation',
	'Class:ServiceSubcategory/Attribute:org_id+' => '',
	'Class:ServiceSubcategory/Attribute:provider_name' => 'Fournisseur',
	'Class:ServiceSubcategory/Attribute:provider_name+' => '',
	'Class:SLA' => 'Niveau de service',
	'Class:SLA+' => '',
	'Class:SLA/Attribute:name' => 'Nom',
	'Class:SLA/Attribute:name+' => '',
	'Class:SLA/Attribute:service_id' => 'Service',
	'Class:SLA/Attribute:service_id+' => '',
	'Class:SLA/Attribute:service_name' => 'Service',
	'Class:SLA/Attribute:service_name+' => '',
	'Class:SLA/Attribute:slt_list' => 'SLTs',
	'Class:SLA/Attribute:slt_list+' => 'Objectifs de niveau de service (SLTs)',
	'Class:SLT' => 'SLT',
	'Class:SLT+' => 'Objectif de niveau de service (SLT)',
	'Class:SLT/Attribute:name' => 'Nom',
	'Class:SLT/Attribute:name+' => '',
	'Class:SLT/Attribute:metric' => 'Métrique',
	'Class:SLT/Attribute:metric+' => '',
	'Class:SLT/Attribute:metric/Value:TTO' => 'Limite d\'assignation',
	'Class:SLT/Attribute:metric/Value:TTO+' => 'Limite d\'assignation (TTO)',
	'Class:SLT/Attribute:metric/Value:TTR' => 'Limite de résolution',
	'Class:SLT/Attribute:metric/Value:TTR+' => 'Limite de résolution (TTR)',
	'Class:SLT/Attribute:ticket_priority' => 'Priorité du ticket',
	'Class:SLT/Attribute:ticket_priority+' => '',
	'Class:SLT/Attribute:ticket_priority/Value:1' => '1',
	'Class:SLT/Attribute:ticket_priority/Value:1+' => '1',
	'Class:SLT/Attribute:ticket_priority/Value:2' => '2',
	'Class:SLT/Attribute:ticket_priority/Value:2+' => '2',
	'Class:SLT/Attribute:ticket_priority/Value:3' => '3',
	'Class:SLT/Attribute:ticket_priority/Value:3+' => '3',
	'Class:SLT/Attribute:value' => 'Valeur',
	'Class:SLT/Attribute:value+' => '',
	'Class:SLT/Attribute:value_unit' => 'Unité',
	'Class:SLT/Attribute:value_unit+' => '',
	'Class:SLT/Attribute:value_unit/Value:days' => 'jours',
	'Class:SLT/Attribute:value_unit/Value:days+' => '',
	'Class:SLT/Attribute:value_unit/Value:hours' => 'heures',
	'Class:SLT/Attribute:value_unit/Value:hours+' => '',
	'Class:SLT/Attribute:value_unit/Value:minutes' => 'minutes',
	'Class:SLT/Attribute:value_unit/Value:minutes+' => '',
	'Class:SLT/Attribute:sla_list' => 'Niveaux de service',
	'Class:SLT/Attribute:sla_list+' => 'Accords de niveau de service utilisant cet objectif',
	'Class:lnkSLTToSLA' => 'lien SLT/SLA',
	'Class:lnkSLTToSLA+' => '',
	'Class:lnkSLTToSLA/Attribute:sla_id' => 'SLA',
	'Class:lnkSLTToSLA/Attribute:sla_id+' => '',
	'Class:lnkSLTToSLA/Attribute:sla_name' => 'SLA',
	'Class:lnkSLTToSLA/Attribute:sla_name+' => '',
	'Class:lnkSLTToSLA/Attribute:slt_id' => 'SLT',
	'Class:lnkSLTToSLA/Attribute:slt_id+' => '',
	'Class:lnkSLTToSLA/Attribute:slt_name' => 'SLT',
	'Class:lnkSLTToSLA/Attribute:slt_name+' => '',
	'Class:lnkSLTToSLA/Attribute:slt_metric' => 'Métrique',
	'Class:lnkSLTToSLA/Attribute:slt_metric+' => '',
	'Class:lnkSLTToSLA/Attribute:slt_ticket_priority' => 'Priorité du ticket',
	'Class:lnkSLTToSLA/Attribute:slt_ticket_priority+' => '',
	'Class:lnkSLTToSLA/Attribute:slt_value' => 'Valeur',
	'Class:lnkSLTToSLA/Attribute:slt_value+' => '',
	'Class:lnkSLTToSLA/Attribute:slt_value_unit' => 'Unité',
	'Class:lnkSLTToSLA/Attribute:slt_value_unit+' => '',
	'Class:lnkServiceToDoc' => 'Service/Document',
	'Class:lnkServiceToDoc+' => '',
	'Class:lnkServiceToDoc/Attribute:service_id' => 'Service',
	'Class:lnkServiceToDoc/Attribute:service_id+' => '',
	'Class:lnkServiceToDoc/Attribute:service_name' => 'Service',
	'Class:lnkServiceToDoc/Attribute:service_name+' => '',
	'Class:lnkServiceToDoc/Attribute:document_id' => 'Document',
	'Class:lnkServiceToDoc/Attribute:document_id+' => '',
	'Class:lnkServiceToDoc/Attribute:document_name' => 'Document',
	'Class:lnkServiceToDoc/Attribute:document_name+' => '',
	'Class:lnkServiceToDoc/Attribute:document_type' => 'Type du Document',
	'Class:lnkServiceToDoc/Attribute:document_type+' => '',
	'Class:lnkServiceToDoc/Attribute:document_status' => 'Etat du Document',
	'Class:lnkServiceToDoc/Attribute:document_status+' => '',
	'Class:lnkServiceToContact' => 'Service/Contact',
	'Class:lnkServiceToContact+' => '',
	'Class:lnkServiceToContact/Attribute:service_id' => 'Service',
	'Class:lnkServiceToContact/Attribute:service_id+' => '',
	'Class:lnkServiceToContact/Attribute:service_name' => 'Service',
	'Class:lnkServiceToContact/Attribute:service_name+' => '',
	'Class:lnkServiceToContact/Attribute:contact_id' => 'Contact',
	'Class:lnkServiceToContact/Attribute:contact_id+' => '',
	'Class:lnkServiceToContact/Attribute:contact_name' => 'Contact',
	'Class:lnkServiceToContact/Attribute:contact_name+' => '',
	'Class:lnkServiceToContact/Attribute:contact_email' => 'Email du Contact',
	'Class:lnkServiceToContact/Attribute:contact_email+' => '',
	'Class:lnkServiceToContact/Attribute:role' => 'Rôle',
	'Class:lnkServiceToContact/Attribute:role+' => '',
	'Class:lnkServiceToCI' => 'Service/CI',
	'Class:lnkServiceToCI+' => '',
	'Class:lnkServiceToCI/Attribute:service_id' => 'Service',
	'Class:lnkServiceToCI/Attribute:service_id+' => '',
	'Class:lnkServiceToCI/Attribute:service_name' => 'Service',
	'Class:lnkServiceToCI/Attribute:service_name+' => '',
	'Class:lnkServiceToCI/Attribute:ci_id' => 'CI',
	'Class:lnkServiceToCI/Attribute:ci_id+' => '',
	'Class:lnkServiceToCI/Attribute:ci_name' => 'CI',
	'Class:lnkServiceToCI/Attribute:ci_name+' => '',
	'Class:lnkServiceToCI/Attribute:ci_status' => 'Etat du CI',
	'Class:lnkServiceToCI/Attribute:ci_status+' => '',
	'Menu:ServiceManagement' => 'Gestion des services',
	'Menu:ServiceManagement+' => '',
	'Menu:Service:Overview' => 'Vue d\'ensemble',
	'Menu:Service:Overview+' => 'Vue d\'ensemble de la Gestion des Services',
	'UI-ServiceManagementMenu-ContractsBySrvLevel' => 'Contrats, par niveau de service',
	'UI-ServiceManagementMenu-ContractsByStatus' => 'Contrats, par état',
	'UI-ServiceManagementMenu-ContractsEndingIn30Days' => 'Contrats se terminant dans moins d\'un mois',
	'Menu:ServiceType' => 'Types de services',
	'Menu:ServiceType+' => 'Types de services',
	'Menu:ProviderContract' => 'Contrats fournisseurs',
	'Menu:ProviderContract+' => 'Contrats fournisseurs',
	'Menu:CustomerContract' => 'Contrats clients',
	'Menu:CustomerContract+' => 'Contrats clients',
	'Menu:ServiceSubcategory' => 'Eléments de service',
	'Menu:ServiceSubcategory+' => 'Eléments de service',
	'Menu:Service' => 'Services',
	'Menu:Service+' => 'Services',
	'Menu:SLA' => 'SLAs',
	'Menu:SLA+' => 'Accords de niveau de service (SLA)',
	'Menu:SLT' => 'SLTs',
	'Menu:SLT+' => 'Objectifs de niveau de service (SLT)',
	'Class:Contract' => 'Contrat',
	'Class:Contract+' => '',
	'Class:Contract/Attribute:name' => 'Nom',
	'Class:Contract/Attribute:name+' => '',
	'Class:Contract/Attribute:description' => 'Description',
	'Class:Contract/Attribute:description+' => '',
	'Class:Contract/Attribute:start_date' => 'Date de début',
	'Class:Contract/Attribute:start_date+' => '',
	'Class:Contract/Attribute:end_date' => 'Date de fin',
	'Class:Contract/Attribute:end_date+' => '',
	'Class:Contract/Attribute:cost' => 'Coût',
	'Class:Contract/Attribute:cost+' => '',
	'Class:Contract/Attribute:cost_currency' => 'Monnaie',
	'Class:Contract/Attribute:cost_currency+' => '',
	'Class:Contract/Attribute:cost_currency/Value:dollars' => 'Dollars',
	'Class:Contract/Attribute:cost_currency/Value:dollars+' => '',
	'Class:Contract/Attribute:cost_currency/Value:euros' => 'Euros',
	'Class:Contract/Attribute:cost_currency/Value:euros+' => '',
	'Class:Contract/Attribute:cost_unit' => 'Unité de coût',
	'Class:Contract/Attribute:cost_unit+' => '',
	'Class:Contract/Attribute:billing_frequency' => 'Périodicité de facturation',
	'Class:Contract/Attribute:billing_frequency+' => '',
	'Class:Contract/Attribute:contact_list' => 'Contacts',
	'Class:Contract/Attribute:contact_list+' => 'Contacts liés au contrat',
	'Class:Contract/Attribute:document_list' => 'Documents',
	'Class:Contract/Attribute:document_list+' => 'Documents liés au contrat',
	'Class:Contract/Attribute:ci_list' => 'CIs',
	'Class:Contract/Attribute:ci_list+' => 'CI faisant l\'objet du contrat',
	'Class:Contract/Attribute:finalclass' => 'Type',
	'Class:Contract/Attribute:finalclass+' => '',
	'Class:Service/Tab:Related_Contracts' => 'Contrats liés',
	'Class:Service/Tab:Related_Contracts+' => '',
));
?>