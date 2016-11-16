<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="well form-group">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create($users) ?>
            <fieldset>
                <legend class="text-center"><?= __('Veuillez compléter les informations') ?></legend>
                <?= $this->Form->input('username',['label' => 'Identifiant','class' => 'form-control']) ?>
                <?= $this->Form->input('firstname',['label' => 'Prénom','class' => 'form-control']) ?>
                <?= $this->Form->input('lastname',['label' => 'Nom','class' => 'form-control']) ?>
                <?= $this->Form->input('email',['label' => 'Email','class' => 'form-control']) ?>
                <?= $this->Form->input('password',['label' => 'Mot de passe','class' => 'form-control']) ?>
            </fieldset>
            <hr>
            <div class="text-center">
                <?= $this->Form->submit('Valider',['class' => 'btn btn-lg btn-info']); ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>