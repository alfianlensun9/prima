package models

// TrxPerencanaans get data perencanaan Request
type TrxPerencanaans struct {
	IdTrxPerencanaan   int64  `from:"id_trx_perencanaan" json:"id_trx_perencanaan"`
	NamaKategori       string `from:"nama_kategori" json:"nama_kategori"`
	IDMessageTelegram  int64  `from:"id_message_telegram" json:"id_message_telegram"`
	NamaAlkes          string `from:"nama_alkes" json:"nama_alkes"`
	NamaAlkesMstAlkes  string `from:"nama_alkes_mst_alkes" json:"nama_alkes_mst_alkes"`
	Kuantitas          string `from:"kuantitas" json:"kuantitas"`
	Harga              string `from:"harga" json:"harga"`
	Justifikasi        string `from:"justifikasi" json:"justifikasi"`
	UmurAset           string `from:"umur_aset" json:"umur_aset"`
	MudahRusak         string `from:"mudah_rusak" json:"mudah_rusak"`
	MudahHilang        string `from:"mudah_hilang" json:"mudah_hilang"`
	Eplanning          string `from:"eplanning" json:"eplanning"`
	FileDataPendukung  string `from:"file_data_pendukung" json:"file_data_pendukung"`
	ValidStatus        string `from:"valid_status" json:"valid_status"`
	FlagActive         int64  `from:"flag_active" json:"flag_active"`
	DateCreated        string `from:"date_created" json:"date_created"`
	UserPenginput      string `from:"nama_penginput" json:"nama_penginput"`
	IdUserInputer      string `from:"id_user_inputer" json:"id_user_inputer"`
	Prioritas          string `from:"prioritas" json:"prioritas"`
	IdMstAlasanPending int64  `from:"id_mst_alasan_pending" json:"id_mst_alasan_pending"`
}

//ValidasiRequest
type TrxPerencanaansValidasis struct {
	// IdTrxPerencanaansValidasi int64  `from:"idTrxPerencanaanValidasi" json:"IdTrxPerencanaansValidasi"`
	IdTrxPerencanaan int64  `from:"idTrxPerencanaan" json:"idTrxPerencanaan"`
	AlasanPending    int64  `from:"alasanPending" json:"alasanPending"`
	Indikator        string `from:"indikator" json:"indikator"`
	Prioritas        string `from:"prioritas" json:"prioritas"`
	ValidStatus      string `from:"validStatus" json:"validStatus"`
	Komentar         string `from:"komentar" json:"komentar"`
}

// MstAlkes get data alkes
type MstAlkes struct {
	IdMstAlkes int64  `gorm:"column:id_mst_alkes; PRIMARY_KEY" from:"id_mst_alkes" json:"id_mst_alkes"`
	NamaAlkes  string `from:"nama_alkes" json:"nama_alkes"`
}

// MstAlasanPending get alasan pending
type MstAlasanPending struct {
	IdMstAlasanPending int64  `from:"id_mst_alasan_pending" json:"id_mst_alasan_pending"`
	Keterangan         string `from:"keterangan" json:"keterangan"`
}

type MstIndikators struct {
	IdMstIndikator int64  `from:"id_mst_indikator" json:"id_mst_indikator"`
	NamaIndikator  string `from:"nama_indikator" json:"nama_indikator"`
}

// MstNomenklaturAlatKesehatans get alkes
type MstNomenklaturAlatKesehatans struct {
	Id                int64  `from:"id" json:"id"`
	NamaKategori      string `from:"nama_kategori" json:"nama_kategori"`
	NamaAlatKesehatan string `from:"nama_alat_kesehatan" json:"nama_alat_kesehatan"`
}

// MstAlkesByName get data Alkes by nama request
type MstAlkesRequest struct {
	NamaAlkes string `from:"NamaAlkes" json:"NamaAlkes"`
}

// AuthUsers create user Request
type AuthUsers struct {
	Id             int64  `from:"idAuthUser" json:"idAuthUser"`
	Username       string `from:"username" json:"username"`
	FirstName      string `from:"firstName" json:"firstName"`
	LastName       string `from:"lastName" json:"lastName"`
	Password       string `from:"password" json:"password"`
	ProfilePicture string `from:"profile_picture" json:"profile_picture"`
	IdTelegram     string `from:"idTelegram" json:"idTelegram"`
	FlagActive     string `from:"flag_active" json:"flag_active"`
}

// MasterUser master alkes
type MasterAlkess struct {
	IdMstAlkes int64  `from:"idMstAlkes" json:"idMstAlkes"`
	NamaAlkes  string `from:"namaAlkes" json:"namaAlkes"`
}

// TrxDataUmum
type TrxDataUmums struct {
	ID        int64  `from:"id" json:"id"`
	Title     string `from:"title" json:"title"`
	Url       string `from:"url" json:"url"`
	Deskripsi string `from:"deskripsi" json:"deskripsi"`
}
