<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>

<body style="width:500px;max-width: 100%;margin: auto; border: 1px solid #e1e1e1">
    <div style="padding:10px">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td><img src="{{ 'assets/images/pdf/Agri-africa-exhibitor-id-card-image.png' }}"
                            style="max-width: 100%;height: auto;"></td>
                </tr>
                <tr>
                    <td style="font-size: 24px;padding: 20px 0;text-align:center;"><span
                            style="color: #6ca5b3;font-weight: 600;">Booth
                        </span><span style="color: #000000;"> #{{ $exhibitor->booth_number }}</span></td>
                </tr>
                <tr>
                    <td style="font-weight: 700;font-family: Montserrat;"><span
                            style="color: #6ca5b3;margin-right:10px">Venue:</span> The Kenyatta International Convention
                        Centre, Nairobi, Kenya</td>
                    {{-- <td></td> --}}
                </tr>
                <tr>
                    <td style="padding-top: 20px;"><img src="{{ 'assets/images/pdf/Line.png' }}"
                            style="max-width: 100%;height: auto;"></td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%;margin: 30px 0;">
            <tbody>
                <tr>
                    <td
                        style="font-size: 24px;width:300px;overflow-wrap: break-word; word-wrap: break-word; word-break: break-word;">
                        {{ $exhibitor->title }}<br><span
                            style="font-weight: bold;">{{ $exhibitor->first_name . ' ' . $exhibitor->last_name }}</span>
                    </td>

                    <td style="text-align: right; width:120px;" rowspan="2">
                        <img src="{{ 'storage/qr_codes/exhibitor/' . $exhibitor->id . '.png' }}"
                            style="max-width: 100%;height: auto;width: 120px;">
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle"><img src="{{ 'assets/images/pdf/circle.png' }}"
                            style="max-width: 100%;height: auto;margin-right: 15px;vertical-align: middle;width:18px""><span
                            style="font-weight: 700;margin-right: 10px;">Exhibitor
                        </span> #{{ $exhibitor->id }}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%;background-color: #E8FFF0;padding: 25px;margin: 20px 0 0 0;">
            <tr>
                <td style="color: #6ca5b3;width: 40%;font-weight: 700;padding-bottom: 8px;">Mobile No.</td>
                <?php
                $phone = '';
                if ($exhibitor->phone) {
                    $phone = $exhibitor->phone;
                    if ($exhibitor->country_code) {
                        $phone = '+' . $exhibitor->country_code . ' ' . $exhibitor->phone;
                    }
                } ?>
                <td style="padding-bottom: 8px;">: {{ $phone }}</td>
            </tr>
            <tr>
                <td style="color: #6ca5b3;font-weight: 700;padding-bottom: 8px;">E-Mail</td>
                <td style="padding-bottom: 8px;">: {{ $exhibitor->email }}</td>
            </tr>
            <tr>
                <td style="color: #6ca5b3;font-weight: 700;padding-bottom: 8px;">Country</td>
                <td style="padding-bottom: 8px;">: {{ $exhibitor->country ? $exhibitor->country->name : '' }}</td>
            </tr>
            <tr>
                <td style="color: #6ca5b3;font-weight: 700;padding-bottom: 8px;">City</td>
                <td style="padding-bottom: 8px;">: {{ $exhibitor->city }}</td>
            </tr>
            <tr>
                <td style="color: #6ca5b3;font-weight: 700;padding-bottom: 8px;">Company Name</td>
                <td style="padding-bottom: 8px;">: {{ $exhibitor->company_name }}</td>
            </tr>
            {{-- <tr>
                <td style="color: #6ca5b3;font-weight: 700;padding-bottom: 8px;">Position</td>
                <td style="padding-bottom: 8px;">: {{ $exhibitor->position }}</td>
            </tr> --}}
        </table>
        <table style="width: 100%;background-color: #000000;text-align: center;padding: 5px;">
            <tr>
                <td style="width:40%;text-align: right;">
                    <img src="{{ 'assets/images/pdf/world.png' }}"
                        style="max-width: 100%;height: auto;margin-right:10px;width: 30px;vertical-align: middle;">
                </td>
                <td style="color: white;font-size: 20px;text-align: left;">www.agriexpo.africa</td>
            </tr>
        </table>
    </div>
</body>

</html>
