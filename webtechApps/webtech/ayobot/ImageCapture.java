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
public class ImageCapture 
{
public String captureImage(int picId){

    FrameGrabbingControl ControlFG = (FrameGrabbingControl)

    broadcast.getControl("javax.media.control.FrameGrabbingControl");

    Buffer buffer = ControlFG.grabFrame();

    BufferToImage image = new BufferToImage((VideoFormat)buffer.getFormat());

    img = image.createImage(buffer);

    path="c:\\employee"+picId+".jpg";

    saveJPG(img,path);//method will save the image

    return path;

}

 public void saveJPG(Image img, String s){***//method will save the image***

    System.out.println(s);

    BufferedImage bi = new BufferedImage(img.getWidth(null), img.getHeight(null),

    BufferedImage.TYPE_INT_RGB);

    Graphics2D g2 = bi.createGraphics();

    g2.drawImage(img,null,null);

    FileOutputStream out = null;
    try{

    out = new FileOutputStream(s);

    }
    catch (java.io.FileNotFoundException io){

    System.out.println("File Not Found");
    }
}
