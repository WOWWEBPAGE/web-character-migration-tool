﻿<?php

    include_once("t_config.php");

    switch($language) {
        case "ru": {
            $write[1] = 'Вход';
            $write[2] = 'Вы должны ввести свой логин и пароль, чтобы войти в Личный Кабинет.';
            $write[3] = 'Введите Ваш логин';
            $write[4] = 'Введите Ваш пароль';
            $write[5] = 'Добро пожаловать,';
            $write[6] = 'Главная';
            $write[7] = 'Выйти';
            $write[20] = 'Доступна только 1 попытка переноса, для на 1 персонажа';
            $write[30] = 'В процессе';
            $write[31] = 'Одобрено <b>GM</b>';
            $write[32] = 'Отклонено <b>GM</b>';
            $write[33] = 'Отменено <b>игроком</b>';
            $write[34] = 'Отклонено <b>Сервером</b> Неверный формат дампа, трансфер не может быть произведён';
            $write[41] = 'Вы удачно покинули Личный Кабинет';
            $write[42] = 'Вернутся на сайт';
            $write[50] = 'Формат файла не верен, нужна другая версия игры';
            $write[51] = 'Ваш аддон chardump устарел, пожалуйста <a href = "v303.664.rar">скачайте</a> более новую версию аддона.';
            $write[52] = 'Слишком много персонажей на аккунте: "';
            $write[53] = '" (не более 9)';
            $write[54] = 'На выбеном мире: ';
            $write[55] = 'Все GM аккаунты заняты! Пожалуйста, подождите пока освободится место!';
            $write[57] = 'Трансфер c данного сервера запрещён!';
            $write[60] = 'Войти в INFO и Загрузить DUMP';
            $write[61] = 'После загрузки дампа персонаж, он появится на  <b>учетной записи представителя администрации</b>, а не на вашей, после его рассмотрения им будет вынесен вердикт: <font color="green">Одобрено <b>GM</b></font> или <font color="red">Отклонено <b>GM</b></font>, вы также можете <font color="purle">Отменить</font> запрос вручную, если вы этого хотите';
            $write[63] = 'Выбрать файл:';
            $write[65] = 'Начало переноса, ШАГ 1';
            $write[70] = 'Пожалуйста напишите ваши данные учетной записи на "старом" сервере, чтобы <br> <b>Представитель Администрации(GM)</b> использовал их, чтобы проверить вашего персонажа. <br> Пожалуйста, введите верные данные, иначе перенос персонажа будет отклонён.';
            $write[71] = 'Имя учетной записи со старого сервера';
            $write[72] = 'Пароль учетной записи со старого сервера';
            $write[73] = 'Реалмлист старого сервера. Только полностью: <b>Пример:</b> <i>set realmlist 127.0.0.1</i>';
            $write[74] = 'Адрес сайта "старого" сервера, где Гейм Мастер сможет прочесть информацию о нем <br> <b>"старом":</b>';
            $write[76] = 'Использовать <b>ТОЛЬКО</b> файл <b>"chardump.lua"</b>!';
            $write[75] = 'Скачать аддон(игровое расширение) для получения  dump персонажа <b><a href = "v303.664.rar">v303.664.rar</a></b><br> Введите /chardump в чате игры зайдя на вашего персонажа для начала переноса персонажа.<br> Отройте сумки инвентаря и банка, чтобы они перенеслись на новый сервер. <br> Для переноса рецептов и профессий - откройте окна профессии. <br> Выйдите из игры и найдите файла дампа, он будет сохранен в  WTF \ Account \ %Username% \ SavedVariables \ chardump.lua <br>Все выше сказаное есть в видео </ a>';
            $write[77] = 'Начало переноса, ШАГ 2';
            $write[78] = 'Добро пожаловать в  <b>Панель Администратора</b> Установите статус персонажа, Please click "<font color = "green">Одобрено</font>" или "<font color = "red">Отклонено</font>" что-бы изменить статус переноса.';
            $write[79] = 'Выберите мир, в который хотите перенести персонажа';
            $write[80] = 'Автоперенос персонажа / Система трансфера';
            $write[84] = 'Отменить';
            $write[85] = 'Одобрить';
            $write[86] = 'Отклонить';
            $write[90] = '<font color = "red">Имя персонажа занято</font>. Выберите новое';
            $write[91] = 'Персонаж отправлен на рассмотрение';
            $write[92] = '"\'^?$%&*()}{@#~?><>,|=_.+¬-\'" Такие ники запрещены';
            $write[93] = 'Такое имя персонажа занято';
            $write[94] = 'Цифры не позволены в имени персонажа';
            $write[95] = 'Длина имени персонажа должна быть от 2 16 символов.';
            $write[96] = 'Имя персонажа: "';
            $write[97] = '" Уже существует';
            $write[98] = 'Ошибка сессии, удалите Cookie, если это не помогло, обратитесь к Администрации сервера';
            $write[99] = 'Максимальная длинна имени пользователя 32 буквы';
            break;
        }
        case "de": {
            $write[1] = 'Einloggen';
            $write[2] = 'Du musst deinen Benutzernamen und dein Passwort eingeben, um dich einzuloggen.';
            $write[3] = 'Bitte gib deinen Benutzernamen ein.';
            $write[4] = 'Bitte gib dein Passwort ein';
            $write[5] = 'Hallo';
            $write[6] = 'Home';
            $write[7] = 'Ausloggen';
            $write[20] = 'Allowed only 1 Attempt for character';
            $write[30] = 'In Bearbeitung';
            $write[31] = 'Bestätigt von <b>GM</b>';
            $write[32] = 'Abgelehnt von <b>GM</b>';
            $write[33] = 'Abgebrochen von <b>Player</b>';
            $write[34] = 'Abgehlent durch <b>Server</b> Fehlerhaft Dump oder Transferprozedur';
            $write[41] = 'Du hast dich erfolgreich ausgeloggt';
            $write[42] = 'Zurück';
            $write[50] = 'Deine Datei war fehlerhaft.';
            $write[51] = 'Dein Chardump ist fehlerhaft, bitte <a href = "v303.664.rar">downloade</a> ein neues Addon.';
            $write[52] = 'Deine Anzahl an Characteren auf dem Realm: "';
            $write[53] = '" (Mehr als 9)';
            $write[54] = 'Für den Realm: ';
            $write[55] = ' Warteschlange ist voll! Bitte warte bis einige Transfers abgearbetet wurde.';
            $write[57] = 'Der Transfer wurde vom Server abgewiesen.';
            $write[60] = 'Bestätige die Informationen & Dump uploaden';
            $write[61] = 'Nach dem Upload wird der Transfer von einem  <b>Game Master Account</b> geprüft und entweder wird dieser  <font color = "green">Bestätigt</font> oder <font color = "red">Abgelehnt</font>, du kannst aber auch manuell <font color = "purle">Abbrechen</font>.';
            $write[63] = 'Ausgewählte Datei:';
            $write[65] = 'Transfer starten, Schritt 1';
            $write[70] = 'Bitte gib deine "alten" Server daten ein, <b>Game Master</b> nutzen diese,um deinen Character zu testen. <br> Bitte gib Wahrheitsgemäße daten ein, sonst wird der Transfer abgelehnt.';
            $write[71] = 'Accountname deines "Alten" Chars';
            $write[72] = 'Accountpasswort deines "Alten" Chars ';
            $write[73] = 'Nur komplette Angaben: <b>Beispiel:</b> <i>set realmlist 127.0.0.1</i>';
            $write[74] = 'Server Adresse, mit der der GM den "Alten" Server überprüfen kann. <br> <b>Beispiel:</b> ';
            $write[76] = 'Lade nur den erstellten Chardump hoch! "chardump.lua"';
            $write[75] = 'Lade folgendes Addon herunter um einen Chardump zu erstellen <b><a href = "v303.664.rar">v303.664.rar</a></b><br> Gib /chardump  im Chatfenster ein um einen DUMP durchzuführen. <br> Um die Sachen aus der Bank zu transferieren müssen diese Seiten auch geöffnet sein. <br> Logge dich as und der Dump wird wie folgt gespeichert: WTF \ Account \ %Username% \ SavedVariables \ chardump.lua <br></ a>';
            $write[77] = 'Transfer starten, Schritt 2';
            $write[78] = 'Willkommen im  <b>ADMIN PANEL</b>. Wenn du Transfers prüfst, dann bitte klicke entweder  "<font color = "green">Bestätigen</font>" oder "<font color = "red">Ablehnen</font>" um die Transfers zu Bestätigen oder Abzulehnen.';
            $write[79] = 'Wähle zu welchem Realm soll dein Character transferiert werden.';
            $write[80] = 'Characters Transfer';
            $write[84] = 'Abbrechen<';
            $write[85] = 'Bestätigen';
            $write[86] = 'Ablehnen';
            $write[90] = 'Wähle deinen neuen Namen für den Character, <font color = "red">Wenn dein Account nich verfügbar ist</font> wird dein Transfer nicht freigegeben.';
            $write[91] = 'Character steht nun zur Ansicht';
            $write[92] = 'Folgende Zeichen sind nicht erlaubt"\'^?$%&*()}{@#~?><>,|=_.+¬-\'"';
            $write[93] = 'Leerschritte sind nicht erlaubt im Characternamen';
            $write[94] = 'Numerische Character sind nicht erlaubt';
            $write[95] = 'Character Name sollte zwischen 2 und 16 Zeichen lang sein.';
            $write[96] = 'Der Character mit dem Namen: "';
            $write[97] = '" existiert bereits';
            $write[98] = 'Sitzungsfehler, Lösche deine Cookies, Versuche es erneut, wenn dies noch einmal passiert, kontaktiere bitte einen Admin';
            $write[99] = 'Die Maximale Länge des Benutzernamen beträgt 32 Buchstaben';
            break;
        }
        case "es": {
            $write[1] = 'Acceder';
            $write[2] = 'Debes introducir el usuario y contraseña para acceder a tu cuenta.';
            $write[3] = 'Introduce tu usuario';
            $write[4] = 'Introduce tu contraseña';
            $write[5] = 'Hola';
            $write[6] = 'Inicio';
            $write[7] = 'Salir';
            $write[20] = 'Allowed only 1 Attempt for character';
            $write[30] = 'En progreso</font>';
            $write[31] = 'Aprobado por el <b>MJ</b>';
            $write[32] = 'Denegado por el <b>MJ</b>';
            $write[33] = 'Cancelado por el <b>Jugador</b>';
            $write[34] = 'Denegado por el <b>Servidor</b> Mal DUMP o no finalizado el proceso de transferencia';
            $write[41] = 'Has salido de tu cuenta';
            $write[42] = 'Volver';
            $write[50] = 'Tu archivo esta corrupto';
            $write[51] = 'Tu dump esta corrupto no es valido, Por favor <a href="v303.664.rar">descarga</a> el nuevo addon.';
            $write[52] = '<b><font color="red">Personajes en el reino: "';
            $write[53] = '" (Mas de 9)';
            $write[54] = 'Para el reino: ';
            $write[55] = ' ¡La cola de migraciones esta llena! Lo sentimos, debes esperar, hasta que haya sitio libre, ¡Gracias por tu paciencia!';
            $write[57] = 'Transferencia rechazada por el servidor';
            $write[60] = 'Introduce datos y sube el dump';
            $write[61] = 'Despues de subir el dump, aparecera en una cuenta de <b>Maestro de Juego</b>, despues de revisarlo y ser <font color="green">Aprobado</font> o <font color="red">Denegado</font> (tambien puedes dar click en <font color="purple">Cancelar</font> manualmente si lo deseas)';
            $write[63] = 'Archivo seleccionado:';
            $write[65] = 'Empezar la transferencia, PASO 1';
            $write[70] = 'Por favor rellena el siguiente formulario con los datos del servidor del que provienes, el <b>Maestro de Juego</b> los usara para comprobar tu personaje. <br> Introduce los datos validos o tu migración sera rechazada.';
            $write[71] = 'Cuenta con la cual el MJ puede entrar a tu antigua cuenta (servidor del que provienes)';
            $write[72] = 'Contraseña de la cuenta anterior (servidor del que provienes) ';
            $write[73] = 'Realmlist entero: <b>Ejemplo:</b> <i>set realmlist 127.0.0.1</i>';
            $write[74] = 'Web del servidor antiguo, donde el MJ puede leer informacion o identificar tu antigua cuenta (servidor del que provienes) <br> <b>Ejemplo:</b>';
            $write[76] = 'Sube el dump "chardump.lua"';
            $write[75] = 'Descarga el addon para hacer dump de tu PJ <b><a href = "v303.664.rar">v303.664.rar</a></b><br> Escribe /chardump en el chat. <br> Para guardar las cosas de fuera del banco debes tener la ventana abierta. <br> Para conservar las recetas de tus profesiones debes abrir las profesiones. <br> Desconecta del servidor y sube el dump, (se encuentra en WTF \ Account \ %Username% \ SavedVariables \ chardump.lua) <br></ a>';
            $write[77] = 'Empezar con la migracion, PASO 2';
            $write[78] = 'Bienvenido al <b>PANEL DE ADMINISTRACION</b> donde puedes administrar los PJs de la gente, haz click en "<font color="green">Aprobar</font>" o "<font color = "red">Denegar</font>" para aprobar o denegar las migraciones';
            $write[79] = 'Selecciona el reino al cual quieres migrar tu personaje';
            $write[80] = 'Sistema de migraciones';
            $write[84] = 'Cancelar';
            $write[85] = 'Aprobar';
            $write[86] = 'Denegar';
            $write[90] = 'Elige el nuevo nombre para tu personaje, <font color="red">solo si el nombre del personaje esta libre</font> tu migracion podra ser aprobada o denegada';
            $write[91] = 'Personaje listo para revision';
            $write[92] = '"\'^?$%&*()}{@#~?><>,|=_.+¬-\'" Caracteres no permitidos';
            $write[93] = 'Los espacios no estan permitidos en el nombre de los personajes';
            $write[94] = 'Los caracteres númericos no estan permitidos en el nombre del personaje';
            $write[95] = 'La longitud del nombre del personaje debe estar entre 2 y 16.';
            $write[96] = 'Personaje con el nombre: "';
            $write[97] = '" ya existe';
            $write[98] = 'Error en la sesión, limpia cookies, y prueba de nuevo (si te sigue pasando contacta con un administrador)';
            $write[99] = 'Los caracteres máximos permitidos para el usuario es de 32 letras';
            break;
        }
        case "en": {
            $write[1] = 'Log in';
            $write[2] = 'You must enter your username and password to log into your account.';
            $write[3] = 'Please enter your username';
            $write[4] = 'Please enter your password';
            $write[5] = 'Hello';
            $write[6] = 'Home';
            $write[7] = 'Quit';
            $write[20] = 'Allowed only 1 Attempt for character';
            $write[30] = 'In Progress';
            $write[31] = 'Approved, by <b>GM</b>';
            $write[32] = 'Denied, by <b>GM</b>';
            $write[33] = 'Canceled, by <b>Player</b>';
            $write[34] = 'Denied, by <b>Server</b> Bad DUMP or not finished Transfer Procedure';
            $write[41] = 'You have successfully left your account';
            $write[42] = 'Go Back';
            $write[50] = 'Your file corrupted, or your client build not';
            $write[51] = 'Your chardump corrupted, Please <a href = "v303.664.rar">download</a> new addon.';
            $write[52] = '<b><font color="red">You have so much characters on Realm: "';
            $write[53] = '" (More then 9)';
            $write[54] = 'For Realm: ';
            $write[55] = ' All Queues FULL! Sorry, you need to wait, unitl one of Reviewers be Free, Thank you for Patience!';
            $write[57] = 'Transfer from this Server Rejected.';
            $write[60] = 'Sign INFO & Upload DUMP';
            $write[61] = 'After loading the dump character will appear on <b>Game Master Account</b>, not your, after review it will be <font color = "green">Approved</font> or <font color = "red">Denied</font>, you can <font color = "purle">Cancel</font> it manualy, if you want';
            $write[63] = 'Selected file:';
            $write[65] = 'Start Transfer, STEP 1';
            $write[70] = 'Please sumbmit your "old" server account details, <b>Game Master</b> use their, to check your character. <br> Please enter Valid Data, else thansfer rejected.';
            $write[71] = 'Account whit which you GM can enter in your "old" server account';
            $write[72] = 'Account password for previous ';
            $write[73] = 'Only full string: <b>Example:</b> <i>set realmlist 127.0.0.1</i>';
            $write[74] = 'Server URL, where Game Master can read info or identify your "old" server <br> <b>Example:</b> ';
            $write[76] = 'Upload created character dump ONLY! "chardump.lua"';
            $write[75] = 'Download the game addon to dump the character <b><a href = "v303.664.rar">v303.664.rar</a></b><br> Enter /chardump in the chat frame to dump. <br> To dump things out of the bank to bank so that the window was also open. <br> To dump recipes professions in turn open the frames of the professions. <br> Make logout and the dump file will be saved in the WTF \ Account \ %Username% \ SavedVariables \ chardump.lua <br></ a>';
            $write[77] = 'Start Transfer, STEP 2';
            $write[78] = 'Welcome to <b>ADMIN PANEL</b> When you check Player Characters, Please click "<font color = "green">Approve</font>" or "<font color = "red">Deny</font>" for approving or deny their transfers';
            $write[79] = 'Select in which realm you want to tranfer your character';
            $write[80] = 'Characters Transfer / Migration Managment System';
            $write[84] = 'Cancel';
            $write[85] = 'Approve';
            $write[86] = 'Deny';
            $write[90] = 'Choice new name for character, <font color = "red">only if your character name will be free</font> your transfer can be allowed for checking';
            $write[91] = 'Character signed for review';
            $write[92] = '"\'^?$%&*()}{@#~?><>,|=_.+¬-\'" characters not allowed';
            $write[93] = 'Spaces not allowed in Character name';
            $write[94] = 'Numeric characters not allowed';
            $write[95] = 'Character name lenght can be from 2 to 16 characters.';
            $write[96] = 'Character with name: "';
            $write[97] = '" already exists';
            $write[98] = 'Session Error, clean Cookie, try again, if happen again contact with adminstrator';
            $write[99] = 'Max username lenght 32 letters';
            break;
        }
        case "fr": {
            $write[1] = 'Connexion';
            $write[2] = 'Vous devez entrer votre nom d\'\'utilisateur et mot de passe pour vous connecter à votre compte.';
            $write[3] = 'Entrer votre nom de compte';
            $write[4] = 'Entrer votre mot de passe';
            $write[5] = 'Bonjour';
            $write[6] = 'Index';
            $write[7] = 'Quitter';
            $write[20] = 'Vous ne pouvez récupérer qu\'\'un seul personnage';
            $write[30] = 'En cours';
            $write[31] = 'Approuvé, par le <b>GM</b>';
            $write[32] = 'Refusé, par le <b>GM</b>';
            $write[33] = 'Annulé, par le <b>Joueur</b>';
            $write[34] = 'Refusé, par le <b>Serveur</b>: Mauvais DUMP ou la procédure ne s\'\'est pas terminé correctement.';
            $write[41] = 'Vous êtes déconnecté.';
            $write[42] = 'Retour';
            $write[50] = 'Votre fichier est corrompu, ou votre DUMP de personnage n\'\'a pas été fait sous la bonne version (3.3.5)';
            $write[51] = 'Votre DUMP de personnage est corrompu, Merci de <a href = "v303.664.rar">télécharger</a> le nouvel addon.';
            $write[52] = '<b><font color="red">Vous avez trop de personnages sur le Royaume: "';
            $write[53] = '" (pas plus de 9)';
            $write[54] = 'Pour le Royaume: ';
            $write[55] = ' Toutes les files d\'\'attentes sont pleines! Désolé, vous devez attendre qu\'\'un MJ soit libre, Merci de votre patience!';
            $write[57] = 'Récupération rejetée pour ce Royaume.';
            $write[60] = 'Inscription INFO & Upload DUMP';
            $write[61] = 'Après le chargement, le fichier DUMP de personnage apparaitra sur le <b>Compte des MJ</b>, pas le votre, après vérification il sera <font color = "green">Approuvé</font> ou <font color = "red">Rejeté</font>, vous pouvez <font color = "purle">Annuler</font> la procédure manuellement, si vous le souhaitez';
            $write[63] = 'Sélectionner un Fichier:';
            $write[65] = 'Démarrer la récupération, Étape 1';
            $write[70] = 'Merci d’’envoyer les informations de compte de votre "ancien" serveur, <b>Les MJ</b> les utiliseront pour vérifier votre personnage. <br> Merci d’’envoyer de vraies informations auquel cas votre demande sera rejetée.';
            $write[71] = 'Compte avec lequel le MJ pourra entrer sur votre "ancien" serveur.';
            $write[72] = 'Mot de passe de ce compte';
            $write[73] = 'Realmlist de votre serveur. <b>Exemple:</b> <i>set realmlist pandaria-games.com</i>';
            $write[74] = 'Adresse URL de votre serveur, où le MJ pourra voir les informations de votre serveur <br> <b>Exemple:</b> <i>http://pandaria-games.com/index.php/</i>';
            $write[76] = 'Uploader SEULEMENT un fichier généré par notre Addon! "chardump.lua"';
            $write[75] = 'Télécharger notre Addon pour créer votre DUMP de personnage <b><a href = "v303.664.rar">v303.664.rar</a></b><br> Tapez /chardump dans la fenêtre de chat pour générer le fichier DUMP de votre personnage. <br> Pour récupérer votre Banque, pensez à ouvrir la fenêtre de votre Banque avant de taper la commande /chardump. <br> Pour récupérer vos recettes de métier, pensez à ouvrir la fenêtre de vos Métiers avant de taper la commande /chardump. <br> Une fois le DUMP crée par l\'\'addon vous trouverez le fichier à nous envoyer dans votre dossier WTF \ Account \ %Username% \ SavedVariables \ chardump.lua <br></ a>';
            $write[77] = 'Démarrer la récupération, Étape 2';
            $write[78] = 'Bienvenue dans le <b>GESTIONNAIRE ADMIN</b> lorsque la vérification de récupération est faite, merci de cliquer sur "<font color = "green">Approuvé</font>" ou "<font color = "red">Refusé</font>" pour autoriser ou refuser une récupération.';
            $write[79] = 'Sélectionner le royaume dans lequel vous voulez tranférer votre personnage';
            $write[80] = 'Transfère de Personnage / Système de gestion des Transfères';
            $write[84] = 'Annuler';
            $write[85] = 'Approuvé';
            $write[86] = 'Refusé';
            $write[90] = 'Choisissez un nouveau nom de personnage, <font color = "red">uniquement si votre nom n\'\'est pas libre</font> pour que votre demande de récupération puisse être traité par un Maitre de Jeu.';
            $write[91] = 'Personnage marqué comme non conforme. Récupération à revoir';
            $write[92] = '"\'^?$%&*()}{@#~?><>,|=_.+¬-\'" Ces caractères ne sont pas Autorisés';
            $write[93] = 'Les espaces ne sont pas autorisés dans les noms de Personnages.';
            $write[94] = 'Les Chiffres ne sont pas autorisés dans les noms de Personnages';
            $write[95] = 'Le nombre de lettre dans votre nom de personnage doit être comprit entre 2 et 16 characters maximum';
            $write[96] = 'Un Personnage avec le nom : "';
            $write[97] = '" Existe Déjà';
            $write[98] = 'Érreur de Session, Supprimer vos Cookies, puis refaite un essai, si le problème persiste, merci de contacter un Administrateur';
            $write[99] = 'La longueur maximum pour le compte est de 32 characters';
            break;
        }
    }
?>