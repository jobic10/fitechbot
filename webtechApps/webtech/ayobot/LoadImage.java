package ayobot;
import java.awt.Image;
import java.awt.image.*;
import java.io.*;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.*;
import static sun.applet.AppletResourceLoader.getImage;

/**
 * This class demonstrates how to load an Image from an external file
 */
public class LoadImage 
{
          
    private BufferedImage img;
    private Image serverImg;
    //private final String imgName;
    public LoadImage()//(String imgName)
    {
    //this.imgName=imgName;
    //Image img = getImage(new URL(“http://www.server.com/files/image.gif”));
    
    }
   
    public BufferedImage getImageFromDir(String dir)
    {
    try 
    {
    img = ImageIO.read(new File(dir));//"http://www.server.com/files/image.gif"
    } 
    catch (IOException e) 
    {
    System.out.println(e);
    }
    return img;
    }
    
    public Image getImageFromUrl(String uri)
    {
    try 
    {
    serverImg = getImage(new URL(uri));
    } 
    catch (MalformedURLException ex) 
    {
    Logger.getLogger(LoadImageApp.class.getName()).log(Level.SEVERE, null, ex);
    }
    return serverImg;
    }
}

