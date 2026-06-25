<h1>Cek email lu bro</h1>
<p>Kami udah kirim link verifikasi ke email lu. Klik linknya buat aktifin akun.</p>

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Kirim ulang email verifikasi</button>
</form>