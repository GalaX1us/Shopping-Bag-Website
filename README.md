# Shopping-Bag-Website

## description 
site de e-commerce permettant d'acheter des biscuits, boissons et fruits secs 

## plan du site
- Page d'acceuil 
	- Boissons 
	- Biscuits
	- Fruits Secs 
- Mon compte/Connexion
	- Creation de compte 
    - connexion
	- Gerer Stocks (si admin)
	- Valider commande (si admin)
- Adresse 
- Paiement 
	- Paiement par chèqe 
	- Paiement par Paypal

### Les fonctionnalités en détails 


- Sur page de connexion, on dispose d'un formulaire pour se connecter avec son identifiant et son mot de passe, le mot de passe est hashé en base de données, en cas d'erreur de loggin le site affiche une alerte pour le dire, ce formulaire permet aussi bien de se connecter en tant que client mais aussi en tant qu'administrateur. 

- Si l'on souhaite se créer un compte client, on peut accéder à une page pour le faire, un certains nombres de renseignement sont demandé, le site vérifie la validité des formats des champs rentrés ainsi que si le nom d'utlisateur choisi n'est pas déjà pris. 

- Si on est connecté en tant qu'admin on à accès à deux autres pages supplémentaires : 
	- une première pour gérer les stocks, les augmenter ou les diminuer.
	- Une deuxième pour afficher la liste des commandes ainsi que leurs contenus pour valider les commandes une fois qu'elles ont été expédiées par l'administrateur.


