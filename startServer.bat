color 0a
set curDir=%CD%
set fitechbotDir=%curDir%xampp\htdocs\fitechbot\
cls

start %curDir%xampp\xampp-control.exe /B /MIN

Explorer "%curDir%Program Files\NetBeans 7.4\bin\netbeans.exe" 

Explorer http://localhost/fitechbot/

Explorer http://localhost/fitechbot/sms/

Explorer http://localhost/fitechbot/chat/web



Explorer  %fitechbotDir%
Explorer  %fitechbotDir%chat\web
Explorer  %fitechbotDir%sms
 
pause