<div class="row">
    <?= $this->Form->create($user,['enctype' => 'multipart/form-data','class' => 'form-group form-confirm']) ?>
    <div class="col-xs-12 col-md-6 col-md-offset-3">

        <div class="panel panel-default">
            <div class="panel-heading panel-heading-articles text-center">
                <span class="h2">Edition du profil <?= $user->username ?></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- profil image -->
                    <div class="col-xs-12 col-md-6">
                        <?= $this->Html->image('avatars/200x200/'.h($user->picture_url),['id' => 'file','class' => 'img-responsive img-thumbnail','width' => '200px','height' => '200px']) ?>
                        <?= $this->Form->input('picture_url',['label' => 'Avatar','type' => 'file','id' => 'file_input','accept' => 'image/*','onchange' => 'imgPreview(event)']) ?>
                    </div>
                    <!-- infos -->
                    <div class="col-xs-12 col-md-6">
                        <?= $this->Form->input('firstname',['label' => 'Prénom','class' => 'form-control']) ?>
                        <?= $this->Form->input('lastname',['label' => 'Nom','class' => 'form-control']) ?>
                        <?= $this->Form->input('email',['class' => 'form-control']) ?>
                        <?= $this->Form->input('password',['label' => 'Mot de passe','type' => 'password','class' => 'form-control']) ?>
                        <?= $this->Form->input('confirm_password',['label' => 'Confirmez le mot de passe','type' => 'password','class' => 'form-control','default' => h($user->password)]) ?>

                    </div>

                </div>
                <hr>
                <div class="text-center">
                    <?= $this->Form->submit('Editer',['class' => 'btn btn-lg btn-success']) ?>
                    <?= $this->Html->link('Annuler',['controller' => 'Users','action' => 'index'],['class' => 'btn btn-lg btn-danger']) ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<?= $this->Html->script('scripts.js') ?>

