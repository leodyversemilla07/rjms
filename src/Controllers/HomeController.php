<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Submission;

/**
 * Home Controller
 * Handles homepage and public pages
 */
class HomeController extends Controller
{
    private Submission $submissionModel;

    public function __construct()
    {
        $this->submissionModel = new Submission();
    }

    /**
     * Display homepage
     */
    public function index(): void
    {
        // Get recent published articles
        $articles = $this->submissionModel->getRecent(6);
        
        // Get statistics
        $stats = [
            'total_articles' => count($this->submissionModel->getPublished()),
            'total_researchers' => 500, // This could be dynamic
            'research_fields' => 50,
            'impact_factor' => 2.8
        ];

        $this->view('home/index', [
            'articles' => $articles,
            'stats' => $stats
        ]);
    }

    /**
     * Display about page
     */
    public function about(): void
    {
        $this->view('home/about');
    }

    /**
     * Display contact page
     */
    public function contact(): void
    {
        $this->view('home/contact');
    }

    /**
     * Handle contact form submission
     */
    public function sendContact(): void
    {
        try {
            $data = $this->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'subject' => 'required|max:255',
                'message' => 'required'
            ]);

            // TODO: Send email or save to database
            
            $this->flash('success', 'Your message has been sent successfully!');
            $this->redirect('/contact');
        } catch (\Exception $e) {
            $this->redirect('/contact');
        }
    }

    /**
     * Display FAQ page
     */
    public function faq(): void
    {
        $this->view('home/faq');
    }

    /**
     * Display current issues
     */
    public function currentIssues(): void
    {
        $articles = $this->submissionModel->getPublished();
        $this->view('home/current-issues', ['articles' => $articles]);
    }

    /**
     * Search articles
     */
    public function search(): void
    {
        $keyword = $_GET['q'] ?? '';
        $results = [];

        if (!empty($keyword)) {
            $results = $this->submissionModel->search($keyword);
        }

        $this->view('home/search', [
            'keyword' => $keyword,
            'results' => $results
        ]);
    }
}
