<?php

use CRM_GvoteConnection_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_GvoteConnection_Form_GVoteSettings extends CRM_Core_Form {

  /**
   * @throws \CRM_Core_Exception
   */
  public function buildQuickForm(): void {
    CRM_Utils_System::setTitle(ts('GVote Connection Settings', ['domain' => 'gvote_connection']));
    CRM_Core_Resources::singleton()->addStyleFile('gvote_connection', 'css/gvote_connection.css');  
    
    $this->add(
      'text',
      'gvote_connection_endpoint',
      ts('Endpoint', ['domain' => 'gvote_connection']),
      [],
      TRUE
    );
    
    $this->add(
      'text',
      'gvote_connection_api_auth_token',
      ts('API Auth Token', ['domain' => 'gvote_connection']),
      [],
      TRUE
    );
      
    $this->add(
      'text',
      'gvote_connection_authority_id',
      ts('Authority ID', ['domain' => 'gvote_connection']),
      [],
      TRUE
    );
    
    $activity_types = $this->getActivityTypeOptions();
    
    $this->add(
      'select',
      'gvote_connection_volunteer_activity_id',
      ts('Volunteer Activity', ['domain' => 'gvote_connection']),
      $activity_types,
      TRUE
    );

    $this->add(
      'select',
      'gvote_connection_sign_request_activity_id',
      ts('Sign Request Activity', ['domain' => 'gvote_connection']),
      $activity_types,
      TRUE
    );

    $this->add(
      'select',
      'gvote_connection_vote_pledge_activity_id',
      ts('Vote Pledge Activity', ['domain' => 'gvote_connection']),
      $activity_types,
      TRUE
    );
          
    /*
      - contribution information
      - membership information
    */
  
    $this->addButtons([
      [
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ],
    ]);

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess(): void {
    $values = $this->exportValues();
    /*$options = $this->getColorOptions();
    CRM_Core_Session::setStatus(E::ts('You picked color "%1"', [
      1 => $options[$values['favorite_color']],
    ]));*/
    parent::postProcess();
  }

  private function getActivityTypeOptions(): array {
      $options = [
        '' => E::ts('- select -'),
      ];
      
      $option_group = Civi\Api4\OptionGroup::get()
          ->addWhere('name', '=', 'activity_type')
          ->setLimit(1)
          ->execute();
      
      if (empty($option_group)) {
          return $options;
      }
      
      $option_values = Civi\Api4\OptionValue::get()
          ->addWhere('option_group_id', '=', $option_group[0]['id'])
          ->execute();
      
      foreach($option_values as $option_value) {
          $options[$option_value['value']] = $option_value['label'];
      }
      
      return $options;
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames(): array {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = [];
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
