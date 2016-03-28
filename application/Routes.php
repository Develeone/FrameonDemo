<?php

// Static pages
Router::set("GET",      "/",                                    "IndexController.ShowPage");


// Catalogue
Router::set("GET",      "/parts",                               "CatalogueController.ShowMainPage");
Router::set("GET",      "/parts/{category}",                    "CatalogueController.ShowCategoryPage");
Router::set("GET",      "/parts/{category}/{manufacturer}",     "CatalogueController.ShowCategoryPage");


// Users
Router::set("GET",      "/login",                               "UserController.ShowLoginForm");
Router::set("POST",     "/login",                               "UserController.Login");

Router::set("GET",      "/register",                            "UserController.ShowRegisterForm");
Router::set("POST",     "/register",                            "UserController.Register");

Router::set("GET",      "/personal",                            "UserController.ShowPersonal");
Router::set("GET",      "/logout",                              "UserController.Logout");


// Admins
Router::set("GET",      "/admin",                               "AdminController.ShowAdminPanel");
Router::set("GET",      "/admin/editCatalogue",                 "AdminController.ShowEditCataloguePage");
Router::set("GET",      "/admin/editCatalogue/{category}",      "AdminController.ShowEditCataloguePage");
Router::set("POST",     "/admin/editCatalogue",                 "AdminController.PostEditCataloguePage");
Router::set("POST",     "/admin/editCatalogue/{category}",      "AdminController.PostEditCataloguePage");