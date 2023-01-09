function recalculerPanier() {
  console.log("Calcul panier")
  var total = 0;
  var produits = document.getElementsByName("produit");
  produits.forEach(produit => {
    var qte = produit.querySelector("input[name='quantite']").value;//getAttribute('value');
    var prix = document.querySelector(".prix").getAttribute('value');
    var total_prod = parseFloat(qte) * parseFloat(prix);
    produit.querySelector(".total_prod").innerHTML = formatagePrix(total_prod);
    total += parseFloat(total_prod);
  });
  document.getElementById("total").innerHTML = "Total de la commande : " + formatagePrix(total);
}    

function formatagePrix(prix_nombre) {
    var prix_str = String(prix_nombre).replace('.', ',') + '€';
    return prix_str;
}