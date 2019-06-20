package javaapplication7;

import javax.swing.*;
import java.awt.*;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.util.logging.Level;
import java.util.logging.Logger;
public class gui
{
public static void main(String args[])
{



    try {  
        send();
    } catch (IOException ex) {
        Logger.getLogger(gui.class.getName()).log(Level.SEVERE, null, ex);
    }
}
    
public static void send() throws MalformedURLException, IOException 
{

  
   String url;
 //url="http://localhost/a/remote_ajax.php?";
   url="http://localhost/a/a.php?";
    String username="ayologbon";


//url=url+"username="+username;
    String pass = "29671990";
//url=url+"&pass="+pass;
    // URL url;
// send as http get request
//URL url;
//send();
    URL urls = new URL(url);
// make json string, try also hamburger

URLConnection conn;
    conn = urls.openConnection();

// Get the response

 read_in_text(conn);




}

    private static  void read_in_text(URLConnection conn) throws IOException 
    {
        BufferedReader rd;
    rd = new BufferedReader(new InputStreamReader(conn.getInputStream()));
    

    show_in_text(rd);
    }
     private  static void show_in_text(BufferedReader rd) {
     
        String line;
        
JFrame frame = new JFrame("Chat");
frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
frame.setSize( 400 , 400 );
JMenuBar mb = new JMenuBar();
JMenu m1 =new JMenu("FILE");
JMenu m2 =new JMenu("Help");
mb.add(m1);
mb.add(m2);
JMenuItem m11 = new JMenuItem("Open");
JMenuItem m22 = new JMenuItem("Save as");
m1.add(m11);
m1.add(m22);
JPanel panel = new JPanel();
JLabel label = new JLabel("Enter Text");
JTextField tf = new JTextField(10);

JButton send = new JButton( "send" );

panel.add(label);
panel.add(tf);
panel.add(send);
//JTextArea ta = new JTextArea("hello no ni");
JEditorPane tp=new JEditorPane();
tp.setEditable(false);
JScrollPane scrolBar = new JScrollPane(tp);
scrolBar.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
frame.getContentPane().add(BorderLayout.SOUTH,panel);
frame.getContentPane().add(BorderLayout.NORTH,mb);
frame.getContentPane().add(BorderLayout.CENTER,scrolBar);
frame.setVisible(true);
    try {
StringBuilder stringBuilder= new StringBuilder();
while ((line = rd.readLine()) != null) 
{


 
 stringBuilder.append(line).append( System.getProperty("line.separator"));
    
}

rd.close();
String toString = stringBuilder.toString();
tp.setContentType("text/html");
 tp.setText("<html>"+toString+"</html>");

} catch (IOException e) 
{
  
}
     
    }
}
