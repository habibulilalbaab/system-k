<!DOCTYPE html>
<html>
<head>
    <title>Surat Permohonan Pinjaman</title>
</head>
<body style="padding:30px;">
    <p><strong>Mojokerto : {{date('d-M-Y')}}</strong></p>
    
    <p>Kepada Yth:<br>
    Ketua {!! $system->nama_koperasi !!}
    <br>
    {!!$system->alamat_koperasi!!}
    </p>
    <br><br>

    <p>Perihal: <u>Permohonan Pinjaman Koperasi</u></p>
    <p>Yang bertanda tangan dibawah ini:</p>

    <table>
        <tr>
            <td width="80px">Nama</td>
            <td>: {{$user->name}}</td>
        </tr>
        <tr>
            <td width="80px">Alamat</td>
            <td>: {{$userDetail->address ?? '-'}}</td>
        </tr>
        <tr>
            <td width="80px">Jabatan</td>
            <td>: {{\App\Models\Jabatan::where('id', $userDetail->jabatan_id ?? 0)->first()->jabatan ?? '-'}}</td>
        </tr>
    </table>

    <p>Dengan ini kami mengajukan pinjaman {!!strip_tags($system->nama_koperasi)!!}<br> sebesar Rp {{number_format($pinjaman->jumlah_pinjaman)}} dengan jangka waktu pinjam <u>{{$pinjaman->tenor_pinjaman}} BULAN</u></p>

    <p>Demikian pernohonan kami, atas perhatiannya diucapkan terima kasih</p>
    <br><br>
    <table>
        <tr>
            <td width="280px" style="text-align:center;">Mengetahui:</td>
            <td width="180px"></td>
            <td style="text-align:center;">Pemohon:</td>
        </tr>
        <tr>
            <td width="280px" style="text-align:center;">{!! $system->nama_koperasi !!}</td>
            <td width="180px"></td>
            <td></td>
        </tr>
        <tr>
            <td width="280px" style="text-align:center;"><br><br><br><u>{{ \App\Models\User::where('id', $system->ketua_koperasi)->first()->name ?? '-'}}</u></td>
            <td width="180px"></td>
            <td style="text-align:center;"><br><br><br><u>{{$user->name}}</u></td>
        </tr>
    </table>
    <br><br>
    <center>
    <p><u>Menyetujui Sie Umum dan SDM</u></p>
    <br><br><br>
    <p><u>{{ \App\Models\User::where('id', $system->finance_koperasi)->first()->name ?? '-'}}</u><br>PENY UMUM & AKUNTANSI</p>
    </center>
</body>
</html>
