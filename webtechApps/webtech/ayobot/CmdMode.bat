
set path="D:\Program Files\Java\jdk1.7.0_03\bin"


javac Ayobot.java
java Ayobot

jar cvfm Ayobot.jar manifest.txt *.class





java -Xmx1024m -jar Ayobot.jar

 start javaw -jar -Xms1024m -Xmx1024m "%webTechRoot%\Ayobot.jar"

pause

