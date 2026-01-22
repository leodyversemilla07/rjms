<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\EmailService;
use App\Core\Logger;

/**
 * Test Controller
 * For verifying system features
 */
class TestController extends Controller
{
    private EmailService $emailService;

    public function __construct()
    {
        // Only allow admins or developer mode for testing
        // For now, we'll keep it open but suggest protecting it later
        $this->emailService = new EmailService();
    }

    /**
     * Send a test email
     */
    public function testEmail(): void
    {
        $to = $_GET['to'] ?? null;
        
        if (!$to) {
            echo "<h1>Email Test</h1>";
            echo "<p>Please provide a recipient email in the URL: <code>/test-email?to=your@email.com</code></p>";
            return;
        }

        echo "<h1>Sending test email to: " . htmlspecialchars($to) . "...</h1>";
        
        $subject = "RJMS SMTP Test Connection";
        $body = "
            <h2>Connection Successful!</h2>
            <p>If you are reading this, your Research Journal Management System (RJMS) is correctly configured to send emails.</p>
            <p><strong>Timestamp:</strong> " . date('Y-m-d H:i:s') . "</p>
            <hr>
            <p>This is a system-generated test message.</p>
        ";

        $result = $this->emailService->send($to, "Test Recipient", $subject, $body);

        if ($result) {
            echo "<h2 style='color: green;'>✓ Success!</h2>";
            echo "<p>Check your inbox (and spam folder) for the test message.</p>";
        } else {
            echo "<h2 style='color: red;'>✗ Failed!</h2>";
            echo "<p>Check the system logs in <code>logs/</code> for detailed error information.</p>";
        }
        
        echo "<br><a href='/'>Go to Home</a>";
    }
}
