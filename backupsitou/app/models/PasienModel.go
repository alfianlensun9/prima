package models

import "database/sql"

// Users struct
type Users struct {
	ID        int64          `from:"id" json:"id"`
	Username  sql.NullString `from:"username" json:"username"`
	FirstName sql.NullString `from:"first_name" json:"first_name"`
}
