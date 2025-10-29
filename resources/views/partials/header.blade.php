<header>
    <div class="container header-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/jochan.png') }}" alt="Jochan Tech Logo" class="fas fa-code logo-icon">
        </a>
        
        <button class="hamburger">
            <i class="fas fa-bars"></i>
        </button>
        
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#pricing">Pricing</a></li>
            <li><a href="#contact">Contact</a></li>
            <li>
                <button class="theme-toggle">
                    <i class="fas fa-sun"></i>
                </button>
            </li>
        </ul>
    </div>
</header>