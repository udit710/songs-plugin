<?php

class SP_REST_API{
    public function __construct() {
        add_action('rest_api_init', [$this, 'sp_register_rest_api']);
    }

    function sp_register_rest_api(){
        register_rest_route( 
            'songs/v1', 
            'send-suggestions', 
            [
                'methods' => 'POST', 
                'callback' => [$this,'sp_handle_song_suggestion_form']
            ]);
    }

    function sp_handle_song_suggestion_form($data){
        $headers = $data->get_headers();
        $params = $data->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        if (!wp_verify_nonce( $nonce,'wp_rest')){
            return new WP_REST_Response('Message not sent', 422);
        }

        $content = 'Name: ' . sanitize_text_field($params['song-name']) . ' Email: ' . sanitize_text_field($params['email']) . ' Description: ' . sanitize_textarea_field($params['song-desc']);

        $post_id = wp_insert_post([
            'post_type' => 'sp_song',
            'post_title' => sanitize_text_field($params['name']),
            'post_excerpt' => $content,
            'post_status' => 'pending'
        ]);

        if($post_id){
            return new WP_REST_Response('Thank you for your enquiry!', 200);
        }

        return new WP_REST_Response('Something went wrong.', 500);

    }
}