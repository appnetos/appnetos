<?php
/**
 * START LICENSE HEADER
 *
 * The license header may not be removed.
 *
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * @copyright       (C) xtrose Media Studio 2019
 * @author          Moses Rivera
 *                  Im Wiesengrund 24
 *                  73540 Heubach
 * @mail            media.studio@xtrose.de
 *
 * END LICENSE HEADER
 *
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Language strings.
$strings = [
    "admin__apps__settings__css_conf" => "CSS è stato salvato",
    "admin__apps__settings__js_conf" => "JavaScript è stato salvato",
    "admin__apps__settings__css_err" => "Impossibile salvare IL CSS",
    "admin__apps__settings__js_err" => "Impossibile salvare JavaScript",
    "admin__apps__settings__warning" => "Prestare attenzione durante la modifica. Le modifiche possono modificare il comportamento dell'app in modo sostenibile. Modifiche errate possono distruggere l'app, l'output e le funzionalità.",
    "admin__apps__settings__css_info" => "Nell'Editor CSS, il file CSS dell'app può essere modificato. Il file CSS dell'app viene archiviato nella directory dell'app. Questo file CSS viene caricato automaticamente con l'applicazione. Se un'app non dispone di un file CSS, ne viene creata una nuova. Se la cache è attiva, deve essere svuotata per applicare le modifiche.",
    "admin__apps__settings__js_info" => "Nell'Editor JavaScript, il file JavaScript dell'app può essere modificato. Il file JavaScript dell'app viene archiviato nella directory dell'app. Questo file JavaScript viene caricato automaticamente con l'applicazione. Se un'app non dispone di un file JavaScript, ne viene creata una nuova. Se la cache è attiva, deve essere svuotata per applicare le modifiche.",
    "admin__apps__settings__data_err" => "Impossibile salvare i dati",
    "admin__apps__settings__data_conf" => "I dati sono stati salvati",
    "admin__apps__settings__size_err" => "Le dimensioni e l'orientamento non potevano essere salvati",
    "admin__apps__settings__size_conf" => "Le dimensioni e l'orientamento sono stati salvati",
    "admin__apps__settings__header_col_xl" => "Layout dell'app per la larghezza dello schermo >1200px",
    "admin__apps__settings__header_col_lg" => "Layout dell'app per la larghezza dello schermo 992-1200px",
    "admin__apps__settings__header_col_md" => "Layout dell'app per la larghezza dello schermo 720-992px",
    "admin__apps__settings__header_col_sm" => "Layout dell'app per la larghezza dello schermo 576-720px",
    "admin__apps__settings__header_col" => "Layout dell'app per la larghezza dello schermo <576px",
    "admin__apps__settings__grid_css" => "Bootstrap Grid CSS",
    "admin__apps__settings__size_info" => "Per le app contenitore, è possibile modificare le dimensioni e l'orientamento. Se un'app contenitore non regola le dimensioni e l'orientamento, verrà restituita a larghezza intera. APPNET OS utilizza Bootstrap e il Bootstrap Grid System per i suoi contenitori. Il sistema di griglia utilizza 5 dimensioni del dispositivo. Ogni dimensione è divisa in 12 parti. Le dimensioni e l'orientamento delle app contenitore possono essere definiti da queste parti. Se si posizionano due app contenitore tra loro e si definiscono le dimensioni con 6 parti ciascuna, le app vengono emesse affiancate in due parti uguali. Se definisci la prima app in un contenitore con 4 parti e la seconda con 8 parti, l'app a destra viene restituita due volte più grande dell'app sinistra. Se tre app sono definite in un contenitore di 4 parti ciascuna, le tre app vengono emesse affiancate, con le stesse dimensioni. Se definisci 12 parti per la prima app e 6 parti per le due seguenti, la prima app verrà emessa a larghezza intera e le due successive, anche con metà della larghezza. Se le app sono definite correttamente per ogni dimensione del dispositivo, ottieni un design reattivo perfetto.",
    "admin__apps__settings__data_info" => "Se un'app ha un'area di amministrazione, è possibile accedervi tramite le impostazioni. Le app possono anche essere caricate in contenitori insieme ad altre app. Questa applicazione si chiama applicazioni contenitore. Le app contenitore possono regolare le dimensioni e l'orientamento. Ad esempio, se due app vengono caricate in un contenitore e la dimensione è impostata su 50% per ogni app, vengono emesse affiancate. I tag CSS possono anche essere aggiunti al contenitore. In questo modo è possibile influenzare l'aspetto di un contenitore con più app. Attenzione, se più app vengono caricate in un unico contenitore e più app personalizzano il contenitore CSS, tutti i tag CSS vengono aggiunti al contenitore. I CSS dell'app consentono di aggiungere tag CSS a ogni app in un contenitore. In modalità esperto, puoi anche modificare CSS e JavaScript di un'app. Questa modalità deve essere sbloccata nel file config.inc.php. Ma attenzione. Se il CSS o JavaScript viene modificato in modalità esperto, applicazioni o anche l'intera pagina può essere mutilato o permanentemente distrutto.",
    "admin__apps__settings__menu_header" => "Impostazioni dell'app",
    "admin__apps__settings__admin_area" => "Area di amministrazione",
    "admin__apps__settings__description" => "Descrizione",
    "admin__apps__settings__size_and_align" => "Dimensioni e orientamento",
    "admin__apps__settings__css_container_fluid" => "CSS container-fluid",
    "admin__apps__settings__css_container" => "CSS container",
    "admin__apps__settings__css_app" => "CSS app",
    "admin__apps__settings__edit_css" => "Modifica CSS",
    "admin__apps__settings__edit_js" => "Modifica JavaScript",
    "admin__apps__settings__management" => "Gestione delle app",
    "admin__apps__settings__app_data" => "Dati dell'app",
    "admin__apps__settings__activate" => "attivare",
    "admin__apps__settings__deactivate" => "disattivare",
    "admin__apps__settings__activated" => "Abilitato",
    "admin__apps__settings__deactivated" => "handicappato",
    "admin__apps__settings__no_description" => "Nessuna descrizione",
    "admin__apps__settings__app_id" => "ID app",
    "admin__apps__settings__properties" => "Proprietà",
    "admin__apps__settings__frontend" => "Frontend",
    "admin__apps__settings__no_content" => "Nessun contenuto",
    "admin__apps__settings__static" => "statico",
    "admin__apps__settings__not_static" => "Non statico",
    "admin__apps__settings__size" => "Dimensioni e orientamento",
    "admin__apps__settings__no_container_css" => "Nessun container CSS",
    "admin__apps__settings__no_container_fluid_css" => "Nessun container-fluid CSS",
    "admin__apps__settings__no_app_css" => "Nessun app CSS",
    "admin__apps__settings__container_fluid" => "container-fluid",
    "admin__apps__settings__container" => "container",
    "admin__apps__settings__apps" => "Applicazioni",
    "admin__apps__settings__save" => "Salvare",
    "admin__apps__settings__cache" => "Usare la cache delle app",
    "admin__apps__settings__js_cache" => "Utilizzare la cache JavaScript",
    "admin__apps__settings__css_cache" => "Utilizzare la cache CSS",
];