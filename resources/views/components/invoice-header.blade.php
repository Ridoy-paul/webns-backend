<div>
    @php
        $settings = DB::table('global_settings')->first(['id', 'title', 'phone', 'email', 'address', 'logo']);
    @endphp
    
    <table style="margin-top: 10px;">
    <tr>
        <td style="border: 0px solid white;">
            <div>
                <img style="max-height: 100px !important;" src="{{url(uploaded_asset($settings->logo))}}">
            </div>
        </td>
        <td style="text-align: right; border: 0px solid white;">
            <div>
                <p style="font-size: 13px; text-align: right; overflow: hidden;"><span style="font-size: 15px; font-weight: bold;">
                    {{$settings->title}}</span><br>
                    {!!$settings->address!!}<br>
                    {!!$settings->phone!!}</b><br>
                    {{$settings->email}}<br>
                </p>
            </div>
        </td>
    </tr>
</table>
</div>