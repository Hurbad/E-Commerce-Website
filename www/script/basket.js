

//Globals
window.onload = loadBasket;

//Get basket from session storage or create one if it does not exist
function getBasket(){
    let basket;
    if(sessionStorage.basket === undefined || sessionStorage.basket === ""){

        basket = [];
    }
    else {
        basket = JSON.parse(sessionStorage.basket);
    }
    return basket;
}

//Displays basket in page.
function loadBasket(){

  if(sessionStorage.basket == undefined || sessionStorage.basket == ""){
    document.getElementById("basketDiv").innerHTML = "<h1>No Items in Basket</h1>";

  }
  else {


    let basket = getBasket();//Load or create basket

    //Build string with basket HTML
    let htmlStr = "<form action='checkout.php' method='post'>";
    let prodIDs = [];
     var  total

    for(let i=0; i<basket.length; ++i){
        htmlStr += " <table><td> " + basket[i].id + "</td><td>"+ basket[i].name + "</td><td>"+basket[i].colour + "</td><td>"+basket[i].size+"</td><td>£"+basket[i].price+"</td><td><img src='"+ basket[i].image_url +"'height=100 width=100></img></td></table><br>";
        prodIDs.push({id: basket[i].id, count: 1, name: basket[i].name, price: basket[i].price});//Add to product array
    }



    //Add hidden field to form that contains stringified version of product ids.
    htmlStr += "<input type='hidden' name='prodIDs' value='" + JSON.stringify(prodIDs) + "'>";

    //Add checkout and empty basket buttons
    htmlStr += "<button style='position: fixed;right:480px;' type='' >Checkout </button></form>";
    htmlStr += "<br><button style='position: fixed;top:90px;' onclick='emptyBasket()'>Empty Basket</button>";

    //Display nubmer of products in basket
    document.getElementById("basketDiv").innerHTML = htmlStr;
  }

}

//Adds an item to the basket
function addToBasket(prodID, prodName, prodColour, prodSize, prodPrice, prodImage){
    let basket = getBasket();//Load or create basket

    //Add product to basket
    basket.push({id: prodID, name: prodName, colour:prodColour, size:prodSize, price:prodPrice, image_url:prodImage});

    //Store in local storage
    sessionStorage.basket = JSON.stringify(basket);

    //Display basket in page.
    loadBasket();
}

//Deletes all products from basket
function emptyBasket(){
    sessionStorage.clear();
    loadBasket();
}
