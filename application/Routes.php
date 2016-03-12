<?php

Router::set("GET", "/", "IndexController.ShowPage");
Router::set("GET", "/parts", "PartsCatalogueController.ShowMainPage");
Router::set("GET", "/parts/{category}", "PartsCatalogueController.ShowCategoryPage");
Router::set("GET", "/parts/{category}/{manufacturer}", "PartsCatalogueController.ShowCategoryPage");
Router::set("GET", "/login", "UserController.ShowLoginForm");
Router::set("POST", "/login", "UserController.Login");
Router::set("GET", "/register", "UserController.ShowRegisterForm");
Router::set("POST", "/register", "UserController.Register");
Router::set("GET", "/personal", "UserController.ShowPersonal");