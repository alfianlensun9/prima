package controllers

import (
	"encoding/json"
	"fmt"
	"io"
	"io/ioutil"
	"net/http"
	"os"
	"sitou-plan/app/config"
	"sitou-plan/app/helpers"
	"sitou-plan/app/models"
	"strconv"

	"github.com/RediSearch/redisearch-go/redisearch"
	"github.com/chilts/sid"
	"github.com/labstack/echo"
)

// TrxPerencanaan create perencanaan trx_perencanaans
type TrxPerencanaan struct {
	IdTrxPerencanaan         int64
	IdMstAlkes               int64
	IdMstKategoriPerencanaan string
	Kuantitas                string
	Harga                    string
	Justifikasi              string
	UmurAset                 string
	MudahRusak               string
	MudahHilang              string
	Eplanning                string
	FileDataPendukung        string
	IdUserInputer            string
	UserGroup                string
	namaAlkesNonEplanning    string
}

type TrxDataUmum struct {
	Id        int64
	Url       string
	Title     string
	Deskripsi string
}

type TrxPerencanaansValidasi struct {
	IdTrxPerencanaan int64
	Komentar         string
	Indikator        string
	Prioritas        string
	AlasanPending    int64
	ValidStatus      string
}

// AuthUser table struktur
type AuthUser struct {
	FirstName string
	LastName  string
	Username  string
	Password  string
}

// AuthUser table struktur
type AuthUserRequest struct {
	ID         string
	FirstName  string
	LastName   string
	Username   string
	Password   string
	IdTelegram string
}

// MasterAlkes table struktur
type MstAlkes struct {
	IdMstAlkes int64  `gorm:"column:id_mst_alkes; PRIMARY_KEY" from:"id_mst_alkes" json:"id_mst_alkes"`
	NamaAlkes  string `from:"nama_alkes" json:"nama_alkes"`
}

func GetPerencanaan(c echo.Context) error {
	db := config.DBSimrs()

	var perencanaans []models.TrxPerencanaans
	err := db.Raw(`
		SELECT
		id_trx_perencanaan,
		id_mst_alkes,
		kuantitas,
		harga,
		id_message_telegram,
		justifikasi,
		umur_aset,
		mudah_rusak,
		mudah_hilang,
		eplanning,
		file_data_pendukung,
		date_created,
		id_user_inputer,
		(select alasan_pending from trx_perencanaans_validasis where id_trx_perencanaan = a.id_trx_perencanaan limit 1) as id_mst_alasan_pending,
		(select nama_alat_kesehatan from mst_nomenklatur_alat_kesehatans where id = a.id_mst_alkes limit 1) as nama_alkes,
		(select nama_alkes from mst_alkes where id_mst_alkes = a.id_mst_alkes limit 1) as nama_alkes_mst_alkes,
		(select valid_status from trx_perencanaans_validasis where id_trx_perencanaan = a.id_trx_perencanaan and flag_active = 1 order by id_trx_perencanaans_validasi desc limit 1) as valid_status,
		(select prioritas from trx_perencanaans_validasis where id_trx_perencanaan = a.id_trx_perencanaan and flag_active = 1 order by id_trx_perencanaans_validasi desc limit 1) as prioritas,
		(select nama_kategori from mst_kategori_perencanaan where id_mst_kategori_perencanaan = a.id_mst_kategori_perencanaan) as nama_kategori
		from trx_perencanaans as a where flag_active = 1`).Find(&perencanaans).Error

	if err != nil {
		fmt.Println(err)
	}
	// return nil
	return c.JSON(http.StatusOK, perencanaans)
}

// GetAlasanPendingRequest
type GetAlasanPendingRequest struct {
	ID string `json:"id"`
}

func GetAlkesMstAlkes(c echo.Context) error {
	db := config.DBSimrs()

	var mstAlkes []models.MstAlkes
	// mstAlkes.

	err := db.Raw(`
		SELECT 
		id_mst_alkes,
		nama_alkes
		from mst_alkes as a`).Find(&mstAlkes).Error

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, mstAlkes)
}

func GetAlkes(c echo.Context) error {
	db := config.DBSimrs()

	var mstNomenklaturAlatKesehatan []models.MstNomenklaturAlatKesehatans

	err := db.Raw(`
		SELECT 
		nama_alat_kesehatan, 
		(select kategori from mst_nomenklatur_alat_kesehatan_kategori where id = a.id_mst_nomenklatur_alat_kesehatan_kategori) as nama_kategori,
		id
		from mst_nomenklatur_alat_kesehatans as a`).Find(&mstNomenklaturAlatKesehatan).Error
	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, mstNomenklaturAlatKesehatan)
}

// getIndikator master indikator
func GetIndikator(c echo.Context) error {
	db := config.DBSimrs()

	var mstIndikator []models.MstIndikators

	err := db.Raw(`
		SELECT 
		id_mst_indikator,
		nama_indikator
		from mst_indikators as a`).Find(&mstIndikator).Error

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, mstIndikator)
}

// getAlasanpending mst alasan pending
func GetAlasanPending(c echo.Context) error {
	db := config.DBSimrs()

	var mstAlasanPending []models.MstAlasanPending

	err := db.Raw(`
		SELECT 
		keterangan,
		id_mst_alasan_pending
		from mst_alasan_pendings where flag_active = 1`).Find(&mstAlasanPending).Error

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, mstAlasanPending)
}

// getResgisteredTelegramUsers telegram users
func GetRegisteredTelegramUsers(c echo.Context) error {
	db := config.DBSimrs()

	var telegramUser []models.TelegramUser

	err := db.Raw(`
		SELECT 
		id,
		telegram_id,
		username,
		first_name,
		last_name
		from telegram_users`).Find(&telegramUser).Error

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, telegramUser)
}

// GetRKAKL
func GetPanduan(c echo.Context) error {
	db := config.DBSimrs()

	var trxDataUmum []models.TrxDataUmums

	err := db.Raw(`
		SELECT 
		title,
		url,
		deskripsi
		from trx_data_umums as a`).Find(&trxDataUmum).Error

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, trxDataUmum)
}

// getAuthUsers users
func GetAuthUsers(c echo.Context) error {
	db := config.DBSimrs()

	var authUser []models.AuthUsers

	err := db.Raw(`
		SELECT 
		id,
		username,
		first_name,
		last_name,
		id_telegram,
		auth_group,
		flag_active
		from auth_users`).Find(&authUser).Error

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, authUser)
}

// getalasanPendingbyid get alasan pending
func GetAlasanPendingById(c echo.Context) (err error) {
	db := config.DBSimrs()

	var mstAlasanPending []models.MstAlasanPending

	u := new(GetAlasanPendingRequest)

	if err = c.Bind(u); err != nil {
		return
	}

	db.Limit(100).Where(`id_mst_alasan_pending = ?`, u.ID).Find(&mstAlasanPending)

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, mstAlasanPending)
}

// GetUserById
func GetUserById(c echo.Context) (err error) {
	db := config.DBSimrs()

	var authUser []models.AuthUserDetail

	u := new(AuthUserRequest)

	if err = c.Bind(u); err != nil {
		return
	}
	fmt.Println(u.IdTelegram)
	err = db.Raw(`
		SELECT 
		first_name,
		last_name
		from
		auth_users
		where 
		id_telegram = ?
	`, u.ID).Find(&authUser).Error

	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, authUser)
}

// getAlkesByName get data alkes by name
func GetAlkesByName(c echo.Context) (err error) {
	db := config.DBSimrs()

	var mstAlkes []models.MstNomenklaturAlatKesehatans

	alkes := new(models.MstAlkesRequest)
	if err = c.Bind(alkes); err != nil {
		return
	}

	db.Limit(100).Where(`nama_alat_kesehatan like ?`, "%"+alkes.NamaAlkes+"%").Find(&mstAlkes)

	fmt.Println(mstAlkes)
	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, mstAlkes)
}

// CreatePerencanaan create perencanaan trx_perencanaans
func CreatePerencanaan(c echo.Context) (err error) {
	db := config.DBSimrs()
	idMstAlkes, err := strconv.ParseInt(c.FormValue("idMstAlkes"), 10, 64)
	idMstKategoriPerencanaan := c.FormValue("idMstKategoriPerencanaan")
	kuantitas := c.FormValue("kuantitas")
	harga := c.FormValue("harga")
	justifikasi := c.FormValue("justifikasi")
	umurAset := c.FormValue("umurAset")
	mudahHilang := c.FormValue("mudahHilang")
	mudahRusak := c.FormValue("mudahRusak")
	ePlanning := c.FormValue("ePlanning")
	idUserInputer := c.FormValue("idUserInputer")
	userGroup := c.FormValue("userGroup")
	// Get File

	fmt.Println(idMstAlkes)
	fileDataPendukung, err := c.FormFile("fileDataPendukung")
	if err != nil {
		return err
	}

	// Source File
	src, err := fileDataPendukung.Open()
	if err != nil {
		return err
	}

	// Destination File
	idgenerate := sid.Id()
	fileNameDataPendukung := idgenerate + "_" + fileDataPendukung.Filename
	dst, err := os.Create("resources/assets/images/" + fileNameDataPendukung)
	if err != nil {
		return err
	}

	// Copy File
	if _, err = io.Copy(dst, src); err != nil {
		return err
	}

	perencanaan := TrxPerencanaan{
		IdMstAlkes:               idMstAlkes,
		IdMstKategoriPerencanaan: idMstKategoriPerencanaan,
		Kuantitas:                kuantitas,
		Harga:                    harga,
		Justifikasi:              justifikasi,
		UmurAset:                 umurAset,
		MudahRusak:               mudahRusak,
		MudahHilang:              mudahHilang,
		Eplanning:                ePlanning,
		FileDataPendukung:        fileNameDataPendukung,
		IdUserInputer:            idUserInputer,
		UserGroup:                userGroup}

	db.NewRecord(perencanaan)

	db.Create(&perencanaan)
	// fmt.Println(db)

	return c.JSON(http.StatusOK, c)
}

func CreatePerencanaanNotEplanning(c echo.Context) (err error) {
	db := config.DBSimrs()
	namaAlkesNonEplanning := c.FormValue("namaAlkesNonEplanning")
	idMstKategoriPerencanaan := c.FormValue("idMstKategoriPerencanaan")
	kuantitas := c.FormValue("kuantitas")
	harga := c.FormValue("harga")
	justifikasi := c.FormValue("justifikasi")
	umurAset := c.FormValue("umurAset")
	mudahHilang := c.FormValue("mudahHilang")
	ePlanning := c.FormValue("ePlanning")
	idUserInputer := c.FormValue("idUserInputer")
	userGroup := c.FormValue("userGroup")
	// Get File
	// fmt.Println(idMstAlkes)
	fileDataPendukung, err := c.FormFile("fileDataPendukung")
	if err != nil {
		return err
	}

	// Source File
	src, err := fileDataPendukung.Open()
	if err != nil {
		return err
	}

	// Destination File
	idgenerate := sid.Id()
	fileNameDataPendukung := idgenerate + "_" + fileDataPendukung.Filename
	dst, err := os.Create("resources/assets/images/" + fileNameDataPendukung)
	if err != nil {
		return err
	}

	// Copy File
	if _, err = io.Copy(dst, src); err != nil {
		return err
	}

	mstAlkes := MstAlkes{
		NamaAlkes: namaAlkesNonEplanning}

	db.NewRecord(mstAlkes)
	db.Create(&mstAlkes)

	perencanaan := TrxPerencanaan{
		IdMstAlkes:               mstAlkes.IdMstAlkes,
		IdMstKategoriPerencanaan: idMstKategoriPerencanaan,
		Kuantitas:                kuantitas,
		Harga:                    harga,
		Justifikasi:              justifikasi,
		UmurAset:                 umurAset,
		MudahHilang:              mudahHilang,
		Eplanning:                ePlanning,
		FileDataPendukung:        fileNameDataPendukung,
		IdUserInputer:            idUserInputer,
		UserGroup:                userGroup}

	db.NewRecord(perencanaan)
	db.Create(&perencanaan)
	return c.JSON(http.StatusOK, c)
}

// CreateUser create user auth_users
func CreateUser(c echo.Context) (err error) {
	db := config.DBSimrs()
	user := new(models.AuthUsers)
	if err = c.Bind(user); err != nil {
		return
	}
	password, err := config.HashPassword(user.Password)
	authUser := AuthUser{
		FirstName: user.FirstName,
		LastName:  user.LastName,
		Username:  user.Username,
		Password:  password}

	db.NewRecord(authUser)

	db.Create(&authUser)

	return c.JSON(http.StatusOK, c)
}

// CreateValidasi trx_perencanaan_validasi
func CreateValidasi(c echo.Context) (err error) {
	db := config.DBSimrs()
	validasi := new(models.TrxPerencanaansValidasis)
	if err = c.Bind(validasi); err != nil {
		return
	}
	fmt.Println(validasi)

	validasiInsert := TrxPerencanaansValidasi{
		IdTrxPerencanaan: validasi.IdTrxPerencanaan,
		Komentar:         validasi.Komentar,
		Indikator:        validasi.Indikator,
		Prioritas:        validasi.Prioritas,
		ValidStatus:      validasi.ValidStatus,
		AlasanPending:    validasi.AlasanPending}

	db.NewRecord(validasiInsert)
	db.Create(&validasiInsert)

	return c.JSON(http.StatusOK, c)
}

// CreateMasterAlkes create master alkes mst_alkess
func CreateMasterAlkes(c echo.Context) (err error) {
	db := config.DBSimrs()
	masterAlkes := new(models.MasterAlkess)
	if err = c.Bind(masterAlkes); err != nil {
		return
	}

	fmt.Println(masterAlkes)

	alkes := MstAlkes{NamaAlkes: masterAlkes.NamaAlkes}
	fmt.Println(alkes)
	db.NewRecord(alkes)

	db.Create(&alkes)

	return c.JSON(http.StatusOK, c)
}

// CreateKomentarOnPerencanaanPertama buat komentar untuk perencanaan
func CreateKomentarOnPerencanaanPertama(c echo.Context) (err error) {
	db := config.DBSimrs()
	komentarRequest := new(models.TrxKomentar)

	if err = c.Bind(komentarRequest); err != nil {
		return c.JSON(http.StatusOK, err)
	}
	toIDTelegram, err := strconv.ParseInt(c.FormValue("to_id_telegram"), 10, 64)
	fmt.Println(toIDTelegram)
	fromIDTelegram, err := strconv.ParseInt(c.FormValue("from_id_telegram"), 10, 64)
	idTrxPerencanaan, err := strconv.ParseInt(c.FormValue("id_trx_perencanaans"), 10, 64)

	if err != nil {
		fmt.Println(err)
	}

	chatID := helpers.SetKomentarPertama(komentarRequest.Komentar, toIDTelegram)

	// fmt.Printf("tipennyaaa %T", chatID)
	fmt.Println(idTrxPerencanaan)
	fmt.Println(idTrxPerencanaan)
	fmt.Println(idTrxPerencanaan)
	fmt.Println(idTrxPerencanaan)
	fmt.Println(idTrxPerencanaan)
	fmt.Println(idTrxPerencanaan)
	fmt.Println(idTrxPerencanaan)
	fmt.Println(chatID)

	trxPerencanaan := new(models.TrxPerencanaans)
	dbt := config.DBSimrs()

	dbt.Model(&trxPerencanaan).Where("id_trx_perencanaan = ?", idTrxPerencanaan).Update("id_message_telegram", chatID)

	newKomentar := models.TrxKomentar{
		Komentar:                 komentarRequest.Komentar,
		ToIDTelegram:             toIDTelegram,
		FromIDTelegram:           fromIDTelegram,
		IDTrxPerencanaans:        idTrxPerencanaan,
		IDMessageTelegramPertama: chatID,
	}

	db.NewRecord(newKomentar)
	db.Create(&newKomentar)

	return c.JSON(http.StatusOK, komentarRequest)
}

// CreateKomentarOnPerencanaanPercakapan percakapan
func CreateKomentarOnPerencanaanPercakapan(c echo.Context) (err error) {
	db := config.DBSimrs()
	komentarRequest := new(models.TrxKomentar)

	if err = c.Bind(komentarRequest); err != nil {
		return c.JSON(http.StatusOK, err)
	}
	toIDTelegram, err := strconv.ParseInt(c.FormValue("to_id_telegram"), 10, 64)
	fromIDTelegram, err := strconv.ParseInt(c.FormValue("from_id_telegram"), 10, 64)
	idMessageTelegramPertama, err := strconv.Atoi(c.FormValue("id_message_telegram"))

	// idMessageTelegramPertamaSave, err := strconv.ParseInt(c.FormValue("id_message_telegram"), 10, 64)

	fmt.Println(idMessageTelegramPertama)
	fmt.Println(idMessageTelegramPertama)
	fmt.Println(idMessageTelegramPertama)
	fmt.Println(idMessageTelegramPertama)
	fmt.Println(idMessageTelegramPertama)
	fmt.Println(idMessageTelegramPertama)
	fmt.Println(idMessageTelegramPertama)

	if err != nil {
		fmt.Println(err)
	}

	fmt.Println("jlsdkfjsldkfjsldkf lsdkj flksd jflksdjf lsdkj flsd jflksdkjf lsdkfj lsdj fklsd ddfa")

	chatID := helpers.SetKomentarPercakapan(komentarRequest.Komentar, toIDTelegram, idMessageTelegramPertama)

	fmt.Println(komentarRequest.IDTrxPerencanaans)

	if err != nil {
		fmt.Println(err)
	}

	newKomentar := models.TrxKomentar{
		Komentar:                    komentarRequest.Komentar,
		ToIDTelegram:                toIDTelegram,
		FromIDTelegram:              fromIDTelegram,
		IDTrxPerencanaans:           komentarRequest.IDTrxPerencanaans,
		IDMessageTelegramPertama:    idMessageTelegramPertama,
		IDMessageTelegramPercakapan: chatID,
	}

	db.NewRecord(newKomentar)
	db.Create(&newKomentar)

	return c.JSON(http.StatusOK, komentarRequest)
}

// TestingMe ssfddf
func TestingMe(c echo.Context) (err error) {

	db := config.DBSimrs()

	trxPerencanaan := new(models.TrxPerencanaans)

	db.Model(&trxPerencanaan).Where("id_trx_perencanaan = ?", "1").Update("id_message_telegram", 947)
	if err != nil {
		fmt.Println(err)
	}

	return c.JSON(http.StatusOK, trxPerencanaan)
}

type komentarRequest struct {
	IDMessageTelegram string `json:"id_message_telegram" form:"id_message_telegram" query:"id_message_telegram"`
	IDTrxPerencanaans string `json:"id_trx_perencanaans" form:"id_trx_perencanaans" query:"id_trx_perencanaans"`
}

type komentarWithID struct {
	ID                          int64  `from:"id" json:"id"`
	IDTrxPerencanaans           int64  `from:"id_trx_perencanaans" json:"id_trx_perencanaans"`
	IDMessageTelegramPertama    int    `from:"id_message_telegram_pertama" json:"id_message_telegram_pertama"`
	IDMessageTelegramPercakapan int    `from:"id_message_telegram_percakapan" json:"id_message_telegram_percakapan"`
	Komentar                    string `from:"komentar" json:"komentar"`
	ProfilePicture              string `from:"profile_picture" json:"profile_picture"`
	Username                    string `from:"username" json:"username"`
	FromIDTelegram              int64  `from:"from_id_telegram" json:"from_id_telegram"`
	ToIDTelegram                int64  `from:"to_id_telegram" json:"to_id_telegram"`
	FlagActive                  string `from:"flag_active" json:"flag_active"`
	DateCreated                 string `from:"date_created" json:"date_created"`
}

// GetKomentarOnPerencanaanWithID s
func GetKomentarOnPerencanaanWithID(c echo.Context) (err error) {

	idMessage := new(komentarRequest)
	if err = c.Bind(idMessage); err != nil {
		return
	}

	db := config.DBSimrs()

	var trxKomentar []komentarWithID

	err = db.Raw(`
		SELECT 
			a.id, komentar, a.from_id_telegram, a.id_trx_perencanaans, a.id_message_telegram_pertama, a.id_message_telegram_percakapan,
			a.to_id_telegram, a.flag_active, a.date_created, b.profile_picture, b.username
			from trx_komentars as a
			join auth_users as b on a.from_id_telegram = b.id_telegram
			where a.id_message_telegram_pertama in (select id_message_telegram_pertama from trx_komentars where id_trx_perencanaans = ?) or a.id_trx_perencanaans = ? and a.id_trx_perencanaans <> ?
			order by a.id desc
	`, idMessage.IDTrxPerencanaans, idMessage.IDTrxPerencanaans, idMessage.IDMessageTelegram).Find(&trxKomentar).Error

	fmt.Println(trxKomentar)

	if err != nil {
		fmt.Println(err)
	}
	defer db.Close()

	return c.JSON(http.StatusOK, trxKomentar)
}

// GetKomentarOnPerencanaan s
func GetKomentarOnPerencanaan(c echo.Context) (err error) {

	db := config.DBSimrs()

	var trxKomentar []models.TrxKomentar

	err = db.Raw(`
		SELECT 
		id, komentar, from_id_telegram, id_trx_perencanaans, id_message_telegram_pertama, id_message_telegram_percakapan,
		to_id_telegram, flag_active, date_created
		from trx_komentars
		order by id desc
	`).Find(&trxKomentar).Error

	fmt.Println(trxKomentar)

	if err != nil {
		fmt.Println(err)
	}
	defer db.Close()
	return c.JSON(http.StatusOK, trxKomentar)
}

// DeletePerencanaan hapus perencanaan
func DeletePerencanaan(c echo.Context) (err error) {
	db := config.DBSimrs()
	trxPerencanaan := new(models.TrxPerencanaans)
	if err = c.Bind(trxPerencanaan); err != nil {
		return
	}
	db.Model(&trxPerencanaan).Where("id_trx_perencanaan = ?", trxPerencanaan.IdTrxPerencanaan).Update("flag_active", "0")

	defer db.Close()
	return c.JSON(http.StatusOK, c)
}

// AlkesRedis alkes struct for redis
type AlkesRedis struct {
	ID                                       int64  `json:"id"`
	IDMstNomenklaturAlatKesehatanKategori    int64  `json:"id_mst_nomenklatur_alat_kesehatan_kategori"`
	IDMstNomenklaturAlatKesehatanSubKategori int64  `json:"id_mst_nomenklatur_alat_kesehatan_sub_kategori"`
	NamaAlatKesehatan                        string `json:"nama_alat_kesehatan"`
	Sinonim                                  string `json:"sinonim"`
}

// AlkesRedisRequest cari berdasarkan nama
type AlkesRedisRequest struct {
	Nama string `json:"nama"`
}

// GetAlkesFromRedis get
func GetAlkesFromRedis(c echo.Context) (err error) {

	redis := redisearch.NewClient("127.0.0.1:6379", "sitouplan:alkes")

	u := new(AlkesRedisRequest)

	if err = c.Bind(u); err != nil {
		return
	}

	docs, total, err := redis.Search(redisearch.NewQuery(u.Nama).Limit(0, 100))

	fmt.Println(total, err)

	return c.JSON(http.StatusOK, docs)

}

// CreateJSONToRedisAlkes create redis db
func CreateJSONToRedisAlkes(c echo.Context) (err error) {
	redis := redisearch.NewClient("redis:6379", "sitouplan:alkes")

	jsonFileAlkes, err := os.Open("alkes.json")
	if err != nil {
		fmt.Println(err)
	}
	byteAlkes, _ := ioutil.ReadAll(jsonFileAlkes)
	alkes := []AlkesRedis{}
	json.Unmarshal(byteAlkes, &alkes)

	for _, value := range alkes {

		fmt.Println(value.NamaAlatKesehatan)

		doc := redisearch.NewDocument(strconv.Itoa(int(value.ID)), 1.0)

		doc.Set("id", value.ID).
			Set("id_mst_nomenklatur_alat_kesehatan_kategori", strconv.Itoa(int(value.IDMstNomenklaturAlatKesehatanKategori))).
			Set("id_mst_nomenklatur_alat_kesehatan_sub_kategori", strconv.Itoa(int(value.IDMstNomenklaturAlatKesehatanSubKategori))).
			Set("nama_alat_kesehatan", value.NamaAlatKesehatan).
			Set("sinonim", value.Sinonim)

		if err := redis.Index([]redisearch.Document{doc}...); err != nil {
			fmt.Println(err)
		}

	}

	c.Response().Header().Set(echo.HeaderContentType, echo.MIMEApplicationJSONCharsetUTF8)
	c.Response().WriteHeader(http.StatusOK)
	return json.NewEncoder(c.Response()).Encode(alkes)

}

func CekPassword(c echo.Context) (err error) {
	user := new(AuthUser)
	if err = c.Bind(user); err != nil {
		return
	}
	username := user.Username
	password := user.Password
	db := config.DBSimrs()

	var authUser []models.AuthUsers

	db.Limit(1).Where(`username = ?`, username).Find(&authUser)

	defer db.Close()
	// Check in your db if the user exists or not
	if username == authUser[0].Username && config.CheckPasswordHash(password, authUser[0].Password) {
		return c.JSON(http.StatusOK, map[string]string{
			"status": "200",
		})
	} else {
		return c.JSON(http.StatusOK, map[string]string{
			"status": "201",
		})
	}
}

// UpdatePassword ubah password user
func UpdatePassword(c echo.Context) (err error) {

	db := config.DBSimrs()

	authUser := new(models.AuthUsers)
	if err = c.Bind(authUser); err != nil {
		return
	}

	passwordBaru, _ := config.HashPassword(authUser.Password)

	db.Model(&authUser).Where("username = ?", authUser.Username).Update("password", passwordBaru)

	defer db.Close()

	// // Check in your db if the user exists or not
	return c.JSON(http.StatusOK, map[string]string{
		"status": "200",
	})
}

// UpdateIDTelegram
func UpdateIDTelegram(c echo.Context) (err error) {

	db := config.DBSimrs()

	authUser := new(models.AuthUsers)
	if err = c.Bind(authUser); err != nil {
		return
	}

	db.Model(&authUser).Where("username = ?", authUser.Username).Update("id_telegram", authUser.IdTelegram)

	defer db.Close()
	// // Check in your db if the user exists or not
	return c.JSON(http.StatusOK, map[string]string{
		"status": "200",
	})
}

// UpdateProfilePicture ganti foto profil
func UpdateProfilePicture(c echo.Context) (err error) {
	db := config.DBSimrs()
	// Get File
	authUser := new(models.AuthUsers)
	if err = c.Bind(authUser); err != nil {
		return
	}
	username := c.FormValue("username")
	profilePicture, err := c.FormFile("profilePicture")
	fmt.Println(username)

	if err != nil {
		return err
	}

	// Source File
	src, err := profilePicture.Open()
	if err != nil {
		return err
	}

	// Destination File
	idgenerate := sid.Id()
	fileNameProfilePicture := "profile-" + idgenerate + "_" + profilePicture.Filename
	fmt.Println(fileNameProfilePicture)
	dst, err := os.Create("resources/assets/images/" + fileNameProfilePicture)
	if err != nil {
		return err
	}

	// Copy File
	if _, err = io.Copy(dst, src); err != nil {
		return err
	}

	db.Model(&authUser).Where("username = ?", username).Update("profile_picture", fileNameProfilePicture)
	// fmt.Println(db)

	defer db.Close()
	return c.JSON(http.StatusOK, map[string]string{
		"picture": fileNameProfilePicture,
	})
}

func UpdateRKAKL(c echo.Context) (err error) {
	db := config.DBSimrs()
	// Get File
	trxDataUmumm := new(models.TrxDataUmums)
	if err = c.Bind(trxDataUmumm); err != nil {
		return
	}
	dataUpload, err := c.FormFile("dataUpload")

	if err != nil {
		return err
	}

	// Source File
	src, err := dataUpload.Open()
	if err != nil {
		return err
	}

	// Destination File
	idgenerate := sid.Id()
	fileNamedataUpload := "RKAKL-" + idgenerate + "_" + dataUpload.Filename
	fmt.Println(fileNamedataUpload)
	dst, err := os.Create("resources/assets/images/" + fileNamedataUpload)
	if err != nil {
		return err
	}

	// Copy File
	if _, err = io.Copy(dst, src); err != nil {
		return err
	}

	title := "RKAKL"
	deskripsi := "RKAKL"

	trxDataUmum := TrxDataUmum{
		Title:     title,
		Deskripsi: deskripsi,
		Url:       fileNamedataUpload}

	db.NewRecord(trxDataUmum)

	db.Create(&trxDataUmum)
	return c.JSON(http.StatusOK, map[string]string{
		"file": fileNamedataUpload,
	})
}

func UpdateRKO(c echo.Context) (err error) {
	db := config.DBSimrs()
	// Get File
	trxDataUmumm := new(models.TrxDataUmums)
	if err = c.Bind(trxDataUmumm); err != nil {
		return
	}
	dataUpload, err := c.FormFile("dataUpload")

	if err != nil {
		return err
	}

	// Source File
	src, err := dataUpload.Open()
	if err != nil {
		return err
	}

	// Destination File
	idgenerate := sid.Id()
	fileNamedataUpload := "RKO-" + idgenerate + "_" + dataUpload.Filename
	fmt.Println(fileNamedataUpload)
	dst, err := os.Create("resources/assets/images/" + fileNamedataUpload)
	if err != nil {
		return err
	}

	// Copy File
	if _, err = io.Copy(dst, src); err != nil {
		return err
	}

	title := "RKO"
	deskripsi := "RKO"

	trxDataUmum := TrxDataUmum{
		Title:     title,
		Deskripsi: deskripsi,
		Url:       fileNamedataUpload}

	db.NewRecord(trxDataUmum)

	db.Create(&trxDataUmum)
	return c.JSON(http.StatusOK, map[string]string{
		"file": fileNamedataUpload,
	})
}
