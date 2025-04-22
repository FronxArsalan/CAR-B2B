<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px; margin: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); overflow: hidden;">
        <tr style="background-color: #4a90e2;">
            <td style="padding: 20px; color: #ffffff; text-align: center;">
                <h1 style="margin: 0; font-size: 24px;">Welcome to Our Platform</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 16px; margin-bottom: 20px;">Hello,</p>
                <p style="font-size: 16px; margin-bottom: 20px;">Your account has been created successfully. Please find your login credentials below:</p>

                <table cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px;">
                    <tr>
                        <td style="padding: 10px 0; font-weight: bold;">Email:</td>
                        <td style="padding: 10px 0;">{{ $email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-weight: bold;">Password:</td>
                        <td style="padding: 10px 0;">{{ $plainPassword }}</td>
                    </tr>
                </table>

                <p style="font-size: 16px; margin-bottom: 20px;">For your security, please login and change your password as soon as possible.</p>

                <p style="margin: 30px 0;">
                    <a href="{{ url('/login') }}" style="background-color: #4a90e2; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 4px;">Login Now</a>
                </p>

                <p style="font-size: 14px; color: #888;">If you did not sign up for this account, please ignore this email or contact support.</p>
            </td>
        </tr>
        <tr style="background-color: #f4f4f4;">
            <td style="text-align: center; padding: 15px; font-size: 12px; color: #999;">
                &copy; {{ date('Y') }} <a href="https://fronxsolutions.com/">Fronxsolution.com</a>. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
