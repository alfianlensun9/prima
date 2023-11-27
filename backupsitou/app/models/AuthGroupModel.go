package models

// AuthGroupModel user model
type AuthGroupModel struct {
	ID        int64  `from:"id" json:"id"`
	Nama      string `from:"nama" json:"nama"`
	Deskripsi string `from:"deskripsi" json:"deskripsi"`
}
