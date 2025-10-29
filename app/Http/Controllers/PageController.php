<?php

namespace App\Http\Controllers;

use App\Jobs\SendAutoReplyEmail;
use App\Jobs\SendContactFormEmail;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Mail\CustomerAutoReply;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function home()
    {
        $services = [
            [
                'icon' => 'fas fa-code',
                'title' => 'Web Development',
                'description' => 'Custom websites and web applications built with the latest technologies to ensure performance, security, and scalability.'
            ],
            [
                'icon' => 'fas fa-mobile-alt',
                'title' => 'App Development',
                'description' => 'Native and cross-platform mobile applications that provide seamless user experiences across all devices.'
            ],
            [
                'icon' => 'fas fa-chart-line',
                'title' => 'Digital Marketing',
                'description' => 'Comprehensive digital marketing strategies including SEO, social media marketing, and PPC campaigns.'
            ],
            [
                'icon' => 'fas fa-paint-brush',
                'title' => 'Design & Branding',
                'description' => 'Creative design solutions including logos, UI/UX design, brand identity, and marketing materials.'
            ]
        ];

        $features = [
            [
                'icon' => 'fas fa-shield-alt',
                'title' => 'Trust & Reliability',
                'description' => 'We build long-term relationships with our clients based on trust and consistent delivery.'
            ],
            [
                'icon' => 'fas fa-star',
                'title' => 'Premium Quality',
                'description' => 'Our team of experts ensures that every project meets the highest quality standards.'
            ],
            [
                'icon' => 'fas fa-indian-rupee-sign',
                'title' => 'Affordable Pricing',
                'description' => 'We offer competitive pricing without compromising on quality or service.'
            ],
            [
                'icon' => 'fas fa-clock',
                'title' => 'On-Time Delivery',
                'description' => 'We understand the importance of deadlines and ensure timely project completion.'
            ]
        ];

        $testimonials = [
            [
                'text' => 'Jochan Tech transformed our online presence. Our website traffic increased by 200% and conversion rates tripled within just 3 months of working with them.',
                'author' => 'Rahul Sharma, E-commerce Business Owner'
            ],
            [
                'text' => 'The team at Jochan Tech delivered a stunning website that perfectly captured our brand identity. Their attention to detail and communication throughout the project was exceptional.',
                'author' => 'Priya Patel, Creative Agency Director'
            ],
            [
                'text' => 'We\'ve been using their digital marketing services for the past year, and the results have been phenomenal. Our ROI has increased significantly across all channels.',
                'author' => 'Amit Kumar, Tech Startup Founder'
            ]
        ];

        $pricingPlans = [
            [
                'name' => 'Starter Package',
                'price' => '₹10,000+',
                'description' => 'Starting from ₹10,000',
                'features' => [
                    '3-5 Page Website',
                    'Mobile Responsive Design',
                    'Basic SEO Setup',
                    'Contact Form',
                    '1 Month Technical Support'
                ],
                'popular' => false
            ],
            [
                'name' => 'Growth Package',
                'price' => '₹20,000-35,000',
                'description' => 'Perfect for growing businesses',
                'features' => [
                    '6-10 Page Dynamic Website',
                    'Social Media Integration',
                    '1 Month Basic Digital Marketing',
                    'Content Management System',
                    '3 Months Technical Support'
                ],
                'popular' => true
            ],
            [
                'name' => 'Premium Package',
                'price' => '₹50,000-1,00,000',
                'description' => 'Comprehensive solution',
                'features' => [
                    'Full Custom Website/Web App',
                    'Payment Gateway Integration',
                    'Advanced SEO Optimization',
                    '3 Months Digital Marketing',
                    'Brand Kit (Logo, Guidelines)',
                    '6 Months Technical Support'
                ],
                'popular' => false
            ]
        ];

        return view('home', compact('services', 'features', 'testimonials', 'pricingPlans'));
    }


public function contactSubmit(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'message' => 'required|string|min:10|max:1000'
    ]);

    try {
        // Save to database
        $submission = ContactSubmission::create($validated);

        // Dispatch jobs for emails
        SendContactFormEmail::dispatch($submission);
        SendAutoReplyEmail::dispatch($submission);

        return back()->with('success', 'Thank you for your enquiry! We have received your message and will get back to you within 24 hours.');

    } catch (\Exception $e) {
        Log::error('Contact form submission failed: ' . $e->getMessage());
        
        return back()->with('error', 'Sorry, there was an error sending your message. Please try again or contact us directly.');
    }
}
}