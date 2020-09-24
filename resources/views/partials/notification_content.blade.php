<h4>
    <span class="badge badge-info">{{ $notification->type }}</span>
    {{ mb_convert_case($notification->caption, MB_CASE_UPPER) }}
</h4>
<h5>{{ $notification->headline }}</h5>
{{ $notification->text }}
