// Notification System
class NotificationSystem {
    constructor() {
        this.popup = document.getElementById('notificationPopup');
        if (!this.popup) return;
        
        this.title = this.popup.querySelector('.notification-title');
        this.message = this.popup.querySelector('.notification-message');
        this.closeBtn = this.popup.querySelector('.notification-close');
        
        this.init();
    }
    
    init() {
        // Close button event
        this.closeBtn.addEventListener('click', () => {
            this.hide();
        });
        
        // Auto-hide after 5 seconds
        this.popup.addEventListener('animationend', () => {
            if (this.popup.classList.contains('show')) {
                setTimeout(() => {
                    this.hide();
                }, 5000);
            }
        });
    }
    
    show(type, title, message) {
        if (!this.popup) return;
        
        // Remove previous classes
        this.popup.classList.remove('success', 'error', 'show');
        
        // Add current type class
        this.popup.classList.add(type);
        
        // Set content
        this.title.textContent = title;
        this.message.textContent = message;
        
        // Show popup
        setTimeout(() => {
            this.popup.classList.add('show');
        }, 100);
        
        // Scroll to contact section if it's a success message
        if (type === 'success') {
            setTimeout(() => {
                const contactSection = document.getElementById('contact');
                if (contactSection) {
                    contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 300);
        }
    }
    
    hide() {
        if (this.popup) {
            this.popup.classList.remove('show');
        }
    }
}

// Global function to show notifications
window.showNotification = function(type, title, message) {
    if (window.notificationSystem) {
        window.notificationSystem.show(type, title, message);
    }
};

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize notification system
    window.notificationSystem = new NotificationSystem();
    
    // Check for session messages and show notification
    const successMessage = document.querySelector('[data-success]');
    const errorMessage = document.querySelector('[data-error]');
    
    if (successMessage) {
        const message = successMessage.getAttribute('data-success');
        window.notificationSystem.show('success', 'Success!', message);
        
        // Remove the data attribute after showing popup
        setTimeout(() => {
            successMessage.remove();
        }, 1000);
    }
    
    if (errorMessage) {
        const message = errorMessage.getAttribute('data-error');
        window.notificationSystem.show('error', 'Error!', message);
        
        // Remove the data attribute after showing popup
        setTimeout(() => {
            errorMessage.remove();
        }, 1000);
    }

    // Theme Toggle
    const themeToggle = document.querySelector('.theme-toggle');
    if (themeToggle) {
        const themeIcon = themeToggle.querySelector('i');
        
        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('light-mode');
            
            if (document.body.classList.contains('light-mode')) {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            } else {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            }
            
            // Save preference to localStorage
            const isLightMode = document.body.classList.contains('light-mode');
            localStorage.setItem('lightMode', isLightMode);
        });
        
        // Check for saved theme preference
        if (localStorage.getItem('lightMode') === 'true') {
            document.body.classList.add('light-mode');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
    }

    // Mobile Navigation
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            
            if (navLinks.classList.contains('active')) {
                hamburger.innerHTML = '<i class="fas fa-times"></i>';
            } else {
                hamburger.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
        
        // Close mobile nav when clicking on links
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function() {
                navLinks.classList.remove('active');
                if (hamburger) {
                    hamburger.innerHTML = '<i class="fas fa-bars"></i>';
                }
            });
        });
    }

    // Testimonial Slider
    const track = document.querySelector('.testimonial-track');
    const dots = document.querySelectorAll('.testimonial-dot');
    
    if (track && dots.length > 0) {
        let currentIndex = 0;
        
        function showTestimonial(index) {
            track.style.transform = `translateX(-${index * 100}%)`;
            
            // Update dots
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
            
            currentIndex = index;
        }
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                showTestimonial(index);
            });
        });
        
        // Auto slide testimonials
        setInterval(() => {
            currentIndex = (currentIndex + 1) % dots.length;
            showTestimonial(currentIndex);
        }, 5000);
    }

    // Scroll animations
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    function checkScroll() {
        animatedElements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight * 0.85;
            
            if (elementPosition < screenPosition) {
                element.classList.add('is-visible');
            }
        });
    }
    
    // Check on load and scroll
    window.addEventListener('load', checkScroll);
    window.addEventListener('scroll', checkScroll);

    // Form submission
    const enquiryForm = document.getElementById('enquiryForm');
    
    if (enquiryForm) {
        enquiryForm.addEventListener('submit', function(e) {
            // Form validation
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            let isValid = true;

            // Clear previous errors
            document.querySelectorAll('.error').forEach(error => {
                error.remove();
            });

            // Reset border colors
            document.querySelectorAll('.form-control').forEach(input => {
                input.style.borderColor = '';
            });

            // Name validation
            if (!name.value.trim()) {
                showError(name, 'Name is required');
                isValid = false;
            }

            // Email validation
            if (!email.value.trim()) {
                showError(email, 'Email is required');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }

            // Message validation
            if (!message.value.trim()) {
                showError(message, 'Message is required');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                // Show error notification
                if (window.notificationSystem) {
                    window.notificationSystem.show('error', 'Validation Error', 'Please check the form for errors.');
                }
            }
            // If form is valid, it will submit normally to Laravel backend
        });
    }

    // Helper function to show validation errors
    function showError(input, message) {
        const errorElement = document.createElement('span');
        errorElement.className = 'error';
        errorElement.textContent = message;
        input.parentNode.appendChild(errorElement);
        input.style.borderColor = '#ef4444';
    }

    // Email validation helper
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Parallax effect for hero visual
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroVisual = document.querySelector('.hero-visual');
        if (heroVisual) {
            heroVisual.style.transform = `translateY(${scrolled * 0.1}px) rotate(${scrolled * 0.05}deg)`;
        }
    });

    // Initialize floating labels
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        // Check if input has value on load
        if (input.value) {
            input.previousElementSibling.classList.add('active');
        }
        
        input.addEventListener('focus', function() {
            this.previousElementSibling.classList.add('active');
            this.style.borderColor = ''; // Clear error border color on focus
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.previousElementSibling.classList.remove('active');
            }
        });
    });
});

// Export functions for potential reuse
window.JochanTech = {
    initTheme: function() {
        // Theme initialization can be called from other scripts if needed
    },
    
    showNotification: function(message, type = 'success') {
        if (window.notificationSystem) {
            const title = type === 'success' ? 'Success!' : 'Error!';
            window.notificationSystem.show(type, title, message);
        }
    }
};