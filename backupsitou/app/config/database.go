package config

import (
	"fmt"
	"time"

	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/mysql"
)

// DBSimrs koneksi ke database
func DBSimrs() (db *gorm.DB) {
	dbDriver := "mysql"
	dbUser := "root"
	dbPass := "root"
	dbName := "db_sitou"
	db, err := gorm.Open(dbDriver, dbUser+":"+dbPass+"@tcp(127.0.0.1:3306)/"+dbName)
	if err != nil {
		// panic(err.Error())
		fmt.Println("tidak terkonek dengan database")
	}
	db.DB().SetMaxIdleConns(100)
	db.DB().SetMaxOpenConns(500)
	db.DB().SetConnMaxLifetime(time.Hour)

	return db
}

// DBAdms koneksi ke database
