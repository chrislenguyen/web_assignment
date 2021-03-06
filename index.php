<?php
session_start();
include 'views/header.html';

define('MEMBER', '1');
define('STAFF', '2');
define('ADMIN', '3');

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = '';
}
$role = $_SESSION['role'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == "") {
        include "views/exception.html";
    } 
    elseif ($page == "login" && $role == '') {
        include_once "views/login_view.html";
    } 
    elseif ($page == "sign_up" && $role == '') {
        include_once "views/signup_view.html";
    } 
    elseif ($page == "home") {
        include "views/$page.html";
    } 
    elseif ($page == "modify_question" && ($role == STAFF || $role == ADMIN)){
        include "views/modify_question_view.html";
    }
    elseif ($page == "add_question" && ($role == STAFF || $role == ADMIN)) {
        include "views/add_question_view.html";
    } 
    elseif ($page == "delete_question" && ($role == STAFF || $role == ADMIN)) {
        include "views/delete_question_view.html";
    } 
    elseif ($page == "insert_staff" && $role == ADMIN) {
        include "views/insert_staff_view.html";
    } 
    elseif ($page == "delete_staff" && $role == ADMIN) {
        include "views/delete_staff_view.html";
    }
    elseif ($page == "exam_view") {
        include "views/exam_view.html";
    } 
    elseif ($page == "result" && $_SESSION['role'] != null) {
        include "views/result.html";
    } 
    elseif ($page == "ranking") {
        include "views/ranking.html";
    } 
    elseif ($page == "about") {
        include "views/about_view.html";
    }
    else {
        include "views/home.html";
    }
}
else include "views/home.html";
include 'views/footer.html';
