<link href="/secondversion/icatalogo/icatalogo-parte2/componentes/header/header.css" rel="stylesheet">
<header id="header" class="header">
    <figure>
        <img src="/secondversion/icatalogo/icatalogo-parte2/imgs/logo.png" alt="">
    </figure>
    <input type="search" placeholder="Pesquisar" />
    <?php
    if (!$_SESSION["secao"] == true) {
    ?>
        <nav>
            <ul>
                <a id="menu-admin">Administrador</a>
            </ul>
        </nav>
        <div class="container-login" id="container-login">
            <h1>Fazer Login</h1>
            <form action="/secondversion/icatalogo/icatalogo-parte2/componentes/header/login.php" method="POST">
                <input type="hidden" name="acao" value="login">
                <input type="text" name="usuario" placeholder="Usuário">
                <input type="password" name="senha" placeholder="Senha">
                <button>Entrar</button>
            </form>
        </div>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <a id="menu-admin" onclick="logout()">Sair</a>
            </ul>
        </nav>
        <form id="form-logout" style="display: none;" method="POST" action="/secondversion/icatalogo/icatalogo-parte2/componentes/header/login.php">
            <input type="hidden" name="acao" value="logout" />
        </form>
    <?php
    }
    ?>
</header>
<script lang="javascript">
    function logout() {
        document.querySelector('#form-logout').submit();
    }
    document.querySelector("#menu-admin").addEventListener('click', togglelogin);

    function togglelogin() {
        let containerLogin = document.querySelector("#container-login");
        let formContainer = document.querySelector('#container-login > form');
        let h1Container = document.querySelector('#container-login > h1');

        if (containerLogin.style.opacity == 0) {
            formContainer.style.display = "flex"
            h1Container.style.display = "block";
            containerLogin.style.opacity = 1;
            containerLogin.style.height = "200px";
        } else {
            h1Container.style.display = "none";
            formContainer.style.display = "none";
            containerLogin.style.opacity = 0;
            containerLogin.style.height = "0px";
        }
    }


    document.querySelector("#logout"), addEventListener('click', logout)
</script>