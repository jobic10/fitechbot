package ayobot;

import java.awt.*;
import java.awt.image.*;
import java.io.*;
import java.net.URL;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.*;
import javax.swing.*;


public class GetThumb extends JComponent 
{
          
    BufferedImage img;
    private Image serverImg;
    private int resizeHeight;
    private int resizeWidth;
    
    @Override
    public void paint(Graphics g) 
    {
        //g.drawImage(serverImg, 0, 0, null);
        g.drawImage(serverImg, 0, 0, resizeWidth, resizeHeight, 0, 0, serverImg.getWidth(this), serverImg.getHeight(this), null);
    }

    public GetThumb(String uri,int w,int h) 
    {
           resizeHeight=h;
           resizeWidth=w;
        try {
            //serverImg = getImage(new URL("http://localhost/fitechbot/sms/uploads/oba/oba.jpg"));
            if(uri==null || uri.trim().isEmpty())
            {
             uri="http://localhost/fitechbot/chat/default/thumbanon.jpg";
            }
            serverImg= ImageIO.read(new URL(uri));
            serverImg.getWidth(null);
            
            //System.out.println(serverImg.toString());
        } catch (IOException ex) {
            Logger.getLogger(LoadImageApp.class.getName()).log(Level.SEVERE, null, ex);
        } 
 
    }

    
    @Override
    public Dimension getPreferredSize() 
    {
        if (serverImg == null) 
        {
             return new Dimension(50,50);
        } 
        else 
        {
            System.out.println(serverImg.getHeight(this));
           return new Dimension(resizeWidth, resizeHeight);
       }
    }

}

