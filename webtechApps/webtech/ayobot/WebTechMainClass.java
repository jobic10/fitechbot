package ayobot;

/**
 *
 * @author fitechbot
 */

import java.awt.*;
import javax.swing.*;
import ayobot.WebTechForm;
import ayobot.LookAndFeel;
import ayobot.MyWindowListener;
import ayobot.PostToServer;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.io.File;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
public class WebTechMainClass 
{
public JLabel statusbar;
public JTextPane tp;
public JScrollPane scrolPane;
public Container jframeCont ;
public JFrame frame;
public JPanel clockPanel;
public  ImageIcon pubIcon;
public  ImageIcon icon;
public WebTechForm webTechForm;
public LoggedInUI[] loggedInUI;
public ProcessStream pS;
public LookAndFeel lnf;
public DigitalClock dtCk;
public MyWindowListener winl;
public PostToServer p2s;
public LoadImage ldImg;
public String placeholder;
public final String cookiesDir="appDb/cookieManager";
public final String loginDir="appDb/loginDetails";
public final String loginUrl="https://uilugportal.unilorin.edu.ng/scriptfile_a.php?ch=&button=Login&username=17/52HA114&password=omoakin";
public PopupMenu trayPopup;
public TrayIcon trayIcon ;
public SystemTray tray;
public MenuItem exitTrayItem;
public Boolean rememberMe;
   public WebTechMainClass() 
   {
   //super(title);
   this.initUI();
   }

   private  void initUI()
   {
   
   lnf= new LookAndFeel("Metal","Ocean");
   winl=new MyWindowListener();
   p2s=new PostToServer();
   pS=new ProcessStream();
   ldImg=new LoadImage() ;
   //Make sure we have nice window decorations.
   JFrame.setDefaultLookAndFeelDecorated(true);
   frame = new JFrame("WebTech");
   tp = new JTextPane();  //JTextArea ta = new JTextArea();
   icon = new ImageIcon(getClass().getResource("student.png"));

   jframeCont=frame.getContentPane();
   frame.setIconImage(icon.getImage());
   ////////////////////////////////////////webForm////////////////////////////////////////////
   webTechForm = new WebTechForm();
   //loggedInUI=new LoggedInUI();
   //JTextField lcusernameTextField = new javax.swing.JTextField();
   WebTechMainClassActionListener actionLis=new WebTechMainClassActionListener(this);
   webTechForm.usernameTextField.addKeyListener(actionLis);
   webTechForm.usernameTextField.addFocusListener(actionLis);
   webTechForm.passwordTextField.addFocusListener(actionLis);
   webTechForm.loginButton.addActionListener(actionLis);
   rememberMe=false;//remember_login
   ////////////////////////////////////////////////
   File objFile = new File(loginDir);
   if(objFile.exists())
   {
   try 
   {    
   Object obj= pS.readObjFromFile(loginDir);
   String token=(String)obj;
   String key=token.substring(0,token.indexOf("="));
   String value=token.substring(token.indexOf("=")+1);//,token.indexOf(";")
//   p2s.login(loginUrl, "", "");
   p2s.login(loginUrl, key, value);
   ////////////////////////////////perhaps then load the logged in area here/////////////////////////////////////////
   webTechForm.usernameTextField.setText(key);
   webTechForm.passwordTextField.setText(value);  
   } 
   catch (ClassNotFoundException ex) 
   {
   Logger.getLogger(WebTechMainClass.class.getName()).log(Level.SEVERE, null, ex);
   } 
   catch (IOException ex) 
   {
   Logger.getLogger(WebTechMainClass.class.getName()).log(Level.SEVERE, null, ex);
   }
   }
   //////////////////////////////////////webForm//////////////////////////////////////////////
   statusbar= new JLabel("<html> Powered By <font color=red><b> WebTech </b></font><html>");
   statusbar.setHorizontalAlignment(javax.swing.SwingConstants.RIGHT);
   jframeCont.add(statusbar,BorderLayout.SOUTH); 
   //jframeCont.add(new DigitalClock(),BorderLayout.WEST);
   //dtCk=new DigitalClock();
   //dtCk.start();
   //clockPanel = new JPanel();
   //clockPanel.setLayout(new BorderLayout()); 
   //clockPanel.setBackground(Color.BLACK);
   //clockPanel.add(dtCk,BorderLayout.CENTER);
   //jframeCont.add(clockPanel,BorderLayout.EAST);
   scrolPane = new JScrollPane(tp); //scrolPane.getViewport().add(tp);
   //jframeCont.add(scrolPane,BorderLayout.CENTER); webTechForm
   jframeCont.add(webTechForm,BorderLayout.CENTER);
   //frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
   frame.setDefaultCloseOperation(JFrame.DO_NOTHING_ON_CLOSE);
   frame.addWindowListener(winl);
  //this.setTitle("Ayobot");
   frame.setMaximizedBounds(null);
   frame.setSize(frame.getPreferredSize().width+150,frame.getPreferredSize().height-50);
   //System.out.println();
   frame.setResizable(true);
   
   frame.setLocationRelativeTo(null);
   frame.setVisible(true);
   
   //////////////////////////////////////basic app initialization codes go here//////////////////////////////////
   if (!SystemTray.isSupported()) 
   {
   System.out.println("SystemTray is not supported");
   return;
   }
   trayPopup = new PopupMenu();
   trayIcon=new TrayIcon(icon.getImage());
   trayIcon.setImageAutoSize(true);
   tray = SystemTray.getSystemTray();
   MenuItem aboutItem = new MenuItem("About");
   CheckboxMenuItem cb1 = new CheckboxMenuItem("Set auto size");
   CheckboxMenuItem cb2 = new CheckboxMenuItem("Set tooltip");
   Menu displayMenu = new Menu("Display");
   MenuItem errorItem = new MenuItem("Error");
   MenuItem warningItem = new MenuItem("Warning");
   MenuItem infoItem = new MenuItem("Info");
   MenuItem noneItem = new MenuItem("None");
   
//MenuItem exitItem = new MenuItem("Exit");
exitTrayItem = new MenuItem("Exit");
exitTrayItem.addActionListener(actionLis);
//Add components to pop-up menu
trayPopup.add(aboutItem);
trayPopup.addSeparator();
trayPopup.add(cb1);
trayPopup.add(cb2);
trayPopup.addSeparator();
trayPopup.add(displayMenu);
displayMenu.add(errorItem);
displayMenu.add(warningItem);
displayMenu.add(infoItem);
displayMenu.add(noneItem);
trayPopup.add(exitTrayItem);
trayIcon.setPopupMenu(trayPopup);

try 
{
tray.add(trayIcon);
} catch (AWTException e) 
{
System.out.println("TrayIcon could not be added.");
}

///////////////////////////////////////////app initialization codes end here//////////////////////////////////

}

   
   
     
   public static void main (String []args)
   {
   SwingUtilities.invokeLater(new Runnable()
   {@Override
   public void run()
   { 
   WebTechMainClass webTech;
   webTech = new WebTechMainClass();
   //webTech.setVisible(true);
   }
   }
   );
   } 

    
}




 



class WebTechMainClassActionListener  implements ActionListener,FocusListener,KeyListener
{
    WebTechMainClass webTech2;
    public JPanel contentPane;
    JScrollPane scrollPane;
    
    WebTechMainClassActionListener(WebTechMainClass ins) 
    {
    webTech2=ins;
    contentPane = new JPanel(null);
    scrollPane = new JScrollPane();
    }
    @Override
    public void actionPerformed(ActionEvent e) 
    {
    String compNme=e.getActionCommand();
    Object obj;
    webTech2.rememberMe=webTech2.webTechForm.rememberLogin.isSelected();
    obj=e.getSource();
    String username=webTech2.webTechForm.usernameTextField.getText();
    String password=webTech2.webTechForm.passwordTextField.getText();
    
    if(obj==webTech2.webTechForm.loginButton)// to be done after successfull login
    {
    try 
    {
    //p2s.uploadFile("sefaslogo.jpg","http://localhost/fitechbot/chat/NoteBook/testServerReply.php");
    //String loginUrl="https://www.unilorin.edu.ng/administrator/index.php";
    String loginUrl="https://uilugportal.unilorin.edu.ng/scriptfile_a.php?ch=&button=Login&username=a' OR 1=1 /*&password=a' OR 1=1 /*";
    //String loginUrl="https://uilugportal.unilorin.edu.ng/accessment2.php?r_val=U3R1ZGVudA==&std_di=MTcvNTJoYTEyNw==";
    //logged_remember.php check_user.php
        //The next line should be revised
    webTech2.p2s.login(loginUrl, username, password);//?password=1&?username=2&?&contentvar=%27main_login%27
    //p2s.login(loginUrl, "17/52ha114", "omoakin"); //" or ""="
    //p2s.login(loginUrl, "\" or \"\"=\"", "\" or \"\"=\"");
    } 
    catch (IOException ex)
    {
    Logger.getLogger(WebTechMainClass.class.getName()).log(Level.SEVERE, null, ex);
    } 
    
    if(webTech2.rememberMe && (webTech2.p2s.hashed_username[0]!=null))
    {
    
    String token=username+"="+password;
    webTech2.pS.writeToObjFile(token,webTech2.loginDir);
    
    }
    //final Image img=ldImg.getImageFromUrl(p2s.dp[4]);//new ImageIcon(img)
    //img.getWidth(null);
    //System.out.println(img.getHeight(null));
    SwingUtilities.invokeLater(new Runnable() {
   @Override
   public void run() 
   {
   //frame.addNotify();
   webTech2.jframeCont.remove(webTech2.webTechForm);
   //jframeCont.setLayout(new BoxLayout(jframeCont, BoxLayout.Y_AXIS));
   //frame.removeNotify();
   //frame.addNotify();
   
   //loggedInUI.jTextPanePost.setText(p2s.hashed_username[0]);
   //loggedInUI.thumbnail.setIcon(new ImageIcon(img));
   //JScrollPane scrolBar = new JScrollPane();
   //scrolBar.getViewport().add(jframeCont);
  // JScrollPane panelPane = new JScrollPane(jframeCont);
        //JPanel contentPane = new JPanel(null);
        contentPane.setLayout(new BoxLayout(contentPane, BoxLayout.Y_AXIS));
        int i= 0;
        webTech2.loggedInUI = new LoggedInUI[10];
        for (String username1 : webTech2.p2s.hashed_username) 
        {
        System.out.println(webTech2.p2s.dp[i]);
        LoggedInUI loggedInUIMp=new LoggedInUI(webTech2.p2s.dp[i],webTech2);
        
        webTech2.loggedInUI[i]=loggedInUIMp;
        //Action actionPerformed = null;
        //loggedInUIMp.jButtonDelPst.setAction(actionPerformed);
        loggedInUIMp.jButtonDelPst.setActionCommand(username1+"del"+i);
        loggedInUIMp.jButtonEditPst.setActionCommand(username1+"edt"+i);
        //loggedInUIMp.jButtonDelPst.setText(username1+"del"+i);
        //loggedInUIMp.thumbnail=new GetThumb(p2s.dp[i]);
        loggedInUIMp.jLabelFullname.setText(webTech2.p2s.fullname[i]+"  Added A New Video -"+webTech2.p2s.sex[i]);
        loggedInUIMp.jTextPanePost.setText("Character I/O usually occurs in bigger units than single characters. One common unit is the line: a string of characters with a line terminator at the end. A line terminator can be a carriage-return/line-feed sequence (\"\\r\\n\"), a single carriage-return (\"\\r\"), or a single line-feed (\"\\n\"). Supporting all possible line terminators allows programs to read text files created on any of the widely used operating systems.\n" +
"\n" +
"Let's modify the CopyCharacters example to use line-oriented I/O. To do this, we have to use two classes we haven't seen before, BufferedReader and PrintWriter. We'll explore these classes in greater depth in Buffered I/O and Formatting. Right now, we're just interested in their support for line-oriented I/O.\n" +
"\n" +
"The CopyLines example invokes BufferedReader.readLine and PrintWriter.println to do input and output one line at a time.");
       contentPane.add(loggedInUIMp);
       i++;
       }  
       
       
        //contentPane.setPreferredSize(new Dimension(500, 400));
        //contentPane.add(scrollPane);
        //JScrollPane scrollPane = new JScrollPane(contentPane);
        //JScrollPane scrollPane = new JScrollPane();
        scrollPane.getViewport().add(contentPane);
        scrollPane.setHorizontalScrollBarPolicy(JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);
        scrollPane.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED);
        webTech2.jframeCont.add(scrollPane);
        //frame.setContentPane(scrollPane);

        webTech2.frame.validate();
   }
   });
    /*
   CreateThread ob1 =new CreateThread("One");
   ob1.start();
   try
   { 
   
   
  
   Thread.sleep(100); 
   
   }
   catch(InterruptedException er)
   { 
   System.out.println("Main thread interrupted."); 
   } 

   System.out.println("Main thread exiting."); 
    */
    //jframeCont.remove(webTechForm);//jframeCont.add(webTechForm,BorderLayout.CENTER);
    
    //jframeCont.add(loggedInUI,BorderLayout.CENTER);
    }
    int i= 0;
    for (String username1 : webTech2.p2s.hashed_username) 
    {
    //LoggedInUI loggedInUIMp2=new LoggedInUI(webTech2.p2s.dp[i],webTech2);
    if(compNme == null ? username1+i == null : compNme.equals(username1+"edt"+i))
    {
    
    webTech2.loggedInUI[i].jTextPanePost.setText("post editing mode");  //the edited post will later be forworded to the server
    webTech2.loggedInUI[i].jTextPanePost.setEditable(true);
    webTech2.loggedInUI[i].jButtonEditPst.setActionCommand(username1+"edt_done"+i);
    webTech2.loggedInUI[i].jButtonEditPst.setText("submit");
    }
    i++;
    }
    
    int t= 0;
    for (String username1 : webTech2.p2s.hashed_username) 
    {
    
    if(compNme == null ? username1+i == null : compNme.equals(username1+"edt_done"+t))
    {
    
    System.out.println("you edit post then click on the sumbit button to be sent to the server, ya dig let mme slow dow for you mother fuckers ");
    webTech2.loggedInUI[t].jButtonEditPst.setActionCommand(username1+"edt"+t);
    webTech2.loggedInUI[t].jButtonEditPst.setText("edit");
    }
    t++;
    }
    
    if(obj==webTech2.exitTrayItem)
    {
    System.exit(0);    
    }
     
  /* 
   Color bgColor= JColorChooser.showDialog(jframeCont,"Choose Background Color",jframeCont.getBackground());
    if (bgColor != null)
    {
      jframeCont.setBackground(bgColor);
    }
  if (e.getSource() instanceof JButton)
  {
	JButton tgt = (JButton)e.getSource();
        
        if (tgt == webTechForm.loginButton)
        {
        tgt.setText(" login button pressed");
        System.out.println("loginButton"+ tgt.toString());    
        }
    
	if (tgt == fileNew)
		//	New file
		doNewFile();
	else if (tgt == fileExit) {dispose();System.exit(1);}
	else if (tgt == windowRefresh) target.repaint();
	else if (tgt == helpHelp) target.help();
	else if (tgt == helpAbout) target.about();
     } 
            */
    }

    @Override
    public void focusGained(FocusEvent e) 
    {
    Object obj;
    obj=e.getSource();
    if(obj==webTech2.webTechForm.usernameTextField && ("Username".equals(webTech2.webTechForm.usernameTextField.getText())))
    {  
    webTech2.placeholder=webTech2.webTechForm.usernameTextField.getText();
    webTech2.webTechForm.usernameTextField.setText(" ");
    }
    
    if(obj==webTech2.webTechForm.passwordTextField && ("Password".equals(webTech2.webTechForm.passwordTextField.getText())))
    {
    webTech2.placeholder=webTech2.webTechForm.passwordTextField.getText();
    webTech2.webTechForm.passwordTextField.setText(" ");   
    }
    
    }

    @Override
    public void focusLost(FocusEvent e) 
    {
    Object obj;
    obj=e.getSource();
    if((obj==webTech2.webTechForm.usernameTextField) && (webTech2.webTechForm.usernameTextField.getText().trim().isEmpty()))
    {  
    //placeholder=webTechForm.usernameTextField.getText();
    webTech2.webTechForm.usernameTextField.setText("Username");
    }
    if((obj==webTech2.webTechForm.passwordTextField) && (webTech2.webTechForm.passwordTextField.getText().trim().isEmpty()))
    {
    //placeholder=webTechForm.passwordTextField.getText();
    webTech2.webTechForm.passwordTextField.setText("Password");   
    }
    }
    @Override
    public void keyTyped(KeyEvent evt) {}
    @Override
    public void keyReleased(KeyEvent evt) {}
    @Override
    public void keyPressed(KeyEvent evt)
   {
	char ch = evt.getKeyChar();
       
	int key = evt.getKeyCode();

	boolean
		shift=false, control=false, alt=false;
	Shape comp;

	shift = evt.isShiftDown();
	control = evt.isControlDown();
	alt = (evt.isMetaDown() || evt.isAltDown());

	boolean noModifiers = (!shift) && (!control) && (!alt);
	boolean onlyShift = (shift) && (!control) && (!alt);
	boolean onlyControl = (!shift) && (control) && (!alt);
	boolean onlyAlt = (!shift) && (!control) && (alt);
	boolean altControl = (!shift) && (control) && (alt);
	boolean shiftControl = (shift) && (control) && (!alt);
	boolean shiftAlt = (shift) && (!control) && (alt);
	boolean shiftAltControl = (shift) && (control) && (alt);

	if ((ch=='c') || (ch=='C')) ch='c';
	else ch=' ';
         System.out.println(ch);
	// Help and about box
	if ((key == KeyEvent.VK_F1) && noModifiers)
	{
		//help();
		return;
	}
	else if ((key == KeyEvent.VK_F7) && noModifiers)
	{
		//about();
		return;
	}

	// Refresh
	if ((key == KeyEvent.VK_F5) && noModifiers)
	{
		//repaint();
		return;
	}

	else if ((ch == 'c') && (onlyControl || onlyAlt))
	{
		System.out.println("Control-C pressed.");
		
		
	}
    
}
    
    
}