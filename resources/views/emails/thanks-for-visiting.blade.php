<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <style>
        @media only screen and (max-width:556px) and (min-width:320px) {
            .h1-text {
                font-size: 40px !important;
            }

            .msg-text {
                font-size: 16px !important;
                width: 100% !important;
            }

            .visitor-sec {
                width: 100% !important;
                padding: 50px 0 !important;
            }

            .visitor-text {
                font-size: 20px !important;
            }
        }
    </style>
</head>

<body>
    <div
        style="width: 800px;max-width: 100%;margin: 0 auto;text-align: center;font-family: sans-serif;border: 1px solid #A0A0A0;">
        {{-- <div
            style="text-align: center;width:390px;max-width:100%;margin:0 auto;background-color: #DBFFE8;padding-top:30px;">
            <div style="padding:15px">
                <img src="{{ asset('assets/images/email/Logo-main.png') }}" style="max-width: 100%;height: auto;">
            </div>
            <div style="background-color: #028136;color: white;padding:12px ;">
                <div style="font-weight: 700;margin-bottom: 15px;">09-12 May 2023</div>
                <div style="font-size: 14px;font-weight: 500;">The Kenyatta International Convention Centre
                </div>
            </div>
        </div> --}}
        {{-- <div style="margin: 50px 0;">
            <div style="font-size:36px">Welcome to 2023</div>
            <div style="font-size:60px;font-weight: bold;margin-top: 10px;" class="h1-text">Fiksers
            </div>
            <div style="width: 2px;height: 150px;background-color: #707070;margin: 30px auto;"></div>
        </div> --}}
        {{-- <div style="font-size: 18px;margin:10px 0px;line-height: 30px;padding-bottom: 50px;" class="msg-text"> --}}

                <div><span style="font-weight: 700;">Dear</span>
                    {{ $provider->first_name . ' ' . $provider->last_name }},</div>

                    <div>
                        <h5>Please verify your email by clicking on this link :- </h5> <a href="{{ route('email.verification', ['email' => $provider->email]) }}">Click Here</a>
                    </div>

                {{-- <div>
                    You are now all set to experience Fiksers (09 - 12 May 2023) at
                    <span style="font-weight: 700;">The Kenyatta International Convention Centre.</span> A summary
                    of your visitor booking
                    confirmation is given below (see attachment). Please present this confirmation
                    e-mail or attached badge at any of our Fast Entry Counters.
                    We look forward to welcoming you!
                </div> --}}

        </div>
        {{-- <div style="padding:50px 10px;width: 630px;max-width: 100%;margin:80px auto 40px auto;background-color: #DBFFE8;"
            class="visitor-sec">
            <div style="margin-top: -130px;">
                <img src="{{ asset('assets/images/email/visitor.png') }}" style="max-width: 100%;height: auto;">
            </div>
            <div style="font-size: 32px;font-weight: 800;color: #057D34;margin: 20px;" class="visitor-text">Your
                Visitor Pass
                Includes</div>
            <div style="font-weight: 500;font-size: 20px;line-height: 27px;">
                <div style="margin:10px 0">1. Full access to exhibition areas</div>
                <div>2. Full access to Conference</div>
            </div>
        </div> --}}
        <div style="font-size: 18px;">
            {{-- <div style="padding: 20px 10px;">
                <div>Location</div>
                <div style="margin-top: 10px;"><img src="{{ asset('assets/images/email/map-marker.png') }}"
                        style="max-width: 100%;height: auto;"><span
                        style="color: #1043CE;font-weight: bold;margin-left: 15px;">The
                        Kenyatta International Convention Centre</span></div>
            </div> --}}
            <div style="line-height:30px;padding: 20px 10px;">
                <div>With Regards,</div>
                <div style="font-weight: bold;font-size: 24px;">Fiksers</div>
            </div>
        </div>
        <div style="background-color: #393E3A;color: white;padding: 30px;margin-top: 30px;">
            <table style="width: 100%;">
                <tr style="width: 50%;">
                    <th rowspan="2" style="text-align:left;font-size: 24px;color: white;">Feel free to contact us,</th>
                    <td style="float:right;font-size: 16px;padding-bottom: 10px;font-weight: bold;color: white;"><img
                            src="{{ asset('assets/images/email/Path-70.png') }}"
                            style="max-width: 100%;height: auto;margin-right: 20px;">expo@agriexpo.africa</td>
                </tr>
                <tr style="width: 50%;">
                    <td style="float:right;font-size: 16px;font-weight: bold;color: white;"><img
                            src="{{ asset('assets/images/email/phone-pause.png') }}"
                            style="max-width: 100%;height: auto;margin-right: 20px;">+254 790 888333</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
