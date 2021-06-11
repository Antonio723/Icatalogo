    <link rel="stylesheet" href="/secondversion/icatalogo/icatalogo-parte3/componentes/header/header.css" />

        <?php 
        if(!isset($_SESSION)) session_start();
            if(isset($_SESSION["mensagem"])){
        ?>
                <div class="mensagem">
                    <?= $_SESSION["mensagem"]; ?>
                </div>

                <script lang="javascript">
                    setInterval(() => {
                        document.querySelector(".mansagem").style.display = "none";
                    }, 3000);                 
                </script>
        <?php
            unset($_SESSION["mensagem"]);
            }
        ?>
        
        
    <header class="header">
        <figure>
            <a href="/secondversion/icatalogo/icatalogo-parte3/produtos/index.php">
            <img  src="/secondversion/icatalogo/icatalogo-parte3/imgs/logo.png" />
            </a>
        </figure>
        <form method="GET" action="../../../icatalogo-parte3/produtos/index.php" >
            <input  type="search" placeholder="Pesquisar"  name="pesquisa" id="pesquisa"/>
            <button>
                <img src="/secondversion/icatalogo/icatalogo-parte3/imgs/lupa-de-pesquisa.svg">
            </button>
        </form>
        <?php if (!isset($_SESSION["usuarioId"])) { ?>
            <nav>
                <ul>
                    <a id="menu-admin">Administrador</a>
                </ul>
            </nav>

            <div class="container-login" id="container-login">
                <h1>Fazer login</h1>

                <form method="POST" action="/secondversion/icatalogo/icatalogo-parte3/componentes/header/acoes-do-usuario.php">
                    <input type="hidden" name="acao" value="login" />
                    <input type="text" name="usuario" placeholder="Usuário" />
                    <input type="password" name="senha" placeholder="Senha" />
                    <button>Entrar</button>
                </form>

            </div>
        <?php } else { ?>
            <nav>
                <ul>
                    <a id="menu-admin" onclick="logout()">sair</a>
                </ul>
            </nav>

            <form id="form-logout" style="display: none" method="POST" action="../componentes/header/acoes-do-usuario.php">
                <input type="hidden" name="acao" value="logout">
            </form>

        <?php } ?>

    </header>


    <script lang="javascript">
        function logout() {
            document.querySelector("#form-logout").submit();
        }

        document.querySelector("#menu-admin").addEventListener("click", toggleLogin);


        function toggleLogin() {

            let containerLogin = document.querySelector("#container-login");

            let formContainer = document.querySelector("#container-login > form");

            let h1Container = document.querySelector("#container-login > h1");

            //se o container estiver oculto, motramos

            if (containerLogin.style.opacity == 0) {

                formContainer.style.display = "flex";

                h1Container.style.display = "block";

                containerLogin.style.opacity = 1;

                containerLogin.style.height = "200px";

            } else {

                //se não, ocultamos

                formContainer.style.display = "none";

                h1Container.style.display = "none";

                containerLogin.style.opacity = 0;

                containerLogin.style.height = "0px";

            }

        }
    </script>