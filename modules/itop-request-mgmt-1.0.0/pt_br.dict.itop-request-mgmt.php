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
 * Localized data
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:RequestManagement' => 'Help Desk',
	'Menu:RequestManagement+' => 'Help Desk',
	'Menu:UserRequest:Overview' => 'Vis&atilde;o geral',
	'Menu:UserRequest:Overview+' => 'Vis&atilde;o geral',
	'Menu:NewUserRequest' => 'Novo Chamado',
	'Menu:NewUserRequest+' => 'Novo Chamado',
	'Menu:SearchUserRequests' => 'Pesquisa para Chamados',
	'Menu:SearchUserRequests+' => 'Pesquisa para Chamados',
	'Menu:UserRequest:Shortcuts' => 'Atalhos',
	'Menu:UserRequest:Shortcuts+' => '',
	'Menu:UserRequest:MyRequests' => 'Chamados atribu&aacute;dos para mim',
	'Menu:UserRequest:MyRequests+' => 'Chamados atribu&aacute;dos para mim (como Agente)',
	'Menu:UserRequest:EscalatedRequests' => 'Chamados encaminhados',
	'Menu:UserRequest:EscalatedRequests+' => 'Chamados encaminhados',
	'Menu:UserRequest:OpenRequests' => 'Todos chamados abertos',
	'Menu:UserRequest:OpenRequests+' => 'Todos chamados abertos',
));

// Dictionnay conventions
// Class:<class_name>
// Class:<class_name>+
// Class:<class_name>/Attribute:<attribute_code>
// Class:<class_name>/Attribute:<attribute_code>+
// Class:<class_name>/Attribute:<attribute_code>/Value:<value>
// Class:<class_name>/Attribute:<attribute_code>/Value:<value>+
// Class:<class_name>/Stimulus:<stimulus_code>
// Class:<class_name>/Stimulus:<stimulus_code>+

//
// Class: UserRequest
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:UserRequest' => 'Usu&aacute;rio solicitante',
	'Class:UserRequest+' => '',
	'Class:UserRequest/Attribute:freeze_reason' => 'Pending reason',
	'Class:UserRequest/Attribute:freeze_reason+' => '',
	'Class:UserRequest/Stimulus:ev_assign' => 'Atribu&iacute;r',
	'Class:UserRequest/Stimulus:ev_assign+' => '',
	'Class:UserRequest/Stimulus:ev_freeze' => 'Marque como pendente',
	'Class:UserRequest/Stimulus:ev_freeze+' => '',
	'Class:UserRequest/Stimulus:ev_reassign' => 'Re-atribu&iacute;r',
	'Class:UserRequest/Stimulus:ev_reassign+' => '',
	'Class:UserRequest/Stimulus:ev_timeout' => 'ev_timeout',
	'Class:UserRequest/Stimulus:ev_timeout+' => '',
	'Class:UserRequest/Stimulus:ev_resolve' => 'Marque como resolvido',
	'Class:UserRequest/Stimulus:ev_resolve+' => '',
	'Class:UserRequest/Stimulus:ev_close' => 'Fechado',
	'Class:UserRequest/Stimulus:ev_close+' => '',
));

?>
