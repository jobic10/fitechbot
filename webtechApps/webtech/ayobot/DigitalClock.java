package ayobot;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Font;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.Date;
import javax.imageio.ImageIO;
import javax.swing.JComponent;

public class DigitalClock extends JComponent implements Runnable
{
   Font theFont;
   Date theDate;
   Thread runner;
   BufferedImage img;
   Color colors[];
   public DigitalClock(  )
   {
   theFont = new Font("TimesRoman",Font.BOLD,24);
   colors = new Color[50];
   try {
           img = ImageIO.read(new File("student.png"));
       } catch (IOException e) 
       {
       System.out.println(e);
       }
   }
   
   public void start() 
   {
   if (runner == null) 
   {
   runner = new Thread(this,"Ditial Clock Thread");
   
   runner.start();
   }
   }
   
   public void stop() 
   {
   if (runner != null) 
   {
   //runner.stop();
   runner = null;
   }
   }
    @Override
    public Dimension getPreferredSize() {
        if (img == null) {
             return new Dimension(100,100);
        } else 
        {
            return new Dimension(300,200);
           //return new Dimension(img.getWidth(null), img.getHeight(null));
       }
    }
    /*
    @Override
    public void paint(Graphics g) 
    {
        g.drawImage(img, 0, 0, null);
    }

    */
    @Override
    public void paint(Graphics g) 
    {
    g.setFont(theFont);
    g.drawString(theDate.toString(),10,50);
    }
    
    @Override
    public void update(Graphics g) 
    {
    paint(g);
    }
    
    @Override
    public void run() 
    {
    // initialize the color array
    float c = 0;
    for (int i = 0; i < colors.length; i++) 
    {
    colors[i] =
    Color.getHSBColor(c, (float)1.0,(float)1.0);
    c += .02;
    }
    int i = 0; 
    while (true) 
    {
    //////////////////////////////////////////
    setForeground(colors[i]);
    theDate = new Date();
    repaint();
    ///////////////////////////////////////////
    i++;
    try 
    { 
    Thread.sleep(1000); 
    }
    catch (InterruptedException e) 
    { 
    System.out.println(e.toString());
    }
    if (i == colors.length ) i = 0;
    }
    }
}