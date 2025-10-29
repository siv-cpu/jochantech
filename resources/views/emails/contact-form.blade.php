<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission - Jochan Tech</title>
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
        .field { 
            margin-bottom: 20px; 
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        .label { 
            font-weight: 600; 
            color: #2563eb;
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .value {
            color: #374151;
            font-size: 16px;
        }
        .message-box {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #2563eb;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .action-button {
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Jochan Tech</div>
            <h1>New Contact Form Submission</h1>
            <p>You have received a new inquiry from your website</p>
        </div>
        
        <div class="content">
            <div class="field">
                <span class="label">Client Name:</span>
                <span class="value">{{ $submission->name }}</span>
            </div>
            
            <div class="field">
                <span class="label">Email Address:</span>
                <span class="value">
                    <a href="mailto:{{ $submission->email }}" style="color: #2563eb; text-decoration: none;">
                        {{ $submission->email }}
                    </a>
                </span>
            </div>
            
            <div class="field">
                <span class="label">Phone Number:</span>
                <span class="value">
                    @if($submission->phone)
                        <a href="tel:{{ $submission->phone }}" style="color: #2563eb; text-decoration: none;">
                            {{ $submission->phone }}
                        </a>
                    @else
                        Not provided
                    @endif
                </span>
            </div>
            
            <div class="field">
                <span class="label">Message:</span>
                <div class="message-box">
                    <p style="margin: 0; white-space: pre-wrap;">{{ $submission->message }}</p>
                </div>
            </div>
            
            <div class="field">
                <span class="label">Submitted On:</span>
                <span class="value">
                    {{ $submission->created_at->timezone('Asia/Kolkata')->format('F j, Y \a\t g:i A') }} (IST)
                </span>
            </div>
            
            <div class="field">
                <span class="label">Quick Actions:</span>
                <div style="margin-top: 10px;">
                    <a href="mailto:{{ $submission->email }}?subject=Re: Your inquiry to Jochan Tech&body=Dear {{ $submission->name }},"
                       class="action-button">
                       📧 Reply via Email
                    </a>
                    @if($submission->phone)
                    <a href="https://wa.me/91{{ preg_replace('/\D/', '', $submission->phone) }}?text=Hi {{ $submission->name }}, thank you for contacting Jochan Tech."
                       class="action-button" style="background: #25D366;">
                       💬 Reply via WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>This email was automatically generated from your website contact form.</p>
            <p>&copy; {{ date('Y') }} Jochan Tech. All rights reserved.</p>
        </div>
    </div>
</body>
</html>