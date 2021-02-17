<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>Импорт</h1>
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
                                <a href="/import/" class="nav-link active">
                                    <span class="text-dark">Импорт Сотрудников</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/employes/" class="nav-link">
                                    <span class="text-dark">Список всех сотрудников</span>
                                </a>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-dark">Сотрудники по отделам</span>
                            </li>

                            <?php foreach ($departments as $k => $department) : ?>
                                <li class="nav-item">
                                    <a href="/employes/<?=$k;?>" class="nav-link">
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-block bg-gradient-warning import" data-action="generateXml">Сгенерировать XML</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-block bg-gradient-success import" data-action="xmlToSql">Загрузить XML в БД</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-block bg-gradient-danger import" data-action="clearTables">Очистить БД</button>
                                </div>
                            </div>
                            <div class="row" id="mainTable">
                            </div>
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