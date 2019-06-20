

//import java.awt.event.ActionListener;

//import javax.swing.JFrame;

//import javax.swing.SwingUtilities;

import javax.swing.*;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import java.awt.*;
import javax.swing.border.EtchedBorder;
import java.awt.event.*;
import java.awt.event.MouseAdapter;

import java.awt.event.MouseEvent;

public class Example extends JFrame
{
 private JLabel statusbar;


  public Example()
 
   {

  initUI();

  }

public final void initUI()

{


JMenuBar menubar = new JMenuBar();
ImageIcon icon = new ImageIcon(getClass().getResource("exit.png"));
JMenu file = new JMenu("File");
file.setMnemonic(KeyEvent.VK_F);
JCheckBoxMenuItem sbar = new JCheckBoxMenuItem("Show StartuBar");
sbar.setState(true);
sbar.addActionListener(new ActionListener()
{

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
file.add(sbar);
statusbar= new JLabel("Statusbar");
statusbar.setBorder(BorderFactory.createEtchedBorder(EtchedBorder.RAISED));
add(statusbar,BorderLayout.SOUTH); 














JMenu imp = new JMenu("Import");
imp.setMnemonic(KeyEvent.VK_M);

JMenuItem newsf = new JMenuItem("Import newsfeed list...");


JMenuItem mail = new JMenuItem("Import mail...");


JMenuItem bookm = new JMenuItem("Import Bookmarks...");
imp.add(newsf);
imp.add(bookm);
imp.add(mail);
JMenuItem fileNew = new JMenuItem("New",icon);
fileNew.setMnemonic(KeyEvent.VK_N);




JMenuItem fileOpen = new JMenuItem("Open",icon);
fileOpen.setMnemonic(KeyEvent.VK_O);


JMenuItem fileSave = new JMenuItem("Save",icon);
fileSave.setMnemonic(KeyEvent.VK_S);












JMenuItem fileExit = new JMenuItem("Exit",icon);
fileExit.setMnemonic(KeyEvent.VK_C);
fileExit.setToolTipText("Exit application");



fileExit.setAccelerator(KeyStroke.getKeyStroke(KeyEvent.VK_W,ActionEvent.CTRL_MASK));





fileExit.addActionListener(new ActionListener()
{

 public void
actionPerformed(ActionEvent event)
 {
   System.exit(0);
 }
}
);
file.add(fileNew);
file.add(fileOpen);
file.add(fileSave);
file.addSeparator();
file.add(imp);
file.addSeparator();
file.add(fileExit);
menubar.add(file);
//menubar.add(imp);
setJMenuBar(menubar);

 setTitle("Simple menu");
    setSize(360,250);
    setLocationRelativeTo(null);
setDefaultCloseOperation(EXIT_ON_CLOSE);

}



public static void main (String []args)


{

SwingUtilities.invokeLater(new Runnable()


  { 
   public void run()
     {
       Example ex = new Example();
        ex.setVisible(true);
     }
  }
);


}

}











/*











JPanel panel = new JPanel();



//getContentPane().add(BorderLayout.EAST,panel);



getContentPane().add(panel);
panel.setLayout(null);
panel.setToolTipText("A Panel Container");
JButton quitButton = new JButton("Quit");
quitButton.setBounds(100,60,100,30);
quitButton.setToolTipText("A button");

quitButton.addActionListener(new ActionListener()
  {

 public void actionPerformed(ActionEvent event)
    {
      System.exit(0);
    }   
 }
);


panel.add(quitButton);




   
    setTitle("Quit Button");
    setSize(300,200);
    setLocationRelativeTo(null);

setDefaultCloseOperation(EXIT_ON_CLOSE);

}

public static void main (String []args)


{

SwingUtilities.invokeLater(new Runnable()


  { 
   public void run()
     {
       Example ex = new Example();
        ex.setVisible(true);
     }
  }
);


}

}
*/