<?php 

function up_rest_api_signup_handler($request) {
    //initial status - 1 is fail, should update to 2 to represent success
    $response = ['status' => 1];
    $params = $request->get_json_params();

    //make sure fields are not empty
    if(!isset($params['email'], $params['username'], $params['password']) || 
        empty($params['email']) || 
        empty($params['username']) ||
        empty($params['password'])
        ) {
        return $response;
    }

    //sanitize values
    $email = sanitize_email($params['email']);
    $username = sanitize_text_field($params['username']);
    $password = sanitize_text_field($params['password']);

    // check database for duplicates
    if(
        username_exists($username) ||
        !is_email($email) ||
        email_exists($email)
    ) {
        return $response;
    }

    //Adds user to database
    $userID = wp_insert_user([
        'user_login' => $username,
        'user_pass' => $password,
        'user_email' => $email
    ]);

    //stores error and sends as response
    if(is_wp_error($userID)) {
        return $response;
    }

    //Send confirmation email, login, add cookie
    wp_new_user_notification($userID, null, 'user');
    wp_set_current_user($userID);
    wp_set_auth_cookie($userID);

    $user = get_user_by('id', $userID);

    do_action('wp_login', $user->user_login,);

    $response['status'] = 2;
    return $response;

}