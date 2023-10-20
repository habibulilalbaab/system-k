            <ul class="nav-main">
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('dashboard')}}">
                  <i class="nav-main-link-icon si si-speedometer"></i>
                  <span class="nav-main-link-name">Dashboard</span>
                </a>
              </li>
              <li class="nav-main-heading">Pinjaman</li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('pengajuan.index')}}">
                  <i class="nav-main-link-icon si si-notebook"></i>
                  <span class="nav-main-link-name">Pengajuan Pinjaman</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('jabatan.index')}}">
                  <i class="nav-main-link-icon far fa-id-badge"></i>
                  <span class="nav-main-link-name">Pinjaman Saya</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('jabatan.index')}}">
                  <i class="nav-main-link-icon far fa-id-badge"></i>
                  <span class="nav-main-link-name">TopUp Pinjaman</span>
                </a>
              </li>
              <li class="nav-main-heading">Administrator</li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('jabatan.index')}}">
                  <i class="nav-main-link-icon far fa-id-badge"></i>
                  <span class="nav-main-link-name">Approval Pinjaman</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('jabatan.index')}}">
                  <i class="nav-main-link-icon far fa-id-badge"></i>
                  <span class="nav-main-link-name">Approval TopUp</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('jabatan.index')}}">
                  <i class="nav-main-link-icon far fa-id-badge"></i>
                  <span class="nav-main-link-name">Pembayaran</span>
                </a>
              </li>
              @role('super-admin')
              <li class="nav-main-heading">Configuration</li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('jabatan.index')}}">
                  <i class="nav-main-link-icon far fa-id-badge"></i>
                  <span class="nav-main-link-name">Jabatan</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('system.index')}}">
                  <i class="nav-main-link-icon si si-settings"></i>
                  <span class="nav-main-link-name">System</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('users.index')}}">
                  <i class="nav-main-link-icon si si-users"></i>
                  <span class="nav-main-link-name">Users</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('roles.index')}}">
                  <i class="nav-main-link-icon fa fa-people-group"></i>
                  <span class="nav-main-link-name">Roles</span>
                </a>
              </li>
              @endrole
            </ul>