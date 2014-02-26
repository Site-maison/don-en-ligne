<?php
/*------------------------------------------------------------------------
# default.php - Faire un don Component
# ------------------------------------------------------------------------
# author    MiniHenk
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.minihenk.org
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// load tooltip behavior
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_celebration.soutiens');
$archived	= $this->state->get('filter.published') == 2 ? true : false;
$trashed	= $this->state->get('filter.published') == -2 ? true : false;
$saveOrder	= $listOrder == 'ordering';

?>
<form action="<?php echo JRoute::_('index.php?option=com_soutiens&view=soutiens'); ?>" method="post" name="adminForm" id="adminForm">
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		
		<?php //Load the batch processing form. ?>
		<?php //echo $this->loadTemplate('batch'); ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div></div>
    <h3>Vous trouverez ici des explications pour le formulaire de don en ligne</h3>

    <div class="span10 form-horizontal">

	<fieldset>
<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', '<img src="components/com_soutiens/assets/images/configuration.png" width="16" height="16" alt="configuration.png" align="left" border="0" style="padding-right:8px;" />Les paramètres (admin)'); ?>
         
<p>On les définit en cliquant sur le bouton : <img src="components/com_soutiens/assets/images/param.png" width="" height="" alt="param" align="" border="0" /><br />
Faites vos modifications et "Enregistrer" (pour fermer, cliquez sur Annuler)</p>
<p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Configuration :</strong><br />
Y renseigner : </p>
<ul><li>les adresses mails pour les envois des reçus de transaction</li>
<li>les montants</li>
</ul>
<p>Pour les adresses mails : <br />
Le champ "adresse expéditeur principal" est l&rsquo;adresse <strong>avec laquelle</strong> seront envoyés les mails aux internautes. Cette adresse sera donc visible pour l&rsquo;internaute.<br />
Le champ "Destinataires des mails" sont les adresses mail <strong>à qui</strong> seront envoyées les transactions (en plus de l&rsquo;internaute) : ces adresses mails ne seront pas visibles pour l&rsquo;interanute. L&rsquo; "adresse expéditeur principal" peut aussi faire partie de ce champ <br />
Attention : retour à la ligne(Tch Entrée) après chaque adresse mail

</p>
<p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Messages pour le site :</strong><br />
Ce sont les messages qui vont s&rsquo;afficher sur le site, dans le formulaire de don et à la suite d&rsquo;un don : ils sont donc en HTML.<br />
Y renseigner : </p>

<p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Messages pour les mails :</strong><br />
Ce sont les messages qui seront envoyés par mail à la suite d&rsquo;un don : ils sont donc en texte brut.<br />
Y renseigner : les sujets (objet du mail) et les textes</p>

<p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Droits :</strong><br />
Ne rien modifier</p>


        	<?php echo JHtml::_('bootstrap.endTab'); ?>
           
       		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'gestion','<img src="components/com_soutiens/assets/images/s_soutienpaimts.png" width="16" height="16" alt="s_soutienpaimts.png" align="left" border="0" style="padding-right:8px;" />Gestion des dons');  ?>
      <p>Les informations concernant les donateurs et les transactions sont situés dans la partie (menu de gauche) :  "Donateurs"  </p>
            <p>
            Dans chaque fiche :</p>
            <p>Sur la droite, en un coup d'oeil, vous voyez qui est le donateur et quel est son mode de paiement >>> <img src="components/com_soutiens/assets/images/details_don.png" width="86"  height="120" alt="details_don" align="right" border="0" style="padding-right:8px;" /></p>  
            <p>Sur la partie centrale de chaque fiche, plusieurs onglets :</p>
   <p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Informations du donateur :</strong><br />
Tout ce qui concerne les coordonnées du donateur<br />
</p>  
   <p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Infos transaction :</strong><br />
Tout ce qui concerne la transaction (surtout important pour les transactions bancaires avec les données de la banque.)<br />
</p> 
   <p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Infos supplémentaires :</strong><br />
C&rsquo;est ici que vous pouvez mettre un commentaire personnalisé pour cette transaction ou sur le donateur.<br />
le champ Referrers vous donne la provenance du donateur (de quelle page est-il venu - utile pour vérifier lors d&rsquo;une campagne de don si le formulaire est signalé sur d&rsquo;autres sites)
</p> 
   <p><img src="components/com_soutiens/assets/images/accept.png" width="16" height="16" alt="accept.png" align="left" border="0" style="padding-right:8px;"/><strong>Onglet Détails :</strong><br />
Concerne le concepteur du composant<br />
</p> 

<h5>Pour l&rsquo;administration générale : </h5>
            <p><img src="components/com_soutiens/assets/images/archiv.jpg" width="200" height="120" alt="archiv.jpg" align="left" border="0" style="padding-right:8px;" />Lorsqu&rsquo;un don est bien reçu et encaissé, vous pouvez l&rsquo;archiver (ou le dépublier) : <br />il n&rsquo;apparaitra plus dans le tableau de bord mais il n&rsquo;est pas supprimé. </p><p>
            Pour archiver : en regard du nom, apparairt une flèche noire et les actions que vous pouvez faire pour chaque enregistrement : cliquez sur "Archiver"</p>
            <p>&nbsp;</p>            <p>&nbsp;</p>
            <p><img src="components/com_soutiens/assets/images/filter.png" width="200" height="130" alt="filter" align="left" border="0" style="padding-right:8px;" />Une fois l&rsquo;enregistrement archivé, il n&rsquo;apparait plus sur le tableu de bord principal, mais vou pouvez le retrouver grâce aux filtres (sur la gauche) en selectionnant "Archivé"</p>
                    
           <?php echo JHtml::_('bootstrap.endTab'); ?>

          	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'infotransac', '<img src="components/com_soutiens/assets/images/star_1.png" width="16" height="16" alt="asterisk" align="left" border="0" style="padding-right:8px;" />Infos sur les transac. banc.'); ?>
      <p>Vous trouverez dans le tableau ci-dessous les codes réponse renvoyés par le serveur Sogenactif dans le champ code_response suite à une demande d’autorisation. <font style="color:#00B9B2;"><strong>(en gras turquoise, les codes les plus fréquents)</strong></font> :</p>
                    <table border="1" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="123" valign="top"><p align="center"><strong>Codes réponse</strong></p></td>
                        <td width="387" valign="top"><p align="center"><strong>Signification</strong></p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center" style="color:#00B9B2;"><strong>00</strong></p></td>
                        <td width="387" valign="top"><p align="left">Autorisation acceptée</p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center">02</p></td>
                        <td width="387" valign="top"><p align="left">demande d’autorisation par téléphone à la banque à cause d’un dépassement de plafond d’autorisation sur la carte</p> </td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center">03</p></td>
                        <td width="387" valign="top"><ul>
                          <li>Champ <strong>merchant_id</strong> invalide, vérifier la valeur renseignée dans la requête</li>
                          <li>Contrat de vente à distance inexistant,    contacter votre banque.</li>
                        </ul></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center" style="color:#00B9B2;"><strong>05</strong></p></td>
                        <td width="387" valign="top"><p align="left">Autorisation refusée</p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center">12</p></td>
                        <td width="387" valign="top"><p align="left">Transaction invalide,    vérifier les paramètres transférés dans la requête.</p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center">13</p></td>
                        <td width="387" valign="top"><p align="left">Montant invalide,    vérifier le montant transféré dans la requête.</p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center" style="color:#00B9B2;"><strong>17</strong></p></td>
                        <td width="387" valign="top"><p align="left">Annulation de    l&rsquo;internaute</p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center">30</p></td>
                        <td width="387" valign="top"><p align="left">Erreur de format.</p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center">63</p></td>
                        <td width="387" valign="top"><p align="left">Règles de sécurité non    respectées, transaction arrêtée</p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center" style="color:#00B9B2;"><strong>75</strong></p></td>
                        <td width="387" valign="top"><p align="left">Nombre de tentatives de    saisie du numéro de carte dépassé. </p></td>
                      </tr>
                      <tr>
                        <td width="123" valign="top"><p align="center">90</p></td>
                        <td width="387" valign="top"><p align="left">Service temporairement    indisponible</p></td>
                      </tr>
                    </table>
<?php echo JHtml::_('bootstrap.endTab'); ?>

           			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'exports', '<img src="components/com_soutiens/assets/images/exports.png" width="16" height="16" alt="exports.png" align="left" border="0" style="padding-right:8px;" />Exports'); ?>
            
                    <h4>Exporter les infos des transactions</h4>
                   <p> A venir</p>
<?php echo JHtml::_('bootstrap.endTab'); ?>

	</fieldset></div>

</form>

