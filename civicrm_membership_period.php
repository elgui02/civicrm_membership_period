<?php

require_once 'civicrm_membership_period.civix.php';
use CRM_CivicrmMembershipPeriod_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function civicrm_membership_period_civicrm_config(&$config) {
  _civicrm_membership_period_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function civicrm_membership_period_civicrm_xmlMenu(&$files) {
  _civicrm_membership_period_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function civicrm_membership_period_civicrm_install() {
  _civicrm_membership_period_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function civicrm_membership_period_civicrm_postInstall() {
  _civicrm_membership_period_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function civicrm_membership_period_civicrm_uninstall() {
  _civicrm_membership_period_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function civicrm_membership_period_civicrm_enable() {
  _civicrm_membership_period_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function civicrm_membership_period_civicrm_disable() {
  _civicrm_membership_period_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function civicrm_membership_period_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civicrm_membership_period_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function civicrm_membership_period_civicrm_managed(&$entities) {
  _civicrm_membership_period_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function civicrm_membership_period_civicrm_caseTypes(&$caseTypes) {
  _civicrm_membership_period_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function civicrm_membership_period_civicrm_angularModules(&$angularModules) {
  _civicrm_membership_period_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function civicrm_membership_period_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civicrm_membership_period_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function civicrm_membership_period_civicrm_entityTypes(&$entityTypes) {
  _civicrm_membership_period_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Hook function to check membership post actions
 * create: when create a new membership add a period history
 * delete: when delete a membership delete all history for this membership
 */
function civicrm_membership_period_civicrm_post($op, $objectName, $objectId, &$objectRef)
{
   switch ($objectName)
    {
    case 'Membership':
        switch( $op )
        {
        case 'create':
            try
            {
                $perdiod = civicrm_api3('MembershipPeriod', 'create', array(
                    'membership_id' => $objectId,
                    'start_date' => $objectRef->start_date,
                    'end_date' => $objectRef->end_date
                ));
            }
            catch (CiviCRM_API3_Exception $e) {
                $error = $e->getMessage();
            }
            break;
        case 'delete':
            try
            {
                $perdiod = civicrm_api3('MembershipPeriod', 'delete', array(
                    'membership_id' => $objectId
                ));
            }
            catch (CiviCRM_API3_Exception $e) {
                $error = $e->getMessage();
            }
            break;
        default:
            //nothing to do
        }
        break;
    case 'MembershipPayment':
        Civi::log()->debug($objectName);
        Civi::log()->debug($op);
        foreach($objectRef as $key => $value)
        {
    Civi::log()->debug($key);
    Civi::log()->debug($value);
        }
        break;
    default:
        // nothing to do
    }
}

/**
 * Hook function to check membership pre actions
 * edit: when edit a membership catch before and after to know is a edition or renewal
 */
function civicrm_membership_period_civicrm_pre($op, $objectName, $objectId, &$objectRef)
{
   switch ($objectName)
    {
    case 'Membership':
        switch( $op )
        {
        case 'edit':
            //get period history for update if doesn't exists that will be created
            try {
                $periods = civicrm_api3('MembershipPeriod', 'get', array(
                    'membership_id' => $objectId
                ));
            }
            catch (CiviCRM_API3_Exception $e) {
                $error = $e->getMessage();
            }

            //create a period with update dates
            $lastPeriod = end($periods['values']);
            $lastPeriod['membership_id'] = $objectId;
            
            if( $periods['count'] == 0 )
            {
                unset($lastPeriod['id']);
            }

            switch($_GET['action'])
            {
            case 'update':
                $lastPeriod['start_date'] = $objectRef['start_date'];
                $lastPeriod['end_date'] = $objectRef['end_date'];
                
                try
                {
                    $period = civicrm_api3('MembershipPeriod', 'create', $lastPeriod);
                }
                catch (CiviCRM_API3_Exception $e) {
                    $error = $e->getMessage();
                }
                break;
            case 'renew':

                $lastPeriod['start_date'] = $objectRef['membership_start_date'];
                $lastPeriod['end_date'] = $objectRef['membership_end_date'];

                $newPeriod = array(
                    'membership_id' => $objectId,
                    'start_date' => $objectRef['start_date'],
                    'end_date'   => $objectRef['end_date']
                );
                try
                {
                    if (array_key_exists('membership_start_date', $objectRef))
                    {
                        $period = civicrm_api3('MembershipPeriod', 'create', $lastPeriod);
                    }
                    $nperiod = civicrm_api3('MembershipPeriod', 'create', $newPeriod);
                }
                catch (CiviCRM_API3_Exception $e) {
                    $error = $e->getMessage();
                }

                break;
            }
        }
        break;
    default:
        // nothing to do
    }
}



/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function civicrm_membership_period_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function civicrm_membership_period_civicrm_navigationMenu(&$menu) {
  _civicrm_membership_period_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _civicrm_membership_period_civix_navigationMenu($menu);
} // */
