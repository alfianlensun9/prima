package helpers

import (
	"fmt"
	"log"
	"sitou-plan/app/config"
	"sitou-plan/app/models"
	"strconv"

	tgbotapi "github.com/go-telegram-bot-api/telegram-bot-api"
)

// SitouPlanBotStart sitou
func SitouPlanBotStart() {
	bot, err := tgbotapi.NewBotAPI("947669538:AAEnTt7EizumrHxnP0JPE_RFZmeG2dLMiTE")
	if err != nil {
		// log.Panic(err)
		fmt.Println(err)
		return
	}

	bot.Debug = true

	log.Printf("Authorized on account %s", bot.Self.UserName)

	u := tgbotapi.NewUpdate(0)
	u.Timeout = 60

	updates, err := bot.GetUpdatesChan(u)

	for update := range updates {
		if update.Message == nil { // ignore any non-Message Updates
			continue
		}

		// log.Printf("[%s] %s", update.Message.From.UserName, update.Message.Text)

		if update.Message.Text == "/start" {

			newTelegramUser := models.TelegramUser{
				TelegramID: update.Message.Chat.ID,
				FirstName:  update.Message.Chat.FirstName,
				LastName:   update.Message.Chat.LastName,
				Username:   update.Message.Chat.UserName,
			}

			db := config.DBSimrs()
			db.NewRecord(newTelegramUser)
			db.Create(&newTelegramUser)

			pesan := fmt.Sprintf("Anda telah didaftarkan dengan ID Telegram: %s", strconv.Itoa(int(update.Message.Chat.ID)))
			msg := tgbotapi.NewMessage(update.Message.Chat.ID, pesan)
			msg.ReplyToMessageID = update.Message.MessageID
			bot.Send(msg)
		}

		if update.Message.ReplyToMessage != nil {

			newKomentar := models.TrxKomentar{
				Komentar:                    update.Message.Text,
				ToIDTelegram:                0,
				FromIDTelegram:              update.Message.Chat.ID,
				IDTrxPerencanaans:           0,
				IDMessageTelegramPertama:    update.Message.ReplyToMessage.MessageID,
				IDMessageTelegramPercakapan: update.Message.MessageID,
			}

			db := config.DBSimrs()
			db.NewRecord(newKomentar)
			db.Create(&newKomentar)
			// pesan := fmt.Sprintf("%s, ID Telegram: %s", update.Message.Text, strconv.Itoa(int(update.Message.Chat.ID)))
			// msg := tgbotapi.NewMessage(update.Message.Chat.ID, pesan)
			// msg.ReplyToMessageID = update.Message.MessageID
			// bot.Send(msg)
			continue

		}

	}

}

// SetKomentarPertama from telegram
func SetKomentarPertama(komentar string, idTujuanTelegram int64) int {
	botid := "947669538:AAEnTt7EizumrHxnP0JPE_RFZmeG2dLMiTE"
	fmt.Println(idTujuanTelegram)

	bot, err := tgbotapi.NewBotAPI(botid)

	if err != nil {
		// log.Panic(err)
		fmt.Println("koneksi telegram gagal")
		return 0
	}

	bot.Debug = true

	log.Printf("Authorized on account %s", bot.Self.UserName)

	msg := tgbotapi.NewMessage(idTujuanTelegram, komentar)

	sentChat, err := bot.Send(msg)

	if err != nil {
		fmt.Println(err)
		return 0
	}

	return sentChat.MessageID

}

// SetKomentarPercakapan set komentar percakapan
func SetKomentarPercakapan(komentar string, idTujuanTelegram int64, idMessagePertama int) int {

	botid := "947669538:AAEnTt7EizumrHxnP0JPE_RFZmeG2dLMiTE"
	fmt.Println(idTujuanTelegram)

	bot, err := tgbotapi.NewBotAPI(botid)

	if err != nil {
		// log.Panic(err)
		fmt.Println("koneksi telegram gagal")
		return 0
	}

	bot.Debug = true

	log.Printf("Authorized on account %s", bot.Self.UserName)

	msg := tgbotapi.NewMessage(idTujuanTelegram, komentar)
	// msg.ReplyToMessageID = idMessagePertama
	msg.ReplyToMessageID = idMessagePertama

	sentChat, err := bot.Send(msg)

	if err != nil {
		fmt.Println(err)
		return 0
	}

	return sentChat.MessageID

}
