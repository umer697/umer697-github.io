<?php 
include('../config/constant.php');
include('login-check.php');

?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering website - Home Page</title>

    <!-- jquery datatables css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- !jquery datatables  css-->

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- !bootstrap css -->

    <!-- custom css -->
    <!-- <link rel="stylesheet" href="../css/admin.css"> -->
    <!-- !custom css -->


</head>

<body class="d-flex flex-column h-100">

    <nav class=" navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-category.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-food.php">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--menu section starts-->
    <!-- <div class="menu text-center">
        <div class="wrapper">
            <div>
                <ul class="">
                    <li>
                        <a href="./"> Home </a>
                    </li>
                    <li>
                        <a href="manage-admin.php"> Admin </a>
                    </li>
                    <li>
                        <a href="manage-category.php"> Category </a>
                    </li>
                    <li>
                        <a href="manage-food.php"> Food </a>
                    </li>
                    <li>
                        <a href="manage-order.php"> Order </a>
                    </li>
                    <li>
                        <a href="logout.php" class="logout"> Logout </a>
                    </li>
                    <li>
                        <a href="index.php" class="logo"> Logo </a>
                    </li>
                </ul>
            </div>


        </div>
    </div> -->
    <!--!menu section starts-->