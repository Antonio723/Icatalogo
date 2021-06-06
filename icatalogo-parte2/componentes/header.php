<link href="/secondversion/icatalogo/icatalogo-parte2/componentes/header.css" rel="stylesheet">
<header id="header" class="header">
    <figure>
        <img src="/secondversion/icatalogo/icatalogo-parte2/imgs/logo.png" alt="">
    </figure>
    <input type="search" placeholder="Pesquisar" />
    <nav>
        <ul>
            <a id="menu-admin">Administrador</a>
        </ul>
    </nav>
    <div class="container-login" id="container-login">
        <h1>Fazer Login</h1>
        <form action="" method="POST">
            <input type="text" name="usuario" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <button>Entrar</button>
        </form>
    </div>
</header>

<script lang="javascript">
    document.querySelector("#menu-admin").addEventListener('click', togglelogin);

    function togglelogin (){
        let containerLogin = document.querySelector("#container-login");
        let formContainer = document.querySelector('#container-login > form');
        let h1Container = document.querySelector('#container-login > h1');

        if(containerLogin.style.opacity == 0){
            formContainer.style.display = "flex"
            h1Container.style.display = "block";
            containerLogin.style.opacity = 1;
            containerLogin.style.height = "200px";
        }else{
            h1Container.style.display = "none";
            formContainer.style.display = "none";
            containerLogin.style.opacity = 0;
            containerLogin.style.height = "0px";
        }
    }
</script>
