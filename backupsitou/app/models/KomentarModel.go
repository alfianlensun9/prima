package models

// TrxKomentar untuk komentar
type TrxKomentar struct {
	ID                          int64  `from:"id" json:"id"`
	IDTrxPerencanaans           int64  `from:"id_trx_perencanaans" json:"id_trx_perencanaans"`
	IDMessageTelegramPertama    int    `from:"id_message_telegram_pertama" json:"id_message_telegram_pertama"`
	IDMessageTelegramPercakapan int    `from:"id_message_telegram_percakapan" json:"id_message_telegram_percakapan"`
	Komentar                    string `from:"komentar" json:"komentar"`
	// FirstName                   string `from:"first_name" json:"first_name"`
	FromIDTelegram int64 `from:"from_id_telegram" json:"from_id_telegram"`
	ToIDTelegram   int64 `from:"to_id_telegram" json:"to_id_telegram"`
	FlagActive     int   `gorm:"default:1" from:"flag_active" json:"flag_active"`
	DateCreated    int64 `gorm:"default:CURRENT_TIMESTAMP" from:"date_created" json:"date_created"`
}
