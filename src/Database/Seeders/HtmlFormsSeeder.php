<?php

namespace FunctionalityPlugin\Database\Seeders;

use Illuminate\Database\Seeder;

class HtmlFormsSeeder extends Seeder
{
    public function run()
    {
        if (post_exists('Contact', '', '', 'html-form')) {
            throw new \Exception('Contact form already exists');
        }

        $fromAddress = getenv('MAIL_FROM_ADDRESS') ?: get_option('admin_email');

        $htmlFormsId = wp_insert_post([
            'post_type' => 'html-form',
            'post_title' => 'Contact',
            'post_content' => $this->getPartial('form.php'),
            'post_status' => 'publish',
            'meta_input' => [
                '_hf_settings' => [
                    'required_fields' => 'naam,email,bericht',
                    'email_fields' => 'email',
                    'save_submissions' => '1',
                    'hide_after_success' => '0',
                    'redirect_url' => '',
                    'actions' => [
                        [
                            'type' => 'email',
                            'from' => $fromAddress,
                            'to' => get_option('admin_email'),
                            'subject' => 'Nieuw bericht van [naam]',
                            'message' => $this->getPartial('emails/notification.php'),
                            'content_type' => 'text/plain',
                            'headers' => 'Reply-To: [naam] <[email]>'
                        ],
                        [
                            'type' => 'email',
                            'from' => $fromAddress,
                            'to' => '[email]',
                            'subject' => 'Verzendbevestiging',
                            'message' => $this->getPartial('emails/confirmation.php'),
                            'content_type' => 'text/plain',
                            'headers' => 'Reply-To: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>'
                        ]
                    ]
                ],
                'hf_message_success' => 'Bedankt! We nemen contact met je op.',
                'hf_message_invalid_email' => 'Dit e-mailadres lijkt niet te kloppen.',
                'hf_message_required_field_missing' => 'Vul de vereiste velden in.',
                'hf_message_error' => 'Er is een fout opgetreden.',
            ]
        ]);

        if (is_wp_error($htmlFormsId)) {
            throw new \Exception($htmlFormsId->get_error_message());
        }

        return $htmlFormsId;
    }

    private function getPartial($partial)
    {
        ob_start();
        include('partials/htmlforms/' . ltrim($partial, '/'));      
        return ob_get_clean();
    }
}
