@component('mail::message')
新しいメッセージが届きました。

確認はこちら
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
