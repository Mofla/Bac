<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-articles text-center">
                <span class="h3">Profil de <?= h($user->username) ?></span>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-2">
                    <?= $this->Html->image('avatars/200x200/'.h($user->picture_url),['class' => 'img-responsive img-circle']) ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="text-center">
                        <span class="h4 bold">Informations</span>
                    </div>
                    <hr>
                    <label><span class="glyphicon glyphicon-user"></span> Prénom : </label>
                    <?= h($user->firstname) ?>
                    <hr>
                    <label><span class="glyphicon glyphicon-user"></span> Nom : </label>
                    <?= h($user->lastname) ?>
                    <hr>
                    <label><span class="glyphicon glyphicon-envelope"></span> Email : </label>
                    <?= h($user->email) ?>
                    <hr>
                    <span class="text-muted text-italic">Inscrit depuis le : <?= h($user['created']) ?></span>
                    <hr>
                    <span class="text-muted text-italic">Dernière connexion le : <?= h($user['modified']) ?></span>


                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="text-center">
                        <span class="h4 bold">Derniers commentaires</span>
                    </div>
                    <hr>
                    <div>
                        <?php if(!empty($comments)): ?>
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>Article</th>
                                    <th>Commentaire</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($comments as $comment): ?>
                                    <tr>
                                        <td><?= h($comment->article->name) ?></td>
                                        <td><?= h($comment->name) ?></td>
                                        <td><?= $this->Html->link('<span class="glyphicon glyphicon-eye-open text-blue"></span>',[
                                                'controller' => 'Articles',
                                                'action' => 'view',
                                                $comment->article_id,
                                                toUrl(h($comment->article->name))
                                            ],['class' => 'btn btn-xs btn-default', 'escape' => false]) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            vide
                        <?php endif; ?>
                    </div>
                    <?php if(sizeof($user->comments) > 5): ?>
                        <div class="paginator text-center">
                            <ul class="pagination">
                                <?= $this->Paginator->prev('< ') ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(' >') ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>
</div>
</div>