<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Contacting Jochan Tech</title>
    <style>
        body { 
            font-family: 'Inter', Arial, sans-serif; 
            line-height: 1.6; 
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            padding: 20px;
            background: #f9fafb;
        }
        .header { 
            background: linear-gradient(135deg, #2563eb, #9333ea); 
            color: white; 
            padding: 30px 20px; 
            text-align: center; 
            border-radius: 10px 10px 0 0;
        }
        .content { 
            background: white; 
            padding: 30px; 
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .contact-info {
            background: #f0f9ff;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .action-button {
            background: #2563eb;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 10px 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div style="font-size: 24px; font-weight: 700; margin-bottom: 10px;">Jochan Tech</div>
            <h1>Thank You for Contacting Us!</h1>
        </div>
        
        <div class="content">
            <p>Dear <strong>{{ $submission->name }}</strong>,</p>
            
            <p>Thank you for reaching out to Jochan Tech! We have successfully received your inquiry and our team will review it shortly.</p>
            
            <div class="contact-info">
                <h3>Here's a summary of your inquiry:</h3>
                <p><strong>Name:</strong> {{ $submission->name }}</p>
                <p><strong>Email:</strong> {{ $submission->email }}</p>
                @if($submission->phone)
                <p><strong>Phone:</strong> {{ $submission->phone }}</p>
                @endif
                <p><strong>Message:</strong> {{ Illuminate\Support\Str::limit($submission->message, 150) }}</p>
                <p><strong>Submitted:</strong> {{ $submission->created_at->timezone('Asia/Kolkata')->format('F j, Y \a\t g:i A') }} (IST)</p>
            </div>
            
            <h3>What happens next?</h3>
            <ul>
                <li>Our team will review your requirements within 24 hours</li>
                <li>We'll contact you to discuss your project in detail</li>
                <li>You'll receive a customized proposal based on your needs</li>
            </ul>
            
           <h3>Need immediate assistance?</h3>
<p>Feel free to contact us directly:</p>
<p>
    <a href="mailto:jochantech@gmail.com" class="action-button" style="background: #c6f7ff; color: white !important; text-decoration: none;">
        📧 Email Us
    </a>
    <a href="tel:+918903723268" class="action-button" style="background: #ffcced; color: white !important; text-decoration: none;">
        📞 Call Us
    </a>
    <a href="https://wa.me/918903723268" class="action-button" style="background: #25D366; color: white !important; text-decoration: none;">
        💬 WhatsApp
    </a>
</p>
            
            <p>We look forward to helping you achieve your digital goals!</p>
            
            <p>Best regards,<br>
            <strong>The Jochan Tech Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Jochan Tech. All rights reserved.</p>
            <p>Your Digital Growth Partner</p>
        </div>
    </div>
</body>
</html>