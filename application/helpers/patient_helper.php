<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * format the patient registeration number
 * @param interger $val
 * @return string
 */
function formatPatientNumber($val)
{
    return 'PATIENT' . sprintf('%08d', $val);
    ;
}

/**
 * combine first and last name
 * @param string $firstName
 * @param string $lastName
 * @return string
 */
function formatPatientName($firstName, $lastName)
{
    return $firstName . ' ' . $lastName;
}
