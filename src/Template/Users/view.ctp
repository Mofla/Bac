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
                    <span class="text-muted text-italic">Inscrit depuis le : <?= h($user->created->i18nformat('EEEE dd MMMM YYYY hh:mm:ss')) ?></span>
                    <hr>
                    <span class="text-muted text-italic">Dernière connexion le : <?= h($user->modified->i18nformat('EEEE dd MMMM YYYY hh:mm:ss')) ?></span>


                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="text-center">
                        <span class="h4 bold">Derniers commentaires</span>
                    </div>
                    <hr>
                    <div id="comments">
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function(){
        $.ajax({
            type:"GET",
            url:"<?= $this->Url->build(['controller' => 'Comments','action' => 'user']) ?>",
            data:{id:<?= $user->id ?>},
            success:function(data){
                $('#comments').hide().html(data).slideDown();
            }
        })
    });
</script>