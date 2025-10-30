<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Frequently Asked Questions - RJMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 50px;
        }
        .faq-category {
            margin-bottom: 40px;
        }
        .accordion-button:not(.collapsed) {
            background-color: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/navigation.php'; ?>

    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Frequently Asked Questions</h1>
            <p class="lead">Find answers to common questions</p>
        </div>
    </div>

    <div class="container mb-5">
        <!-- General Questions -->
        <div class="faq-category">
            <h3 class="mb-4"><i class="fas fa-question-circle me-2"></i>General Questions</h3>
            <div class="accordion" id="generalFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#g1">
                            What is RJMS?
                        </button>
                    </h2>
                    <div id="g1" class="accordion-collapse collapse show" data-bs-parent="#generalFAQ">
                        <div class="accordion-body">
                            RJMS (Research Journal Management System) is a comprehensive platform designed to streamline the entire 
                            process of academic journal management, from submission to publication. It provides tools for authors, 
                            reviewers, editors, and administrators to collaborate efficiently.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#g2">
                            Who can use RJMS?
                        </button>
                    </h2>
                    <div id="g2" class="accordion-collapse collapse" data-bs-parent="#generalFAQ">
                        <div class="accordion-body">
                            RJMS is designed for researchers, academic institutions, journal publishers, peer reviewers, and editors. 
                            Anyone involved in the scholarly publishing process can benefit from our platform.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#g3">
                            Is RJMS free to use?
                        </button>
                    </h2>
                    <div id="g3" class="accordion-collapse collapse" data-bs-parent="#generalFAQ">
                        <div class="accordion-body">
                            RJMS offers different pricing tiers depending on your needs. Authors can submit papers for free, while 
                            institutions may subscribe for advanced features and unlimited submissions.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Questions -->
        <div class="faq-category">
            <h3 class="mb-4"><i class="fas fa-upload me-2"></i>Submission Questions</h3>
            <div class="accordion" id="submissionFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s1">
                            How do I submit a paper?
                        </button>
                    </h2>
                    <div id="s1" class="accordion-collapse collapse" data-bs-parent="#submissionFAQ">
                        <div class="accordion-body">
                            After creating an account and logging in, navigate to your Author Dashboard and click "Submit New Article". 
                            Fill in the required information, upload your manuscript, and submit. You'll receive a confirmation email 
                            and can track your submission's progress in your dashboard.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s2">
                            What file formats are accepted?
                        </button>
                    </h2>
                    <div id="s2" class="accordion-collapse collapse" data-bs-parent="#submissionFAQ">
                        <div class="accordion-body">
                            We accept PDF, DOC, DOCX, and LaTeX files. PDF is preferred for the final submission. Make sure your 
                            document is properly formatted according to the journal's guidelines.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s3">
                            Can I edit my submission after submitting?
                        </button>
                    </h2>
                    <div id="s3" class="accordion-collapse collapse" data-bs-parent="#submissionFAQ">
                        <div class="accordion-body">
                            Once submitted, you cannot directly edit your submission. However, you can withdraw it and resubmit, 
                            or request the editor to return it for revision. If revisions are requested during the review process, 
                            you'll be able to upload a revised version.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s4">
                            How long does the review process take?
                        </button>
                    </h2>
                    <div id="s4" class="accordion-collapse collapse" data-bs-parent="#submissionFAQ">
                        <div class="accordion-body">
                            The review timeline varies by journal and submission. Typically, initial review takes 4-6 weeks, 
                            with the complete review process taking 2-3 months. You can track your submission status in real-time 
                            through your dashboard.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Questions -->
        <div class="faq-category">
            <h3 class="mb-4"><i class="fas fa-user-check me-2"></i>Reviewer Questions</h3>
            <div class="accordion" id="reviewerFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#r1">
                            How do I become a reviewer?
                        </button>
                    </h2>
                    <div id="r1" class="accordion-collapse collapse" data-bs-parent="#reviewerFAQ">
                        <div class="accordion-body">
                            Create an account and select "Reviewer" as your role. Complete your profile with your expertise areas 
                            and qualifications. Editors will invite you to review submissions that match your expertise.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#r2">
                            How long do I have to complete a review?
                        </button>
                    </h2>
                    <div id="r2" class="accordion-collapse collapse" data-bs-parent="#reviewerFAQ">
                        <div class="accordion-body">
                            Typical review deadlines are 14-21 days from assignment. You'll see the specific deadline when accepting 
                            a review invitation. If you need more time, contact the editor before the deadline.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#r3">
                            Is the review process anonymous?
                        </button>
                    </h2>
                    <div id="r3" class="accordion-collapse collapse" data-bs-parent="#reviewerFAQ">
                        <div class="accordion-body">
                            RJMS supports both single-blind and double-blind review processes, depending on the journal's policy. 
                            In most cases, reviewers remain anonymous to authors, but editors can see reviewer identities.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Questions -->
        <div class="faq-category">
            <h3 class="mb-4"><i class="fas fa-cog me-2"></i>Technical Questions</h3>
            <div class="accordion" id="technicalFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#t1">
                            I forgot my password. What should I do?
                        </button>
                    </h2>
                    <div id="t1" class="accordion-collapse collapse" data-bs-parent="#technicalFAQ">
                        <div class="accordion-body">
                            Click "Forgot Password" on the login page. Enter your registered email address, and we'll send you 
                            instructions to reset your password.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#t2">
                            What browsers are supported?
                        </button>
                    </h2>
                    <div id="t2" class="accordion-collapse collapse" data-bs-parent="#technicalFAQ">
                        <div class="accordion-body">
                            RJMS works best with modern browsers including Chrome, Firefox, Safari, and Edge (latest versions). 
                            We recommend keeping your browser updated for the best experience.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#t3">
                            Is my data secure?
                        </button>
                    </h2>
                    <div id="t3" class="accordion-collapse collapse" data-bs-parent="#technicalFAQ">
                        <div class="accordion-body">
                            Yes, we use industry-standard encryption and security practices to protect your data. All submissions 
                            and personal information are stored securely, and we never share your data with third parties without 
                            your consent.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="text-center mt-5 p-5 bg-light rounded">
            <h4 class="mb-3">Still Have Questions?</h4>
            <p class="text-muted mb-4">Can't find the answer you're looking for? We're here to help!</p>
            <a href="/contact" class="btn btn-primary btn-lg">
                <i class="fas fa-envelope me-2"></i>Contact Support
            </a>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
