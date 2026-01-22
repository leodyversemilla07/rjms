<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Core\Logger;

class EmailService
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->setup();
    }

    /**
     * Configure PHPMailer with environment variables
     */
    private function setup()
    {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host       = env('MAIL_HOST', 'smtp.example.com');
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = env('MAIL_USERNAME', 'user@example.com');
            $this->mailer->Password   = env('MAIL_PASSWORD', 'secret');
            $this->mailer->SMTPSecure = env('MAIL_ENCRYPTION', PHPMailer::ENCRYPTION_STARTTLS);
            $this->mailer->Port       = env('MAIL_PORT', 587);

            // Default sender
            $this->mailer->setFrom(
                env('MAIL_FROM_ADDRESS', 'noreply@rjms.com'),
                env('MAIL_FROM_NAME', 'RJMS System')
            );

            // CharSet
            $this->mailer->CharSet = 'UTF-8';

        } catch (Exception $e) {
            Logger::error("EmailService Setup Error: {$e->getMessage()}");
        }
    }

    /**
     * Send an email
     * 
     * @param string $to Recipient email
     * @param string $name Recipient name
     * @param string $subject Email subject
     * @param string $body Email body (HTML)
     * @param string $altBody Plain text body
     * @return bool True on success, false on failure
     */
    public function send(string $to, string $name, string $subject, string $body, string $altBody = ''): bool
    {
        try {
            // Reset recipients for new email
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();

            $this->mailer->addAddress($to, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->AltBody = $altBody ?: strip_tags($body);

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            Logger::error("Email Send Error to {$to}: {$this->mailer->ErrorInfo}");
            return false;
        }
    }

    /**
     * Send welcome email to new user
     */
    public function sendWelcomeEmail(string $email, string $name): bool
    {
        $subject = 'Welcome to RJMS';
        $body = "
            <h1>Welcome to RJMS, {$name}!</h1>
            <p>Thank you for registering with the Research Journal Management System.</p>
            <p>You can now log in and start using our platform.</p>
            <p><a href='" . env('APP_URL', 'http://localhost') . "/login'>Login here</a></p>
        ";

        return $this->send($email, $name, $subject, $body);
    }

    /**
     * Send submission confirmation
     */
    public function sendSubmissionConfirmation(string $email, string $name, string $title): bool
    {
        $subject = 'Submission Received: ' . $title;
        $body = "
            <h1>Submission Received</h1>
            <p>Dear {$name},</p>
            <p>We have successfully received your manuscript titled <strong>{$title}</strong>.</p>
            <p>Our editorial team will review it shortly.</p>
        ";

        return $this->send($email, $name, $subject, $body);
    }

    /**
     * Send reviewer assignment notification
     */
    public function sendReviewAssignment(string $email, string $name, string $title, string $deadline): bool
    {
        $subject = 'Review Assignment: ' . $title;
        $body = "
            <h1>New Review Assignment</h1>
            <p>Dear {$name},</p>
            <p>You have been assigned to review the manuscript: <strong>{$title}</strong>.</p>
            <p>The deadline for this review is: <strong>{$deadline}</strong>.</p>
            <p>Please log in to your dashboard to accept or decline this assignment.</p>
        ";

        return $this->send($email, $name, $subject, $body);
    }

    /**
     * Send decision notification to author
     */
    public function sendDecisionNotification(string $email, string $name, string $title, string $decision): bool
    {
        $subject = 'Editor Decision: ' . $title;
        $decisionText = ucfirst($decision);
        
        $body = "
            <h1>Editor Decision</h1>
            <p>Dear {$name},</p>
            <p>A decision has been made regarding your submission: <strong>{$title}</strong>.</p>
            <p><strong>Decision: {$decisionText}</strong></p>
            <p>Please log in to your dashboard to view the full details and any reviewer comments.</p>
        ";

        return $this->send($email, $name, $subject, $body);
    }
}
