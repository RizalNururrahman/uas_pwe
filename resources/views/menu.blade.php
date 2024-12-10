<!--awal MENU NAVBAR-->
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url(Auth::user()->role.'/home')}}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url(Auth::user()->role.'/buku')}}">Data Buku</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url(Auth::user()->role.'/anggota')}}">Data Anggota</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url(Auth::user()->role.'/petugas')}}">Data Petugas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url(Auth::user()->role.'/pinjam')}}">Data Peminjaman</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url(Auth::user()->role.'/laporan/pinjaman')}}">Laporan</a>
                </li>

                <li class="nav-item">
                    <form action="{{url('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="nav-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!--akhir MENU NAVBAR-->
