<?php

/**
 * Global Connect AI Chatbot Logic
 * Handles API communication with OpenAI.
 */

if (!defined('ABSPATH')) {
    exit;
}

class GC_AI_Chat
{

    private $api_url = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function register_routes()
    {
        register_rest_route('gc/v1', '/chat', array(
            'methods' => 'POST',
            'callback' => array($this, 'handle_chat_request'),
            'permission_callback' => '__return_true', // We verify nonce manually? Or public for guests? Guest access needed.
        ));
    }

    public function handle_chat_request($request)
    {

        // 1. Security Check (Nonce)
        $nonce = $request->get_header('X-WP-Nonce');
        if (!wp_verify_nonce($nonce, 'wp_rest')) {
            return new WP_Error('rest_forbidden', 'Invalid security token', array('status' => 403));
        }

        $params = $request->get_json_params();
        $message = isset($params['message']) ? sanitize_text_field($params['message']) : '';
        $history = isset($params['history']) ? $params['history'] : array();

        if (empty($message)) {
            return new WP_Error('no_message', 'Message is required', array('status' => 400));
        }

        // 2. Get API Key & Prompt from Options
        // We will store these in WP Options (managed via our admin page)
        $api_key = get_option('gc_ai_api_key');
        $system_prompt = get_option('gc_ai_system_prompt', 'You are a helpful assistant for Global Connect Shipping.');
        $model = get_option('gc_ai_model', 'gpt-3.5-turbo');

        if (empty($api_key)) {
            return new WP_Error('no_key', 'AI Service not configured', array('status' => 500));
        }

        // 3. Build Payload
        $messages = array();
        $messages[] = array('role' => 'system', 'content' => $system_prompt);

        // Append history (limit to last 5 pairs to save tokens)
        // Helper logic would go here to parse $history array safely
        if (is_array($history)) {
            foreach ($history as $msg) {
                if (isset($msg['role']) && isset($msg['content'])) {
                    $messages[] = array('role' => sanitize_text_field($msg['role']), 'content' => sanitize_text_field($msg['content']));
                }
            }
        }

        // Append current message
        $messages[] = array('role' => 'user', 'content' => $message);

        $body = array(
            'model' => $model,
            'messages' => $messages,
            'max_tokens' => 300,
            'temperature' => 0.7
        );

        // 4. Call OpenAI
        $response = wp_remote_post($this->api_url, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode($body),
            'timeout' => 20,
        ));

        if (is_wp_error($response)) {
            return new WP_Error('api_error', $response->get_error_message(), array('status' => 500));
        }

        $response_body = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($response_body['error'])) {
            return new WP_Error('openai_error', $response_body['error']['message'], array('status' => 500));
        }

        // 5. Return Answer
        $bot_reply = isset($response_body['choices'][0]['message']['content']) ? $response_body['choices'][0]['message']['content'] : 'Sorry, I faced an error.';

        return new WP_REST_Response(array('reply' => $bot_reply), 200);
    }
}

new GC_AI_Chat();
