<nav class="navbar">
    <div class="container">
        <ul class="navbar-list">
            <li class="navbar-item"><a class="navbar-link" href="<?= url('/home') ?>">Home</a></li>
            <?php if (\Auth::check()): ?>
            <li class="navbar-item"><a href="<?= route('equipment.index') ?>" class="navbar-link">Equipment</a></li>
            <li class="navbar-item"><a href="<?= route('auth.stats') ?>" class="navbar-link">My Stats</a></li>
            <li class="navbar-item">
                <a class="navbar-text" data-popover="#userInfoPopover" href="javascript:void(0);">User</a>

                <div id="userInfoPopover" class="popover">
                    <ul class="popover-list">

                        <li class="popover-item">
                            <span class="popover-text"><a href="/profile">{{ \Auth::user()->name }}</a></span>
                        </li>
                        <li class="popover-item">
                            <a class="popover-link"
                               href="<?= route('auth.logout') ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="navbar-item"><a href="javascript:void(0);" class="navbar-text"><?= \Auth::user()->subscription ?>
                    user</a></li>
            <?php else: ?>
            <li class="navbar-item"><a href="<?= action('Auth\AuthController@getRegister') ?>"
                                       class="navbar-link">Register</a>
            </li>
            <li class="navbar-item"><a href="<?= action('Auth\AuthController@getLogin') ?>"
                                       class="navbar-link">Login</a>
            </li>
            <?php endif ?>
        </ul>
    </div>
</nav>