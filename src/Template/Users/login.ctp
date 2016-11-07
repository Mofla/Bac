<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="form-group">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create() ?>
            <fieldset>
                <legend class="text-center"><?= __('Veuillez renseigner vos identifiants') ?></legend>
                <?= $this->Form->input('email',['label' => 'Email','class' => 'form-control']) ?>
                <?= $this->Form->input('password',['label' => 'Mot de passe','class' => 'form-control']) ?>
            </fieldset>
            <div class="text-center">
                <?= $this->Form->button('Connexion'); ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <hr>
        <div class="text-center">
            Mot de passe oublié ? <?= $this->Html->link('cliquez ici',['action' => 'retrieve']) ?>
            <br>
            Pas encore membre ? <?= $this->Html->link('cliquez ici',['action' => 'register']) ?>
        </div>
    </div>
</div>
