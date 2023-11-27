package models

// TelegramUser user telegram user
type TelegramUser struct {
	ID         int64  `from:"id" json:"id"`
	TelegramID int64  `from:"telegram_id" json:"telegram_id"`
	Username   string `from:"username" json:"username"`
	FirstName  string `from:"first_name" json:"first_name"`
	LastName   string `from:"last_name" json:"last_name"`
}
