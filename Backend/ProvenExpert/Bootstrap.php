<?php

/**
 *
 * @package     Plugins
 * @subpackage  Backend
 * @copyright   Copyright (c) 2016, Expert Systems GmbH
 * @link        https://www.provenexpert.com/de/
 * @author      Expert Systems GmbH
 */
class Shopware_Plugins_Backend_ProvenExpert_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    /**
     * defines which parameters are valid for which seal
     *
     * @var array $combinations
     */
    private $combinations = array(
        'portrait'  => array('pe_type', 'pe_feedback'),
        'circle'    => array('pe_type'),
        'logo'      => array('pe_type'),
        'bar'       => array('pe_type', 'pe_feedback', 'pe_style'),
        'landing'   => array('pe_type', 'pe_feedback', 'pe_style', 'pe_position', 'pe_avatar', 'pe_competence'),
    );

    /**
     * Returns version
     *
     * @return string
     */
    public function getVersion()
    {
        return '1.0.1';
    }

    /**
     * Returns information
     *
     * @return array
     */
    public function getInfo() {
        return array(
            'label'       => 'ProvenExpert',
            'author'      => 'ProvenExpert',
            'copyright'   => '© 2016 ',
            'version'     => $this->getVersion(),
        );
    }

    /**
     * Plugin install method
     *
     * @return array
     */
    public function install() {
        require_once $this->Path().'lib/db_install.php';

        //creates the menu node for RichSnippets
        $this->subscribeEvent('Enlight_Controller_Dispatcher_ControllerPath_Backend_ProvenExpert', 'getBackendController');
        $logors = '../engine/Shopware/Plugins/Community/Backend/ProvenExpert/images/rs_small.png';
        $this->createMenuItem(array(
            'label' => 'ProvenExpert Richsnippets',
            'controller' => 'ProvenExpert',
            'class' => '\" style=\"background: url('.$logors.') no-repeat scroll 0 0 transparent !important;',
            'action' => 'Index',
            'active' => 1,
            'position' => 98,
            'parent' => $this->Menu()->findOneBy(['label' => 'Marketing'])
        ));
        
        //Creates the menu node for Seals
        $this->subscribeEvent('Enlight_Controller_Dispatcher_ControllerPath_Backend_ProvenExpertseals', 'getSealsbackendController');
        $logoseals = '../engine/Shopware/Plugins/Community/Backend/ProvenExpert/images/seal_small.png';
        $this->createMenuItem(array(
            'label' => 'ProvenExpert Siegel',
            'controller' => 'ProvenExpertseals',
            'class' => '\" style=\"background: url('.$logoseals.') no-repeat scroll 0 0 transparent !important;',
            'action' => 'Index',
            'active' => 1,
            'position' => 99,
            'parent' => $this->Menu()->findOneBy(['label' => 'Marketing'])
        ));        

        //calls onFrontendPostDispatch() every time a page is called in the frontend
        $this->subscribeEvent('Enlight_Controller_Action_PostDispatchSecure_Frontend', 'onFrontendPostDispatch');
        
        $this->createConfig();
        return array('success' => true, 'invalidateCache' => array('frontend', 'backend'));
    }

    /**
     * @param string $version
     * @return bool
     */
    public function update($version)
    {
        return true;
    }
    
    /**
     * Creates the plugin config menu
     *
     * @return void
     */
    private function createConfig() {
        $this->Form()->setElement('text', 'apiid',
            array(
                'label'         => 'API-ID (= Benutzername)',
                'description'   => 'Die API-ID können Sie in Ihrem Profil auf ProvenExpert.com unter "Entwickler-API" (Pfeil oben rechts neben "Mein Profil") einsehen.',
                'required'      => true
            )
        );

        $this->Form()->setElement('text', 'apikey',
            array(
                'label'         => 'API-Schlüssel',
                'description'   => 'Den API-Schlüssel können Sie in Ihrem Profil auf ProvenExpert.com unter "Entwickler-API" (Pfeil oben rechts neben "Mein Profil") einsehen.',
                'required'      => true
            )
        );
    }

    /**
     * performs a call to the ProvenExpert API
     *
     * @param $url, $data
     *
     * @return array
     */    
    private function curlCall($url, $data) {

        //gets config values (these are the config fields that got created in createConfig() (see above) and which get filled during plugin installation)
        $api_id     = Shopware()->Plugins()->Backend()->ProvenExpert()->Config()->apiid;
        $api_key    = Shopware()->Plugins()->Backend()->ProvenExpert()->Config()->apikey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $api_id.':'.$api_key);
        curl_setopt($ch, CURLOPT_POST, 1);
        if(is_array($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        
        return $result;
    }   
    
    /**
     * inserts the literal tags to avoid Smary error
     *
     * @param string $code
     *
     * @return string
     */
    private function parseRS($code) {
        $code = str_replace('<style>', '<style>{literal}', $code);
        $code = str_replace('</style>', '{/literal}</style>', $code);
        return $code;
    }

    /**
     * creates a caching file for the RichSnippet
     *
     * @return void
     */
    public function cacheRS() {
        $sql = "SELECT `pe_rsVersion`, `pe_rsApiScriptVersion` FROM `s_plugin_provenexpert_rs` WHERE `pe_rsStatus` = 1 LIMIT 1";
        $result = Shopware()->Db()->fetchRow($sql, array(1));
        if($result && isset($result['pe_rsVersion']) && isset($result['pe_rsApiScriptVersion'])) {
            $domain = 'www.provenexpert.com';
            $url = 'https://'.$domain.'/api_rating_v'.((int)$result['pe_rsVersion'] + 1).'.json?v='.$result['pe_rsApiScriptVersion'];
            $apiAnswer = $this->curlCall($url);
            if(isset($apiAnswer->aggregateRating)) {
                file_put_contents($this->Path().'cache/rs_'.(int)$result['pe_rsVersion'].'.html', $this->parseRS($apiAnswer->aggregateRating));
            }
        }
    }

    /**
     * EventHandler to load the RichSnippet backend controller when "ProvenExpert RichSnippets" has been clicked in the menu
     *
     * @param Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function getBackendController(Enlight_Event_EventArgs $args) {
        $this->Application()->Template()->addTemplateDir($this->Path().'Views/');
        $this->registerCustomModels();
        return $this->Path().'/Controllers/Backend/ProvenExpert.php';
    }

    /**
     * EventHandler to load the Seals backend controller when "ProvenExpert Seals" has been clicked in the menu
     *
     * @param Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function getSealsbackendController(Enlight_Event_EventArgs $args) {
        $this->Application()->Template()->addTemplateDir($this->Path().'Views/');
        $this->registerCustomModels();
        return $this->Path().'/Controllers/Backend/ProvenExpertseals.php';
    }

    /**
     * fetches the RichSnippet
     *
     * @return string
     */
    private function getRichSnippet(){                
        $sql = "SELECT `pe_rsVersion`, `pe_rsApiScriptVersion` FROM `s_plugin_provenexpert_rs` WHERE `pe_rsStatus` = 1 LIMIT 1";
        $result = Shopware()->Db()->fetchRow($sql, array(1));        
        if($result && isset($result['pe_rsVersion']) && isset($result['pe_rsApiScriptVersion'])) {
            $rsCacheUrl = $this->Path().'cache/rs_'.(int)$result['pe_rsVersion'].'.html';
            //if cached version exists and isn't too old, use that
            if(file_exists($rsCacheUrl) && filemtime($rsCacheUrl) >= (time() - 2100)) {
                return file_get_contents($rsCacheUrl);
            }
            //if cached version doesn't exist or is too old, create a new version with an API call
            else {  
                $domain = 'www.provenexpert.com';
                $url = 'https://'.$domain.'/api_rating_v'.((int)$result['pe_rsVersion'] + 1).'.json?v='.$result['pe_rsApiScriptVersion'];
                $apiAnswer = $this->curlCall($url);
                if(isset($apiAnswer->aggregateRating)) {
                    $this->cacheRS();
                    return $apiAnswer->aggregateRating;
                }                                  
            }
        }
        return;
    }

    /**
     * checks seal-parameter combinations
     *
     * @param $sealtype, $param
     *
     * @return boolean
     */
    private function validParam($sealtype, $param) {
        if(in_array($param, $this->combinations[$sealtype])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * fetches the Seals
     *
     * @param $view
     *
     * @return void
     */
    private function getSeals($view) {
        $sql = "SELECT `pe_type`, `pe_style`, `pe_feedback`, `pe_avatar`, `pe_competence`, `pe_position`, `modified` FROM `s_plugin_provenexpert_seals` WHERE `pe_widgetActive` = 1";
        $result = Shopware()->Db()->fetchAll($sql, array(1));

        foreach($result as $seal) {
            $sealCacheUrl = $this->Path().'cache/seal_'.$seal['pe_type'].'.html';
            //if cached version exists and isn't too old, use the cached version
            if(file_exists($sealCacheUrl) && filemtime($sealCacheUrl) >= (time() - 43200) && (strtotime($seal['modified']) < filemtime($sealCacheUrl))) {
                if($seal['pe_type'] == 'landing') {
                    ($seal['pe_position'] == 'bottom') ? $seal['pe_type'] .= '_bottom' : $seal['pe_type'] .= '_top';
                }
                //hand over cached image to view
                $view->assign('pe_seal_'.$seal['pe_type'], file_get_contents($sealCacheUrl));
            }
            //if cached version doesn't exist or is too old
            else {
                $data = array('data' => array());
                //load parameters into API call
                foreach($seal as $key => $value) {
                    if( ($value != '') && $this->validParam($seal['pe_type'], $key)) {
                        $data['data'][substr($key, 3)] = $value;
                    }
                }
                //load seal type specific parameters
                switch($seal['pe_type']) {
                    case 'portrait':
                    case 'logo':
                        $data['data']['width'] = 180;
                        break;
                    case 'circle':
                        $data['data']['width'] = 150;
                        break;
                }
                $url = 'https://www.provenexpert.com/api/v1/widget/create';
                //perform API call
                $apiresult = $this->curlCall($url, $data);
                if($apiresult->status == 'success') {
                    //parse answer for specific seal types
                    switch($seal['pe_type']) {
                        case 'landing':
                            $css = str_replace('max-width:962px;', 'max-width:1262px;', file_get_contents('https://www.provenexpert.com/css/widget_landing.css'));
                            $css = str_replace('', '', $css);
                            $apiresult->html = str_replace('<link rel="stylesheet" type="text/css" href="https://www.provenexpert.com/css/widget_landing.css" media="screen,print">', 
                                    '<style type="text/css">{literal}'.$css.'{/literal}</style>', 
                                    $apiresult->html);
                            break;
                        case 'bar':
                            $apiresult->html = str_replace('type="text/css">', 'type="text/css">{literal}', $apiresult->html);
                            $apiresult->html = str_replace('</style>', '{/literal}</style>', $apiresult->html);
                            break;
                    }
                    if($seal['pe_type'] == 'landing') {
                        ($seal['pe_position'] == 'bottom') ? $seal['pe_type'] .= '_bottom' : $seal['pe_type'] .= '_top';
                    }
                    //hand over image to view and cache it
                    $view->assign('pe_seal_'.$seal['pe_type'], (string)$apiresult->html);
                    file_put_contents($sealCacheUrl, $apiresult->html);
                }    
            }
            if($seal['pe_type'] == 'bar') {
                //must be used together with bar to avoid hiding the shopware logo
                $view->assign('pe_seal_filler', "<div><p>&nbsp;</p></div>");
            }
        }
    }

    /**
     * triggered by Event every time a page in the frontend is called
     *
     * @param Enlight_Event_EventArgs $args
     *
     * @return void
     */
    public function onFrontendPostDispatch(Enlight_Event_EventArgs $args) {                             

        /**@var $subject Shopware_Controllers_Frontend_Checkout */
        //safety block as recommended by Shopware
        $subject = $args->getSubject();
        $request  = $subject->Request();
        $response = $subject->Response();
        if(!$request->isDispatched() || $response->isException() || $request->getModuleName() != 'frontend' || !$args->getSubject()->View()->hasTemplate()) {
            return; }         

        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->get('subject');
        $view = $controller->View();              
        
        $this->getSeals($view);
        $view->assign('pe_richsnippet', $this->getRichSnippet());        

        $view->addTemplateDir(__DIR__.'/Views');
        //Workaround to solve the incompatibility between Shopware and Windows
        $view->extendsTemplate('backend/plugins/proven_expert/index.tpl');
    }

    /**
     * triggered by Event  every time a page in the frontend is called
     *
     * @return array
     */
    public function uninstall() {        
        require_once $this->Path().'lib/db_uninstall.php';
        return array('success' => true, 'invalidateCache' => array('frontend', 'backend'));
    }    
}
