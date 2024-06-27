<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="{{asset('/js/jquery.validate.min.js')}}" ></script>
    <script src="{{asset('/plugins/moment.js')}}" ></script>
    <link href="{{{ URL::asset('backend/css/modern.css') }}}" rel="stylesheet">
    <link href="{{asset('/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom_mobile.css')}}" rel="stylesheet">
    {{-- <script src="{{{ URL::asset('backend/js/settings.js') }}}"></script> --}}
    <script src="{{asset('/plugins/datatable/jquery.dataTables.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/dataTables.button.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/buttons.html5.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/pdfmake.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/vfs_fonts.js')}}" ></script>
    <script src="{{ URL::asset('backend/js/app.js') }}"></script>

    <script src="{{asset('/plugins/cropimg/cropzee.js')}}" ></script>
    <script src="{{asset('/plugins/toastr/toastr.min.js')}}" ></script>
    <script src="{{asset('/js/global.js')}}" ></script>
    
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid black;
        text-align: left;
        padding: 8px;
    }

    img.logo1 {
        width: 205px;
        float: right;
    }

    tr:nth-child(odd) {
        background-color: #dddddd;
    }

    td {
        background-color: white;
    }

    p.c-name {
        margin-bottom: 0px !important;
        font-size: 34px;
        font-weight: bold;
    }
    p.c-address {
        font-size: 20px;
        line-height: 25px;
    }
    img.logo1 {
        width: 100px;
        float: right;
        margin-right: 10px;
    }
    p.po-title {
        font-size: 28px;
        font-weight: bold;
    }
    .spacer {
        padding: 1em;
    }
    table.desc-table>tbody>tr>th {
        text-align: center;
    }
    table.footer-table>tbody>tr>th {
        text-align: center;
    }
    table.desc-table>tbody>tr>td {
        height: 650px;
    }
    table.footer-table>tbody>tr>td {
        height: 100px;
        text-align: center;
        vertical-align: bottom;
    }
    td.total {
        font-weight: bold;
        font-size: 22px;
    }
    td.total-amount {
        text-align: right;
        background: #dddddd;
        font-weight: bold;
    }
    </style>

<body>
    <div class="po-form">
        <div class="form-layout" style="width: 11.5in; margin: auto; background: white; padding: 20px;">
            <div class="row">
                <div class="col-8" style="display: flex;">
                    <div class="logo-container">
                        <img src="/images/logo-dark.png" class="logo1" alt="company-logo" width="100%"/>
                    </div>
                    <div class="company-details">
                        <p class="c-name">SMP Construction Corporation</p>
                        <p class="c-address">Lot 14 Blk 2 Yakal St. <br>Agapito Subd. Brgy Santalon <br>MN 1610</p>
                    </div>
                </div>
                <div class="col-4">
                    <p class="po-title">Purchase Order</p>
                    <table>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                P.O No.
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="spacer"></div>

            <div class="row">
                <div class="col-6">
                    <table>
                        <tr>
                            <th>
                                Vendor
                            </th>
                            
                        </tr>
                        <tr>
                            <td>
                                SP Construction <br>
                                Lot 14, Blk 2, Yakal St. Agapito Subd. Brgy Santolan
                                MN 1610
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>Terms</td>
                            <td>1</td>
                            <td>Due Date</td>
                            <td>3/14/2024</td>

                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table>
                        <tr>
                            <th>
                                Ship To
                            </th>
                            
                        </tr>
                        <tr>
                            <td>
                                SP Construction <br>
                                Lot 14, Blk 2, Yakal St. Agapito Subd. Brgy Santolan
                                MN 1610
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="spacer"></div>

            <div class="row">
                <div class="col-12">
                    <table class="desc-table">
                        <tr>
                            <th>Description</th>
                            <th>U/M</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                        <tr>
                            <td width="50%"></td>
                            <td width="10%"></td>
                            <td width="10%"></td>
                            <td width="10%"></td>
                            <td width="20%"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td width="60%"></td>
                            <td class="total" width="20%">Total</td>
                            <td class="total-amount" width="20%">PHP 0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="footer-table">
                        <tr>
                            <th>Prepared by:</th>
                            <th>Checked by:</th>
                            <th>Approved by:</th>
                        </tr>
                        <tr>
                           <td>Name & Signature w/ Date</td>
                           <td>Name & Signature w/ Date</td>
                           <td>Name & Signature w/ Date</td>
                        </tr>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
</body>
</html>