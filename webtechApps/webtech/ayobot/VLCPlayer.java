/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package ayobot;

/**
 *
 * @author CountryBoy
 */
//import uk.co.caprica.vlcj.player.AudioDevice;
import com.sun.jna.Native;
import com.sun.jna.NativeLibrary;
import javax.swing.JFrame;
import javax.swing.SwingUtilities;
import uk.co.caprica.vlcj.binding.LibVlc;
import uk.co.caprica.vlcj.component.EmbeddedMediaPlayerComponent;
import uk.co.caprica.vlcj.player.embedded.EmbeddedMediaPlayer;
import uk.co.caprica.vlcj.runtime.RuntimeUtil;

public class VLCPlayer {

private EmbeddedMediaPlayerComponent mediaPlayerComponent;

//This is the path for libvlc.dll
static String VLCLIBPATH = "C:\\Program Files\\VideoLAN\\VLC";
public static void main(String[] args) {
NativeLibrary.addSearchPath(RuntimeUtil.getLibVlcLibraryName(), VLCLIBPATH);
    LibVlc loadLibrary;
    loadLibrary = Native.loadLibrary(RuntimeUtil.getLibVlcLibraryName(), LibVlc.class);
 
SwingUtilities.invokeLater(new Runnable() {
@Override
public void run() 
{
VLCPlayer vlcPlayer = new VLCPlayer();
}
});

}
private VLCPlayer() 
{

//MAXIMIZE TO SCREEN
java.awt.Dimension screenSize = java.awt.Toolkit.getDefaultToolkit().getScreenSize();

JFrame frame = new JFrame("VLC Player");

mediaPlayerComponent = new EmbeddedMediaPlayerComponent();
frame.setContentPane(mediaPlayerComponent);

frame.setLocation(0, 0);
frame.setSize(screenSize.width, screenSize.height);
frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
frame.setVisible(true);

mediaPlayerComponent.getMediaPlayer().playMedia("c.mp4");//Movie name which want to play
}

    private VLCPlayer(String fedora) {
        //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
}