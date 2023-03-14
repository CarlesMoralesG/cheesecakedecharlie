<style>
    body{
        margin: 0;
        width: 100%;
        height: 100%;
        font-family: 'Lucida Console';
    }

    /* Títulos */
    .general-title{
        font-family: 'Lucida Console';
        position: relative;
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .general-title > p{
        margin-top: 20px; 
        font-size: 52px;
    }

    .general-title > p > a{
        text-decoration:none;
        color: black;
    }

    /* Menú */
    .menu{
        position: relative;
        margin-bottom: 30px;
        width: 100%;
    }

    .navbar-nav,
    .mr-auto {
        flex: 0.88;
        margin: auto !important;
        display: flex;
        justify-content: space-between;
        font-size: 18px;
    }

    /* Contenido */
    .contentAdministrator{
        width: 83%;
        margin-left:8.2%;
    }

    /* Botones */
    .btn{
        background-color: burlywood !important;
        border-color: white !important;
    }
    .btn:hover{
        background-color: rgb(250, 213, 166) !important;
        border-color: white !important;
    }

    #create{
        background-color: burlywood !important;
        border-color: white !important;
        width: 100%;
    }

    #create:hover{
        background-color: rgb(250, 213, 166) !important;
        border-color: white !important;
    }

    .dropdown-item.active{
        background-color: burlywood !important;
        border-color: white !important;
    }

    .dropdown-item.active:hover{
        background-color: rgb(250, 213, 166) !important;
        border-color: white !important;
    }

    /* Formulario */
    .formulario{
        place-items: center;
        margin-left: 50px;
    }

    .formulario h1{
        color: black;
        font-size: 40;
    }

    @media screen and (max-width: 700px) {
       
    }
</style>