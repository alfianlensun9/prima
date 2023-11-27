package controllers

import (
	"net/http"
	"sitou-plan/app/config"

	"github.com/labstack/echo"
)

// LoginPage login page view
func LoginPage(c echo.Context) error {
	data := config.M{"message": "Hello World!"}
	return c.Render(http.StatusOK, "login.view.html", data)
}

// SitouApp test
func SitouApp(c echo.Context) error {
	data := config.M{"message": "Hello World!"}
	return c.Render(http.StatusOK, "main.view.html", data)
}

// IndexPage test
func (h *AuthHandler) IndexPage(c echo.Context) error {
	data := config.M{"message": "Hello World!"}
	return c.Render(http.StatusOK, "main.view.html", data)
}

// Dashboard test
func Dashboard(c echo.Context) error {

	data := config.M{"message": "Hello World!"}

	return c.Render(http.StatusOK, "dashboard.view.html", data)
}
