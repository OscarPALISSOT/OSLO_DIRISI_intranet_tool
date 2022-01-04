
          <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">
              <a href ="/" class="navbar-brand"><img src="Ressources/images/logo.png"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="navbar-toggler-icon fas fa-bars"></i>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNavDarkDropdown">
              <ul  class="nav mr-auto">
              
              <li class="nav-item"><a href="/" class="nav-link">Accueil</a></li>              
              <?php
                if(Auth::isLogged()){
                  echo '<li class="dropdown nav-item">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Profil - '.$_SESSION['Auth']['Login'].'
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                    <a class="dropdown-item" href="#">Profil</a>';

                    if(Auth::hasRole()){
                      if(Auth::isAdmin()){
                        echo '<div class="dropdown-divider"></div>';
                        echo '<a class="dropdown-item" href="/admin">Gestion utilisateurs</a>';
                        echo '<a class="dropdown-item" href="/BPT">Gestion BPT</a>';
                        echo '<a class="dropdown-item" href="/BRC">Gestion BRC</a>';
                        echo '<a class="dropdown-item" href="/BCS">Gestion BCS</a>';
                      } else {
                        echo '<div class="dropdown-divider"></div>';
                        echo '<a class="dropdown-item" href="/'.$_SESSION['Auth']['role'].'">Gestion '.$_SESSION['Auth']['role'].'</a>';
                      }
                    }
                    echo '<div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item">Se déconnecter</a>
                  </div>
                  </li>
                ';
                  
                } else {
                  echo '<li class="nav-item"><a href="/login" class="nav-link">Se connecter</a></li>';
              }?>
              <li class="nav-item"><a href="/recherche" class="nav-link">Page de recherche</a></li> 

              </ul>
              <ul  class="nav mr-auto">
              <li class="nav-item"><a href="/contactprincipal" class="nav-link">Contact</a></li>
              
              </ul>
              </div>
             </div>
          </nav>
