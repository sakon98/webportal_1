
for /F "tokens=1-4 delims=/ " %%i in ('date /t') do  set currentdate=%%k-%%i-%%j
for /F "tokens=1-3 delims=: " %%i in ('time /t') do set currenttime=%%i-%%j-%%k

IF "%7"=="y" GOTO :STEP1

:STEP0
SET STEP=y

IF "%STEP%"=="y" GOTO :STEP1

:STEP1
SET SCHEMA_USR=webportal

set _SCRIPT_DRIVE=%~d0
SET ZIPAPP=%_SCRIPT_DRIVE%\DB.Webportal\7-ZipPortable\App\7-Zip64
SET RESTORE_PASS=%_SCRIPT_DRIVE%\DB.Webportal\0.Restore.pass.cnf
SET BACKUP_FILE=%_SCRIPT_DRIVE%\\DB.Webportal\\%SCHEMA_USR%.mysql.%currentdate%_%currenttime%.sql
SET REPLACETEXT=\
SET SEARCHTEXT=\\
SET BACKUP_FILE_=%_SCRIPT_DRIVE%\DB.Webportal\%SCHEMA_USR%.mysql.%currentdate%_%currenttime%.sql
SET PATH=D:\xampp\mysql\bin;%PATH%
%_SCRIPT_DRIVE%
cd %_SCRIPT_DRIVE%\DB.Webportal\

mysqldump.exe --defaults-file="%RESTORE_PASS%" --user=root --protocol=tcp --port=3307  --default-character-set=utf8  --routines --events "%SCHEMA_USR%"  > "%BACKUP_FILE%"

%ZIPAPP%\7z a %BACKUP_FILE%.zip %BACKUP_FILE%
copy %BACKUP_FILE%.zip Z:\Mysql\%SCHEMA_USR%.mysql.%currentdate%_%currenttime%.sql.zip
echo y|del %BACKUP_FILE_%

:End

SET E=Enter to exit 
