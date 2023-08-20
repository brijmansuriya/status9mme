<!doctype html>

<html lang="en">

    <head>

        <title>{{ config('app.name') }}</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap');
        *{margin: 0; padding: 0;}
        body {background: #525659; }
        body {font-family: 'Open Sans', sans-serif; padding: 0; margin: 0;}
        a{text-decoration:none!important;transition:all 0.5s ease;}
        .img-fluid{max-width:100%;}
        .text-center{text-align:center;}
        .bg-blue{background-color:#376c7a;}
        table tr{border-spacing:0;}
        table td{padding: 0 40px;}
        table{width: 100%; background:#fff;border-spacing:0;}
        ul.footer-links {
        padding: 0;
        text-align: center;
        }
        ul.footer-links li{list-style:none;margin:0 7px;}
        ul.footer-links li {
            list-style: none;
            margin: 0 7px;
            display: inline-block;
        }
        ul.footer-links li a{display:inline-block;max-width:50px;height:50px;}
        ul.footer-links li a img{width:100%;}
        h2{color: #fff; font-weight: 600; font-size: 35px;}
        h3{color: #000; font-weight: 600; font-size: 25px;}
        p {
            font-size: 20px;
            font-weight: 300;
            line-height: 30px;
            margin-bottom: 5px;
        }
        .banner-img{max-width: 250px;}
        .d-flex{display: flex;}
        .justify-content-center{justify-content: center;}
        .align-items-center{align-items: center;}
        .logo{max-width: 150px; margin: 0 auto;}
        .content-box{background-color: #fff; }
        .content-box td{padding: 40px 200px;}
        .footer-content td{padding: 40px 20px 60px;}
        .mr-20{margin-right: 20px;}
        .mb-15{margin-bottom: 15px;}
        .banner td{padding: 20px 40px;}
        .t-black{color: #000;}


        .container {
            /* max-width: 100%;
            margin: 0 auto;
            background: #525659; */
        }
        .content-box h2 {
            margin-bottom: 30px;
        }
        .table-responsive {
            padding: 20px 15px;
            max-width: 100%;
            margin: 0 auto;
        }

        @media only screen and (max-width:991px){
            ul.footer-links li a{display:inline-block;max-width:45px;height:45px;}

        }
        @media only screen and (max-width:767px){
            .table-responsive{padding: 20px 15px 20px;}
            .d-flex{display: block;}
            .banner-img{margin: 0 auto;}
            .content-box td {padding: 40px 40px; }
            p {margin: 30px 0;}
            .mr-20{margin-right: 0;}

        }
        @media only screen and (max-width:575px){
            .banner td {padding: 20px 15px;}
            .content-box td {padding: 40px 15px;}
            p {font-size: 18px;}
            h2 {font-size: 28px;}
            h3 {font-size: 20px;}
            ul.footer-links li{list-style:none;margin:0 4px;}
            ul.footer-links li a{max-width:40px;height:40px;}
            .footer-content td {padding: 40px 20px 40px;}
    }
    </style>


    </head>

    <body>
        <div class="container">
            <div class="table-responsive">

                <table class="bg-blue">
                    <tbody>
                        <tr class="banner">
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                     <div class="mr-20" style="margin-left:auto;">
                                        <h2>Fiksers</h2>
                                    </div>
                                    <div class="banner-img text-center" style="margin-right:auto;">
                                        <img src="{{ asset('banner-img1.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="content-box">
                    <tbody>
                        <tr>
                            <td>


