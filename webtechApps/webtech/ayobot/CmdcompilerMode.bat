
set path="D:\Program Files\Java\jdk1.7.0_03\bin"
@echo %path%
pause

javac WebTechMainClass.java
java WebTechMainClass

jar cvfm WebTechMainClass.jar manifest.txt *.class





java -Xmx1024m -jar WebTechMainClass.jar

pause

