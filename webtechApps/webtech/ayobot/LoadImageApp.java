package ayobot;

/*
 * Copyright (c) 1995, 2008, Oracle and/or its affiliates. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   - Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   - Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *
 *   - Neither the name of Oracle or the names of its
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */ 


import java.awt.*;
import java.awt.event.*;
import java.awt.image.*;
import java.io.*;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.*;
import javax.swing.*;
import static sun.applet.AppletResourceLoader.getImage;

/**
 * This class demonstrates how to load an Image from an external file
 */
public class LoadImageApp extends Component 
{
          
    BufferedImage img;
    private Image serverImg;
    
    public void paint(Graphics g) {
        //g.drawImage(serverImg, 0, 0, null);
        g.drawImage(serverImg, 0, 0, 30, 30, 0, 0, serverImg.getWidth(this), serverImg.getHeight(this), null);
    }

    public LoadImageApp() 
    {
        try {
            //serverImg = getImage(new URL("http://localhost/fitechbot/sms/uploads/oba/oba.jpg"));
            serverImg= ImageIO.read(new URL("http://localhost/fitechbot/sms/uploads/oba/oba.jpg"));
            serverImg.getWidth(null);
            //System.out.println(serverImg.toString());
        } catch (IOException ex) {
            Logger.getLogger(LoadImageApp.class.getName()).log(Level.SEVERE, null, ex);
        } 
       
       try {
           img = ImageIO.read(new File("student.png"));
           //System.out.println(img.getWidth(null));
       } catch (IOException e) 
       {
       System.out.println(e);
       }

    }

    public Dimension getPreferredSize() {
        if (serverImg == null) {
             return new Dimension(100,100);
        } else {
            System.out.println(serverImg.getHeight(this));
           return new Dimension(serverImg.getWidth(null), serverImg.getHeight(null));
       }
    }

    public static void main(String[] args) {

        JFrame f = new JFrame("Load Image Sample");
            
        f.addWindowListener(new WindowAdapter(){
                public void windowClosing(WindowEvent e) {
                    System.exit(0);
                }
            });

        f.add(new LoadImageApp());
        f.pack();
        f.setVisible(true);
    }
}

