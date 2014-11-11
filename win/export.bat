@echo off

:: db data
set dbhost="127.0.0.1"
set dbname="test"
set dbuser="user"
set dbpass="password"

:: mysqldump path
set mysqldump="C:\xampp_1.7.3\mysql\bin\mysqldump"

:: backup destination folder
set destfolder="E:\\Temp\\test"

:: backup time
set backuptime=%time:~0,2%%time:~3,2%%time:~6,2%_%date:~-10,2%%date:~-7,2%%date:~-4,4%

:::
set destpath=%destfolder%\%backuptime%

:: export string
@echo on
%mysqldump% --add-drop-table --host=%dbhost% --user=%dbuser% --password=%dbpass% %dbname% > "%destpath%.sql"

::&& "C:\Program Files\7-Zip\7z.exe" a -p123 "%destfolder%\%backuptime%.7z" "%destfolder%\%backuptime%.sql" && rm "%destfolder%\%backuptime%.sql"