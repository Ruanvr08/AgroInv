
    (function (win, doc) {
        'use strict';
        function getCalendar(perfil, div) {
            let calendarEl = doc.querySelector(div);
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'prev,next,today',
                    center: 'title',
                    end: 'dayGridMonth, timeGridWeek, timeGridDay'
                },
                locale: "pt-br",
                buttonText: {
                    today: "hoje",
                    month: "mes",
                    week: "semana",
                    day: "dia",
                },
                dateClick: function (info) {
                    if (perfil == 'manager') {
                        if (info.view.type == 'dayGridMonth') {
                            calendar.changeView('timeGrid', info.dateStr)
                        } else {
                            win.location.href = 'http://localhost/AgroInv/calendarios/cadastrar/' + info.dateStr

                        }
                    } else {
                        if (info.view.type == 'dayGridMonth') {
                            calendar.changeView('timeGrid', info.dateStr)
                        } else {
                            win.location.href = 'http://localhost/AgroInv/calendarios/cadastrar/' + info.dateStr
                        }
                    }

                },

                eventColor: 'green',
                eventClick: function (info) {
                    if (perfil == 'manager') {                        win.location.href = `http://localhost/AgroInv/calendarios/editar/${info.event.id}`
                    } 

                },
                themeSystem: 'bootstrap',
                events:JSON.parse('<?= $this->calendarioModel->trazerEventos()?>')

                ,
            });
            calendar.render();

        }
        if (doc.querySelector('.calendarUser')) {
            getCalendar('user', '.calendarUser');
        } else if (doc.querySelector('.calendarManager')) {
            getCalendar('manager', '.calendarManager');
        }



    })(window, document);
