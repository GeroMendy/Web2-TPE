<?php

    function startSession($user){

        $logEr = "Algunos datos de usuarios estan vacios.";
        finishSession();//por las dudas
        start();
        try{
            $_SESSION['usuario_nombre'] = $user->nombre;
            $_SESSION['usuario_mail'] = $user->mail ;
            $_SESSION['usuario_admin'] = ($user->admin||$user->admin==1||$user->admin=='1');
            $_SESSION['usuario_id'] = $user->id_usuario;
        }catch(Exception $e){
            echo $logEr;
        }
    }
    function finishSession(){
        start();
        session_destroy();
    }
    function isLogged(){
        start();
        $logged= !empty($_SESSION['usuario_mail']);
        return $logged;
    }
    function isAdmin(){
        start();
        $admin = !empty($_SESSION['usuario_admin'])&&$_SESSION['usuario_admin'];
        return $admin;
    }
    function getUserSessionNombre(){
        start();
        $nombre='';
        if(!empty($_SESSION['usuario_nombre'])){
            $nombre=$_SESSION['usuario_nombre'];
        }
        return $nombre;
    }
    function getUserSessionId(){
        start();
        $id='';
        if(!empty($_SESSION['usuario_id'])){
            $id=$_SESSION['usuario_id'];
        }
        return $id;
    }
    function getUserSessionMail(){
        start();
        $mail='';
        if(!empty($_SESSION['usuario_mail'])){
            $mail=$_SESSION['usuario_mail'];
        }
        return $mail;
    }
    function start(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    