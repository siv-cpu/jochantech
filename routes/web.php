<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/test-email', function () {
    $submission = App\Models\ContactSubmission::first();
    
    if ($submission) {
        Mail::to('jochantech@gmail.com')
            ->send(new App\Mail\ContactFormSubmitted($submission));
        return 'Test email sent!';
    }
    
    return 'No submissions found. Please submit the contact form first.';
});
Route::get('/test-auto-reply', function () {
    try {
        // Create a test submission
        $submission = new App\Models\ContactSubmission([
            'name' => 'Test User',
            'email' => 'ajsiva088@gmail.com', // Change to a real email for testing
            'phone' => '9876543210',
            'message' => 'This is a test message for auto-reply',
            'status' => 'new'
        ]);
        
        // Test admin email
        Mail::to('jochantech@gmail.com')
            ->send(new App\Mail\ContactFormSubmitted($submission));
        echo "Admin email sent successfully!<br>";
        
        // Test auto-reply email
        Mail::to('ajsiva088@gmail.com') // Change to a real email
            ->send(new App\Mail\CustomerAutoReply($submission));
        echo "Auto-reply email sent successfully!<br>";
        
        return "Both emails sent successfully!";
        
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});