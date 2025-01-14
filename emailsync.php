<?php

use WHMCS\Database\Capsule;

add_hook('ClientEdit', 1, function ($vars) {
    // Get the client ID and new email from the edited client
    $clientId = $vars['userid'];
    $newEmail = $vars['email'];

    // Check the relationship in tblusers_clients
    $userClientRelation = Capsule::table('tblusers_clients')
        ->select('auth_user_id') // Column in tblusers_clients that maps to tblusers.id
        ->where('client_id', $clientId)
        ->first();

    if ($userClientRelation && $userClientRelation->auth_user_id) {
        // Update the email in tblusers
        Capsule::table('tblusers')
            ->where('id', $userClientRelation->auth_user_id)
            ->update(['email' => $newEmail]);
    }
});
