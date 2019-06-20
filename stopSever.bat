color 0a
set curDir=%CD%
set srcDir=%curDir%xampp\htdocs\fitechbot
set destDir=%curDir%D_FILES\back_up_files\Fitechbot_backups
set destDir2=E:\Fitechbot_backups
cls
Xcopy %srcDir% %destDir% /E /I /F /H  /Y  /D

Xcopy %srcDir% %destDir2% /E /I /F  /Y  /D
pause