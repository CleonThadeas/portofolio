<x-mail::message>
# New Message Received

You have a new message from your portfolio contact form.

**From:** {{ $msg->name }} ({{ $msg->email }})
**Subject:** {{ $msg->subject ?: 'No Subject' }}

**Message:**
<x-mail::panel>
{{ $msg->body }}
</x-mail::panel>

<x-mail::button :url="config('app.url') . '/admin/messages'">
View in Dashboard
</x-mail::button>

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
