<?php

function setMessage($type, $label = '')
{
    $label = ucfirst(strtolower($label));

    if (strtolower($type) == 'create') {
        $msg = $label . " has been created successfully";
    } elseif (strtolower($type) == 'update') {
        $msg = $label . " has been updated successfully";
    } elseif (strtolower($type) == 'delete') {
        $msg = $label . " has been deleted successfully";
    } elseif (strtolower($type) == 'create.error') {
        $msg = "Error in saving " . $label;
    } elseif (strtolower($type) == 'update.error') {
        $msg = "Error in updating " . $label;
    } else {
        $msg = '';
    }
    return $msg;
}

function getStatus($statsu): string
{
    return $statsu == 1 ? 'Active' : 'Inactive';
}

/**
 * get status
 *
 * @param int $status_id
 * @return string
 */
function setBookMark($mark_id = ''): string
{
    if ($mark_id == 0) {
        $status = '<span class="label label-inline label-danger">Not Favorite</span>';
    } else if ($mark_id == 1) {
        $status = '<span class="label label-inline label-success">Favorite</span>';
    } else {
        $status = '';
    }
    return $status;
}


function checkEmpty($value)
{
    return isset($value) ? (!empty($value) ? $value : null) : null;
}

function checkNull($value)
{
    return isset($value) ? (!empty($value) ? $value : '--') : '--';
}
