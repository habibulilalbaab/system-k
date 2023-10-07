            <ul class="nav-main">
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('dashboard')}}">
                  <i class="nav-main-link-icon si si-speedometer"></i>
                  <span class="nav-main-link-name">Dashboard</span>
                </a>
              </li>
              <li class="nav-main-heading">Menu Utama</li>
              <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                  <i class="nav-main-link-icon si si-energy"></i>
                  <span class="nav-main-link-name">Blocks</span>
                </a>
                <ul class="nav-main-submenu">
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_styles.html">
                      <span class="nav-main-link-name">Styles</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_options.html">
                      <span class="nav-main-link-name">Options</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_forms.html">
                      <span class="nav-main-link-name">Forms</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_themed.html">
                      <span class="nav-main-link-name">Themed</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_api.html">
                      <span class="nav-main-link-name">API</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-main-heading">Master Data</li>
              <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                  <i class="nav-main-link-icon si si-energy"></i>
                  <span class="nav-main-link-name">Blocks</span>
                </a>
                <ul class="nav-main-submenu">
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_styles.html">
                      <span class="nav-main-link-name">Styles</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_options.html">
                      <span class="nav-main-link-name">Options</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_forms.html">
                      <span class="nav-main-link-name">Forms</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_themed.html">
                      <span class="nav-main-link-name">Themed</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_api.html">
                      <span class="nav-main-link-name">API</span>
                    </a>
                  </li>
                </ul>
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
                <a class="nav-main-link" href="{{route('jabatan.index')}}">
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