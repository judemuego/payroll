<div class="po-form">
    <div id="printPO" class="form-layout" style="width: 11.5in; margin: auto; background: white; padding: 20px;">
        <div class="row">
            <div class="col-8" style="display: flex;">
                <div class="logo-container">
                    <img src="/images/logo-dark.png" class="logo-po" alt="company-logo" width="100%"/>
                </div>
                <div class="company-details">
                    <p class="c-name">SMP Construction Corporation</p>
                    <p class="c-address">Lot 14 Blk 2 Yakal St. <br>Agapito Subd. Brgy Santalon <br>MN 1610</p>
                </div>
            </div>
            <div class="col-4">
                <p class="po-title">Purchase Order</p>
                <table class="head-table">
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            P.O No.
                        </th>
                    </tr>
                    <tr>
                        <td><span id="po_date1"></span></td>
                        <td><span id="po_no"></span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="spacer"></div>

        <div class="row">
            <div class="col-6">
                <table class="head-table">
                    <tr>
                        <th>
                            Vendor
                        </th>
                        
                    </tr>
                    <tr>
                        <td>
                            <span id="po_vendor1"></span> <br>
                            <span id="po_vendor_address1"></span>
                        </td>
                    </tr>
                </table>
                <table class="head-table">
                    <tr>
                        <td>Terms</td>
                        <td><span id="po_terms1"></span></td>
                        <td>Due Date</td>
                        <td><span id="po_due_date1"></span></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="head-table">
                    <tr>
                        <th>
                            Ship To
                        </th>
                        
                    </tr>
                    <tr>
                        <td>
                            <span id="po_ship_to1"></span> <br>
                            <span id="po_ship_to_address1"></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="spacer"></div>

        <div class="row">
            <div class="col-12">
                <table id="details-table" class="desc-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>U/M</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data rows will be dynamically added here -->
                    </tbody>
                </table>
                <table class="head-table">
                    <tr>
                        <td width="60%"></td>
                        <td class="total" width="20%">Total</td>
                        <td class="total-amount" width="20%"><span id="po_total"></span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="spacer"></div>

        <div class="row">
            <div class="col-12">
                <table class="footer-table">
                    <tr>
                        <th>Prepared by:</th>
                        <th>Checked by:</th>
                        <th>Approved by:</th>
                    </tr>
                    <tr>
                        <td>
                            <p class="data" id="po_prepared_by"></p>
                            <p class="data" id="po_prepared_by_date"></p>
                            <p class="data">Name & Signature w/ Date</p>
                        </td>
                        <td>Name & Signature w/ Date</td>
                        <td>Name & Signature w/ Date</td>
                    </tr>
                </table>
                
            </div>
        </div>
    </div>
</div>

@section('styles')
    <style>
        table.head-table, table.desc-table, table.footer-table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table.head-table td, table.desc-table td, table.footer-table td, table.head-table th, table.desc-table th, table.footer-table th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }
        table.head-table tr:nth-child(odd), table.desc-table tr:nth-child(odd), table.footer-table tr:nth-child(odd) {
            background-color: #dddddd;
        }

        table.head-table td, table.desc-table td, table.footer-table td {
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
        img.logo-po {
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
            height: 75px;
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
        .sc-xl {
            max-width: 1340px;
            width: 100%;
        }
        p.data {
            margin-bottom: 0px;
        }
        p#po_prepared_by {
            font-weight: bold;
        }
        table.desc-table>tbody>tr>td {
            height: 650px;
            vertical-align: baseline;
            text-align: center;
        }
    </style>
@endsection