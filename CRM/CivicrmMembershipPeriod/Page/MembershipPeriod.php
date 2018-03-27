<?php
use CRM_CivicrmMembershipPeriod_ExtensionUtil as E;

class CRM_CivicrmMembershipPeriod_Page_MembershipPeriod extends CRM_Core_Page {

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Membership period history'));
    $id = CRM_Utils_Array::value('id', $_GET);

    $periods = CRM_CivicrmMembershipPeriod_BAO_MembershipPeriod::getMembershipPeriodHistory($id);
    
    //
    // Example: Assign a variable for use in a template
    $this->assign('currentTime', count($periods));


    $this->assign( 'periods', $periods );

    parent::run();
  }

}
