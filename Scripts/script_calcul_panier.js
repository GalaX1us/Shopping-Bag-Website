// recalcule le panier à chauqe fois qu'une quantité est modifiée
function recalculerPanier() {
  var total = 0;
  var produits = document.getElementsByName("produit");
  produits.forEach(produit => {
    var qte = produit.querySelector("input[class='qte']").value;
    var prix = document.querySelector(".prix").getAttribute('value');
    var total_prod = parseFloat(qte) * parseFloat(prix);
    produit.querySelector(".total_prod").innerHTML = formatagePrix(total_prod);
    total += parseFloat(total_prod);
  });
  document.getElementById("total").innerHTML = "Total de la commande : " + formatagePrix(total);
}

// formate le prix : 2.5 -> '2,50€'
function formatagePrix(prix_nombre) {
    var prix_str = String(prix_nombre.toFixed(2)).replace(',', ' ').replace('.', ',') + '€';
    return prix_str;
}