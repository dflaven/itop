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

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:ActionEmail' => 'E-mail di notifica',
	'Class:ActionEmail+' => '',
	'Class:ActionEmail/Attribute:test_recipient' => 'Test destinatario',
	'Class:ActionEmail/Attribute:test_recipient+' => '',
	'Class:ActionEmail/Attribute:from' => 'Da',
	'Class:ActionEmail/Attribute:from+' => '',
	'Class:ActionEmail/Attribute:reply_to' => 'Rispondi A',
	'Class:ActionEmail/Attribute:reply_to+' => '',
	'Class:ActionEmail/Attribute:to' => 'A',
	'Class:ActionEmail/Attribute:to+' => '',
	'Class:ActionEmail/Attribute:cc' => 'Cc',
	'Class:ActionEmail/Attribute:cc+' => '',
	'Class:ActionEmail/Attribute:bcc' => 'BCC',
	'Class:ActionEmail/Attribute:bcc+' => '',
	'Class:ActionEmail/Attribute:subject' => 'Oggetto',
	'Class:ActionEmail/Attribute:subject+' => '',
	'Class:ActionEmail/Attribute:body' => 'corpo',
	'Class:ActionEmail/Attribute:body+' => '',
	'Class:ActionEmail/Attribute:importance' => 'priorità',
	'Class:ActionEmail/Attribute:importance+' => '',
	'Class:ActionEmail/Attribute:importance/Value:high' => 'alta',
	'Class:ActionEmail/Attribute:importance/Value:high+' => '',
	'Class:ActionEmail/Attribute:importance/Value:low' => 'bassa',
	'Class:ActionEmail/Attribute:importance/Value:low+' => '',
	'Class:ActionEmail/Attribute:importance/Value:normal' => 'normake',
	'Class:ActionEmail/Attribute:importance/Value:normal+' => '',
	'Class:TriggerOnStateEnter' => 'Trigger (sull\'entrare in uno stato)',
	'Class:TriggerOnStateEnter+' => '',
	'Class:TriggerOnStateLeave' => 'Trigger (sul lasciare uno stato)~~',
	'Class:TriggerOnStateLeave+' => '',
	'Class:TriggerOnObjectCreate' => 'Trigger (sulla creazione di un oggetto)~~',
	'Class:TriggerOnObjectCreate+' => '',
	'Class:lnkTriggerAction' => 'Azione/Trigger~~',
	'Class:lnkTriggerAction+' => '',
	'Class:lnkTriggerAction/Attribute:action_id' => 'Azione',
	'Class:lnkTriggerAction/Attribute:action_id+' => '',
	'Class:lnkTriggerAction/Attribute:trigger_id' => 'Trigger',
	'Class:lnkTriggerAction/Attribute:trigger_id+' => '',
	'Class:lnkTriggerAction/Attribute:order' => 'Ordine',
	'Class:lnkTriggerAction/Attribute:order+' => '',
	'Class:AsyncSendEmail' => 'Email (asincrona)',
	'Class:AsyncSendEmail/Attribute:to' => 'A',
	'Class:AsyncSendEmail/Attribute:subject' => 'Oggetto',
	'Class:AsyncSendEmail/Attribute:body' => 'Corpo',
	'Class:AsyncSendEmail/Attribute:header' => 'Intestazione',
	'Class:CMDBChange' => 'Cambio',
	'Class:CMDBChange+' => '',
	'Class:CMDBChange/Attribute:date' => 'data',
	'Class:CMDBChange/Attribute:date+' => '',
	'Class:CMDBChange/Attribute:userinfo' => 'info varie',
	'Class:CMDBChange/Attribute:userinfo+' => '',
	'Class:CMDBChangeOp' => 'Operazione di Cambio',
	'Class:CMDBChangeOp+' => '',
	'Class:CMDBChangeOp/Attribute:change' => 'cambio',
	'Class:CMDBChangeOp/Attribute:change+' => '',
	'Class:CMDBChangeOp/Attribute:objclass' => 'oggetto della classe',
	'Class:CMDBChangeOp/Attribute:objclass+' => '',
	'Class:CMDBChangeOp/Attribute:objkey' => 'oggetto id',
	'Class:CMDBChangeOp/Attribute:objkey+' => '',
	'Class:CMDBChangeOp/Attribute:finalclass' => 'tipo',
	'Class:CMDBChangeOp/Attribute:finalclass+' => '',
	'Class:CMDBChangeOpCreate' => 'creazione dell\'oggetto',
	'Class:CMDBChangeOpCreate+' => '',
	'Class:CMDBChangeOpDelete' => 'cancellazione dell\'oggetto',
	'Class:CMDBChangeOpDelete+' => '',
	'Class:CMDBChangeOpSetAttribute' => 'cambio dell\'oggetto',
	'Class:CMDBChangeOpSetAttribute+' => '',
	'Class:CMDBChangeOpSetAttribute/Attribute:attcode' => 'Attributo',
	'Class:CMDBChangeOpSetAttribute/Attribute:attcode+' => '',
	'Class:CMDBChangeOpSetAttributeScalar' => 'cambio della proprietà',
	'Class:CMDBChangeOpSetAttributeScalar+' => '',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:oldvalue' => 'Valore precedente',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:oldvalue+' => '',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:newvalue' => 'Valore Nuovo',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:newvalue+' => '',
	'Class:CMDBChangeOpSetAttributeBlob' => 'modifica i dati',
	'Class:CMDBChangeOpSetAttributeBlob+' => '',
	'Class:CMDBChangeOpSetAttributeBlob/Attribute:prevdata' => 'Dati precedenti',
	'Class:CMDBChangeOpSetAttributeBlob/Attribute:prevdata+' => '',
	'Class:CMDBChangeOpSetAttributeOneWayPassword' => 'Password criptata',
	'Class:CMDBChangeOpSetAttributeOneWayPassword/Attribute:prev_pwd' => 'Valore Precedente',
	'Class:CMDBChangeOpSetAttributeEncrypted' => 'Encrypted Field~~',
	'Class:CMDBChangeOpSetAttributeEncrypted/Attribute:prevstring' => 'Valore Precedente',
	'Class:CMDBChangeOpSetAttributeText' => 'modifica testo',
	'Class:CMDBChangeOpSetAttributeText+' => '',
	'Class:CMDBChangeOpSetAttributeText/Attribute:prevdata' => 'Dati precendenti',
	'Class:CMDBChangeOpSetAttributeText/Attribute:prevdata+' => '',
	'Class:CMDBChangeOpSetAttributeCaseLog' => 'Log dei casi',
	'Class:CMDBChangeOpSetAttributeCaseLog/Attribute:lastentry' => 'Ultima entrata',
	'Class:Event' => 'Log dell\'evento',
	'Class:Event+' => '',
	'Class:Event/Attribute:message' => 'Messaggio',
	'Class:Event/Attribute:message+' => '',
	'Class:Event/Attribute:date' => 'Data',
	'Class:Event/Attribute:date+' => '',
	'Class:Event/Attribute:userinfo' => 'Info Utente',
	'Class:Event/Attribute:userinfo+' => '',
	'Class:Event/Attribute:finalclass' => 'Tipo',
	'Class:Event/Attribute:finalclass+' => '',
	'Class:EventNotification' => 'Notifica dell\'evento',
	'Class:EventNotification+' => '',
	'Class:EventNotification/Attribute:trigger_id' => 'Trigger',
	'Class:EventNotification/Attribute:trigger_id+' => '',
	'Class:EventNotification/Attribute:action_id' => 'utente',
	'Class:EventNotification/Attribute:action_id+' => '',
	'Class:EventNotification/Attribute:object_id' => 'Oggetto id',
	'Class:EventNotification/Attribute:object_id+' => '',
	'Class:EventNotificationEmail' => 'Email caso di emissione',
	'Class:EventNotificationEmail+' => '',
	'Class:EventNotificationEmail/Attribute:to' => 'A',
	'Class:EventNotificationEmail/Attribute:to+' => '',
	'Class:EventNotificationEmail/Attribute:cc' => 'CC',
	'Class:EventNotificationEmail/Attribute:cc+' => '',
	'Class:EventNotificationEmail/Attribute:bcc' => 'BCC',
	'Class:EventNotificationEmail/Attribute:bcc+' => '',
	'Class:EventNotificationEmail/Attribute:from' => 'Da',
	'Class:EventNotificationEmail/Attribute:from+' => '',
	'Class:EventNotificationEmail/Attribute:subject' => 'Oggeto',
	'Class:EventNotificationEmail/Attribute:subject+' => '',
	'Class:EventNotificationEmail/Attribute:body' => 'Corpo',
	'Class:EventNotificationEmail/Attribute:body+' => '',
	'Class:EventIssue' => 'Evento Problema',
	'Class:EventIssue+' => '',
	'Class:EventIssue/Attribute:issue' => 'Problema',
	'Class:EventIssue/Attribute:issue+' => '',
	'Class:EventIssue/Attribute:impact' => 'Impatto',
	'Class:EventIssue/Attribute:impact+' => '',
	'Class:EventIssue/Attribute:page' => 'Pagina',
	'Class:EventIssue/Attribute:page+' => '',
	'Class:EventIssue/Attribute:arguments_post' => 'Argomenti inviati',
	'Class:EventIssue/Attribute:arguments_post+' => '',
	'Class:EventIssue/Attribute:arguments_get' => 'Argomenti URL',
	'Class:EventIssue/Attribute:arguments_get+' => '',
	'Class:EventIssue/Attribute:callstack' => 'Callstack',
	'Class:EventIssue/Attribute:callstack+' => '',
	'Class:EventIssue/Attribute:data' => 'Dati',
	'Class:EventIssue/Attribute:data+' => '',
	'Class:EventWebService' => 'Evento Servizio Web',
	'Class:EventWebService+' => '',
	'Class:EventWebService/Attribute:verb' => 'Verbo',
	'Class:EventWebService/Attribute:verb+' => '',
	'Class:EventWebService/Attribute:result' => 'Resulto',
	'Class:EventWebService/Attribute:result+' => '',
	'Class:EventWebService/Attribute:log_info' => 'Log delle info',
	'Class:EventWebService/Attribute:log_info+' => '',
	'Class:EventWebService/Attribute:log_warning' => 'Log dei warning',
	'Class:EventWebService/Attribute:log_warning+' => '',
	'Class:EventWebService/Attribute:log_error' => 'Log degli errori',
	'Class:EventWebService/Attribute:log_error+' => '',
	'Class:EventWebService/Attribute:data' => 'Dati',
	'Class:EventWebService/Attribute:data+' => '',
	'Class:EventLoginUsage' => 'Login di utilizzo',
	'Class:EventLoginUsage+' => '',
	'Class:EventLoginUsage/Attribute:user_id' => 'Login',
	'Class:EventLoginUsage/Attribute:user_id+' => '',
	'Class:SynchroDataSource' => 'Sorgente di sincronizzazione dei dati',
	'Class:SynchroDataSource/Attribute:name' => 'Nome',
	'Class:SynchroDataSource/Attribute:name+' => '',
	'Class:SynchroDataSource/Attribute:description' => 'Descrizione',
	'Class:SynchroDataSource/Attribute:status' => 'Stato',
	'Class:SynchroDataSource/Attribute:status/Value:implementation' => 'Implementazione',
	'Class:SynchroDataSource/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:SynchroDataSource/Attribute:status/Value:production' => 'Produzione',
	'Class:SynchroDataSource/Attribute:user_id' => 'Utente',
	'Class:SynchroDataSource/Attribute:scope_class' => 'Classe Target',
	'Class:SynchroDataSource/Attribute:scope_restriction' => 'Campo di applicazione restrizione',
	'Class:SynchroDataSource/Attribute:full_load_periodicity' => 'Intervallo a pieno carico',
	'Class:SynchroDataSource/Attribute:full_load_periodicity+' => '',
	'Class:SynchroDataSource/Attribute:reconciliation_policy' => 'Policy di riconciliazione',
	'Class:SynchroDataSource/Attribute:reconciliation_policy/Value:use_attributes' => 'Usa gli attributi',
	'Class:SynchroDataSource/Attribute:reconciliation_policy/Value:use_primary_key' => 'Usa il campo chiave primaria',
	'Class:SynchroDataSource/Attribute:action_on_zero' => 'Azione su zero~~',
	'Class:SynchroDataSource/Attribute:action_on_zero+' => '',
	'Class:SynchroDataSource/Attribute:action_on_zero/Value:create' => 'Crea',
	'Class:SynchroDataSource/Attribute:action_on_zero/Value:error' => 'Errore',
	'Class:SynchroDataSource/Attribute:action_on_one' => 'Azione su uno',
	'Class:SynchroDataSource/Attribute:action_on_one+' => '',
	'Class:SynchroDataSource/Attribute:action_on_one/Value:error' => 'Error',
	'Class:SynchroDataSource/Attribute:action_on_one/Value:update' => 'Aggiorna',
	'Class:SynchroDataSource/Attribute:action_on_multiple' => 'Azione su molti',
	'Class:SynchroDataSource/Attribute:action_on_multiple+' => '',
	'Class:SynchroDataSource/Attribute:action_on_multiple/Value:create' => 'Crea',
	'Class:SynchroDataSource/Attribute:action_on_multiple/Value:error' => 'Errore',
	'Class:SynchroDataSource/Attribute:action_on_multiple/Value:take_first' => 'Considera il primo (random?)',
	'Class:SynchroDataSource/Attribute:delete_policy' => 'Policy di cancellazioen',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:delete' => 'Cancella',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:ignore' => 'Ignora',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:update' => 'Aggiorna',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:update_then_delete' => 'Aggiorna e poi Cancella',
	'Class:SynchroDataSource/Attribute:delete_policy_update' => 'Regole per l\'aggiornamento',
	'Class:SynchroDataSource/Attribute:delete_policy_update+' => '',
	'Class:SynchroDataSource/Attribute:delete_policy_retention' => 'Durata di conservazione',
	'Class:SynchroDataSource/Attribute:delete_policy_retention+' => '',
	'Class:SynchroDataSource/Attribute:attribute_list' => 'Lista degli attributi',
	'Class:SynchroDataSource/Attribute:user_delete_policy' => 'utenti autorizzati',
	'Class:SynchroDataSource/Attribute:user_delete_policy+' => '',
	'Class:SynchroDataSource/Attribute:user_delete_policy/Value:administrators' => 'Solo Amministratore',
	'Class:SynchroDataSource/Attribute:user_delete_policy/Value:everybody' => 'Tutti sono autorizzati a cancellare questi oggetti',
	'Class:SynchroDataSource/Attribute:user_delete_policy/Value:nobody' => 'Nessuno',
	'Class:SynchroDataSource/Attribute:url_icon' => 'Icona di collegamento ipertestuale',
	'Class:SynchroDataSource/Attribute:url_icon+' => '',
	'Class:SynchroDataSource/Attribute:url_application' => 'Collegamento ipertestuale all\'applicazione',
	'Class:SynchroDataSource/Attribute:url_application+' => '',
	'Class:SynchroAttribute' => 'Attributo di sincronizzazione',
	'Class:SynchroAttribute/Attribute:sync_source_id' => 'Sorgente sincronizzazione dati',
	'Class:SynchroAttribute/Attribute:attcode' => 'Codice attributo',
	'Class:SynchroAttribute/Attribute:update' => 'Aggiorna',
	'Class:SynchroAttribute/Attribute:reconcile' => 'Rincocilia',
	'Class:SynchroAttribute/Attribute:update_policy' => 'Policy di aggiornamento',
	'Class:SynchroAttribute/Attribute:update_policy/Value:master_locked' => 'Bloccato',
	'Class:SynchroAttribute/Attribute:update_policy/Value:master_unlocked' => 'Sbloccato',
	'Class:SynchroAttribute/Attribute:update_policy/Value:write_if_empty' => 'Inizializza se vuoto',
	'Class:SynchroAttribute/Attribute:finalclass' => 'Classe',
	'Class:SynchroAttExtKey' => 'Attributo di sincronizzazione (ExtKey)',
	'Class:SynchroAttExtKey/Attribute:reconciliation_attcode' => 'Attributo di riconciliazione',
	'Class:SynchroAttLinkSet' => 'Attributo di sincronizzazione (Linkset)',
	'Class:SynchroAttLinkSet/Attribute:row_separator' => 'Separatore di righe',
	'Class:SynchroAttLinkSet/Attribute:attribute_separator' => 'Separatore di attributi',
	'Class:SynchroLog' => 'Log di sincronizzazione',
	'Class:SynchroLog/Attribute:sync_source_id' => 'Sorgente di sincronizzazione dati',
	'Class:SynchroLog/Attribute:start_date' => 'Data di inizio',
	'Class:SynchroLog/Attribute:end_date' => 'Data di fine',
	'Class:SynchroLog/Attribute:status' => 'Stato',
	'Class:SynchroLog/Attribute:status/Value:completed' => 'Completo',
	'Class:SynchroLog/Attribute:status/Value:error' => 'Errore',
	'Class:SynchroLog/Attribute:status/Value:running' => 'Ancora in esecuzione',
	'Class:SynchroLog/Attribute:stats_nb_replica_seen' => 'Nb replica viste',
	'Class:SynchroLog/Attribute:stats_nb_replica_total' => 'Nb replica totale',
	'Class:SynchroLog/Attribute:stats_nb_obj_deleted' => 'Nb oggetti cancellati',
	'Class:SynchroLog/Attribute:stats_nb_obj_deleted_errors' => 'Nb di errore durante la cancellazione',
	'Class:SynchroLog/Attribute:stats_nb_obj_obsoleted' => 'Nb oggetti obsoleti',
	'Class:SynchroLog/Attribute:stats_nb_obj_obsoleted_errors' => 'Nb di errori mentre obsoleta',
	'Class:SynchroLog/Attribute:stats_nb_obj_created' => 'Nb oggetti creati',
	'Class:SynchroLog/Attribute:stats_nb_obj_created_errors' => 'Nb di errori durante la creazione',
	'Class:SynchroLog/Attribute:stats_nb_obj_updated' => 'Nb oggetti aggiornati',
	'Class:SynchroLog/Attribute:stats_nb_obj_updated_errors' => 'Nb di errori durante l\'aggiornamento',
	'Class:SynchroLog/Attribute:stats_nb_replica_reconciled_errors' => 'Nb di errori durante la riconcilazione',
	'Class:SynchroLog/Attribute:stats_nb_replica_disappeared_no_action' => 'Nb repliche scomparse',
	'Class:SynchroLog/Attribute:stats_nb_obj_new_updated' => 'Nb oggetti aggiornati',
	'Class:SynchroLog/Attribute:stats_nb_obj_new_unchanged' => 'Nb oggetti non modificati',
	'Class:SynchroLog/Attribute:last_error' => 'Untimo errore',
	'Class:SynchroLog/Attribute:traces' => 'Tracce',
	'Class:SynchroReplica' => 'Replica sincronizzazione',
	'Class:SynchroReplica/Attribute:sync_source_id' => 'Sorgente di sincronizzazione dati',
	'Class:SynchroReplica/Attribute:dest_id' => 'Oggetto di destinazione (ID)~~',
	'Class:SynchroReplica/Attribute:dest_class' => 'Tipo di destinazione',
	'Class:SynchroReplica/Attribute:status_last_seen' => 'Ultimo visto',
	'Class:SynchroReplica/Attribute:status' => 'Stato',
	'Class:SynchroReplica/Attribute:status/Value:modified' => 'Modificato',
	'Class:SynchroReplica/Attribute:status/Value:new' => 'Nuovo',
	'Class:SynchroReplica/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:SynchroReplica/Attribute:status/Value:orphan' => 'Orfano',
	'Class:SynchroReplica/Attribute:status/Value:synchronized' => 'Sincronizzato',
	'Class:SynchroReplica/Attribute:status_dest_creator' => 'Oggetto Creato ?',
	'Class:SynchroReplica/Attribute:status_last_error' => 'Ultimo Errore',
	'Class:SynchroReplica/Attribute:info_creation_date' => 'Data di creazione',
	'Class:SynchroReplica/Attribute:info_last_modified' => 'Data ultima modifica',
	'Class:appUserPreferences' => 'Preferenze utente',
	'Class:appUserPreferences/Attribute:userid' => 'Utente',
	'Class:appUserPreferences/Attribute:preferences' => 'Preferenze',
	'Core:AttributeLinkedSet' => 'Array di oggetti',
	'Core:AttributeLinkedSet+' => '',
	'Core:AttributeLinkedSetIndirect' => 'Array di oggetti (N-N)',
	'Core:AttributeLinkedSetIndirect+' => '',
	'Core:AttributeInteger' => 'Integero',
	'Core:AttributeInteger+' => '',
	'Core:AttributeDecimal' => 'Decimale',
	'Core:AttributeDecimal+' => '',
	'Core:AttributeBoolean' => 'Booleano',
	'Core:AttributeBoolean+' => '',
	'Core:AttributeString' => 'Stringa',
	'Core:AttributeString+' => '',
	'Core:AttributeClass' => 'Classe',
	'Core:AttributeClass+' => '',
	'Core:AttributeApplicationLanguage' => 'Linguaggio Utente',
	'Core:AttributeApplicationLanguage+' => '',
	'Core:AttributeFinalClass' => 'Classe (auto)',
	'Core:AttributeFinalClass+' => '',
	'Core:AttributePassword' => 'Password',
	'Core:AttributePassword+' => '',
	'Core:AttributeEncryptedString' => 'Stringa criptata',
	'Core:AttributeEncryptedString+' => '',
	'Core:AttributeText' => 'Testo',
	'Core:AttributeText+' => '',
	'Core:AttributeHTML' => 'HTML',
	'Core:AttributeHTML+' => '',
	'Core:AttributeEmailAddress' => 'Indirizzo Email',
	'Core:AttributeEmailAddress+' => '',
	'Core:AttributeIPAddress' => 'Indirizzo IP',
	'Core:AttributeIPAddress+' => '',
	'Core:AttributeOQL' => 'OQL',
	'Core:AttributeOQL+' => '',
	'Core:AttributeEnum' => 'Enum',
	'Core:AttributeEnum+' => '',
	'Core:AttributeTemplateString' => 'Stringa Template',
	'Core:AttributeTemplateString+' => '',
	'Core:AttributeTemplateText' => 'Testo Template',
	'Core:AttributeTemplateText+' => '',
	'Core:AttributeTemplateHTML' => 'HTML Template',
	'Core:AttributeTemplateHTML+' => '',
	'Core:AttributeDateTime' => 'Data/ora',
	'Core:AttributeDateTime+' => '',
	'Core:AttributeDate' => 'Data',
	'Core:AttributeDate+' => '',
	'Core:AttributeDeadline' => 'Scadenza',
	'Core:AttributeDeadline+' => '',
	'Core:AttributeExternalKey' => 'Chiave esterna',
	'Core:AttributeExternalKey+' => '',
	'Core:AttributeExternalField' => 'Campo esterno',
	'Core:AttributeExternalField+' => '',
	'Core:AttributeURL' => 'URL',
	'Core:AttributeURL+' => '',
	'Core:AttributeBlob' => 'Blob',
	'Core:AttributeBlob+' => '',
	'Core:AttributeOneWayPassword' => 'Password unidierzionale',
	'Core:AttributeOneWayPassword+' => '',
	'Core:AttributeTable' => 'Tabella',
	'Core:AttributeTable+' => '',
	'Core:AttributePropertySet' => 'Proprietà',
	'Core:AttributePropertySet+' => '',
	'Class:CMDBChangeOp/Attribute:date' => 'data',
	'Class:CMDBChangeOp/Attribute:date+' => '',
	'Class:CMDBChangeOp/Attribute:userinfo' => 'utente',
	'Class:CMDBChangeOp/Attribute:userinfo+' => '',
	'Change:ObjectCreated' => 'Oggetto creato',
	'Change:ObjectDeleted' => 'Oggetto cancellato',
	'Change:ObjectModified' => 'Object modificato',
	'Change:AttName_SetTo_NewValue_PreviousValue_OldValue' => '%1$s imposatato a  %2$s (valore precendente: %3$s)',
	'Change:AttName_SetTo' => '%1$s impostato a  %2$s~~',
	'Change:Text_AppendedTo_AttName' => '%1$s allegato a  %2$s~~',
	'Change:AttName_Changed_PreviousValue_OldValue' => '%1$s moficato, valore precendente: %2$s',
	'Change:AttName_Changed' => '%1$s modificato',
	'Change:AttName_EntryAdded' => '%1$s modificato, nuova entrata aggiunta.',
	'Class:EventLoginUsage/Attribute:contact_name' => 'Nome Utente',
	'Class:EventLoginUsage/Attribute:contact_name+' => '',
	'Class:EventLoginUsage/Attribute:contact_email' => 'Email Utente',
	'Class:EventLoginUsage/Attribute:contact_email+' => '',
	'Class:Action' => 'Azione personalizzata',
	'Class:Action+' => '',
	'Class:Action/Attribute:name' => 'Nome',
	'Class:Action/Attribute:name+' => '',
	'Class:Action/Attribute:description' => 'Descrizione',
	'Class:Action/Attribute:description+' => '',
	'Class:Action/Attribute:status' => 'Stato',
	'Class:Action/Attribute:status+' => '',
	'Class:Action/Attribute:status/Value:test' => 'In fase di test',
	'Class:Action/Attribute:status/Value:test+' => '',
	'Class:Action/Attribute:status/Value:enabled' => 'In produzione',
	'Class:Action/Attribute:status/Value:enabled+' => '',
	'Class:Action/Attribute:status/Value:disabled' => 'Inattivo',
	'Class:Action/Attribute:status/Value:disabled+' => '',
	'Class:Action/Attribute:trigger_list' => 'Trigger Correlati',
	'Class:Action/Attribute:trigger_list+' => '',
	'Class:Action/Attribute:finalclass' => 'Tipo',
	'Class:Action/Attribute:finalclass+' => '',
	'Class:ActionNotification' => 'Notifica',
	'Class:ActionNotification+' => '',
	'Class:Trigger' => 'Trigger',
	'Class:Trigger+' => '',
	'Class:Trigger/Attribute:description' => 'Descrizione',
	'Class:Trigger/Attribute:description+' => '',
	'Class:Trigger/Attribute:action_list' => 'Azioni Triggerate',
	'Class:Trigger/Attribute:action_list+' => '',
	'Class:Trigger/Attribute:finalclass' => 'Tipo',
	'Class:Trigger/Attribute:finalclass+' => '',
	'Class:TriggerOnObject' => 'Trigger (classe dipendente)',
	'Class:TriggerOnObject+' => '',
	'Class:TriggerOnObject/Attribute:target_class' => 'Classe Target',
	'Class:TriggerOnObject/Attribute:target_class+' => '',
	'Class:TriggerOnStateChange' => 'Trigger (sul cambio di stato)',
	'Class:TriggerOnStateChange+' => '',
	'Class:TriggerOnStateChange/Attribute:state' => 'Stato',
	'Class:TriggerOnStateChange/Attribute:state+' => '',
	'Class:lnkTriggerAction/Attribute:action_name' => 'Azione',
	'Class:lnkTriggerAction/Attribute:action_name+' => '',
	'Class:lnkTriggerAction/Attribute:trigger_name' => 'Trigger',
	'Class:lnkTriggerAction/Attribute:trigger_name+' => '',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:never' => 'Nessuno',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:depends' => 'Solo Amministratore',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:always' => 'Tutti gli utenti autorizzati',
	'SynchroDataSource:Description' => 'Descrizione',
	'SynchroDataSource:Reconciliation' => 'Ricerca &amp; riconciliazione',
	'SynchroDataSource:Deletion' => 'Regole di cancellazione',
	'SynchroDataSource:Status' => 'Stato',
	'SynchroDataSource:Information' => 'Informazione',
	'SynchroDataSource:Definition' => 'Definizione',
	'Core:SynchroAttributes' => 'Attributi',
	'Core:SynchroStatus' => 'Stato',
	'Core:Synchro:ErrorsLabel' => 'Errori',
	'Core:Synchro:CreatedLabel' => 'Creato',
	'Core:Synchro:ModifiedLabel' => 'Modificato',
	'Core:Synchro:UnchangedLabel' => 'Non modificato',
	'Core:Synchro:ReconciledErrorsLabel' => 'Errori',
	'Core:Synchro:ReconciledLabel' => 'Reconciliato',
	'Core:Synchro:ReconciledNewLabel' => 'Creato',
	'Core:SynchroReconcile:Yes' => 'Si',
	'Core:SynchroReconcile:No' => 'No',
	'Core:SynchroUpdate:Yes' => 'Si',
	'Core:SynchroUpdate:No' => 'No',
	'Core:Synchro:LastestStatus' => 'Ultimo stato',
	'Core:Synchro:History' => 'Storia della sincronizzazione',
	'Core:Synchro:NeverRun' => 'Questa sincronizzazione non è mai stata eseguita. Nessun Log ancora...',
	'Core:Synchro:SynchroEndedOn_Date' => 'L\'ultima sincronizzazione si è conclusa il %1$s.~~',
	'Core:Synchro:SynchroRunningStartedOn_Date' => 'La sincronizzazione è iniziata il $1$s è ancora in esecuzione...~~',
	'Menu:DataSources' => 'Sorgente di sincronizzazione dei dati',
	'Menu:DataSources+' => '',
	'Core:Synchro:label_repl_ignored' => 'Ignorato(%1$s)',
	'Core:Synchro:label_repl_disappeared' => 'Scomparso (%1$s)',
	'Core:Synchro:label_repl_existing' => 'Esistente (%1$s)',
	'Core:Synchro:label_repl_new' => 'Nuovo (%1$s)~~',
	'Core:Synchro:label_obj_deleted' => 'Cancellato (%1$s)',
	'Core:Synchro:label_obj_obsoleted' => 'Obsoleto (%1$s)',
	'Core:Synchro:label_obj_disappeared_errors' => 'Errori (%1$s)',
	'Core:Synchro:label_obj_disappeared_no_action' => 'Nessuna Azione (%1$s)',
	'Core:Synchro:label_obj_unchanged' => 'Non modificato(%1$s)',
	'Core:Synchro:label_obj_updated' => 'Aggiornato (%1$s)',
	'Core:Synchro:label_obj_updated_errors' => 'Errori (%1$s)',
	'Core:Synchro:label_obj_new_unchanged' => 'Non modificato (%1$s)',
	'Core:Synchro:label_obj_new_updated' => 'Aggiornato (%1$s)',
	'Core:Synchro:label_obj_created' => 'Creato (%1$s)',
	'Core:Synchro:label_obj_new_errors' => 'Errori (%1$s)',
	'Core:SynchroLogTitle' => '%1$s - %2$s~~',
	'Core:Synchro:Nb_Replica' => 'Replica processata: %1$s',
	'Core:Synchro:Nb_Class:Objects' => '%1$s: %2$s',
	'Class:SynchroDataSource/Error:AtLeastOneReconciliationKeyMustBeSpecified' => 'Almeno una chiave riconciliazione deve essere specificata, o la policy di conciliazione deve essere quella di utilizzare la chiave primaria',
	'Class:SynchroDataSource/Error:DeleteRetentionDurationMustBeSpecified' => 'Deve essere specificato un periodo di conservazione di cancellazione , dato che gli oggetti devono essere eliminati dopo essere contrassegnati come obsoleti ',
	'Class:SynchroDataSource/Error:DeletePolicyUpdateMustBeSpecified' => 'Oggetti obsoleti devono essere aggiornati, ma nessun aggiornamento è specificato',
	'Core:SynchroReplica:PublicData' => 'Dati Pubblici',
	'Core:SynchroReplica:PrivateDetails' => 'Dettagli Privati',
	'Core:SynchroReplica:BackToDataSource' => 'Torna indietro alla sorgente di sincronizzazione dei dati: %1$s~~',
	'Core:SynchroReplica:ListOfReplicas' => 'Lista della Replica',
	'Core:SynchroAttExtKey:ReconciliationById' => 'id (Chiave Primaria)',
	'Core:SynchroAtt:attcode' => 'Attributo',
	'Core:SynchroAtt:attcode+' => '',
	'Core:SynchroAtt:reconciliation' => 'Riconciliazione ?~~',
	'Core:SynchroAtt:reconciliation+' => '',
	'Core:SynchroAtt:update' => 'Aggiornamento ?~~',
	'Core:SynchroAtt:update+' => '',
	'Core:SynchroAtt:update_policy' => 'Policy di aggiornamento',
	'Core:SynchroAtt:update_policy+' => '',
	'Core:SynchroAtt:reconciliation_attcode' => 'Chiave di riconciliazione',
	'Core:SynchroAtt:reconciliation_attcode+' => '',
	'Core:SyncDataExchangeComment' => '(Scambio dati)',
	'Core:Synchro:ListOfDataSources' => 'Lista delle sorgenti di dati:',
	'Core:Synchro:LastSynchro' => 'Ultima sincronizzazione:',
	'Core:Synchro:ThisObjectIsSynchronized' => 'Questo oggetto è sincronizzato con una sorgente esterna di dati',
	'Core:Synchro:TheObjectWasCreatedBy_Source' => 'L\'oggetti è stato <b>creato</b> da una sorgente esterna di dati %1$s~~',
	'Core:Synchro:TheObjectCanBeDeletedBy_Source' => 'L\'oggetti <b>può essere cancellato</b> da una sorgente esterna di dati %1$s~~',
	'Core:Synchro:TheObjectCannotBeDeletedByUser_Source' => 'Tu <b>non puoi cancellare l\'oggetto</b> perché è di proprietà della sorgente dati esterna %1$s~~',
	'TitleSynchroExecution' => 'Esecuzione della sincronizzazione',
	'Class:SynchroDataSource:DataTable' => 'Tabella del database: %1$s',
	'Core:SyncDataSourceObsolete' => 'La fonte dei dati è contrassegnata come obsoleta. Operazione annullata',
	'Core:SyncDataSourceAccessRestriction' => 'Solo amministratori o l\'utente specificato nella fonte dei dati può eseguire questa operazione. Operazione annullata',
	'Core:SyncTooManyMissingReplicas' => 'Tutte le repliche sono mancanti dall\'importazione. Hai eseguito realmente l\'importazione? Operazione annullata',
	'Core:Duration_Seconds' => '%1$ds',
	'Core:Duration_Minutes_Seconds' => '%1$dmin %2$ds',
	'Core:Duration_Hours_Minutes_Seconds' => '%1$dh %2$dmin %3$sec~~',
	'Core:Duration_Days_Hours_Minutes_Seconds' => '%1$sg %2$dh %3$dmin %4$ds~~',
));
?>
