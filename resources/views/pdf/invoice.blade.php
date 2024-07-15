<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>REÇU CRM - TEMPLATE</title>
    <style>
        .conrainer {
            display: block;
            margin: 50px;
            max-width: 2480px;
        }

        .banner {
            padding: 0 0 40px 0;
        }

        .banner .logo {
            width: 40%;
            margin-left: -16px;
        }

        .banner .logo img {
            width: 100%;
        }

        .title {
            font-family: FDKReg, serif;
            font-size: 36px;
            margin: 0 0 15px 0;
            font-weight: 700;
        }

        .date-edit {
            font-family: FDKReg, serif;
            font-size: 25px;
            margin: -5px 0 15px 0;
        }

        .main-montant {
            font-family: FDKReg, serif;
            font-size: 42px;
            margin: 32px 0 15px 0;
            font-weight: 700;
        }

        .debit-credit {
            font-family: FDKReg, serif;
            font-size: 16px;
            margin: -5px 0 15px 0;
        }

        .debit-credit span {
            font-family: FDKReg, serif;
            font-size: 22px;
        }

        .operation {
            font-family: FDKReg, serif;
            font-size: 22px;
            color: #FFFFFF;
            background: #176BEF;
            border: 1px solid #176BEF;
            border-radius: 4px;
            padding: 5px 10px;
            display: inline-block;
            margin: 5px 0 40px 0;
        }

        .ligne-details {
            font-family: FDKReg, serif;
            font-size: 22px;
            margin: -5px 0 15px 0;
            padding: 20px 0 15px 0;
            border-bottom: 1px solid #000000;
        }

        .ligne-details span {
            font-family: FDKReg, serif;
            font-size: 26px;
            text-align: right;
            float: right;
        }

        .clearBoth {
            display: block;
            clear: both;
        }

        .color-red {
            color: #FF0000;
        }

        .color-green {
            color: #09AC8F;
        }
    </style>
</head>

<body>

    <div class="conrainer">
        <div class="banner">
            <div class="logo"><img src="images/logo-visa-apaym.png" alt="Logo CRM"></div>
        </div>
        <div class="title">Reçu de transaction</div>
        <div class="date-edit">Date d'édition : 19 avr. 2024 11:33:05</div>
        {{-- <div class="main-montant color-red">- 505 F</div>
        <div class="debit-credit">de carte VISA : <span>**** 9991</span></div>
        <div class="debit-credit">à <span>07 47 25 10 31</span></div>
        <div class="operation">Transfert vers Orange Money</div> --}}
        <div class="clearBoth"></div>
        {{-- <div class="ligne-details">Date & heure : <span> {{  (\Carbon\Carbon::parse())->format('d M Y H:i:s') }}</span></div> --}}
        <div class="ligne-details">Montant : <span>{{ $invoice['amount'] }} F</span></div>
        <div class="ligne-details">Frais : <span>{{ $invoice['fee'] }} F</span></div>
        <div class="ligne-details">Montant : <span>{{ $invoice['total_amount'] }} F</span></div>
        <div class="ligne-details">Numéro de Facture : <span>{{ $invoice['invoice_number'] }}</span></div>
    </div>

</body>

</html>
