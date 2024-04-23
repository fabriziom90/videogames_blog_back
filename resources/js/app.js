import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import DataTable from 'datatables.net-dt';
import languageIT from 'datatables.net-plugins/i18n/it-IT.mjs';

import.meta.glob([
    '../img/**'
])

//RECPERO TUTTI I PULSANTI DELLA TABELLA
const deleteButtons = document.querySelectorAll('.btn-delete');

//CICLIAMO I PULSANTI
deleteButtons.forEach((button) => {
    //AD OGNI PULSANTE AGGIUNGIAMO L'EVENTO ON CLICK
    button.addEventListener('click', function () {
        //RECUPERIAMO IL VALORE DELL'ATTRIBUTO postid DEL PULSANTE CLICCATO
        let id = button.getAttribute('data-id');
        console.log(id);
        let type = button.getAttribute('data-type');
        //COSTRUIAMO LA URL CONCATENANDO LA URL BASE CON IL RESTO E L'ID DEL POST CHE VOGLIAMO CANCELLARE
        let url = `${window.location.origin}/admin/${type}/${id}`;
        //LA ASSEGNA ALLA FORM CON setAttribute
        let form_delete = document.getElementById('form_delete');
        form_delete.setAttribute('action', url);
    })
})

if (document.getElementById('cover_image') != null) {
    document.getElementById('cover_image').addEventListener('change', function () {
        let file = this.files[0];
        document.getElementById('preview-image').src = URL.createObjectURL(file);
    });
}

let table_post_admin = new DataTable('#table-posts-admin', {
    responsive: true,
    language: languageIT,
    "columns": [
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true,
            "width": '12%'
        },
        {
            "sortable": false
        }
    ]
});

let table_post_user = new DataTable('#table-posts-user', {
    responsive: true,
    language: languageIT,
    "columns": [
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": false
        }
    ]
});

let table_tag = new DataTable('#table-tags', {
    responsive: true,
    language: languageIT,
    "columns": [
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": false
        }
    ]
});

let table_category = new DataTable('#table-categories', {
    responsive: true,
    language: languageIT,
    "columns": [
        {
            "sortable": true
        },
        {
            "sortable": false
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": false
        }
    ]
});