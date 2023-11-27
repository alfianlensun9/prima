package models

// AuthUser user model
type AuthUser struct {
	IDUser         int64  `from:"id" json:"id"`
	ProfilePicture string `from:"profile_picture" json:"profile_picture"`
	Username       string `from:"username" json:"username"`
	FirstName      string `from:"first_name" json:"first_name"`
	LastName       string `from:"last_name" json:"last_name"`
	IDTelegram     string `from:"id_telegram" json:"id_telegram"`
	Password       string `from:"password" json:"password"`
	AuthGroup      string `from:"auth_group" json:"auth_group"`
}

// AuthUserDetail user model
type AuthUserDetail struct {
	IDUser         int64  `from:"id" json:"id"`
	ProfilePicture string `from:"profile_picture" json:"profile_picture"`
	Username       string `from:"username" json:"username"`
	FirstName      string `from:"first_name" json:"first_name"`
	LastName       string `from:"last_name" json:"last_name"`
	IDTelegram     string `from:"id_telegram" json:"id_telegram"`
	// Password       string `from:"password" json:"password"`
	AuthGroup string `from:"auth_group" json:"auth_group"`
}
