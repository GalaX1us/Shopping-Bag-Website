<?php if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-3 p-1">
    <a class="navbar-brand" href="index.php">
    <h4 class="ps-2">ISIWEB4SHOP</h4>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Notre Offre</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?action=Boissons">Boissons</a>
                    <a class="dropdown-item" href="index.php?action=Biscuits">Biscuits</a>
                    <a class="dropdown-item" href="index.php?action=FruitsSecs">Fruits secs</a>
                </div>
            </li>
        </ul>
        
        <ul class="navbar-nav ms-md-auto">
            <li class="nav-item">
                <?php 
                    if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'] )
                    {
                        $message = "Mon compte"; 
                    }
                    else
                    {
                        $message = "Connexion"; 
                    }
                ?>
                    <a class="nav-link" href="index.php?action=Connexion"><?= $message?></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=Panier">
                <svg class="pb-1" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 
                    1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 
                    1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                Panier</a>
            </li>
            </ul>
        </ul>
    </div>
</nav>