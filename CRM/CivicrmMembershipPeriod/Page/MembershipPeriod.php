<?php
use CRM_CivicrmMembershipPeriod_ExtensionUtil as E;

class CRM_CivicrmMembershipPeriod_Page_MembershipPeriod extends CRM_Core_Page {

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Membership period history'));
    $id = CRM_Utils_Array::value('id', $_GET);

    try {
        $periods = civicrm_api3('MembershipPeriod', 'get', array(
            'membership_id' => $id
        ));
    }
    catch (CiviCRM_API3_Exception $e) {
        $error = $e->getMessage();
    }
    //
    // Example: Assign a variable for use in a template
    $this->assign('currentTime', $periods['count']);


    $this->assign( 'periods', $periods['values'] );

    parent::run();
  }

}
