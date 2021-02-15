<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Upgrade -->

        <?php foreach ($departments as $k => $department) : ?>
        <li class="nav-item">
            <a href="/employes/<?=$k;?>" class="nav-link">
                <i class="nav-icon fas fa-info-circle"></i>
                <p><?=$department['title'];?></p>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</nav>
<!-- /.sidebar-menu -->
