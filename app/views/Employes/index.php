<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>Сотрудники</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Отделы</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Upgrade -->
                            <li class="nav-item">
                                <a href="/import/" class="nav-link">
                                    <span class="text-dark">Импорт Сотрудников</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/employes/" class="nav-link <?if ($activeDepartment == 0) echo 'active';?>">
                                    <span class="text-dark">Список всех сотрудников</span>
                                </a>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-dark">Сотрудники по отделам</span>
                            </li>

                            <?php foreach ($departments as $k => $department) : ?>
                                <li class="nav-item">
                                    <a href="/employes/<?=$k;?>" class="nav-link  <?if ($activeDepartment == $k) echo 'active';?>">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <span class="text-dark"><?=$department['title'];?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <nav aria-label="...">
                                        <ul class="pagination">
                                            <?php foreach(COUNTONPAGE['counts'] as $valueCount) :?>
                                                <?php if($valueCount == $pagination['countOnPage']): ?>
                                                     <li class='page-item active'>
                                                         <a class="page-link" href="<?=$url;?>?count=<?=$valueCount;?>"><?=$valueCount;?>
                                                            <span class='sr-only'>(current)</span>
                                                         </a>
                                                    </li>
                                                <?php else : ?>
                                                    <li class='page-item'>
                                                        <a class="page-link" href="<?=$url;?>?count=<?=$valueCount;?>"><?=$valueCount;?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-md-4">
                                    <p>Показано с <?=($pagination['page'] - 1) * $pagination['countOnPage'] + 1;?> по <?=($pagination['page'] - 1 + count($data));?> из <?=$pagination['countRows'];?></p>
                                </div>
                                <div class="col-md-4">
                                    <nav aria-label="..." class=" float-right">
                                        <ul class="pagination">
                                            <li class="page-item <?php if($pagination['page'] == 1) echo 'disabled';?>">
                                                <a class="page-link" href="<?=$url;?>?page=1&count=<?=$pagination['countOnPage'];?>">Первая</a>
                                            </li>
                                            <li class="page-item <?php if($pagination['page'] == 1) echo 'disabled';?>">
                                                <a class="page-link" href="<?=$url;?>?page=<?=$pagination['page']-1;?>&count=<?=$pagination['countOnPage'];?>">Предыдущая</a>
                                            </li>
                                            <li class="page-item active">
                                                <span class="page-link"><?=$pagination['page'];?>
                                                    <span class="sr-only">(current)</span>
                                                </span>
                                            </li>
                                            <li class="page-item <?php if($pagination['page'] >= $pagination['countPages']) echo 'disabled';?>">
                                                <a class="page-link" href="<?=$url;?>?page=<?=$pagination['page']+1;?>&count=<?=$pagination['countOnPage'];?>">Следующая</a>
                                            </li>
                                            <li class="page-item <?php if($pagination['page'] == $pagination['countPages']) echo 'disabled';?>">
                                                <a class="page-link" href="<?=$url;?>?page=<?=$pagination['countPages'];?>&count=<?=$pagination['countOnPage'];?>">Последняя</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" id="mainTable">
                            <?php include 'table/table.php'?>
                        </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->