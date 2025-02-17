<div>
  <div class="brand-logo d-flex align-items-center justify-content-between">
    <a href="" class="text-nowrap logo-img text-center pb-0 my-n5">
      <img src="{{ asset('assets/images/logos/kitab1.png') }}" alt="" width="50%" />
    </a>
    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
      <i class="ti ti-x fs-8"></i>
    </div>
  </div>
  <!-- Sidebar navigation-->
  <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
      @if (auth()->user()->hasRole('admin'))
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
        <span class="hide-menu">Admin</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/dashboard" aria-expanded="false">
          <span>
            <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Dasboard</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/menu" aria-expanded="false">
          <span>
            <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone"
              class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Daftar Kitab</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/customer" aria-expanded="false">
          <span>
            <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Daftar Pelanggan</span>
        </a>
      </li>
      @else
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
        <span class="hide-menu">Pelanggan</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/customer/menu" aria-expanded="false">
          <span>
            <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone"
              class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Daftar menu</span>
        </a>
      </li>
      @endif

      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
        <span class="hide-menu">Pesanan</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('admin.pending') || request()->routeIs('customer.pending') || request()->routeIs('customer.pending.show') ? 'active' : '' }}" href="{{ auth()->user()->hasRole('admin') ? '/admin/pending' : '/customer/pending' }}" aria-expanded="false">
          <span>
            <iconify-icon icon="uim:clock" width="24" height="24"></iconify-icon>
          </span>
          <span class="hide-menu">Menunggu konfirmasi</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('admin.done') || request()->routeIs('customer.done') || request()->routeIs('customer.history.show') ? 'active' : '' }}" href="{{ auth()->user()->hasRole('admin') ? '/admin/history' : '/customer/history' }}" aria-expanded="false">
          <span>
            <iconify-icon icon="ix:success" width="24" height="24"></iconify-icon>
          </span>
          <span class="hide-menu">Selesai</span>
        </a>
      </li>
      {{-- <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
          <span class="hide-menu">UI COMPONENTS</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Buttons</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:danger-circle-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Alerts</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Card</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:file-text-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Forms</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:text-field-focus-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Typography</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6"></iconify-icon>
          <span class="hide-menu">AUTH</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Login</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Register</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4" class="fs-6"></iconify-icon>
          <span class="hide-menu">EXTRA</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:sticker-smile-circle-2-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Icons</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:planet-3-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Sample Page</span>
          </a>
        </li> --}}
    </ul>
  </nav>
  <!-- End Sidebar navigation -->
</div>