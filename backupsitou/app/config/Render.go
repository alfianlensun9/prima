package config

import (
	"html/template"
	"io"

	"github.com/labstack/echo"
)

// M data render
type M map[string]interface{}

// Renderer struct untuk render html
type Renderer struct {
	template *template.Template
	debug    bool
	location string
}


// NewRenderer new renderer
func NewRenderer(location string, debug bool) *Renderer {
	tpl := new(Renderer)
	tpl.location = location
	tpl.debug = debug

	tpl.ReloadTemplates()

	return tpl
}

// ReloadTemplates reload templates
func (t *Renderer) ReloadTemplates() {
	t.template = template.Must(template.ParseGlob(t.location))
}

// Render render
func (t *Renderer) Render(
	w io.Writer,
	name string,
	data interface{},
	c echo.Context,
) error {
	if t.debug {
		t.ReloadTemplates()
	}

	return t.template.ExecuteTemplate(w, name, data)
}
