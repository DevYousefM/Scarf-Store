<?php $msg = 0;
$noti = 0; ?>
@foreach (Auth::User()->unreadNotifications as $item)
    @if (strpos($item->type, 'Message') !== false)
        <?php $msg++; ?>
    @endif
    @if (strpos($item->type, 'Order') !== false)
        <?php $noti++; ?>
    @endif
@endforeach
<?php
function get_time_ago($time)
{
    $time_difference = time() - $time;

    if ($time_difference < 1) {
        return 'less than 1 second ago';
    }
    $condition = [12 * 30 * 24 * 60 * 60 => 'year', 30 * 24 * 60 * 60 => 'month', 24 * 60 * 60 => 'day', 60 * 60 => 'hour', 60 => 'minute', 1 => 'second'];

    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;

        if ($d >= 1) {
            $t = round($d);
            return 'about ' . $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
        }
    }
}
?>
<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="index.html"><img
                src="{{ asset('admin/assets/images/logo-mini.svg') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form method="POST" action="{{ route('search_admin') }}"
                    class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                    @csrf
                    <input type="text" name="search" style="color: white !important" class="form-control search_ad"
                        placeholder="Search products">
                </form>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email"></i>
                    @if ($msg > 0)
                        <span class="count bg-success"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Messages(<?= $msg ?>)</h6>
                    @if ($msg > 0)
                        @foreach (Auth::User()->unreadNotifications as $item)
                            @if (strpos($item->type, 'Message') !== false)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-bell-ring text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">{{ $item->data['sender'] }} send you a
                                            message
                                        </p>
                                    </div>
                                </a>
                            @endif
                        @endforeach

                        <p class="p-3 mb-0 text-center">
                            <a href="{{ route('read', 'message') }}" style="color: white">
                                Mark all as read
                            </a>
                        </p>
                    @else
                        <p class="p-3 mb-0 text-center text-danger">There are no new notifications</p>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    @if ($noti > 0)
                        <span class="count bg-danger"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications(<?= $noti ?>)</h6>
                    @if ($noti > 0)
                        @foreach (Auth::User()->unreadNotifications as $item)
                            @if (strpos($item->type, 'Order') !== false)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-bell-ring text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">{{ $item->data['user'] }} made a new order</p>
                                        <p class="text-muted ellipsis mb-0">
                                            <?= get_time_ago(strtotime($item->data['create_time'])) ?>
                                        </p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                        <p class="p-3 mb-0 text-center">
                            <a href="{{ route('read', 'order') }}" style="color: white">
                                Mark all as read
                            </a>
                        </p>
                    @else
                        <p class="p-3 mb-0 text-center text-danger">There are no new notifications</p>
                    @endif
                </div>
            </li>
            <li>
                <x-app-layout></x-app-layout>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>
