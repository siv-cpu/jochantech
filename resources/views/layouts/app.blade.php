<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
    <title>@yield('title', 'Jochan Tech - Your Digital Growth Partner')</title>
    <meta name="description" content="@yield('description', 'Jochan Tech - Your digital growth partner helping businesses build their online presence with custom solutions.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
    
    @stack('styles')
</head>

<body>
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="grid-lines"></div>
    </div>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

        <!-- Session Data for Notifications -->
    @if(session('success'))
    <div data-success="{{ session('success') }}" style="display: none;"></div>
    @endif

    @if(session('error'))
    <div data-error="{{ session('error') }}" style="display: none;"></div>
    @endif

    <!-- Notification Popup -->
    <div id="notificationPopup" class="notification-popup">
        <div class="notification-content">
            <div class="notification-icon">
                <i class="fas fa-check-circle success-icon"></i>
                <i class="fas fa-exclamation-circle error-icon"></i>
            </div>
            <div class="notification-text">
                <h4 class="notification-title"></h4>
                <p class="notification-message"></p>
            </div>
            <button class="notification-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>