@extends('layouts.app')

@section('title', 'Jochan Tech - Your Digital Growth Partner')

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Your Digital Growth Partner</h1>
                <p>We help businesses build their online presence with custom web solutions, digital marketing strategies, and stunning designs powered by our team of experts.</p>
                <a href="#contact" class="btn btn-secondary">Get Free Quote</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="tech-cube">
                <div class="front"><i class="fas fa-code"></i></div>
                <div class="back"><i class="fas fa-paint-brush"></i></div>
                <div class="right"><i class="fas fa-mobile-alt"></i></div>
                <div class="left"><i class="fas fa-chart-line"></i></div>
                <div class="top"><i class="fas fa-cloud"></i></div>
                <div class="bottom"><i class="fas fa-server"></i></div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <h2 class="text-center">Our Services</h2>
            
            <div class="services-grid">
                @foreach($services as $service)
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="{{ $service['icon'] }}"></i>
                    </div>
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['description'] }}</p>
                    <a href="#contact" class="btn btn-outline">Get Quote</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class="features-section">
        <div class="container">
            <h2 class="text-center">Why Choose Us</h2>
            
            <div class="features">
                @foreach($features as $feature)
                <div class="feature animate-on-scroll">
                    <div class="feature-icon">
                        <i class="{{ $feature['icon'] }}"></i>
                    </div>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="text-center">Success Stories</h2>
            
            <div class="testimonial-slider">
                <div class="testimonial-track">
                    @foreach($testimonials as $testimonial)
                    <div class="testimonial">
                        <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
                        <p class="testimonial-author">- {{ $testimonial['author'] }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="testimonial-nav">
                    @foreach($testimonials as $index => $testimonial)
                    <div class="testimonial-dot {{ $index === 0 ? 'active' : '' }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="container">
            <h2 class="text-center">Our Packages</h2>
            
            <div class="pricing-grid">
                @foreach($pricingPlans as $plan)
                <div class="pricing-card {{ $plan['popular'] ? 'popular' : '' }} animate-on-scroll">
                    @if($plan['popular'])
                    <div class="popular-badge">Popular</div>
                    @endif
                    <h3>{{ $plan['name'] }}</h3>
                    <div class="price">{{ $plan['price'] }}</div>
                    <p class="price-desc">{{ $plan['description'] }}</p>
                    
                    <ul class="pricing-features">
                        @foreach($plan['features'] as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    
                    <a href="#contact" class="btn {{ $plan['popular'] ? '' : 'btn-outline' }}">Get Free Quote</a>
                </div>
                @endforeach
            </div>
            
            <div class="text-center" style="margin-top: 50px;">
                <div class="pricing-card animate-on-scroll" style="max-width: 500px; margin: 0 auto;">
                    <h3>Digital Marketing Retainer</h3>
                    <div class="price">₹15,000-50,000/month</div>
                    <p class="price-desc">Ongoing digital marketing support</p>
                    
                    <ul class="pricing-features">
                        <li>Social Media Management</li>
                        <li>Monthly Ad Campaigns</li>   
                        <li>SEO & Content Strategy</li>
                        <li>Monthly Performance Reports</li>
                        <li>Dedicated Account Manager</li>
                    </ul>
                    
                    <a href="#contact" class="btn">Get Free Quote</a>
                </div>
            </div>
        </div>
    </section>

   <!-- Contact Section -->
<section id="contact" class="contact">
    <div class="container">
        <h2 class="text-center">Get In Touch</h2>
        
        <!-- Remove the old alert sections - we don't need them anymore -->
        
        <div class="contact-form animate-on-scroll">
            <form id="enquiryForm" action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" id="name" name="name" class="form-control" placeholder=" " required value="{{ old('name') }}">
                    <label for="name">Your Name</label>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder=" " required value="{{ old('email') }}">
                    <label for="email">Email Address</label>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder=" " value="{{ old('phone') }}">
                    <label for="phone">Phone Number</label>
                </div>
                
                <div class="form-group">
                    <textarea id="message" name="message" class="form-control" placeholder=" " required>{{ old('message') }}</textarea>
                    <label for="message">Your Requirement</label>
                    @error('message')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn" style="width: 100%;" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
        
        <div class="text-center" style="margin-top: 50px;">
            <a href="https://wa.me/918903723268" class="btn btn-secondary" style="margin: 10px; animation: glow 2s infinite ease-in-out;">
                <i class="fab fa-whatsapp"></i> Chat on WhatsApp
            </a>
            
            <a href="mailto:jochantech@gmail.com" class="btn btn-outline" style="margin: 10px;">
                <i class="fas fa-envelope"></i> jochantech@gmail.com
            </a>
            
            <a href="tel:+918903723268" class="btn btn-outline" style="margin: 10px;">
                <i class="fas fa-phone"></i> +91 89037 23268
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Your JavaScript code here (same as in your original HTML)
</script>
@endpush