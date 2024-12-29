// DO NOT ADD FUNCTIONS TO THIS FILE
const header = document.querySelector("header");

const icons = checkLinks({
  logo: "media/images/logo.svg",
  profile: "media/images/icons/profile-circle.svg",

  lang: "media/images/icons/translate.svg",
  english: "media/images/icons/country/uk.svg",
  french: "media/images/icons/country/france.svg",
  arabic: "media/images/icons/country/lebanon.svg",

  home: "media/images/icons/home.svg",
  search: "media/images/icons/search.svg",
  coin: "media/images/icons/coin.svg",
  menu: "media/images/icons/menu.svg",

  cart: "media/images/icons/shopping-cart.svg",
  apple: "media/images/icons/payment/apple-pay.svg",
  mastercard: "media/images/icons/payment/mastercard.svg",
  visa: "media/images/icons/payment/visa-classic.svg",
  wu: "media/images/icons/payment/western-union.svg",

  email: "media/images/icons/social/email.svg",
  instagram: "media/images/icons/social/instagram.svg",
  facebook: "media/images/icons/social/facebook.svg",
  twitter: "media/images/icons/social/twitter.svg",
});

const pages = checkLinks({
  home: "index.php",
  login: "en/account/login.php",
  register: "en/account/register.php",
  profile: "en/account/profile.php",
  password: "en/account/reset-password.php",

  categories: "en/category.php",
  cart: "en/php/pages/cart.php",
  favorites: "en/php/pages/favorites.php",
  about: "en/php/pages/about-us.php",
  contact: "en/php/pages/contact-us.php",
});

const php = checkLinks({
  search: "en/php/search.php",
});

const socialMedia = {
  email: "mailto:info@isae.edu.lb",
  instagram: "http://instagram.com/_u/CNAM.Liban/",
  facebook: "https://www.facebook.com/CNAM Liban/",
  twitter: "https://twitter.com/cnamLiban?s=20",
};

const loading = () => {
  // adds an icon for the page
  document.head.innerHTML += `<link rel='icon' href='${icons.logo}'/>`;

  // adds the rest of components
  addHeader();
  addNavBar();
  addMenu();
  addSearchLayer();
  addFooter();
  attachEventHandlers();
};

// prevent current page's link from refreshing the page
pages[header.id] = "#" + header.id;

// this adds the event onload for body and runs it
document.addEventListener("DOMContentLoaded", loading);

function addHeader() {
  header.innerHTML = `
<section id="logo">
  <img src="${icons["logo"]}" alt="Logo">
</section>

<section id="bigTitle" class="aTitle">
  CNAM Library
</section>

<section id="accessibility">
  <div id="profile" title="profile">
    <img src="${icons["profile"]}" alt="account" />
    <br/>
    <span>Login</span>
  </div>

  <div id="language" title="choose your language">
    <img src="${icons["lang"]}" alt="language" />

    <aside id="langs">
      <div class="english">
        <img src="${icons["english"]}" >
        <span>English</span>
      </div>

      <div class="french">
        <img src="${icons["french"]}">
        <span>Français</span>
      </div>

      <div class="arabic">
        <img src="${icons["arabic"]}">
        <span>العربية</span>
      </div>
    </aside>
  </div>
</section>
`;
}

function addNavBar() {
  document.querySelector("#navBar").innerHTML = `
<section id="leftNav">
  <div id="homeButton" onclick="window.open('${pages["home"]}', '_self')">
    <span>HOME</span>
    <img src="${icons["home"]}" alt="home">
  </div>

  <div id="searchBar" title="search">
    <span>SEARCH</span>
    <img src="${icons["search"]}">
  </div>
</section>

<section id="rightNav">
  <div id="coinBalance" title="your coins">
    <label>0</label>
    <img src="${icons["coin"]}">
  </div>

  <div id="sideMenu" title="menu">
    <img src="${icons["menu"]}"/>
  </div>
</section>
`;
}

function addSearchLayer() {
  let searchLayer = document.querySelector("#searchLayer");

  // ADD form infos here
  searchLayer.method = "post";
  searchLayer.action = php["search"];

  // this one is for the search genre options
  let selection = "";
  let options = [
    "All",
    "Romance",
    "Fantasy",
    "Biography",
    "Self Improvement",
    "Comedy",
    "Thriller",
    "Science Fiction",
    "History",
    "Sports",
    "Cooking",
    "Science",
    "Education",
    "Kids",
    "Manga",
    "Health",
    "Religion",
    "Technology",
    "Bande Dessinee",
    "Law",
    "Comics",
  ];
  // add options depending on array
  for (let i in options)
    selection += `<option value="${options[i]}">${options[i]}</option>\n`;

  searchLayer.innerHTML = `
<div>
  <h1 class="aTitle">Search a book</h1>
  <span class="closeSearch">x</span>
</div>
<div class="searchPart">
  <label>
    <img src="${icons["search"]}"/>
    <input type="text" placeholder="Search..." name="search" required>
  </label>
  <button type="submit" name="submit">Enter</button>
</div>
<select name="category-search" id="category-search">
  ${selection}
</select>
`;
}

function addMenu() {
  document.querySelector("#menu").innerHTML = `
<span id="closeMenu">x</span>
<section class="aTitle">Menu</section>
<a href="${pages["cart"]}">
  Cart
  <img src="${icons["cart"]}">
</a>
<a href="${pages["categories"]}">Categories</a>
<a href="${pages["favorites"]}">Favorites</a>
<a href="${pages["about"]}">About us</a>
<a href="${pages["contact"]}">Contact us</a>
`;
}

function addFooter() {
  document.querySelector("footer").innerHTML = `
<section id="leftFoot">
  <h1 class="aTitle">Infos:</h1>
  <ul id="footInfo">
    <li>Copyright 2023 &copy;</li>
    <li>Based in Lebanon</li>
    <li>University of CNAM - Lebanon</li>
    <li>
      <img src="${icons["apple"]}">
      <img src="${icons["mastercard"]}">
      <img src="${icons["visa"]}">
      <img src="${icons["wu"]}">
    </li>
  </ul>
</section>

<section id="rightFoot">
  <h1 class="aTitle">Social media:</h1>
  <div>
    <div class="email">
      <img src="${icons["email"]}">
      <a href="${socialMedia["email"]}">info@isae.edu.lb</a>
    </div>

    <div class="instagram">
      <img src="${icons["instagram"]}">
      <a href="${socialMedia["instagram"]}">CNAM.Liban</a>
    </div>

    <div class="facebook">
      <img src="${icons["facebook"]}">
      <a href="${socialMedia["facebook"]}">CNAM Liban</a>
    </div>

    <div class="twitter">
      <img src="${icons["twitter"]}">
      <a href="${socialMedia["twitter"]}">CNAM Liban</a>
    </div>
  </div>
</section>
`;
}

function attachEventHandlers() {
  // link to login page
  document
    .querySelector("#profile")
    .addEventListener("click", () => window.open(pages["login"], "_self"));

  // search buttons for closing and opening the searchLayer
  let search = document.querySelector("#searchLayer");

  document.querySelector("#searchBar").addEventListener("click", () => {
    search.style.visibility = "visible";
    search.style.opacity = "100%";
  });
  document.querySelector(".closeSearch").addEventListener("click", () => {
    search.style.visibility = "hidden";
    search.style.opacity = "0";
  });

  // open side menu
  document.querySelector("#sideMenu").addEventListener("click", () => {
    let menu = document.querySelector("#menu");

    if (window.innerWidth <= 500) {
      menu.style.height = "100%";
      menu.style.width = "100%";
    } else {
      menu.style.width = "300px";
      menu.style.height = "100%";
    }
    menu.style.visibility = "visible";
  });
  // close side menu
  document.querySelector("#closeMenu").addEventListener("click", () => {
    let menu = document.querySelector("#menu");

    if (window.innerWidth <= 500) menu.style.height = "0";
    else menu.style.width = "0";

    menu.style.visibility = "hidden";
  });
}

// this function checks the location of a file based on which folder level we are
function checkLinks(links) {
  let updated = {};
  let checkLevel = header.className.slice(header.className.length - 1);

  for (let x in links) {
    updated[x] = links[x];
    for (let i = 0; i < checkLevel; i++) updated[x] = "../" + updated[x];
  }
  return updated;
}
