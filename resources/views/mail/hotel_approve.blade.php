<p>Dear {{ $hotel->user->name }},</p>
<p>Your hotel <strong>{{ $hotel->name }}</strong> has been {{ $status == 'verified' ? 'approved' : 'rejected' }}.</p>
@if($status == 'verified')
    <p>You can now manage your hotel from the admin panel.</p>
@else
    <p>Unfortunately, your hotel did not meet the requirements.</p>
    <p>Message: {{$hotel->reject_message}}</p>
@endif



