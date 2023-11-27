package middlewares

import (
	"fmt"
	"net/http"

	"github.com/dgrijalva/jwt-go"
	"github.com/labstack/echo"
	"github.com/labstack/echo/middleware"
)

// MustAuth  cek if login in
var MustAuth = middleware.JWTWithConfig(middleware.JWTConfig{
	SigningKey: []byte("secret"),
})

// GlobalMiddleware load global middleware
func GlobalMiddleware(route *echo.Echo) *echo.Echo {
	// route.Use(middleware.Logger())
	route.Use(middleware.Recover())
	route.Use(middleware.CORSWithConfig(middleware.CORSConfig{
		AllowOrigins: []string{"*"},
		AllowMethods: []string{http.MethodGet, http.MethodPut, http.MethodPost, http.MethodDelete},
	}))
	return route
}

// IsVerlosKamerAPI is admin
func IsVerlosKamerAPI(next echo.HandlerFunc) echo.HandlerFunc {
	return func(c echo.Context) error {
		user := c.Get("username").(*jwt.Token)
		claims := user.Claims.(jwt.MapClaims)
		authGroup := claims["auth_group"].(string)
		if authGroup == "vk" {
			return echo.ErrUnauthorized
		}
		return next(c)
	}
}

// IsVerlosKamerFront is admin
func IsVerlosKamerFront(next echo.HandlerFunc) echo.HandlerFunc {

	return func(c echo.Context) error {
		cookie, err := c.Cookie("token")
		if err != nil {
			// c.Redirect(http.StatusFound, "/front/login")
			return echo.ErrUnauthorized
		}
		claims := jwt.MapClaims{}
		token, err := jwt.ParseWithClaims(cookie.Value, claims, func(token *jwt.Token) (interface{}, error) {
			return []byte("secret"), nil
		})

		authGroup := token.Claims.(jwt.MapClaims)["auth_group"].(string)
		fmt.Println(authGroup)
		if authGroup != "vk" {
			c.Redirect(http.StatusFound, "/front/login")
			return echo.ErrUnauthorized
		}
		return next(c)
	}

}
