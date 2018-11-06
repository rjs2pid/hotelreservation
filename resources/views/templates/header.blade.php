@extends('layouts.layout')

@section('navbar')
<nav class="navbar  navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="images/logo.png"  alt="holiday crown"></a>
            </div>
    
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav">        
                <li><a href="/">Home </a></li>
                <li><a href="/tarrif">Rooms & Tariff</a></li>        
                <li><a href="/">Introduction</a></li>
                <li><a href="/gallery">Gallery</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
            </div><!-- Wnavbar-collapse -->
        </div><!-- container-fluid -->
        </nav>
