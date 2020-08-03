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
 * @description     Admin app creator to build apps.
 */

// Language strings.
$strings = [
    "admin__apps__create__dev_header" => "App per sviluppatori",
    "admin__apps__create__info" => "Nuove app possono essere generate in quest'area. È possibile generare app HTML multilingue o app di sviluppo avanzate. Le app HTML sono basate su modelli. Per ogni set di lingue, è possibile creare un modello HTML separato nell'area di amministrazione dell'app. Quindi l'app è pronta per l'uso. Le app per sviluppatori sono rivolte agli sviluppatori che desiderano creare app avanzate per il sistema operativo APPNET. Le app per sviluppatori includono un'area applicativa predefinita, un'area di amministrazione predefinita e un widget predefinito per l'area di amministrazione. Per le app per sviluppatori, può essere scelto come modello. Può anche essere scelta la cache dell'app e le impostazioni del contenitore con cui deve essere generata. Gli sviluppatori possono offrire le loro app, nel marketplace, su <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a> per saldi. Gli utenti del sistema operativo APPNET possono acquistare e installare le app direttamente dall'area di amministrazione.",
    "admin__apps__create__html_info" => "HTML App Builder crea app HTML complete e multilingue. Le app HTML hanno la loro area di amministrazione. In quest'area, un modello separato può essere creato e modificato per ogni set di lingue. Grazie al built-in wysiwyg e all'editor HTML, è leggero per personalizzare il codice. Le app HTML sono basate su Smarty Template. Qui è possibile utilizzare codice HTML ordinario o Smarty Code. Le app HTML sono app contenitore. Ciò consente di modificare le dimensioni e l'orientamento in qualsiasi momento, nelle impostazioni dell'app. Un contenitore può essere interessato in qualsiasi momento. Nelle impostazioni dell'app, i tag CSS possono essere assegnati al contenitore. Se il fine del contenitore di app è definito in un URI prima e dopo l'app, l'app viene emessa individualmente in un contenitore. Un riempimento viene sempre aggiunto a un'app contenitore a sinistra ea destra. Per rimuovere questo deve essere aggiunto a px-0. classe nelle impostazioni dell'app, nel contenitore CSS. In modalità esperto, un file CSS e JavaScript può anche essere aggiunto all'app. Questa modalità deve essere sbloccata in config.inc.php.",
    "admin__apps__create__dev_info" => "Sviluppare app sono preparate per gli sviluppatori. Per creare un'app per sviluppatori è necessario un nome, uno spazio dei nomi e una directory. Le app per sviluppatori sono archiviate nella directory root per applicazioni / app di app. L'opzione Directory memorizza l'app nella sottodirectory specificata nella directory principale. Uno spazio dei nomi è urgentemente necessario. Lo spazio dei nomi è utilizzato da tutti i controller e i modelli. Questo previene i conflitti con altre app. Gli sviluppatori possono proteggere i propri spazi dei nomi per il sistema operativo APPNET, sotto <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a>. Le app offerte e scaricate nell'APP OS Store non creano conflitti. L'opzione dell'app Contenitore indica se le app, insieme ad altre app contenitore, saranno emesse in un contenitore. Nelle app del contenitore è possibile modificare successivamente, nelle dimensioni dell'applicazione. Le app che utilizzano sempre la larghezza completa del browser non devono essere generate come app contenitore. Un'app di sviluppo creata include un controller, un modello, due viste, diversi file di lingua, un controller di amministrazione, un modello di amministrazione, due visualizzazioni di amministrazione e diversi file di lingua di amministrazione. Un'app di sviluppo è inoltre conforme a un widget preparato costituito da un controller, un modello e due viste e diversi file di lingua. Inoltre, tutti gli eventi di amministrazione sono preparati.",
    "admin__apps__create__err_no_name" => "Nessun nome inserito",
    "admin__apps__create__err_name" => "Il nome non può essere utilizzato",
    "admin__apps__create__err_name_exists" => "Esiste già un'app con questo nome",
    "admin__apps__create__conf" => "L'app è stata creata",
    "admin__apps__create__err_dir" => "Impossibile utilizzare l'input della directory",
    "admin__apps__create__err_dev_name_ex" => "C'è già un'app con quel nome, in questa directory",
    "admin__apps__create__err_ns_wrong" => "Impossibile utilizzare l'input dello spazio dei nomi",
    "admin__apps__create__err_ns_exists" => "Esiste già un'app con quel nome, in e quello spazio dei nomi",
    "admin__apps__create__container_app" => "App contenitore",
    "admin__apps__create__container_true" => "App contenitore",
    "admin__apps__create__container_false" => "Nessuna app contenitore",
    "admin__apps__create__development" => "Sviluppo",
    "admin__apps__create__smarty" => "Visualizza come modello Smarty",
    "admin__apps__create__php" => "Visualizza come modello PHP",
    "admin__apps__create__cache" => "Cache dell'app",
    "admin__apps__create__cache_false" => "Non aggiungere una funzione cache",
    "admin__apps__create__cache_true" => "Aggiungi una funzionalità di cache",
    "admin__apps__create__html_header" => "App modello HTML",
    "admin__apps__create__html_description" => "App HTML multilingue basata su modelli. L'app ha la propria area di amministrazione. Grazie all'editor wysiwyg e HTML integrato, è facile personalizzare il testo o il codice. L'applicazione non richiede alcuna conoscenza di programmazione e può essere facilmente integrato.",
    "admin__apps__create__dev_description" => "Un kit completamente prefabbricato per gli sviluppatori. Può essere usato per definire le aree con cui deve essere generata l'app. Area dell'applicazione, area di amministrazione e widget. Vengono creati file di stringhe per ogni area. Inoltre, vengono preparati tutti gli eventi. L'applicazione è adatta per gli sviluppatori di programmare le proprie applicazioni per il APPNETOS.",
    "admin__apps__create__name" => "Nome dell'app",
    "admin__apps__create__description" => "Descrizione dell'app",
    "admin__apps__create__namespace" => "Namespace",
    "admin__apps__create__directory" => "Directory",
    "admin__apps__create__build" => "Creare",
    "admin__apps__create__widget" => "Widget",
    "admin__apps__create__widget_false" => "Non aggiungere un widget",
    "admin__apps__create__widget_true" => "Aggiungi widget",
    "admin__apps__create__overview" => "Visione f d'insieme",
    "admin__apps__create__menu_header" => "Creare una nuova app",
    "admin__apps__create__install_apps" => "Installare app",
    "admin__apps__create__html_string_header" => "App Stringa HTML",
    "admin__apps__create__html_sting_description" => "App HTML basata su stringa multilingue. L'area di amministrazione dispone di un editor HTML e wysiwyg incorporato. Nel file HTML, è possibile utilizzare stringhe da file di lingua PHP. Viene creato un file globale e un file in lingua inglese, ma è possibile aggiungere semplicemente file di lingua. L'app richiede competenze di programmazione minime",
    "admin__apps__create__html_string_info" => "App HTML multilingue basata su stringhe. L'area di amministrazione dispone di un editor HTML e wysiwyg incorporato. I file di stringa vengono utilizzati per il testo. I testi dei file di stringa possono essere facilmente trasferiti in HTML. Questo ha il vantaggio che solo un file HTML deve essere generato per tutti i linguaggi. Quando viene creata l'app, viene creato un file di stringa globale e un file di stringa inglese. Per modificare i file di stringa è necessario un editor esterno. Per altre lingue, solo un file di stringa esistente deve essere copiato e denominato con l'ID paese appropriato. La lingua viene selezionata automaticamente. Può essere inserito tra 3 lingue di modello selezionate nelle stringhe di seguito.",
    "admin__apps__create__template_language" => "Linguaggio modello",
    "admin__apps__create__twig" => "Viste come modelli di ramoscello",
];