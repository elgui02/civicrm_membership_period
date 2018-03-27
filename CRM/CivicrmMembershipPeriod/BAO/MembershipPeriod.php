<?php
use CRM_CivicrmMembershipPeriod_ExtensionUtil as E;

class CRM_CivicrmMembershipPeriod_BAO_MembershipPeriod extends CRM_CivicrmMembershipPeriod_DAO_MembershipPeriod {

  /**
   * Create a new MembershipPeriod based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_CivicrmMembershipPeriod_DAO_MembershipPeriod|NULL
   **/
  public static function create($params)
  {
    $className = 'CRM_CivicrmMembershipPeriod_DAO_MembershipPeriod';
    $entityName = 'MembershipPeriod';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }

  /**
  * Obtein the last membership period created
  * If there isn't exists it will be created
  *
  * @param id $id membership id
  * @param array $params key-value pairs
  * @return CRM_CivicrmMembershipPeriod_DAO_MembershipPeriod
  */
  public static function UpdateLastMembershipPeriod($id, $params)
  {
    $className = 'CRM_CivicrmMembershipPeriod_DAO_MembershipPeriod';
    $entityName = 'MembershipPeriod';

    try {
      $periods = civicrm_api3('MembershipPeriod', 'get', array(
        'membership_id' => $id
      ));
    }
    catch (CiviCRM_API3_Exception $e) {
      $error = $e->getMessage();
    }

    $hook = $periods['count'] == 0 ? 'create' : 'edit';

    if( $hook == 'edit')
    {
      $params['id'] = end($periods['values'])['id'];
    }

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }

}
