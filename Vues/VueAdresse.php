<?php $titre = 'ISIWEB4SHOP - Paiement'; ?>

<?php ob_start(); ?>

<div class="col-12 mt-4">
    <div class="card p-3">
        <p class="mb-0 fw-bold h4">Adresse de Livraison</p>
    </div>
</div>
<div class="col-12">
    <?php if ($estConnecte) { ?>
        <div class="card p-3">
            <div class="card-body p-0">
                <p>
                    <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
                        <span class="fw-bold">Adresse Enregistrée</span>
                    </a>
                </p>
                <div class="collapse p-3 pt-0" id="collapseExample">
                    <form class="row g-3" method="post" action="index.php?action=ProcessAddress">
                        <h4 class="d-flex float-start">Identité</h4>
                        <div class="col-md-6 col-12"><input type="text" name="name" value="<?= $infosClient['forname'] ?>" placeholder="Prénom" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 col-12"><input type="text" name="surname" value="<?= $infosClient['surname'] ?>" placeholder="Nom" class="form-control" readonly>
                        </div>
                        <br>
                        <h4 class="d-flex float-start">Adresse</h4>
                        <div class="col-md-6 col-12"><input type="text" name="add1" value="<?= $infosClient['add1'] ?>" placeholder="Adresse" class="form-control col" readonly></div>
                        <div class="col-md-6 col-12"><input type="text" name="add2" value="<?= $infosClient['add2'] ?>" placeholder="Complément d'adresse" class="form-control" readonly></div>
                        <div class="col-md-6 col-12"><input type="text" name="city" value="<?= $infosClient['add3'] ?>" placeholder="Ville" class="form-control" readonly></div>
                        <div class="col-md-6 col-12"><input type="text" name="code" value="<?= $infosClient['postcode'] ?>" placeholder="Code Postal" class="form-control" readonly></div>
                        <br>

                        <h4 class="d-flex float-start">Contact</h4>
                        <div class="col-md-6 col-12"><input type="email" name="email" value="<?= $infosClient['email'] ?>" placeholder="Email" class="form-control" readonly></div>
                        <div class="col-md-6 col-12"><input type="tel" name="phone" value="<?= $infosClient['phone'] ?>" placeholder="Numéro de téléphone" class="form-control" readonly></div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Utiliser</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
        <div class="card-body p-0">
            <p>
                <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-controls="collapseExample">
                    <span class="fw-bold">Nouvelle Adresse</span>
                </a>
            </p>
            <div class="collapse show p-3 pt-0 " id="collapseExample">

                <form class="row g-3" method="post" action="index.php?action=ProcessAddress">
                    <h4 class="d-flex float-start">Identité</h4>
                    <div class="col-md-6 col-12"><input type="text" name="name" placeholder="Prénom" class="form-control" aria-required="true" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-md-6 col-12"><input type="text" name="surname" placeholder="Nom" class="form-control" aria-required="true" required>
                    </div>
                    <br>
                    <h4 class="d-flex float-start">Adresse</h4>
                    <div class="col-md-6 col-12"><input type="text" name="add1" placeholder="Adresse" class="form-control col" aria-required="true" required></div>
                    <div class="col-md-6 col-12"><input type="text" name="add2" placeholder="Complément d'adresse" class="form-control"></div>
                    <div class="col-md-6 col-12"><input type="text" name="city" placeholder="Ville" class="form-control" aria-required="true" required></div>
                    <div class="col-md-6 col-12"><input type="text" name="code" placeholder="Code Postal" class="form-control" pattern="\d{5,5}" aria-required="true" required></div>
                    <br>

                    <h4 class="d-flex float-start">Contact</h4>
                    <div class="col-md-6 col-12"><input type="email" name="email" placeholder="Email" class="form-control" aria-required="true" required></div>
                    <div class="col-md-6 col-12"><input type="tel" name="phone" placeholder="Numéro de téléphone" class="form-control" aria-describedby="emailHelp" pattern="\d{10,10}" aria-required="true" required></div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Utiliser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>