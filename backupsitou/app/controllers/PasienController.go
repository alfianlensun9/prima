package controllers

import (
	"fmt"
	"net/http"
	"sitou-plan/app/config"
	"sitou-plan/app/models"

	"github.com/RediSearch/redisearch-go/redisearch"
	"github.com/labstack/echo"
)

// GetUsers get pasien dari redis
func GetUsers(c echo.Context) error {
	db := config.DBSimrs()

	var users []models.Users

	err := db.Raw("SELECT id, username, first_name FROM auth_users limit 39").Find(&users).Error

	if err != nil {
		fmt.Println("error nyong")
	}

	return c.JSON(http.StatusOK, users)

}

// PasienRequest request pasien
type PasienRequest struct {
	Nama string `json:"nama"`
}

// GetPasienRedis get pasien dari redis POST request
func GetPasienRedis(c echo.Context) (err error) {

	redis := redisearch.NewClient("", "")

	u := new(PasienRequest)

	if err = c.Bind(u); err != nil {
		return
	}

	docs, total, err := redis.Search(redisearch.NewQuery(u.Nama).Limit(0, 30))

	fmt.Println(total, err)

	return c.JSON(http.StatusOK, docs)

}
