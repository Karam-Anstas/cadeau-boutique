<!DOCTYPE html>
<html>
<body>
    <h2>Vendor Application Submitted</h2>

    <p>Hello {{ $user->name }},</p>

    <p>We received your vendor application for <strong>{{ $vendor->shop_name }}</strong>.</p>

    <p>The admin team is reviewing your request. We will notify you once a decision is made.</p>

    <p>Thank you.</p>
</body>
</html>
