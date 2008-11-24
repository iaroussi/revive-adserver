<?php
/*
+---------------------------------------------------------------------------+
| Openads v${RELEASE_MAJOR_MINOR}                                           |
| ============                                                              |
|                                                                           |
| Copyright (c) 2003-2007 Openads Limited                                   |
| For contact details, see: http://www.openads.org/                         |
|                                                                           |
| Copyright (c) 2000-2003 the phpAdsNew developers                          |
| For contact details, see: http://www.phpadsnew.com/                       |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id$
*/

require_once 'market-common.php';
require_once MAX_PATH .'/lib/OA/Admin/UI/component/Form.php';
require_once MAX_PATH .'/lib/OX/Admin/Redirect.php';

// Security check
OA_Permission::enforceAccount(OA_ACCOUNT_ADMIN);

phpAds_registerGlobalUnslashed('purl');

/*-------------------------------------------------------*/
/* Display page                                          */
/*-------------------------------------------------------*/

    $oMarketComponent = OX_Component::factory('admin', 'oxMarket');
    //check if you can see this page
    $oMarketComponent->checkActive();
    
    
    //retrieve menu from 
    $pubconsolePageName = $oMarketComponent->createMenuForPubconsolePage($purl);
    
    //header
    $pageId = "openx-market";
    if (!empty($pubconsolePageName)) {
        $oMenu = OA_Admin_Menu::singleton();
        //update page title
        $oCurrentSection = $oMenu->get($pageId);
        phpAds_PageHeader($pageId, new OA_Admin_UI_Model_PageHeaderModel($oCurrentSection->getName().': '.$pubconsolePageName, "iconMarketLarge"), '../../');
    }
    else {
        phpAds_PageHeader($pageId, null,'../../');
    }

    //get template and display form
    $oTpl = new OA_Plugin_Template('market-include.html','openXMarket');
    $oTpl->assign('pubconsoleHost', $oMarketComponent->getConfigValue('marketHost'));
    $oTpl->assign('pubconsoleURL', $oMarketComponent->getConfigValue('marketHost'));
    //TODO use plugin code when it returns anything meaningful 
    $oTpl->assign('pubconsoleAccountId', 23);///$oMarketComponent->getAccountId());
    $oTpl->assign('pubconsoleAccountIdParamName', $oMarketComponent->getConfigValue('marketAccountIdParamName'));
    $oTpl->assign('pubconsolePageId', $purl);
    $oTpl->display();
    
    //footer
    phpAds_PageFooter();

?>