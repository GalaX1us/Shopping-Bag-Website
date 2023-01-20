# Shopping-Bag-Website

## Description 
Site de e-commerce permettant d'acheter des biscuits, boissons et fruits secs.

L'ensemble du site est optimisé pour tout format d'écran.

## Plan du site
- Page d'acceuil 
	- Boissons 
	- Biscuits
	- Fruits Secs 
- Mon compte/Connexion
	- Création de compte 
    - Connexion
	- Gérer Stocks (si admin)
	- Valider commande (si admin)
- Panier
- Adresse 
- Paiement 
	- Paiement par chèque 
	- Paiement par Paypal
	- Génération de facture

### Les fonctionnalités en détails 


- La page d'**accueil** permet d'accéder aux trois catéogories de produits que propose notre site : boissons, biscuits et fruits secs

- Les pages de **catégories** permettent de visualiser tous les produits appartenant à une catégorie et d'accéder à la page d'un produit en particulier.

- Les pages **produit** permettent de visualiser toutes les informations d'un produit en particulier. Ces pages disposent de quelques fonctionnalités :
	- On ne peut pas ajouter au panier une quantité supérieur au stock restant.
	- Si il n'y a plus de produit en stock une rupture de stock s'affichera et le bouton ajouter au panier sera désactivé. 

- Sur la page de **connexion**, nous disposons d'un formulaire pour se connecter avec son identifiant et son mot de passe, le mot de passe est hashé en base de données. En cas d'erreur de login, le site affiche une alerte pour le dire. Ce formulaire permet de se connecter en tant que client mais aussi en tant qu'administrateur. 

- Si l'on souhaite se **créer un compte** client, on peut accéder à une page pour le faire. Un certain nombre de renseignements sont demandés, le site vérifie la validité des formats des champs rentrés et que le nom d'utilisateur ne soit pas déjà pris.

- Si l'on est connecté en tant qu'**administrateur**, on à accès à deux autres pages supplémentaires : 
	- Une première pour gérer les stocks, les augmenter ou les diminuer.
	- Une deuxième pour afficher la liste des commandes ainsi que leurs contenus pour valider les commandes une fois qu'elles ont été expédiées par l'administrateur.

- La page du **panier** permet de visualiser les produits que l'utilisateur à ajouté à son panier. Cette page dispose de plusieurs fonctionnalités permettant d'améliorer l'expérience de l'utilisateur : 
	- Un bouton permet de supprimer un article du panier.
	- L'utilisateur peut modifier les quantités des produits qu'il souhaite acheter grâce à une zone de saisie. Il ne peut cependant pas dépasser la quantité de stock du produit. De plus, le total du produit et le total général sont recalculés en direct lors de la modification d'une quantité.
	- Si l'utilisateur ajoute deux fois le même produit à son panier, les quantités des deux ajouts sont additionnées (sans dépasser le stock du produit), afin qu'il n'y ait qu'une seule fois le produit dans son panier.
	- En cliquant sur l'image ou le nom d'un produit, l'utilisateur peut retourner sur la page du produit s'il le souhaite.
	- Lorsque l'utilisateur ajoute un produit à son panier, il peut retourner sur la page de catégorie d'où il venait en cliquant sur le bouton retour en haut à gauche afin de continuer ses achats.
 
- Lorsque le panier est validé, l'utilisateur accède à la page où il doit renseigner son **adresse** de livraison. S'il est connecté à son compte, il peut choisir d'utiliser l'adresse précédemment enregistrée.

- Enfin, la page de **paiement** permet à l'utilisateur de choisir son moyen de paiement : Paypal ou chèque. Si l'utilisateur choisit de payer par chèque, il peut générer une facture récapitulant sa commande.



