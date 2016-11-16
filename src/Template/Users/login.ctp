<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="well form-group">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create() ?>
            <fieldset>
                <legend class="text-center">Veuillez renseigner vos identifiants</legend>
                <?= $this->Form->input('email',['label' => 'Email','class' => 'form-control']) ?>
                <?= $this->Form->input('password',['label' => 'Mot de passe','class' => 'form-control']) ?>
            </fieldset>
            <br>
            <div class="text-center">
                <?= $this->Form->submit('Connexion',['class' => 'btn btn-lg btn-success']); ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <hr>
        <div class="well text-center">
            Mot de passe oublié ? <?= $this->Html->link('cliquez ici',['action' => 'retrieve']) ?>
            <br>
            Pas encore membre ? <?= $this->Html->link('cliquez ici',['action' => 'register']) ?>
        </div>
    </div>
</div>
