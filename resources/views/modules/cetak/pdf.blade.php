<!DOCTYPE html>
<html>
<head>
    <title>PDF Tabel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: -20px -30px -20px -30px; /* margin: top right bottom left */
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 18px;
            margin-bottom: 20px; /* Margin bawah untuk jarak dengan tabel */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 2px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-size: 12px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>PENERIMA PUPUK BERSUBSIDI 2025</h1>
    <table style="border-collapse: collapse; width: 100%;">
        <tbody>
            <tr style="height: 21px;">
            <td style="width: 33.3333%; height: 21px;">Kecamatan</td>
            <td style="width: 1.35135%; height: 21px;">:</td>
            <td style="width: 65.3152%; height: 21px;">PURWANEGARA</td>
            </tr>
            <tr style="height: 21px;">
            <td style="width: 33.3333%; height: 21px;">Desa/Kelurahan</td>
            <td style="width: 1.35135%; height: 21px;">:</td>
            <td style="width: 65.3152%; height: 21px;">KARANGANYAR</td>
            </tr>
            <tr style="height: 21px;">
            <td style="width: 33.3333%; height: 21px;">Kelompok Tani</td>
            <td style="width: 1.35135%; height: 21px;">:</td>
            <td style="width: 65.3152%; height: 21px;">Tri usaha tani</td>
            </tr>
            <tr style="height: 21px;">
            <td style="width: 33.3333%; height: 21px;">Subsektor</td>
            <td style="width: 1.35135%; height: 21px;">:</td>
            <td style="width: 65.3152%; height: 21px;">TANAMAN PANGAN</td>
            </tr>
            <tr style="height: 21px;">
            <td style="width: 33.3333%; height: 21px;">Komoditas</td>
            <td style="width: 1.35135%; height: 21px;">:</td>
            <td style="width: 65.3152%; height: 21px;">PADI</td>
            </tr>
            <tr style="height: 21px;">
            <td style="width: 33.3333%; height: 21px;">Kios</td>
            <td style="width: 1.35135%; height: 21px;">:</td>
            <td style="width: 65.3152%; height: 21px;">RT0000026324 - UD. INDO JAYA TANI</td>
            </tr>
        </tbody>
        </table>

    <table>
        <thead>
            <tr>
                <th>Farmer NIK</th>
                <th>Farmer Name</th>
                <th>Retailer Name</th>
                <th>Rencana Tanam</th>
                <th>Total Urea</th>
                <th>Total NPK</th>
                <th>Total Organic</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->farmer_nik }}</td>
                    <td>{{ $item->farmer_name }}</td>
                    <td>{{ $item->retailer_name }}</td>
                    <td>{{ $item->rencana_tanam }}</td>
                    <td>{{ $item->jml_urea }}</td>
                    <td>{{ $item->jml_npk }}</td>
                    <td>{{ $item->jml_organic }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>