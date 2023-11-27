
Vue.component('v-select', VueSelect.VueSelect);
Vue.use(window["vue-js-modal"].default);
Vue.use(VueMask.VueMaskPlugin);

Vue.filter("rupiah", function (value) {
  return numeral(value).format("0,0"); // displaying other groupings/separators is possible, look at the docs
});

Vue.component('dashboard-component', {
  data: () => {
    return {
      filterBarangHabisPakai: false,
      filterAlatKesehatan: false,
      cariAlatKesehatanAllPerencanaan: 'Cari Alat Kesehatan',
      dataAllPerencanaan: [],
      dataAllPerencanaanSearched: [],
    }
  },

  computed: {


    totalPengajuan () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }
      return this.dataAllPerencanaan.length
    },

    totalValid () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }
      return this.dataAllPerencanaan.filter( (d) => {
        return d.valid_status == "1"
      }).length
    },

    totalPending () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }
      return this.dataAllPerencanaan.filter( (d) => {
        return d.valid_status == ""
      }).length
    },

    totalDitolak () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }
      return this.dataAllPerencanaan.filter( (d) => {
        return d.valid_status == "0"
      }).length
    },

    totalDitolakRupiah () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }

      let a =  this.dataAllPerencanaan.filter( (d) => {
        return d.valid_status == "0"
      })
      return _.sumBy(a, (n) => parseFloat(n.harga))
    },

    totalPengajuanRupiah () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }
      return _.sumBy(this.dataAllPerencanaan, (n) => parseFloat(n.harga))
    },

    totalValidasiRupiah () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }
      let a =  this.dataAllPerencanaan.filter( (d) => {
        return d.valid_status == "1"
      })
      return _.sumBy(a, (n) => parseFloat(n.harga))
    },

    totalPendingRupiah () {
      if (this.dataAllPerencanaan.length == 0) {
        return 0
      }

      let a = this.dataAllPerencanaan.filter( (d) => {
        return d.valid_status == ""
      })
      return _.sumBy(a, (n) => parseFloat(n.harga))
    },


  },

  watch: {
    cariAlatKesehatanAllPerencanaan (q) {
      if(q == "") {
        this.dataAllPerencanaanSearched = this.dataAllPerencanaan
      }
      this.cariAlatKesehatan(q)
    }
  },

  mounted() {
    this.loadChart()
    this.loadVerifikasiChart()
    this.loadAlatKesehatan()
    this.loadAlatKesehatanChart()
    this.loadPerencanaan()

  },

  methods: {



    cariAlatKesehatan (q) {
      let options = {
        shouldSort: true,
        threshold: 0.6,
        location: 0,
        distance: 100,
        maxPatternLength: 200,
        minMatchCharLength: 1,
        keys: [
          "nama_alkes",
          "nama_alkes_mst_alkes",
        ]
      };
      let fuse = new Fuse(this.dataAllPerencanaan, options); // "list" is the item array
       result = fuse.search(q);
       console.log(result)
       this.dataAllPerencanaanSearched = result
    },

    loadPerencanaan(){
        axios.get('/api/perencanaan',
        {
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
            },
        }
        ).then((response) => {
            if (response.status == 200){
                this.dataAllPerencanaan = response.data
                this.dataAllPerencanaanSearched = response.data
                console.log(this.dataAllPerencanaan)
            } else {
                
            }
        })
        .catch(function(error){
            console.log(error);
        });
    },

    loadVerifikasiChart () {
      am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_dark);
        am4core.useTheme(am4themes_animated);
        // Themes end
        
        var container = am4core.create("verifikasi-chart", am4core.Container);
        container.width = am4core.percent(100);
        container.height = am4core.percent(100);
        container.layout = "horizontal";
        
        
        var chart = container.createChild(am4charts.PieChart);
        
        // Add data
        chart.data = [{
          "country": "Valid",
          "litres": 2,
          "subData": [{ name: "Umur > 1 Tahun", value: 200 }, { name: "Umur Dibawah < 1 Tahun", value: 150 }, { name: "Mudah Hilang", value: 100 }, { name: "E-Planning", value: 50 }]
        },
        {
          "country": "Belum Valid",
          "litres": 13,
          "subData": [{ name: "Belum Sesuai Indikator RS", value: 200 }, { name: "Belum Perlu", value: 150 }, { name: "C", value: 100 }, { name: "D", value: 50 }]
        }
      ];
        
        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "country";
        pieSeries.slices.template.states.getKey("active").properties.shiftRadius = 0;
        //pieSeries.labels.template.text = "{category}\n{value.percent.formatNumber('#.#')}%";
        
        pieSeries.slices.template.events.on("hit", function(event) {
          selectSlice(event.target.dataItem);
        })
        
        var chart2 = container.createChild(am4charts.PieChart);
        chart2.width = am4core.percent(30);
        chart2.radius = am4core.percent(80);
        
        // Add and configure Series
        var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
        pieSeries2.dataFields.value = "value";
        pieSeries2.dataFields.category = "name";
        pieSeries2.slices.template.states.getKey("active").properties.shiftRadius = 0;
        pieSeries2.labels.template.disabled = true;
        pieSeries2.ticks.template.disabled = true;
        pieSeries2.alignLabels = false;
        pieSeries2.events.on("positionchanged", updateLines);
        
        var interfaceColors = new am4core.InterfaceColorSet();
        
        var line1 = container.createChild(am4core.Line);
        line1.strokeDasharray = "2,2";
        line1.strokeOpacity = 0.5;
        line1.stroke = interfaceColors.getFor("alternativeBackground");
        line1.isMeasured = false;
        
        var line2 = container.createChild(am4core.Line);
        line2.strokeDasharray = "2,2";
        line2.strokeOpacity = 0.5;
        line2.stroke = interfaceColors.getFor("alternativeBackground");
        line2.isMeasured = false;
        
        var selectedSlice;
        
        function selectSlice(dataItem) {
        
          selectedSlice = dataItem.slice;
        
          var fill = selectedSlice.fill;
        
          var count = dataItem.dataContext.subData.length;
          pieSeries2.colors.list = [];
          for (var i = 0; i < count; i++) {
            pieSeries2.colors.list.push(fill.brighten(i * 2 / count));
          }
        
          chart2.data = dataItem.dataContext.subData;
          pieSeries2.appear();
        
          var middleAngle = selectedSlice.middleAngle;
          var firstAngle = pieSeries.slices.getIndex(0).startAngle;
          var animation = pieSeries.animate([{ property: "startAngle", to: firstAngle - middleAngle }, { property: "endAngle", to: firstAngle - middleAngle + 360 }], 600, am4core.ease.sinOut);
          animation.events.on("animationprogress", updateLines);
        
          selectedSlice.events.on("transformed", updateLines);
        
        //  var animation = chart2.animate({property:"dx", from:-container.pixelWidth / 2, to:0}, 2000, am4core.ease.elasticOut)
        //  animation.events.on("animationprogress", updateLines)
        }
        
        
        function updateLines() {
          if (selectedSlice) {
            var p11 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle) };
            var p12 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle + selectedSlice.arc), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle + selectedSlice.arc) };
        
            p11 = am4core.utils.spritePointToSvg(p11, selectedSlice);
            p12 = am4core.utils.spritePointToSvg(p12, selectedSlice);
        
            var p21 = { x: 0, y: -pieSeries2.pixelRadius };
            var p22 = { x: 0, y: pieSeries2.pixelRadius };
        
            p21 = am4core.utils.spritePointToSvg(p21, pieSeries2);
            p22 = am4core.utils.spritePointToSvg(p22, pieSeries2);
        
            line1.x1 = p11.x;
            line1.x2 = p21.x;
            line1.y1 = p11.y;
            line1.y2 = p21.y;
        
            line2.x1 = p12.x;
            line2.x2 = p22.x;
            line2.y1 = p12.y;
            line2.y2 = p22.y;
          }
        }
        
        chart.events.on("datavalidated", function() {
          setTimeout(function() {
            selectSlice(pieSeries.dataItems.getIndex(0));
          }, 1000);
        });
        
        
        }); // end am4core.ready()

    },

    loadChart() {
      am4core.useTheme(am4themes_dark);
      am4core.useTheme(am4themes_animated);

      var chart = am4core.createFromConfig({

        "data": [{
          "country": "Lithuania",
          "units": 500,
          "pie": [{
            "value": 250,
            "title": "Cat #1"
          }, {
            "value": 150,
            "title": "Cat #2"
          }, {
            "value": 100,
            "title": "Cat #3"
          }]
        }, {
          "country": "Czech Republic",
          "units": 300,
          "pie": [{
            "value": 80,
            "title": "Cat #1"
          }, {
            "value": 130,
            "title": "Cat #2"
          }, {
            "value": 90,
            "title": "Cat #3"
          }]
        }, {
          "country": "Ireland",
          "units": 200,
          "pie": [{
            "value": 75,
            "title": "Cat #1"
          }, {
            "value": 55,
            "title": "Cat #2"
          }, {
            "value": 70,
            "title": "Cat #3"
          }]
        }],

        "hiddenState": {
          "properties": {
            "opacity": 0
          }
        },

        "xAxes": [{
          "type": "CategoryAxis",
          "dataFields": {
            "category": "country"
          },
          "renderer": {
            "grid": {
              "disabled": true
            }
          }
        }],

        "yAxes": [{
          "type": "ValueAxis",
          "title": {
            "text": "Units sold (M)",
          },
          "min": 0,
          "renderer": {
            "baseGrid": {
              "disabled": true
            },
            "grid": {
              "strokeOpacity": 0.07
            }
          }
        }],

        "series": [{
          "type": "ColumnSeries",
          "dataFields": {
            "valueY": "units",
            "categoryX": "country"
          },
          "tooltip": {
            "pointerOrientation": "vertical"
          },
          "columns": {
            "column": {
              "tooltipText": "Series: {name}\nCategory: {categoryX}\nValue: {valueY}",
              "tooltipY": 0,
              "cornerRadiusTopLeft": 20,
              "cornerRadiusTopRight": 20
            },
            "strokeOpacity": 0,
            "adapter": {
              "fill": function (fill, target) {
                var chart = target.dataItem.component.chart;
                var color = chart.colors.getIndex(target.dataItem.index * 3);
                return color;
              }
            },

            // pie
            "children": [{
              "type": "PieChart",
              "forceCreate": true,
              "width": "80%",
              "height": "80%",
              "align": "center",
              "valign": "middle",
              "dataFields": {
                "data": "pie"
              },
              "series": [{
                "type": "PieSeries",
                "dataFields": {
                  "value": "value",
                  "category": "title"
                },
                "labels": {
                  "disabled": true
                },
                "ticks": {
                  "disabled": true
                },
                "slices": {
                  "stroke": "#ffffff",
                  "strokeWidth": 1,
                  "strokeOpacity": 0,
                  "adapter": {
                    "fill": function (fill, target) {
                      return am4core.color("#ffffff");
                    },
                    "fillOpacity": function (fillOpacity, target) {
                      return (target.dataItem.index + 1) * 0.2;
                    }
                  }
                },
                "hiddenState": {
                  "properties": {
                    "startAngle": -90,
                    "endAngle": 270
                  }
                }
              }]
            }]
          }
        }],

      }, "chart-id", "XYChart");
    },

    loadAlatKesehatan () {
      am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_dark);
        am4core.useTheme(am4themes_animated);
        // Themes end
        
        var chart = am4core.create("alat-kesehatan", am4plugins_forceDirected.ForceDirectedTree);
        var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())
        
        chart.data = [
          {
            name: "Core",
            children: [
              {
                name: "First",
                children: [
                  { name: "A1", value: 100 },
                  { name: "A2", value: 60 }
                ]
              },
              {
                name: "Second",
                children: [
                  { name: "B1", value: 135 },
                  { name: "B2", value: 98 }
                ]
              },
              {
                name: "Third",
                children: [
                  {
                    name: "C1",
                    children: [
                      { name: "EE1", value: 130 },
                      { name: "EE2", value: 87 },
                      { name: "EE3", value: 55 }
                    ]
                  },
                  { name: "C2", value: 148 },
                  {
                    name: "C3", children: [
                      { name: "CC1", value: 53 },
                      { name: "CC2", value: 30 }
                    ]
                  },
                  { name: "C4", value: 26 }
                ]
              },
              {
                name: "Fourth",
                children: [
                  { name: "D1", value: 415 },
                  { name: "D2", value: 148 },
                  { name: "D3", value: 89 }
                ]
              },
              {
                name: "Fifth",
                children: [
                  {
                    name: "E1",
                    children: [
                      { name: "EE1", value: 33 },
                      { name: "EE2", value: 40 },
                      { name: "EE3", value: 89 }
                    ]
                  },
                  {
                    name: "E2",
                    value: 148
                  }
                ]
              }
        
            ]
          }
        ];
        
        networkSeries.dataFields.value = "value";
        networkSeries.dataFields.name = "name";
        networkSeries.dataFields.children = "children";
        networkSeries.nodes.template.tooltipText = "{name}:{value}";
        networkSeries.nodes.template.fillOpacity = 1;
        networkSeries.manyBodyStrength = -20;
        networkSeries.links.template.strength = 0.8;
        networkSeries.minRadius = am4core.percent(2);
        
        networkSeries.nodes.template.label.text = "{name}"
        networkSeries.fontSize = 10;
        
        }); // end am4core.ready()

    },

    loadAlatKesehatanChart () {

      am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        
        /**
         * Chart design taken from Samsung health app
         */
        
        var chart = am4core.create("alat-kesehatan-chart", am4charts.XYChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
        
        chart.paddingBottom = 30;
        
        chart.data = [{
            "name": "Monica",
            "steps": 45688,
            "href": "https://www.amcharts.com/wp-content/uploads/2019/04/monica.jpg"
        }, {
            "name": "Joey",
            "steps": 35781,
            "href": "https://www.amcharts.com/wp-content/uploads/2019/04/joey.jpg"
        }, {
            "name": "Ross",
            "steps": 25464,
            "href": "https://www.amcharts.com/wp-content/uploads/2019/04/ross.jpg"
        }, {
            "name": "Phoebe",
            "steps": 18788,
            "href": "https://www.amcharts.com/wp-content/uploads/2019/04/phoebe.jpg"
        }, {
            "name": "Rachel",
            "steps": 15465,
            "href": "https://www.amcharts.com/wp-content/uploads/2019/04/rachel.jpg"
        }, {
            "name": "Chandler",
            "steps": 11561,
            "href": "https://www.amcharts.com/wp-content/uploads/2019/04/chandler.jpg"
        }];
        
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "name";
        categoryAxis.renderer.grid.template.strokeOpacity = 0;
        categoryAxis.renderer.minGridDistance = 10;
        categoryAxis.renderer.labels.template.dy = 35;
        categoryAxis.renderer.tooltip.dy = 35;
        
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inside = true;
        valueAxis.renderer.labels.template.fillOpacity = 0.3;
        valueAxis.renderer.grid.template.strokeOpacity = 0;
        valueAxis.min = 0;
        valueAxis.cursorTooltipEnabled = false;
        valueAxis.renderer.baseGrid.strokeOpacity = 0;
        
        var series = chart.series.push(new am4charts.ColumnSeries);
        series.dataFields.valueY = "steps";
        series.dataFields.categoryX = "name";
        series.tooltipText = "{valueY.value}";
        series.tooltip.pointerOrientation = "vertical";
        series.tooltip.dy = - 6;
        series.columnsContainer.zIndex = 100;
        
        var columnTemplate = series.columns.template;
        columnTemplate.width = am4core.percent(50);
        columnTemplate.maxWidth = 66;
        columnTemplate.column.cornerRadius(60, 60, 10, 10);
        columnTemplate.strokeOpacity = 0;
        
        series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueY", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
        series.mainContainer.mask = undefined;
        
        var cursor = new am4charts.XYCursor();
        chart.cursor = cursor;
        cursor.lineX.disabled = true;
        cursor.lineY.disabled = true;
        cursor.behavior = "none";
        
        var bullet = columnTemplate.createChild(am4charts.CircleBullet);
        bullet.circle.radius = 30;
        bullet.valign = "bottom";
        bullet.align = "center";
        bullet.isMeasured = true;
        bullet.mouseEnabled = false;
        bullet.verticalCenter = "bottom";
        bullet.interactionsEnabled = false;
        
        var hoverState = bullet.states.create("hover");
        var outlineCircle = bullet.createChild(am4core.Circle);
        outlineCircle.adapter.add("radius", function (radius, target) {
            var circleBullet = target.parent;
            return circleBullet.circle.pixelRadius + 10;
        })
        
        var image = bullet.createChild(am4core.Image);
        image.width = 60;
        image.height = 60;
        image.horizontalCenter = "middle";
        image.verticalCenter = "middle";
        image.propertyFields.href = "href";
        
        image.adapter.add("mask", function (mask, target) {
            var circleBullet = target.parent;
            return circleBullet.circle;
        })
        
        var previousBullet;
        chart.cursor.events.on("cursorpositionchanged", function (event) {
            var dataItem = series.tooltipDataItem;
        
            if (dataItem.column) {
                var bullet = dataItem.column.children.getIndex(1);
        
                if (previousBullet && previousBullet != bullet) {
                    previousBullet.isHover = false;
                }
        
                if (previousBullet != bullet) {
        
                    var hs = bullet.states.getKey("hover");
                    hs.properties.dy = -bullet.parent.pixelHeight + 30;
                    bullet.isHover = true;
        
                    previousBullet = bullet;
                }
            }
        })
        
        }); // end am4core.ready()

    },

    onClickShowPengajuan () {
      this.$modal.show("modalDashboardPengajuan")
    }

  },


  template: `
        <div>

<modal
    :width="'80%'" 
    :height="'80%'"
    name="modalDashboardPengajuan">
  <div class="w-full bg-gray-900 shadow-2xl text-white">

    <div class="w-full mx-auto shadow-2xl">
      
      <div class="container shadow-3xl">

          <div class="bg-indigo-900 flex justify-between py-4 lg:px-4">



            <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
              <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">Cari :</span>
              <span class="font-semibold mr-2 text-left flex-auto">
                <input 
                v-model="cariAlatKesehatanAllPerencanaan"
                class=" bg-transparent " type="text"
                />
            </span>
              <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>

            <div>
              <h1 class="text-2xl text-white">Total Perencanaan</h1>
            </div>
      </div>

	    <table class="text-left w-full">
        <thead class="bg-gray-800 flex text-white w-full">
          <tr class="flex w-full">
            <th class="p-4 w-1/4">Nama Pengajuan</th>
            <th class="p-4 w-1/4 text-right">Harga</th>
            <th class="p-4 w-1/4">Justifikasi</th>
            <th class="p-4 w-1/4">Umur Aset</th>
            <th class="p-4 w-1/4">Mudah Hilang</th>
            <th class="p-4 w-1/4">E-Planning</th>
          </tr>
        </thead>
        <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
        <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full" style="height: 100vh;">
          <tr 
          class="flex w-full mb-4 hover:bg-gray-800"
          v-for="p in dataAllPerencanaanSearched" 
          v-bind:key="p.id_trx_perencanaan"

          >
            <td class="p-4 w-1/4" v-if="p.eplanning == '0'">{{p.nama_alkes}}</td>
            <td class="p-4 w-1/4" v-if="p.eplanning == '1'">{{p.nama_alkes_mst_alkes}}</td>
            <td class="p-4 w-1/4 flex justify-between"><span>Rp.</span><span>{{p.harga | rupiah}}</span></td>
            <td class="p-4 w-1/4">{{p.justifikasi}}</td>

            <td class="p-4 w-1/4" v-if="p.umur_aset == '> 1 Tahun'">
              <div class="bg-green-600 text-center py-0 px-0 rounded-full">
                Diatas 1 Tahun
              </div>
            </td>

            <td class="p-4 w-1/4" v-if="p.umur_aset == '< 1 Tahun'">
              <div class="bg-yellow-600 text-center py-0 px-0 rounded-full">
                Dibawah 1 Tahun
              </div>
            </td>

            <td class="p-4 w-1/4" v-if="p.mudah_hilang == '1'">
              <div class="bg-red-600 text-center py-0 px-0 rounded-full">
                Ya
              </div>
            </td>

            <td class="p-4 w-1/4" v-if="p.mudah_hilang == '0'">
              <div class="bg-green-600 text-center py-0 px-0 rounded-full">
                Tidak
              </div>
            </td>


            <td class="p-4 w-1/4" v-if="p.eplanning == '1'">
              <div class="bg-yellow-800 text-center py-0 px-0 rounded-full">
                Tidak
              </div>
            </td>

            <td class="p-4 w-1/4" v-if="p.eplanning == '0'">
              <div class="bg-yellow-600 text-center py-0 px-0 rounded-full">
                Ya
              </div>
            </td>

          </tr>
        </tbody>
      </table>
</div>
    </div>
  </div>

</modal>

        <div class="elative">

        <div class="flex items-center justify-center">
    
    <div class="flex-shrink-0 m-6 relative overflow-hidden bg-purple-500 hover:bg-purple-600 cursor-pointer    rounded-lg max-w-xs shadow-lg"
    @click="onClickShowPengajuan()"
    >
      <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
      </svg>
      <div class="relative pt-10 px-10 flex items-center justify-center">
        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
        <span class="p-3 text-white text-6xl p-16" sytle="font-size: 9em;">
          {{totalPengajuan}}
        </span>

      </div>
      <div class="relative text-white px-6 pb-6 mt-6">
        <span class="block opacity-75 -mb-1">Jumlah</span>
        <div class="flex justify-between">
          <span class="block font-semibold text-xl">Pengajuan</span>
          <span class="block bg-white rounded-full text-purple-500 text-xs font-bold px-3 py-2 leading-none flex items-center">Rp.{{totalPengajuanRupiah | rupiah}}</span>
        </div>
      </div>
    </div>


    <div class="flex-shrink-0 m-6 relative overflow-hidden bg-teal-500 rounded-lg max-w-xs shadow-lg">

      <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
      </svg>

      <div class="relative pt-10 px-10 flex items-center justify-center">
        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
        <span class="p-3 text-white text-6xl p-16 " sytle="font-size: 9em;">
          {{totalValid}}
        </span>
      </div>

      <div class="relative text-white px-6 pb-6 mt-6">
        <span class="block opacity-75 -mb-1">Jumlah</span>
        <div class="flex justify-between">
          <span class="block font-semibold text-xl">Valid</span>
          <span class="block bg-white rounded-full text-teal-500 text-xs font-bold px-3 py-2 leading-none flex items-center">Rp.{{totalValidasiRupiah | rupiah}}</span>
        </div>
      </div>

    </div>

    <div class="flex-shrink-0 m-6 relative overflow-hidden bg-orange-500 rounded-lg max-w-xs shadow-lg">
      <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
      </svg>
      <div class="relative pt-10 px-10 flex items-center justify-center">
        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
        <span class="p-3 text-white text-6xl p-16" sytle="font-size: 9em;">
          {{totalPending}}
        </span>
        
      </div>
      <div class="relative text-white px-6 pb-6 mt-6">
        <span class="block opacity-75 -mb-1">Jumlah</span>
        <div class="flex justify-between">
          <span class="block font-semibold text-xl">Pending</span>
          <span class="block bg-white rounded-full text-orange-500 text-xs font-bold px-3 py-2 leading-none flex items-center">Rp.{{totalPendingRupiah | rupiah}}</span>
        </div>
      </div>
    </div>

    
    <div class="flex-shrink-0 m-6 relative overflow-hidden bg-red-500 rounded-lg max-w-xs shadow-lg">
      <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
      </svg>
      <div class="relative pt-10 px-10 flex items-center justify-center">
        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
        <span class="p-3 text-white text-6xl p-16" sytle="font-size: 9em;">
          {{totalDitolak}}
        </span>
        
      </div>
      <div class="relative text-white px-6 pb-6 mt-6">
        <span class="block opacity-75 -mb-1">Jumlah</span>
        <div class="flex justify-between">
          <span class="block font-semibold text-xl">Ditolak</span>
          <span class="block bg-white rounded-full text-orange-500 text-xs font-bold px-3 py-2 leading-none flex items-center">Rp.{{totalDitolakRupiah | rupiah}}</span>
        </div>
      </div>
    </div>

    
    
  </div>


              <div>
                <h1 class="text-2xl text-white mb-4 mt-10 sticky top-100">Validasi</h1>
                <div id="verifikasi-chart" class="chart-row"></div>
              </div>


              <div> 
                <h1 class="text-2xl text-white mb-4 mt-10 sticky top-100">Umur Aset</h1>
                <div id="chart-id" class="chart-row"></div>
              </div>

        </div>

</div>
    `
})
