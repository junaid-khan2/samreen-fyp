<div class="sidebar">
    <img class="logo" src="<?= BASE_URL ?>/assets/logo.svg">
    <div class="menu">
        <a href="./events.php"
            data-active="<?= (basename($_SERVER['PHP_SELF']) == 'events.php') ? 'true' : 'false'; ?>">
            <img src="<?= BASE_URL; ?>/assets/calendar-icon.svg" />
            Events
        </a>
        <a href="./news.php" data-active="<?= (basename($_SERVER['PHP_SELF']) == 'news.php') ? 'true' : 'false'; ?>">
            <img src="<?= BASE_URL; ?>/assets/news-icon.svg" />
            News
        </a>
    </div>
    <div class="menu" style="flex: none;">
        <a href="./actions/logout.php">
            Logout
        </a>
    </div>
</div>