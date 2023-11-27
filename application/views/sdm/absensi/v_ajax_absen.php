<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> By Date</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">By Photo</a>
    </li>

</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

        <div class="card">
            <div class="card-body">
                <div id='calendar' class="text-sm w-full">
                    <div class="w-full h-full flex flex-col justify-center items-center">
                        Memuat Halaman
                    </div>
                </div>

            </div>
        </div>



    </div>


    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Pulang</th>
                    </thead>
                    <tbody>
                        <?php

                        $absen = json_decode($list_absensi);
                        $allAbsen  = $absen->data->absen;

                        foreach ($allAbsen as $item) {
                        ?>
                            <tr>
                                <td><?= formatdmY($item->tanggal) ?></td>
                                <td>
                                    <?php if ($item->masuk) { ?>
                                        <img src="<?= URI_AEVY . "/static/attendance/image/$id_auth_users/" . $item->detail_absen_masuk->filename ?>" height="200"><br>
                                        <span class="badge badge-info text-center"><?= $item->masuk_formatted->time ?></span>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>

                                </td>
                                <td>
                                    <?php if ($item->pulang) { ?>
                                        <img src="<?= URI_AEVY . "/static/attendance/image/$id_auth_users/" . $item->detail_absen_pulang->filename ?>" height="200"><br>
                                        <span class="badge badge-danger text-center"><?= $item->pulang_formatted->time ?></span>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>


<textarea name="" cols="30" rows="10" id="list_absensi" hidden><?= $list_absensi ?></textarea>




<script>
    function loadCalendar() {
        const listabsensi = JSON.parse('<?= $list_absensi ?>')
        const listabsensiformatted = []

        for (const item of listabsensi.data.absen) {
            const lblabsen = item.absen_type == 1 ? 'Masuk' : 'Pulang'
            listabsensiformatted.push({
                title: `${item.masuk_formatted.time} - ${item.pulang_formatted.time}`, // a property!
                start: item.tanggal,
                textColor: '#ffffff',
                color: item.absen_type == 1 ? '#2196f3' : '#64b5f6',
                className: 'text-center',
                value: item,
                typeAbsen: item.absen_type
            })
        }
        console.log(listabsensi)
        console.log(listabsensiformatted)
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: listabsensiformatted
        });
        calendar.render();
    };

    if (document.readyState !== 'complete') {
        document.addEventListener('DOMContentLoaded', loadCalendar);
    } else {
        loadCalendar();
    }
</script>

<script>
    // $(function() {
    //     const listabsensi = JSON.parse($('#list_absensi').val())

    //     const listabsensiformatted = []


    // for (const item of listabsensi.data.absen) {
    //     const lblabsen = item.absen_type == 1 ? 'Masuk' : 'Pulang'
    //     listabsensiformatted.push({
    //         title: lblabsen + ' : ' + item.masuk_formatted.time, // a property!
    //         start: item.tanggal,
    //         textColor: '#ffffff',
    //         color: item.absen_type == 1 ? '#2196f3' : '#64b5f6',
    //         className: 'text-center',
    //         value: item,
    //         typeAbsen: item.absen_type
    //     })
    // }
    // console.log(listabsensiformatted)

    // $('#calendar').html('')
    // $('#calendar').fullCalendar({

    //     header: {
    //         left: 'today',
    //         center: 'title',
    //         right: 'month,basicWeek,basicDay'
    //     },
    //     defaultDate: '<?php //date('Y-m-d'); 
                            ?>',
    //     locale: 'id',
    //     navLinks: false, // can click day/week names to navigate views
    //     editable: true,
    //     eventLimit: true,
    //     today: false,
    //     prevYear: false,
    //     prevMonth: false,
    //     nextMonth: false,
    //     nextYear: false, // allow "more" link when too many events
    //     events: listabsensiformatted,
    // });

    // $('.fc-left').hide()
    // }())
</script>