<?php 

function up_rest_api_add_rating_handler($request) {
    $response = ['status' => 1];

    $params = $request->get_json_params();

    //make sure required fields are not empty
    if(!isset($params['postID'], $params['rating']) || 
        empty($params['postID']) ||
        empty($params['rating'])
        ) {
        return $response;
    }

    $postID = absint(($params['postID']));
    $rating = round(floatval($params['rating']), 1);
    $userID = get_current_user_id();

    global $wpdb;

    $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}recipe_rating
        WHERE post_id=%d AND user_id=%d",
        $postID, $userID
    ));

    if($wpdb->num_rows > 0) {
        return $response;
    }

    $wpdb->insert( 
        "{$wpdb->prefix}recipe_rating",
        [
            'post_id' => $postID,
            'rating' => $rating, 
            'user_id' => $userID
        ],
        [ '%d', '%f', '%d' ]
    );

    $avgRating = round($wpdb->get_var($wpdb->prepare(
        "SELECT AVG(`rating`) FROM {$wpdb->prefix}recipe_rating
        WHERE post_id=%d", $postID
    )), 1);

    update_post_meta($postID, 'recipe_rating', $avgRating);
   
    $response['status'] = 2;
    $response['rating'] = $avgRating;
    return $response;
}