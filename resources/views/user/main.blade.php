


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

   <!-- Favicon -->
   <link rel="shortcut icon" href="assets/images/téléchargement.ico" />

<!-- Dark mode -->
<script>
  const storedTheme = localStorage.getItem("theme");

  const getPreferredTheme = () => {
    if (storedTheme) {
      return storedTheme;
    }
    return window.matchMedia("(prefers-color-scheme: light)").matches
      ? "light"
      : "light";
  };

  const setTheme = function (theme) {
    if (
      theme === "auto" &&
      window.matchMedia("(prefers-color-scheme: dark)").matches
    ) {
      document.documentElement.setAttribute("data-bs-theme", "dark");
    } else {
      document.documentElement.setAttribute("data-bs-theme", theme);
    }
  };

  setTheme(getPreferredTheme());

  window.addEventListener("DOMContentLoaded", () => {
    var el = document.querySelector(".theme-icon-active");
    if (el != "undefined" && el != null) {
      const showActiveTheme = (theme) => {
        const activeThemeIcon = document.querySelector(
          ".theme-icon-active use"
        );
        const btnToActive = document.querySelector(
          `[data-bs-theme-value="${theme}"]`
        );
        const svgOfActiveBtn = btnToActive
          .querySelector(".mode-switch use")
          .getAttribute("href");

        document
          .querySelectorAll("[data-bs-theme-value]")
          .forEach((element) => {
            element.classList.remove("active");
          });

        btnToActive.classList.add("active");
        activeThemeIcon.setAttribute("href", svgOfActiveBtn);
      };

      window
        .matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", () => {
          if (storedTheme !== "light" || storedTheme !== "dark") {
            setTheme(getPreferredTheme());
          }
        });

      showActiveTheme(getPreferredTheme());

      document
        .querySelectorAll("[data-bs-theme-value]")
        .forEach((toggle) => {
          toggle.addEventListener("click", () => {
            const theme = toggle.getAttribute("data-bs-theme-value");
            localStorage.setItem("theme", theme);
            setTheme(theme);
            showActiveTheme(theme);
          });
        });
    }
  });
</script>

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com/" />
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap"/>

<!-- Plugins CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/font-awesome/css/all.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}"/>
<link rel="stylesheet" type="text/css" ref="{{ asset('front_office/assets/vendor/tiny-slider/tiny-slider.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/glightbox/css/glightbox.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/apexcharts/css/apexcharts.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css')}}"/>
<link rel="stylesheet" type="text/css"  href="{{ asset('front_office/assets/vendor/choices/css/choices.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/quill/css/quill.snow.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/stepper/css/bs-stepper.min.css')}}"/>

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/css/style.css')}}" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7N7LGGGWT1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag("js", new Date());

  gtag("config", "G-7N7LGGGWT1");
</script>

<!-- password -->
<script>
  p = true;
  function Changer() {
    if (p) {
      document
        .getElementById("inputPassword5")
        .setAttribute("type", "text");
      p = false;
    } else {
      document
        .getElementById("inputPassword5")
        .setAttribute("type", "password");
      p = true;
    }
  }
</script>
 <!------------------------------------- Template Css Styles ----------------------------------------------->
 <link rel="stylesheet" href=".{{ asset('front_office/assets/Template/css/style.css')}}" type="text/css"> 
<!-------------------------------------End Template Css Styles ----------------------------------------------->
</head>
<body>
<!-- Header START -->
<header class="navbar-light navbar-sticky"></header>
<!-- Header END -->
<main>
  <!-- =======================
  Page Banner START -->
  <section class="pt-0">
    <!-- Main banner frontground image -->
    <div class="px-0">
      <div
        class="bg-primary h-100px h-md-200px rounded-0"
        style="
          frontground: url(assets/images/pattern/04.png) no-repeat center center;
          frontground-size: cover;
        "
      ></div>
    </div>
    <div class="ms-5 mt-n4">
      <div class="row">
        <!-- Profile banner START -->
        <div class="col-12">
          <div class="card bg-transparent card-body p-0">
            <div class="row d-flex justify-content-between">
              <!-- Avatar -->
              <div class="col-auto mt-4 mt-md-0">
                <div class="avatar avatar-xxl mt-n3">
                  
                </div>
              </div>
              <div
                class="col d-md-flex justify-content-between align-items-center mt-4"
              >
                <div>
                  <!-- <h1 class="my-1 fs-4">
                    <i class="bi bi-patch-check-fill text-info small"></i>
                  </h1>
                  <h6 class="role-display my-1">
                  </h6> -->
                </div>
              </div>
            </div>
          </div>
          <hr class="d-xl-none" />
          <div
            class="col-12 col-xl-3 d-flex justify-content-between align-items-center"
          >
            <a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
            <button
              class="btn btn-primary d-xl-none"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasSidebar"
              aria-controls="offcanvasSidebar"
            >
              <i class="fas fa-sliders-h"></i>
            </button>
          </div>
          <!-- Advanced filter responsive toggler END -->
        </div>
      </div>
    </div>
  </section>
  <section class="pt-0">
    <div class="row">
      <!-- Left sidebar START -->
      <div class="col-xl-2 ps-5">
        <!-- Responsive offcanvas body START -->
        <div
          class="offcanvas-xl offcanvas-end"
          tabindex="-1"
          id="offcanvasSidebar"
        >
          <!-- Offcanvas header -->
          <div class="offcanvas-header bg-light">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
              Mon profil
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              data-bs-target="#offcanvasSidebar"
              aria-label="Close"
            ></button>
          </div>
          <!-- Offcanvas body -->
          <div class="offcanvas-body p-3 p-xl-0">
            <div class="bg-dark border rounded-3 pb-0 p-3 w-100">
              <!-- Dashboard menu -->
              <div class="list-group list-group-dark list-group-borderless">
                <a class="list-group-item" routerLink="Liste_commande_by_client"
                  ><i class="fas fa-address-card fa-fw me-2"></i>Mes commandes
                </a>
                <a class="list-group-item" routerLink="passer-commande"
                  ><i class="fas fa-plus fa-fw"></i>Ajouter Commande</a
                >

                <a class="list-group-item" routerLink="Facture"
                  ><i class="fas fa-stream"></i>Mes factures</a
                >
                <a
                  class="list-group-item text-danger bg-danger-soft-hover"
                  (click)="logout()"
                  routerLink="/home"
                  ><i class="fas fa-sign-out-alt fa-fw me-2"></i>Se
                  déconnecter</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- Responsive offcanvas body END -->
      </div>
      <!-- Left sidebar END -->

      <!-- Main content START -->
      <div class="col-xl-9">
        <router-outlet></router-outlet>
      </div>
      <!-- Main content END -->
    </div>
    <!-- Row END -->
  </section>
</main>

<footer class="bg-dark p-3">
  <div class="row align-items-center">
    <!-- Widget -->
    <div class="col-md-4 text-center text-md-start mb-3 mb-md-0"></div>
    <!-- Widget -->
    <div class="col-md-4 mb-3 mb-md-0">
      <div class="text-center text-white text-primary-hover">
        Copyrights ©2024.
      </div>
    </div>
    <!-- Widget -->
    <div class="col-md-4">
      <!-- Rating -->
      <ul class="list-inline mb-0 text-center text-md-end">
        <li class="list-inline-item ms-2">
          <a href="#"><i class="text-white fab fa-facebook"></i></a>
        </li>
        <li class="list-inline-item ms-2">
          <a href="#"><i class="text-white fab fa-instagram"></i></a>
        </li>
        <li class="list-inline-item ms-2">
          <a href="#"><i class="text-white fab fa-linkedin-in"></i></a>
        </li>
        <li class="list-inline-item ms-2">
          <a href="#"><i class="text-white fab fa-twitter"></i></a>
        </li>
      </ul>
    </div>
  </div>
</footer>

  <!-- Bootstrap JS -->
<script src="{{ asset('front_office/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- Vendors -->
<script src="{{ asset('front_office/assets/vendor/tiny-slider/tiny-slider.js')}}"></script>
<script src="{{ asset('front_office/assets/vendor/glightbox/js/glightbox.js')}}"></script>
<script src="{{ asset('front_office/assets/vendor/purecounterjs/dist/purecounter_vanilla.js')}}"></script>
<script src="{{ asset('front_office/assets/vendor/apexcharts/js/apexcharts.min.js')}}"></script>
<script src="{{ asset('front_office/assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js')}}"></script>
<script src="{{ asset('front_office/assets/vendor/choices/js/choices.min.js')}}"></script>
<script src="{{ asset('front_office/assets/vendor/quill/js/quill.min.js')}}"></script>
<script src="{{ asset('front_office/assets/vendor/stepper/js/bs-stepper.min.js')}}"></script>
<!-- Template Functions -->
<script src="{{ asset('front_office/assets/js/functions.js')}}"></script>
</body>
</html>
















