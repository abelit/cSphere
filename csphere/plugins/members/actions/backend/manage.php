<?php

/**
 * List action
 *
 * PHP Version 5
 *
 * @category  Plugins
 * @package   Members
 * @author    Hans-Joachim Piepereit <contact@csphere.eu>
 * @copyright 2013 cSphere Team
 * @license   http://opensource.org/licenses/bsd-license Simplified BSD License
 * @link      http://www.csphere.eu
 **/

// Add breadcrumb navigation
$bread = new \csphere\core\template\Breadcrumb('admin');
$bread->add('content');
$bread->plugin('members', 'manage');
$bread->trace();

 // Get RAD class for this action
$rad = new \csphere\core\rad\Listed('members');

$rad->map('manage', 'manage');

// Define closure to execute before finder fetches results
$finder = function ($object) {

    $object->join('users', '', 'user_id');
    $object->join('groups', '', 'group_id');

    return $object;
};

$rad->callFinder($finder);

// Define order columns
$order = ['group_name', 'user_name'];

$rad->search($order, true);
$rad->delegate('group_name', $order);
