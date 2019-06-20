package ayobot;

import java.awt.*;
import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.SwingUtilities;
import java.awt.event.MouseEvent;
import java.awt.event.*;
import java.awt.Toolkit;
import javax.swing.JPopupMenu;
import java.io.*;
import javax.swing.filechooser.FileFilter;
import javax.swing.filechooser.FileNameExtensionFilter;
import java.net.URL;
import java.net.URLConnection;




public class Ayobot extends JFrame
{
private Toolkit toolkit;
private JPopupMenu menu;
private JLabel statusbar;
private JLabel view;
private JMenuItem menuItemBeep;
private JMenuItem menuItemClose;
private JCheckBoxMenuItem sbar;
private JToolBar botTb1; 
private JCheckBoxMenuItem viewsbar;
private JTextPane tp;
private JPanel openPanel;
private JMenuBar botMb;
private JMenu file;
private JMenu viewMenu;
private JMenu windowMenu;
private JMenu helpMenu;
private final String currentFile = null;
public  ImageIcon pubIcon;
public  ImageIcon icon;

public Ayobot(String title)
{
   super(title);
   this.initUI();
}

    private  void initUI()
   {
   tp = new JTextPane();
   icon = new ImageIcon(getClass().getResource("student.png"));
   toolkit = this.getToolkit();
   menu = new JPopupMenu();
   menuItemBeep = new JMenuItem("Beep",icon);
   menuItemClose = new JMenuItem("Close",icon);
   menu.add(menuItemBeep);
   menu.add(menuItemClose);
   sbar = new JCheckBoxMenuItem("Show StartuBar",icon);
   sbar.setState(true);
   botTb1 =  new JToolBar();
   viewsbar = new JCheckBoxMenuItem("tool bars",icon);
   viewsbar.setState(true);
   statusbar= new JLabel("<html> Progammed by <font color=red><b>Olorunlogbon Ayo Samuel.</b></font><html>");
   add(statusbar,BorderLayout.SOUTH); 
   openPanel = new JPanel();
   openPanel.setLayout(new BorderLayout());
   add(openPanel);
   botMb =  new JMenuBar();
   setJMenuBar(botMb);
   file = new JMenu("File");
   file.setMnemonic(KeyEvent.VK_F);
   viewMenu = new JMenu("View");
   windowMenu = new JMenu("Window");
   helpMenu = new JMenu("Help");
   botMb.add(file);
   botMb.add(viewMenu);
   botMb.add(windowMenu);
   botMb.add(helpMenu);
   JMenuItem botMi1 = new JMenuItem("new",icon);
   botMi1.setAccelerator(KeyStroke.getKeyStroke(KeyEvent.VK_N,ActionEvent.CTRL_MASK));
   JMenuItem botMi2 = new JMenuItem("Open...",icon);
   botMi2.setAccelerator(KeyStroke.getKeyStroke(KeyEvent.VK_O,ActionEvent.CTRL_MASK));
   JMenuItem botMi3 = new JMenuItem("Save",icon);
   botMi3.setAccelerator(KeyStroke.getKeyStroke(KeyEvent.VK_S,ActionEvent.CTRL_MASK));
   JMenuItem botMi4 = new JMenuItem("Save as...",icon);
   JMenuItem botMi5 = new JMenuItem("Exit",icon);
   botMi5.setToolTipText("Exit application");
   botMi5.setAccelerator(KeyStroke.getKeyStroke(KeyEvent.VK_W,ActionEvent.CTRL_MASK));
   JMenu botMi6 = new JMenu("import");
   JMenuItem botMi7 = new JMenuItem("import html...",icon);
   JMenuItem botMi8 = new JMenuItem("import php...",icon);
   JMenuItem botMi9 = new JMenuItem("Bookmarks",icon);
   JMenuItem aboutbot = new JMenuItem ("About Ayobot ",icon);
   botMi6.add(botMi7);
   botMi6.add(botMi8);
   botMi6.add(botMi9);
   helpMenu.add(aboutbot);
   viewMenu.add(viewsbar);
   viewMenu.add(sbar);
   file.add(botMi1);
   file.add(botMi2);
   file.add(botMi3);                           
   file.add(botMi4);
   file.addSeparator();
   file.add(botMi6);
   file.addSeparator();
   file.add(botMi5);
   //JTextArea ta = new JTextArea();
   JScrollPane scrolBar = new JScrollPane();
   scrolBar.getViewport().add(tp);
   JPanel botPanel1 = new JPanel();
   //JPanel botPanel2 = new JPanel();
   JToolBar botTb2 = new JToolBar();
   botPanel1.add(scrolBar);
   this.getContentPane().add(scrolBar);
   this.getContentPane().add(BorderLayout.EAST,botTb1);
   JButton quitButton = new JButton("Quit");
   botTb1.add(quitButton);
   this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
  //this.setTitle("Ayobot");
   this.setSize(600,600);
   this.setResizable(true);
   this.setLocationRelativeTo(null);

   
   
   menuItemBeep.addActionListener(new ActionListener()
  {

 @Override
 public void
  actionPerformed(ActionEvent e)
    {  
    toolkit.beep();
    send();
    }
 }

); 

menuItemClose.addActionListener(new ActionListener()
  {
 @Override
 public void actionPerformed(ActionEvent e)
    {
      System.exit(0);
    }   
 }
);


tp.addMouseListener(new MouseAdapter()
{
  @Override
  public void
  mouseReleased(MouseEvent e)
 {
  if(e.getButton()==MouseEvent.BUTTON3)
   {
   menu.show(e.getComponent(),e.getX(),e.getY());
   }
 }
});


sbar.addActionListener(new ActionListener()
{

 @Override
 public void
    actionPerformed(ActionEvent event)
  { 
    if(statusbar.isVisible())
     { statusbar.setVisible(false);
     }

    else
     {
      statusbar.setVisible(true);
      }
  }
}
);









 viewsbar.addActionListener(new ActionListener()
{

 @Override
 public void
    actionPerformed(ActionEvent event)
  { 
    if(botTb1.isVisible())
     { botTb1.setVisible(false);
     }

    else
     {
      botTb1.setVisible(true);
      }
  }
}
);






















botMi2.addActionListener(new ActionListener()
 { 
      @Override
      public void
      actionPerformed(ActionEvent event)
    {
         JFileChooser fileopen = new JFileChooser();
fileopen.setDialogTitle("Specify a file to open");
          FileFilter filter = new FileNameExtensionFilter("c files","c");
        fileopen.addChoosableFileFilter(filter);
        int ret = fileopen.showDialog(openPanel,"Open file");
     if (ret==JFileChooser.APPROVE_OPTION)
       {
        File file =
        fileopen.getSelectedFile();
        //System.out.println(file);
        String text = readFile(file);
        tp.setText(text);
       }
    }
  }
 );


























botMi3.addActionListener(new ActionListener() {

                        @Override
			public void actionPerformed(ActionEvent event) 
{






		JFileChooser fileChooser = new JFileChooser();
		fileChooser.setDialogTitle("Specify a file to save");
               
		int userSelection = fileChooser.showDialog(openPanel,"save file");
		if (userSelection == JFileChooser.APPROVE_OPTION) 
                {
			File fileToSave = fileChooser.getSelectedFile();
			System.out.println("Save as file: " +                         fileToSave.getAbsolutePath());
		}
	








				//showSaveFileDialog();
			
}
		});
















}


public static void send() 
{

try {
// make json string, try also hamburger
String json = "{\"name\":\"Frank\",\"food\":\"pizza\",\"quantity\":3}";

// send as http get request
URL url;
    url = new URL("http://localhost/a/pizzaservice.php?order="+json);
URLConnection conn = url.openConnection();

// Get the response
BufferedReader rd;
    rd = new BufferedReader(new InputStreamReader(conn.getInputStream()));
String line;
while ((line = rd.readLine()) != null) 
{
    
    //tp.setText(line);
System.out.println(line);
}
rd.close();
} catch (IOException e) 
{
}
}
public static void main (String []args)

{









SwingUtilities.invokeLater(new Runnable()
{@Override
 public void run()
 { 
     Ayobot ayobot;
 ayobot = new Ayobot("Ayobot");
 ayobot.setVisible(true);
 }
}
);

}




 public String readFile(File file)
 
  { 
    StringBuffer fileBuffer;
    fileBuffer = null;
    String fileString;
    fileString = null;
    String line;
    line = null;
  


 try {
       FileReader in;
        in = new FileReader(file);
       BufferedReader brd = new BufferedReader(in);
     fileBuffer = new StringBuffer();
   while ((line= brd.readLine())!=null)
{
 fileBuffer.append(line).append( System.getProperty("line.separator"));
}
 in.close();
 fileString = fileBuffer.toString();
}
  catch (IOException e)
  {  
   return null;
  }

return fileString;




}

}