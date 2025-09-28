@component('mail::message')
# 🎵 A New Album Was Added!

<table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 1em;">
    <tbody>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold; width: 120px;">Name:</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $album->name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Artist:</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $album->artist->name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Year:</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $album->year }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Label:</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $album->label ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Producer:</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $album->producer ?? 'N/A' }}</td>
        </tr>
    </tbody>
</table>

@if ($album->image)
@component('mail::button', ['url' => url('storage/' . $album->image), 'color' => 'primary'])
View Cover Image
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
