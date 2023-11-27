package controllers

import (
	"fmt"
	"net/http"
	"sitou-plan/app/config"
	"sitou-plan/app/models"
	"time"

	"github.com/dgrijalva/jwt-go"
	"github.com/labstack/echo"
)

// AuthHandler struct
type AuthHandler struct{}

// User user request
type User struct {
	Username string `json:"username" form:"username" query:"username"`
	Email    string `json:"email" form:"email" query:"email"`
	Password string `json:"password" form:"password" query:"password"`
}

// LoginProcess auth
func (h *AuthHandler) LoginProcess(c echo.Context) (err error) {
	user := new(User)

	if err = c.Bind(user); err != nil {
		return
	}

	username := user.Username
	password := user.Password

	db := config.DBSimrs()

	var authUser []models.AuthUser

	db.Limit(1).Where(`username = ?`, username).Find(&authUser)

	// db.Where("username = ?", username).First(&authUser)

	if err != nil {
		fmt.Println(err)
	}

	fmt.Println(authUser)

	// Check in your db if the user exists or not
	if username == authUser[0].Username && config.CheckPasswordHash(password, authUser[0].Password) {
		// Create token
		token := jwt.New(jwt.SigningMethodHS256)
		// Set claims
		// This is the information which frontend can use
		// The backend can also decode the token and get admin etc.

		claims := token.Claims.(jwt.MapClaims)
		claims["first_name"] = authUser[0].FirstName
		claims["last_name"] = authUser[0].LastName
		claims["username"] = authUser[0].Username
		claims["auth_group"] = authUser[0].AuthGroup
		claims["id_telegram"] = authUser[0].IDTelegram
		claims["profile_picture"] = authUser[0].ProfilePicture
		claims["exp"] = time.Now().Add(time.Hour * 72).Unix()

		// Generate encoded token and send it as response.
		// The signing string should be secret (a generated UUID          works too)
		tokenString, err := token.SignedString([]byte("secret"))
		if err != nil {
			return err
		}

		cookie := new(http.Cookie)
		cookie.Name = "token"
		cookie.Value = tokenString
		cookie.Expires = time.Now().Add(5 * time.Hour)
		c.SetCookie(cookie)

		return c.JSON(http.StatusOK, map[string]string{
			"token": tokenString,
		})
	}
	return echo.ErrUnauthorized
}

// Logout logout
func (h *AuthHandler) Logout(c echo.Context) (err error) {

	token := jwt.New(jwt.SigningMethodHS256)
	// Set claims
	// This is the information which frontend can use
	// The backend can also decode the token and get admin etc.

	claims := token.Claims.(jwt.MapClaims)
	claims["first_name"] = "FirstName"
	claims["last_name"] = "LastName"
	claims["username"] = "Username"
	claims["auth_group"] = "AuthGroup"
	claims["id_telegram"] = "IDTelegram"
	claims["profile_picture"] = "ProfilePicture"
	claims["exp"] = time.Now().Add(time.Hour * 72).Unix()

	// Generate encoded token and send it as response.
	// The signing string should be secret (a generated UUID          works too)
	tokenString, err := token.SignedString([]byte("secrets"))
	if err != nil {
		return err
	}

	cookie := new(http.Cookie)
	cookie.Name = "token"
	cookie.Value = tokenString
	cookie.Expires = time.Now().Add(5 * time.Hour)
	c.SetCookie(cookie)

	c.Redirect(http.StatusFound, "/front/login")
	return echo.ErrUnauthorized

}

// MustAuth untuk yang telah passing auth
func (h *AuthHandler) MustAuth(c echo.Context) error {
	user := c.Get("user").(*jwt.Token)
	claims := user.Claims.(jwt.MapClaims)
	name := claims["username"].(string)
	return c.String(http.StatusOK, "Welcome "+name+"!")
}
