package ayobot;

import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.ButtonGroup;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JRadioButton;
import javax.swing.SwingUtilities;
import javax.swing.UIManager;



	public class LookAndFeel3 {
		  protected JFrame jFrame;
		
		  protected Container cp;
		
		  /** Start with the Java look-and-feel, if possible */
		  final static String laf = "javax.swing.plaf.metal.MetalLookAndFeel";
		  static String windowLookandFeel = "com.sun.java.swing.plaf.windows.WindowsLookAndFeel";
		  static String motifLookandFeel = "com.sun.java.swing.plaf.motif.MotifLookAndFeel";
		  static String macLookandFeel = "com.sun.java.swing.plaf.mac.MacLookAndFeel";
		  static String metalLookandFeel = "javax.swing.plaf.metal.MetalLookAndFeel";
		
		  protected String curLF = laf;
		
		  protected JRadioButton jrbPrevButton;
		
		  /** Construct a program... */
		  public LookAndFeel3() {
		    super();
		    jFrame = new JFrame("Look and Feel");
		    jFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		    cp = jFrame.getContentPane();
		    cp.setLayout(new FlowLayout());
		
		    ButtonGroup bg = new ButtonGroup();
		
		    JRadioButton jrbJava = new JRadioButton("Java");
		    jrbJava.addActionListener(new LNFSetter(
		        metalLookandFeel, jrbJava)
		    );
	    	bg.add(jrbJava);
	    	cp.add(jrbJava);
		
		    JRadioButton jrbWindows = new JRadioButton("MS-Windows");
		    jrbWindows.addActionListener(new LNFSetter(
		    		windowLookandFeel, jrbWindows)
		    );
		    bg.add(jrbWindows);
		    cp.add(jrbWindows);
		
		    JRadioButton jrbMotif = new JRadioButton("Motif");
		    jrbMotif.addActionListener(new LNFSetter(
		    		motifLookandFeel, jrbMotif)
		    );
		    bg.add(jrbMotif);
		    cp.add(jrbMotif);
		
		    JRadioButton jrbMac = new JRadioButton("Sun-MacOS");
		    jrbMac.addActionListener(new LNFSetter(
		        macLookandFeel, jrbMac)
		    );
		    bg.add(jrbMac);
		    cp.add(jrbMac);
		
		    String defaultLookAndFeel = UIManager.getSystemLookAndFeelClassName();
		    // System.out.println(defaultLookAndFeel);
		    JRadioButton jrbDefault = new JRadioButton("Default");
		    jrbDefault.addActionListener(new LNFSetter(defaultLookAndFeel, jrbDefault)
		    );
		    bg.add(jrbDefault);
		    cp.add(jrbDefault);
		
		    (jrbPrevButton = jrbDefault).setSelected(true);
		
		    jFrame.pack();
		    jFrame.setVisible(true);
		  }
		
		  /* Class to set the Look and Feel on a frame */
		  class LNFSetter implements ActionListener {
		    String LAFName;
		    JRadioButton jrbThisButton;
		
		    /** Called to setup for button handling */
		    LNFSetter(String lnfName, JRadioButton jrbButton) {
		      LAFName = lnfName;
		      jrbThisButton = jrbButton;
		    }
		
		    /** Called when the button actually gets pressed. */
		    public void actionPerformed(ActionEvent e) {
		      try {
		        UIManager.setLookAndFeel(LAFName);
		        SwingUtilities.updateComponentTreeUI(jFrame);
		        jFrame.pack();
		      } catch (Exception evt) {
		    	  	JOptionPane.showMessageDialog(null,	  "setLookAndFeel didn't work: " + evt, 
		    	  					"Error", JOptionPane.WARNING_MESSAGE);
		    	  	jrbPrevButton.setSelected(true); // reset the GUI to previous look and feel
		      }
		      jrbPrevButton = jrbThisButton;
		    }
		  }
		
		  public static void main(String[] argv) {
			  new LookAndFeel3();
		  }
}