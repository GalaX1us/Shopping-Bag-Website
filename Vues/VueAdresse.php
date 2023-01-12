<?php $titre = 'Paiement'; ?>

<?php ob_start(); ?>


            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Adresse de Livraison</p>
                </div>
            </div>
            <div class="col-12">
                <?php if (isset($_SESSION['estConnecte']) && $_SESSION['estConnecte']) { ?>
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">Adresse Enregistrée</span>
                            </a>
                        </p>
                        <div class="collapse p-3 pt-0" id="collapseExample">
                            <div class="row">
                                <div class="d-flex justify-content-center"> 

                                    <p class="mb-0"><span class="fw-bold">Prix :</span><span
                                            class="c-green">€ </span></p></div>

                                            <div class="d-flex justify-content-center"> 
                                                <form  method="post" action="index.php?action=Paiement"> <!-- bien creer le fichier au bon endroit -->
                                                <button name="paypal" value=true class="btn btn-primary btn-lg btn-block">Payer</button>
                                        </form>
                                        </div>
                                   
                                
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">Nouvelle Adresse</span>
                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0 " id="collapseExample">

                                <p class="mb-0"><span class="fw-bold">Prix :</span><span class="c-green">€ 
                            
                                <p> Veuillez envoyer votre chèque à l'adresse suivante : </p>
                                <p> 1 rue de la paix </p>
                                <p> 75000 Paris </p>
                                <div class="d-flex justify-content-center"> 
                                        <form  method="post" action="generationPdf.php"> <!-- bien creer le fichier au bon endroit -->
                                                <button name="paypal" value=true class="btn btn-primary btn-lg btn-block">Générer la facture</button>
                                        </form>
                                </div>
                                </span></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $contenu = ob_get_clean(); ?> 