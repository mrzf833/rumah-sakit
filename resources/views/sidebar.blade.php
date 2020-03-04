<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="assets/images/faces/face1.jpg" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">David Grey. H</span>
            <span class="text-secondary text-small">Project Manager</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      @if (Auth::user()->roles()->first()->nama == 'perawat' || Auth::user()->roles()->first()->nama == 'dokter')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('riwayat.index') }}">
            <span class="menu-title">Riwayat Pasien</span>
            <i class="mdi mdi-home menu-icon"></i>
          </a>
        </li>
      @endif
      @if (Auth::user()->roles()->first()->nama == 'perawat')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pasien.index') }}">
            <span class="menu-title">Pasien</span>
            <i class="fas fa-user-injured menu-icon"></i>
          </a>
      </li>
      @endif
      @if (Auth::user()->roles()->first()->nama == 'admin' || Auth::user()->roles()->first()->nama == 'dokter')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('perawat.index') }}">
          <span class="menu-title">Perawat</span>
          <i class="fas fa-user-nurse menu-icon"></i>
        </a>
      </li>
      @endif
      @if (Auth::user()->roles()->first()->nama == 'admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="{{ (request()->routeIs('dokter.index') | request()->routeIs('dokter.tipe') )  ? 'true' : '' }}" aria-controls="ui-basic">
          <span class="menu-title">Dokter</span>
          <i class="menu-arrow"></i>
          <i class="fas fa-user-md menu-icon menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dokter.index') }}">Data Dokter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dokter.tipe') }}">Tipe Dokter</a>
            </li>
          </ul>
        </div>
      </li>
      @endif
    </ul>
  </nav>