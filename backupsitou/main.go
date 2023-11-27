package main

import (
	"sitou-plan/app/helpers"
	"sitou-plan/app/routes"
)

func main() {
	go routes.Route()
	helpers.SitouPlanBotStart()
}
