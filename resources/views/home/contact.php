<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 50px;
        }
        .contact-card {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .info-box {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Contact Us</h1>
            <p class="lead">We'd love to hear from you</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-8">
                <div class="contact-card">
                    <h3 class="mb-4">Send Us a Message</h3>
                    
                    <?php if (isset($_SESSION['flash'])): ?>
                        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                            <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                                <?= htmlspecialchars($message) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['flash'][$type]); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <form id="contactForm" method="POST" action="/contact/submit">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Subject *</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="">Choose a subject...</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="technical">Technical Support</option>
                                    <option value="submission">Submission Help</option>
                                    <option value="account">Account Issues</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="6" required
                                          placeholder="How can we help you?"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-md-4">
                <div class="info-box">
                    <h5 class="mb-3"><i class="fas fa-envelope me-2"></i>Email</h5>
                    <p class="text-muted">support@rjms.edu</p>
                    <p class="text-muted">admin@rjms.edu</p>
                </div>

                <div class="info-box">
                    <h5 class="mb-3"><i class="fas fa-phone me-2"></i>Phone</h5>
                    <p class="text-muted">+1 (555) 123-4567</p>
                    <p class="text-muted">Mon-Fri: 9:00 AM - 5:00 PM EST</p>
                </div>

                <div class="info-box">
                    <h5 class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>Address</h5>
                    <p class="text-muted">
                        Research Journal Management<br>
                        123 Academic Way<br>
                        University City, ST 12345<br>
                        United States
                    </p>
                </div>

                <div class="info-box">
                    <h5 class="mb-3"><i class="fas fa-clock me-2"></i>Response Time</h5>
                    <p class="text-muted">We typically respond within 24-48 hours during business days.</p>
                </div>

                <div class="info-box">
                    <h5 class="mb-3"><i class="fas fa-question-circle me-2"></i>Quick Help</h5>
                    <p class="text-muted mb-2">Looking for answers?</p>
                    <a href="/faq" class="btn btn-sm btn-outline-primary w-100">
                        <i class="fas fa-book me-2"></i>Visit FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            const btn = $(this).find('button[type=submit]');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Sending...');
            
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Message sent successfully! We\'ll get back to you soon.');
                        $('#contactForm')[0].reset();
                    } else {
                        alert(response.message || 'Failed to send message. Please try again.');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again later.');
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Send Message');
                }
            });
        });
    </script>
</body>
</html>
