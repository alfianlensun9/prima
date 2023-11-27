package config

import "github.com/labstack/echo"

// LoadStaticFiles load static files
func LoadStaticFiles() *echo.Echo {

	route := echo.New()

	route.Static("/js", "./resources/assets/js/")
	route.Static("/images", "./resources/assets/images/")
	route.Static("/css", "./resources/assets/css/")
	route.Static("/images", "./resources/assets/images/")
	route.Renderer = NewRenderer("./app/views/*.html", true)

	return route
}
