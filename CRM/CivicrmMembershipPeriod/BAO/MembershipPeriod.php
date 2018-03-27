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

  /**
  * Obtein membership
  *
  * @param id $id membership id
  * @return CRM_Membership_DAO_Membership
  */
  public static function getMembership($id)
  {
    $membership = array();
    if ($id) {
      $membershipObj = new CRM_Member_DAO_Membership();
      $membershipObj->id = $id;
      $membershipObj->find();
      while ($membershipObj->fetch()) {
        $membership['membership_id'] = $membershipObj->id;
        $membership['start_date'] = $membershipObj->start_date;
        $membership['end_date'] = $membershipObj->end_date;
      }
    }
    return $membership;
  }

  /**
  * Obtein membership period history
  *
  * @param id $id membership id
  * @return CRM_Membership_DAO_Membership
  */
  public static function getMembershipPeriodHistory($id)
  {
    try {
        $periods = civicrm_api3('MembershipPeriod', 'get', array(
          'membership_id' => $id,
          'return' => array(
            'id',
            'membership_id',
            'start_date',
            'end_date',
            'contribution_id.total_amount',
            'contribution_id.contact_id',
            'contribution_id'
          ),
        ));
    }
    catch (CiviCRM_API3_Exception $e) {
        $error = $e->getMessage();
    }

    return $periods['values'];
  }
}
