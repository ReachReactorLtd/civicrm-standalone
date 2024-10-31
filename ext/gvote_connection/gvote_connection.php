<?php

require_once 'gvote_connection.civix.php';

use CRM_GvoteConnection_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function gvote_connection_civicrm_config(&$config): void {
  _gvote_connection_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function gvote_connection_civicrm_install(): void {
  _gvote_connection_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function gvote_connection_civicrm_enable(): void {
  _gvote_connection_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * Add entries to the navigation menu, automatically removed on uninstall
 */
function gvote_connection_civicrm_navigationMenu(&$params) {
    _gvote_connection_civix_insert_navigation_menu($params, 'Administer', [
        'label' => E::ts('GVote Connection Settings'),
        'name' => 'GVote Connection Settings',
        'url' => 'civicrm/gvote-settings',
        'permission' => 'administer CiviCRM',
        'operator' => 'OR',
        'separator' => 0,
    ]);
}

/**
 * Implementation of hook_civicrm_postCommit().
 */
function gvote_connection_civicrm_postCommit($op, $objectName,
                                             $objectId, &$objectRef) {
  // Exit early if not a creation.
  if ($op !== 'create') { return; }

  // Exit early if it's the wrong object type.
  if ($objectName !== 'Contribution' && $objectName !== 'Membership'
    && $objectName !== 'Activity') { return; }
  
  // TODO: Get the settings.
  
  // TODO: Bail if the settings are not set.
    
  try {
    // TODO: Build the payload.
    // TODO: Send the payload to the GVOTE API.
  }
  catch (Exception $e) {
    // Log the error.
    \Civi::log()->error('Error in gvote_connection_civicrm_postCommit: ' . $e->getMessage());
  }
}
