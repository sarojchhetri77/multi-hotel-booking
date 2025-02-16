<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Dear {{ $booking->guest_name }},</h2>
    <p>Thank you for booking with us!</p>
    <p><strong>Hotel Name:</strong> {{ $booking->hotel->name }}</p>
    <p><strong>Room ID:</strong> {{ $booking->room_id }}</p>
    <p><strong>Check-in Date:</strong> {{ $booking->check_in_date }}</p>
    <p><strong>Check-out Date:</strong> {{ $booking->check_out_date }}</p>
    <p><strong>Payment Status:</strong> {{ $booking->payment_status }}</p>
    <p>We look forward to your stay.</p>
    <br>
    <p>Best regards,<br>Hotel Booking Team</p>
</body>
</html>
