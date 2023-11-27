package routes

import (
	"sitou-plan/app/config"
	"sitou-plan/app/controllers"
	"sitou-plan/app/middlewares"
)

// Route mengaktifkan routes
func Route() {

	// booting up situo app
	app := config.LoadStaticFiles()
	route := middlewares.GlobalMiddleware(app)
	authController := &controllers.AuthHandler{}

	authVerlosKamerAPI := route.Group("/api/verlos-kamer", middlewares.MustAuth)
	frontRoute := route.Group("/front")
	apiRoute := route.Group("/api")

	// API

	apiRoute.POST("/perencanaan", controllers.CreatePerencanaan)
	apiRoute.POST("/perencanaan-non-eplanning", controllers.CreatePerencanaanNotEplanning)
	apiRoute.GET("/perencanaan", controllers.GetPerencanaan)
	apiRoute.DELETE("/perencanaan", controllers.DeletePerencanaan)
	apiRoute.POST("/user", controllers.CreateUser)
	apiRoute.POST("/auth/cek-password", controllers.CekPassword)
	apiRoute.POST("/auth/update-password", controllers.UpdatePassword)
	apiRoute.POST("/auth/update-profile-picture", controllers.UpdateProfilePicture)
	apiRoute.POST("/auth/update-id-telegram", controllers.UpdateIDTelegram)
	apiRoute.POST("/data-umum/update-rkakl", controllers.UpdateRKAKL)
	apiRoute.POST("/data-umum/update-rko", controllers.UpdateRKO)
	apiRoute.POST("/master-alkes", controllers.CreateMasterAlkes)
	apiRoute.POST("/master-alkes/alkes", controllers.GetAlkesByName)
	apiRoute.POST("/perencanaan/validasi", controllers.CreateValidasi)
	apiRoute.POST("/perencanaan/validasi", controllers.CreateValidasi)
	apiRoute.GET("/persetujuan/alasan-pending/:id", controllers.GetAlasanPendingById)
	apiRoute.GET("/master-alkes", controllers.GetAlkes)
	apiRoute.GET("/master-indikator", controllers.GetIndikator)
	apiRoute.GET("/master-alkes-mst-alkes", controllers.GetAlkesMstAlkes)
	apiRoute.GET("/master-alasan-pending", controllers.GetAlasanPending)
	apiRoute.GET("/auth-users", controllers.GetAuthUsers)
	apiRoute.GET("/get-user/:id", controllers.GetUserById)
	apiRoute.GET("/telegram-user", controllers.GetRegisteredTelegramUsers)
	apiRoute.GET("/panduan", controllers.GetPanduan)

	// redis
	apiRoute.GET("/alkes/redis/:nama", controllers.GetAlkesFromRedis)
	apiRoute.GET("/alkes/to-redis", controllers.CreateJSONToRedisAlkes)

	// dashboard api
	apiRoute.GET("/dashboard", controllers.CreateJSONToRedisAlkes)

	// apiRoute.GET("/bot", func(c echo.Context) (err error) {
	// 	helpers.SitouPlanBotStart()
	// 	return c.JSON(http.StatusOK, "Bot SITOU Strat")
	// })

	// komentar percakapan
	apiRoute.POST("/komentar-percakapan", controllers.CreateKomentarOnPerencanaanPercakapan)

	apiRoute.POST("/komentar", controllers.CreateKomentarOnPerencanaanPertama)
	apiRoute.GET("/komentar", controllers.GetKomentarOnPerencanaan)
	apiRoute.POST("/komentar-perencanaan", controllers.GetKomentarOnPerencanaanWithID)
	apiRoute.GET("/test", controllers.TestingMe)

	authVerlosKamerAPI.GET("/index", authController.IndexPage, middlewares.IsVerlosKamerAPI)
	// apiRoute.POST("/user", controllers.CreateUser)

	// FrontEnd
	frontRoute.GET("/login", controllers.LoginPage)
	frontRoute.POST("/login", authController.LoginProcess)
	frontRoute.GET("/logout", authController.Logout)
	frontRoute.GET("/sitou-app", controllers.SitouApp)
	frontRoute.GET("/sitou-app/dashboard", controllers.Dashboard)

	// route.Logger.Fatal(route.StartTLS(":9991", "rsupkandou.crt", "rsupkandou.key"))
	route.Logger.Fatal(route.Start(":9991"))
}
