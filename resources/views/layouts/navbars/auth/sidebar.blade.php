<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
      <i class="fas fa-lg fa-money-bill-wave"></i>
      <span class="ms-3 font-weight-bold">Aplikasi Pembayaran SPP Sekolah</span>
    </a>
  </div>

  <div class="navbar w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav"  >
      <li class="nav-item" style="padding-right: 50px">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center " >
              <i style="font-size: 1rem;" class="fas fa-th-large fa-lg ps-2 pe-2 text-center {{ (Request::is('dashboard') ? '' : 'text-dark') }} aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1" style="padding-right: 20px" >Dashboard</span>
        </a>
      </li>

      @if(Auth::user()->role != 'admin')
        <li class="nav-item mt-3">
          <a data-bs-toggle="collapse" href="#jurusanCollapse" class="collapsed nav-link">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i style="font-size: 1rem;" class="fas fa-lg fa-graduation-cap ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1"> Jurusan</span>
          </a>
          <div class="collapse" id="jurusanCollapse">
            <ul class="nav flex-column list-unstyled"  style="margin-left:40px;" style="margin-left:40px;">
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('list-major') ? 'active' : '') }}" href="{{ url('list-major') }}">List Jurusan</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link  {{ (Request::is('create-major') ? 'active' : '') }}" href="{{ url('create-major') }}">Tambah Jurusan</a>
              </li>
            </ul>
          </div>
        </li>
      @endif

    <li class="nav-item mt-2">
          <a data-bs-toggle="collapse" href="#siswaCollapse" class="collapsed nav-link">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i style="font-size: 1rem;" class="fas fa-user-graduate fa-lg ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1"> Siswa</span>
          </a>
          <div class="collapse" id="siswaCollapse">
            <ul class="nav flex-column list-unstyled"  style="margin-left:40px;" style="margin-left:40px;">
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('list-student') ? 'active' : '') }}" href="{{ url('list-student') }}">List Siswa</a>
              </li>
              @if(Auth::user()->role != 'admin')
              <li class="nav-item ml-5">
                <a class="nav-link {{ (Request::is('create-student') ? 'active' : '') }}" href="{{ url('create-student') }}">Tambah Siswa</a>
              </li>
              @endif
            </ul>
          </div>
        </li>

      @if(Auth::user()->role != 'operator')
        <li class="nav-item mt-2">
          <a data-bs-toggle="collapse" href="#pembayaranCollapse" class="collapsed nav-link">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i style="font-size: 1rem;" class="fas fa-lg fa-money-check ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1"> Pembayaran</span>
          </a>
          <div class="collapse" id="pembayaranCollapse">
            <ul class="nav flex-column list-unstyled"  style="margin-left:40px;">
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('list-payment') ? 'active' : '') }}" href="{{ url('list-payment') }}">List Pembayaran</a>
              </li>
            </ul>
          </div>
        </li>
      @endif

      @if(Auth::user()->role != 'operator')
        <li class="nav-item mt-3">
          <a data-bs-toggle="collapse" href="#tagihanCollapse" class="collapsed nav-link">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i style="font-size: 1rem;" class="fas fa-lg fa-file-invoice ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1"> Tunggakan</span>
          </a>
          <div class="collapse" id="tagihanCollapse">
            <ul class="nav flex-column list-unstyled"  style="margin-left:40px;">
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('list-arrear') ? 'active' : '') }}" href="{{ url('list-arrear') }}">List Tunggakan</a>
              </li>
            </ul>
          </div>
        </li>
      @endif

      @if(Auth::user()->role != 'admin' && Auth::user()->role != 'headmaster')      
        <li class="nav-item mt-3">
          <a data-bs-toggle="collapse" href="#userColapse" class="collapsed nav-link">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i style="font-size: 1rem;" class="fas fa-lg fa-user-friends ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1"> Pengguna</span>
          </a>
          <div class="collapse" id="userColapse">
            <ul class="nav flex-column list-unstyled"  style="margin-left:40px;">
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('list-user') ? 'active' : '') }}" href="{{ url('list-user') }}">List Pengguna</a>
              </li>
              <li class="nav-item ml-5">
                <a class="nav-link {{ (Request::is('create-user') ? 'active' : '') }}" href="{{ url('create-user') }}">Tambah Pengguna</a>
              </li>
            </ul>
          </div>
        </li>
      @endif

      @if(Auth::user()->role != 'operator')
        <li class="nav-item mt-3">
          <a data-bs-toggle="collapse" href="#userColapse" class="collapsed nav-link">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i style="font-size: 1rem;" class="fas fa-lg fa-table ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1"> Laporan</span>
          </a>
          <div class="collapse" id="userColapse">
            <ul class="nav flex-column list-unstyled"  style="margin-left:40px;">
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('list-major') ? 'active' : '') }}" href="{{ url('list-major') }}">List Jurusan</a>
              </li>
              <li class="nav-item" >
                <a class="nav-link {{ (Request::is('create-major') ? 'active' : '') }}" href="{{ url('create-major') }}" >Tambah Jurusan</a>
              </li>
            </ul>
          </div>
        </li>
      @endif
    </ul>
  </div>
</aside>
