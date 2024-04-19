<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kebijakan Privasi - {{ env('APP_NAME') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {!! json_encode(config('tailwind')) !!}
    </script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
<div class="absolute top-0 left-0 right-0 flex justify-center">
    <div class="w-6/12 mobile:w-full p-4 flex flex-col text-slate-500">
        <div class="text-3xl font-black text-slate-700 mt-8">Kebijakan Privasi</div>
        <div class="text-sm mt-4">Halaman Kebijakan Privasi ini menjelaskan tentang bagaimana Kami mendapatkan, menggunakan, dan menjaga informasi yang pengguna berikan baik melalui aplikasi maupun layanan pihak ketiga.</div>

        <div class="text-xl fon-bold text-slate-700 mt-8 mb-4">1. Informasi yang Kami Dapatkan</div>
        <div class="text-sm">Ketika pengguna mendaftar, menggunakan, dan/atau mengautentikasi layanan pihak ketiga, Kami bisa mendapatkan beberapa data pribadi seperti :</div>
        <div class="text-sm mt-4"><span class="font-bold">1.1. Informasi Dasar.</span> Kami berhak mengakses dan menyimpan informasi dasar yang terhubung dengan akun layanan pihak ketiga pengguna seperti (namun tidak terbatas pada) nama dan alamat email.</div>
        <div class="text-sm mt-4"><span class="font-bold">1.2. Izin Akses.</span> Kami akan meminta akses spesifik untuk mengakses beberapa data dan layanan dari pihak ketiga.</div>

        <div class="text-xl fon-bold text-slate-700 mt-8 mb-4">2. Bagaimana Kami Menggunakan Informasi Pengguna</div>
        <div class="text-sm">Kami akan menggunakan informasi pengguna untuk berbagai layanan pihak ketiga seperti :</div>
        <div class="text-sm mt-4"><span class="font-bold">2.1. Akses Layanan Pihak Ketiga.</span> Untuk mengakses dan memproses layanan spesifik yang disediakan oleh pihak ketiga yang telah pengguna izinkan.</div>
        <div class="text-sm mt-4"><span class="font-bold">2.2. Komunikasi.</span> Mengirim dan menerima informasi yang terkait dengan akses layanan takotoko dan/atau pihak ketiga</div>

        <div class="text-xl fon-bold text-slate-700 mt-8 mb-4">3. Pengelolaan dan Pembagian Informasi</div>
        <div class="text-sm">Kami tidak menjual, menukarkan, atau membagikan data ke pihak manapun di luar kondisi berikut :</div>
        <div class="text-sm mt-4"><span class="font-bold">3.1. Kewajiban Hukum.</span> Kami juga mungkin akan membagikan data pengguna kepada pihak berwenang atau hukum yang berlaku</div>

        <div class="text-xl fon-bold text-slate-700 mt-8 mb-4">4. Keamanan Data</div>
        <div class="text-sm">Kami telah mengimplementasikan dan menguji secara teknis dan terorganisir untuk melindungi data pribadi pengguna. Meskipun demikian tidak ada transaksi online yang sepenuhnya aman dan kami tidak menjamin secara absolut terhadap keamanan data pengguna.</div>

        <div class="text-xl fon-bold text-slate-700 mt-8 mb-4">5. Hak-hak Pengguna</div>
        <div class="text-sm">Pengguna dapat mengubah maupun menghapus data yang kami simpan kapan saja dan mungkin ada beberapa data yang memerlukan permintaan khusus untuk melakukan perubahan atau penghapusan.</div>

        <div class="text-xl fon-bold text-slate-700 mt-8 mb-4">6. Perubahan pada Kebijakan Privasi</div>
        <div class="text-sm">Kami mungkin dan berhak untuk mengubah sebagian atau seluruh kebijakan privasi Kami kapan saja. Kami akan memberitahukan kepada seluruh pengguna beberapa waktu sebelum perubahan tersebut efektif.</div>

        <div class="text-xl fon-bold text-slate-700 mt-8 mb-4">7. Hubungi Kami</div>
        <div class="text-sm">Apabila terdapat pertanyaan lebih lanjut pengguna dapat mengirimkan pesan melalui tombol berikut</div>

        <a href="https://wa.me/6282116806432?text=Halo%20Admin%20Samsat%20Trenggalek%20" target="_blank" class="h-12 w-full rounded-lg border border-blue-500 text-blue-500 mt-6 hover:bg-blue-500 hover:text-white flex items-center justify-center">
            Hubungi Bantuan
        </a>

        <div class="h-20"></div>
    </div>
</div>

</body>
</html>