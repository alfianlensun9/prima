package config

import (
	"time"

	"github.com/dgrijalva/jwt-go"
)

var mySigningKey = []byte("mysecret")

// GenerateJWT generate token
func GenerateJWT() (string, error) {
	token := jwt.New(jwt.SigningMethodHS256)
	claims := token.Claims.(jwt.MapClaims)

	claims["authorized"] = true
	claims["user"] = "Victor Mongi"
	claims["exp"] = time.Now().Add(time.Minute * 30).Unix()

	tokenString, err := token.SignedString(mySigningKey)

	if err != nil {
		return "", err
	}
	return tokenString, nil

}
