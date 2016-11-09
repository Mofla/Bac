<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Blog de Mofla</a>
        </div>
        <ul class="nav navbar-nav">
            <li><?= $this->Html->link('<span class="glyphicon glyphicon-home"></span> Accueil',['controller' => 'Articles','action' => 'index','prefix' => false],['escape' => false]) ?></li>
            <?php if($is_admin): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th"></span> Gestion
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-titles"><b>Articles</b></a></li>
                        <li role="separator" class="divider"></li>
                        <li><?= $this->Html->link('Gérer',[
                            'controller' => 'Articles',
                                'action' => 'index',
                                'prefix' => 'admin'
                            ]) ?></li>
                        <li><?= $this->Html->link('Créer un nouvel article',[
                                'controller' => 'Articles',
                                'action' => 'add',
                                'prefix' => 'admin'
                            ]) ?></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="dropdown-titles"><b>Utilisateurs</b></a></li>
                        <li role="separator" class="divider"></li>
                        <li><?= $this->Html->link('Gérer',[
                                'controller' => 'Users',
                                'action' => 'index',
                                'prefix' => 'admin'
                            ]) ?></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
        <!-- logs -->
        <ul class="nav navbar-nav navbar-right">
            <?php if($is_connected): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Mon Profil
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link('Voir',['controller' => 'Users','action' => 'view','prefix' => false,$user_id],['escape' => false]) ?></li>
                        <li><?= $this->Html->link('Editer',['controller' => 'Users','action' => 'edit','prefix' => false,$user_id],['escape' => false]) ?></li>
                    </ul>
                </li>
                <li><?= $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Se déconnecter',['controller' => 'Users','action' => 'logout','prefix' => false],['escape' => false]) ?></li>
            <?php else: ?>
                <li><?= $this->Html->link('<span class="glyphicon glyphicon-log-in"></span> Se connecter',['controller' => 'Users','action' => 'login','prefix' => false],['escape' => false]) ?></li>
                <li><?= $this->Html->link('<span class="glyphicon glyphicon-user"></span> S\'inscrire',['controller' => 'Users','action' => 'register','prefix' => false],['escape' => false]) ?></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>