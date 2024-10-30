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
